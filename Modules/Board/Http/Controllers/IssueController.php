<?php

namespace Modules\Board\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Issue;
use App\IssueStatus;
use App\Project;
use App\Priority;
use App\IssueLinkType;
use App\IssueLink;
use App\Invite;
use App\Label;
use App\Comment;
use App\ActivitiesLog;

class IssueController extends Controller
{
    public function browseIssue(Request $request)
    {
        $id = (int)$request->route('id');
        $findBug = Issue::find($id);
        $projectId = (int)$findBug->proj_id;
        $issueStatus = IssueStatus::getStatusByProjectID($projectId);
        $reporter = User::getUserInfo($findBug->reporter);
        $assignees = Invite::getAllByProjectAndType($projectId, ['2']);
        $firstLetter = Project::getFirstLetterName($projectId);
        $priorities = Priority::getAllPriority(['id', 'name']);
        $labels = Label::getAllLabel("*");
        $comments = Comment::getAllByIssue($id);
        $history = ActivitiesLog::getAllByIssue($id);

        $currentTime = Carbon::now();
        $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $findBug->created_at);
        $updatedAt = Carbon::createFromFormat('Y-m-d H:i:s', $findBug->updated_at);
        $createdTemp = $createdAt->diffForHumans($currentTime);
        $updatedTemp = $updatedAt->diffForHumans($currentTime);

        return view('board::browse-issue')
            ->with("bugDetail", $findBug)
            ->with("firstLetter", strtoupper($firstLetter))
            ->with("reporter", $reporter)
            ->with("assignees", $assignees)
            ->with("priorities", $priorities)
            ->with("labels", $labels)
            ->with("createdTemp", $createdTemp)
            ->with("updatedTemp", $updatedTemp)
            ->with("comments", $comments)
            ->with("history", $history)
            ->with("issueStatus", $issueStatus);
    }

    public function addComment(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $insertComment = [
                "user_id"       => Auth::id(),
                "proj_id"       => \Cookie::has('projectId') ? \Cookie::get('projectId') : 0,
                "issue_id"      => (int)$params['issueId'],
                "description"   => htmlentities(trim($params['comment']))
            ];

            Comment::create($insertComment);

            \Session::flash('success', 'Thêm bình luận thành công!');
            return response()->json(['error' => 0]);
        }
    }

    public function updateDescription(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $issueId = (int)$params['issueId'];
            $findIssue = Issue::find($issueId);
            if (!empty($findIssue)) {
                $oldDesc = $findIssue->description;
                $findIssue->description = htmlentities(trim($params['description']));
                $findIssue->save();
            }

            //Write log
            $logContent = [
                'issue_id'  => $issueId,
                'field'     => 2, //Desc
                'note'      => $oldDesc . " -> " . $findIssue->description
            ];
            \ActivityLog::writeLog($logContent, 2);
            return response()->json(['error' => 0]);
        }
    }

    public function updateAssignee(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $issueId = (int)$params['issueId'];
            $findIssue = Issue::find($issueId);
            if (!empty($findIssue)) {
                $oldAssignee = !empty($findIssue->assigneeinfo->full_name) ? $findIssue->assigneeinfo->full_name : "Unassign";
                $findIssue->assignee = (int)$params['assignee'];
                $findIssue->save();
            }

            //Write log
            $logContent = [
                'issue_id'  => $issueId,
                'field'     => 4, //Desc
                'note'      => $oldAssignee . " -> " . $findIssue->getFullNameById()
            ];
            \ActivityLog::writeLog($logContent, 2);
            return response()->json(['error' => 0]);
        }
    }

    public function updateStatus(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $issueId = (int)$params['issueId'];
            $findIssue = Issue::find($issueId);
            if (!empty($findIssue)) {
                $oldStatus = IssueStatus::getStatusName($findIssue->issue_status);
                $findIssue->issue_status = (int)$params['issueStatus'];
                $findIssue->save();
            }

            //Write log
            $logContent = [
                'issue_id'  => $issueId,
                'field'     => 3, //Desc
                'note'      => $oldStatus . " -> " . IssueStatus::getStatusName($findIssue->issue_status)
            ];
            \ActivityLog::writeLog($logContent, 2);
            return response()->json(['error' => 0]);
        }
    }

    public function updatePriority(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $issueId = (int)$params['issueId'];
            $findIssue = Issue::find($issueId);
            if (!empty($findIssue)) {
                $oldPriority = Priority::getPriorityName($findIssue->priority_id);
                $findIssue->priority_id = (int)$params['priorityId'];
                $findIssue->save();
            }

            //Write log
            $logContent = [
                'issue_id'  => $issueId,
                'field'     => 6, //Desc
                'note'      => $oldPriority . " -> " . Priority::getPriorityName($findIssue->priority_id)
            ];
            \ActivityLog::writeLog($logContent, 2);
            return response()->json(['error' => 0]);
        }
    }

    public function updateLabel(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $issueId = (int)$params['issueId'];
            if (empty($params['labels'])) {
                return response()->json(['error' => 1, 'message' => 'Không cập nhật được nhãn']);
            }

            $findIssue = Issue::find($issueId);
            $oldLabel = $findIssue->getOldLabelName();

            $labelToInsert = [];
            $newValue = [];
            foreach ($params['labels'] as $value) {
                $checkLabelExisted = Label::find($value);
                if (empty($checkLabelExisted)) {
                    $inserted = Label::create(['proj_id' => \Cookie::has('projectId') ? \Cookie::get('projectId') : 0, 'label' => trim($value)]);
                    $labelToInsert[] = $inserted->id;
                    $newValue[] = trim($value);
                } else {
                    $labelToInsert[] = $value;
                    $newValue[] = $checkLabelExisted->label;
                }
            };

            if (!empty($labelToInsert)) {
                $findIssue->label = implode(",", $labelToInsert);
                $findIssue->save();
                // Issue::where('id', $issueId)->update(['label'=>implode(",", $labelToInsert)]);
            }

            //Write log
            $logContent = [
                'issue_id'  => $issueId,
                'field'     => 5, //Desc
                'note'      => $oldLabel . " -> " . implode(",", $newValue)
            ];
            \ActivityLog::writeLog($logContent, 2);
            return response()->json(['error' => 0]);
        }
    }

    public function linkIssue(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            dd($params);
        }
    }

    public function attachFile(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $issueId = (int)$params['issueId'];
            $findIssue = Issue::find($issueId);
            $oldAttachment = $findIssue->attachment;

            if ($request->hasFile('attachment')) {
                $path = $request->file('attachment')->store('attachment');
                $arrPath = explode("/", $path);
                if ($path) {
                    $newAttachment = (!$oldAttachment) ? [] : unserialize($oldAttachment);
                    $newAttachment[] = end($arrPath);

                    $findIssue->attachment = serialize($newAttachment);
                    $findIssue->save();

                    //Write log
                    $logContent = [
                        'issue_id'  => $issueId,
                        'field'     => 7, //Attachment
                        'note'      => $oldAttachment . " -> " . $findIssue->attachment
                    ];
                    \ActivityLog::writeLog($logContent, 2);
                }
                return response()->json(['error' => 0]);
            }
            return response()->json(['error' => 1]);
        }
    }

    public function deleteAttachment(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $issueId = (int)$params['issueId'];
            $fileName = trim($params['fileName']);
            $findIssue = Issue::find($issueId);
            $oldAttachment = $findIssue->attachment;

            if ($fileName && $oldAttachment) {
                $existFile = \Storage::disk('local')->exists('attachment/' . $fileName);
                if ($existFile) {
                    $newAttachment = unserialize($oldAttachment);
                    if (($key = array_search($fileName, $newAttachment)) !== false) {
                        unset($newAttachment[$key]);
                    }
                    $findIssue->attachment = serialize($newAttachment);
                    $findIssue->save();

                    //Write log
                    $logContent = [
                        'issue_id'  => $issueId,
                        'field'     => 7, //Attachment
                        'note'      => $oldAttachment . " -> " . $findIssue->attachment
                    ];
                    \ActivityLog::writeLog($logContent, 2);
                }
                return response()->json(['error' => 0]);
            }
            return response()->json(['error' => 1]);
        }
    }

    public function search(Request $request)
    {
        $projects = Project::getAllProjectOfUser(['project.id', 'name']);

        // $params = $request->all();
        // $limit = isset($params['limit']) ? (int) $params['limit'] : 10;
        // $order = isset($params['order']) ? $params['order'] : 'issue.created_at';
        // $dir = isset($params['dir']) ? $params['dir'] : 'DESC';

        // $issueList = Issue::getIssueList([
        //     'limit'         => $limit,
        //     'order'         => $order,
        //     'dir'           => $dir
        // ]);

        return view("board::search")
            ->with('projects', $projects);
            // ->with('issueList', $issueList);
    }

    public function ajaxLoadData(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();

            $columns = [
                0 => "project.name",
                1 => "",
                2 => "summary",
                3 => "",
                4 => "users.full_name",
                5 => "issue.created_at",
            ];

            $limit = isset($params['length']) ? (int)$params['length'] : 10;
            $offset = isset($params['start']) ? (int)$params['start'] : 0;
            $order = isset($params['order'][0]['column']) ? $columns[$params['order'][0]['column']] : $columns[5];
            $dir = isset($params['order'][0]['dir']) ? $params['order'][0]['dir'] : "DESC";
            $options = [
                'limit'         => $limit,
                'offset'        => $offset,
                'order'         => $order,
                'dir'           => $dir,
                'data'          => $params['data']
            ];

            $builder = Issue::getIssueBuilder($options);
            $total = $builder->count();
            $result = Issue::getIssueList($builder, $options);

            $data = [];
            foreach ($result as $value) {
                $nestedData["projectName"] = $value->name;
                $nestedData["issueCode"] = "<a href='/board/browse/{$value->id}' target='_blank'>" . strtoupper($value->getIssueCode()) . "</a>";
                $nestedData["summary"] = $value->summary;
                $nestedData["statusName"] = $value->status->name;
                $nestedData["assignee"] = $value->getFullNameById();
                $nestedData["created_at"] = $value->issue_created_at;
                $data[] = $nestedData;
            }

            $json_data = [
                'draw'              => (int)$params['draw'],
                'recordsTotal'      => (int)$total,
                'recordsFiltered'   => (int)$total,
                'data'              => $data
            ];
            return response()->json($json_data);
        }
    }

    public function loadAssigneeStatus(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $projectId = (int)$params['projectId'];

            $issueStatus = IssueStatus::getStatusByProjectID($projectId);
            $assignees = Invite::getAllByProjectAndType($projectId, ['2']);
            foreach ($assignees as $key => $value) {
                $assignees[$key]['full_name'] = $value->getUserInvited()->full_name;
            }

            return response()->json([
                'error'     => 0,
                'assignees' => $assignees,
                'status'    => $issueStatus,
            ]);
        }
    }

    public function createReport(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $options = [
                'data' => $params['data']
            ];

            $builder = Issue::getIssueBuilder($options);
            $result = Issue::getIssueList($builder, $options);

            if ($result->count() > 0) {
                $fileName   = 'report_'.time().'.csv';
                $titleCsv = "Issue key\tIssue id\tParent id\tSummary\tAssignee\tReporter\tPriority\tStatus\tCreated\tUpdated\r\n";

                $csv = $titleCsv;
                foreach ($result as $key => $value) {
                    $createdAt = new Carbon($value->issue_created_at);
                    $updatedAt = new Carbon($value->issue_updated_at);
                    $csv .= strtoupper($value->getIssueCode()) . "\t" . $value->id . "\t" . $value->getParentIssue() . "\t" . $value->summary . "\t" . $value->getFullNameById() . "\t" . $value->getReporter() . "\t" . $value->getPriority() . "\t" . $value->status->name . "\t" . $createdAt->format('d/m/Y H:i:s') . "\t" . $updatedAt->format('d/m/Y H:i:s') . "\r\n";
                }
                $csv = chr(255) . chr(254) . mb_convert_encoding($csv, "UTF-16LE", "UTF-8");
                \Storage::disk('local')->put('report/' . $fileName, $csv);
                return response()->json(['error' => 0, 'fileName' => $fileName]);
            }
        }
        return response()->json(['error' => 1]);
    }

    public function downloadFile(Request $request)
    {
        $fileName = trim($request->route('fileName'));
        return response()->download(storage_path("app/attachment/{$fileName}"));
    }

    public function downloadFileAndDelete(Request $request)
    {
        $fileName = trim($request->route('fileName'));
        return response()->download(storage_path("app/report/{$fileName}"))->deleteFileAfterSend(true);
    }
}