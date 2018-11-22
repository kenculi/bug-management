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
            ->with("firstLetter", $firstLetter)
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

    public function downloadFile(Request $request)
    {
        $fileName = trim($request->route('fileName'));
        return response()->download(storage_path("app/attachment/{$fileName}"));
    }
}