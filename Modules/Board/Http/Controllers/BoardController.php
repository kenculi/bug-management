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

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $projectId = \Cookie::has('projectId') ? \Cookie::get('projectId') : 0;
        $project = Project::where('id', $projectId)->select('name')->first();

        $project_name = !empty($project->name) ? $project->name : "Bảng";

        $issue_status = IssueStatus::getStatusByProjectID($projectId);
        $invited = Invite::getAllByProjectAndType($projectId, ['2']);

        $queryBuilder = Issue::where('proj_id', $projectId);
        if (!empty($params['keyword'])) {
            $queryBuilder->where('summary', 'LIKE', '%'.$params['keyword'].'%');
        }

        $issues = $queryBuilder->get();
        $request->flash();

        return view('board::index', ['project_name' => $project_name, 'issues' => $issues, 'issue_status' => $issue_status, 'projectId' => $projectId, 'invited' => $invited]);
    }

    public function closeIframe()
    {
        return view('board::close-iframe');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function updateStatus(Request $request)
    {
        Issue::where('id', $request->issue_id)->update(['issue_status' => $request->status]);
        return response()->json(['success'=>'Data is successfully added']);
    }

    public function updateSequence(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $idList = $params['sortedIds'];
            for ($i=0; $i < count($idList); $i++) {
                IssueStatus::where('id', (int)$idList[$i])->update(['sequence' => $i+1]);
            }

            return response()->json(['error' => 0]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function bugDetail(Request $request)
    {
        $id = (int)$request->route('id');
        $projectId = \Cookie::has('projectId') ? \Cookie::get('projectId') : 0;
        $findBug = Issue::find($id);
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

        return view('board::bug-detail')
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

    public function createIssue(Request $request)
    {
        $projectId = \Cookie::has('projectId') ? \Cookie::get('projectId') : 0;
        $projects = Project::getAllProjectOfUser(['project.id', 'name']);
        $priorities = Priority::getAllPriority(['id', 'name']);
        $linkedIssueTypes = IssueLinkType::getAllLinkType(['id', 'link_name']);
        $issues = Issue::where('proj_id', $projectId)->get();
        $assignees = Invite::getAllByProjectAndType($projectId, ['2']);

        if ($request->isMethod('post')) {
            $params = $request->all();
            $validator = Validator::make($params, [
                'projectId' => 'required|numeric',
                'summary' => 'required|string|max:255',
                'priorityId' => 'required|numeric',
                'linkedIssueType' => 'numeric',
                'issueId' => 'numeric',
                'assignee' => 'numeric',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $insertIssue = [
                "proj_id"       => (int)$params['projectId'],
                "reporter"      => Auth::id(),
                "summary"       => htmlentities(trim($params['summary'])),
                "priority_id"   => (int)$params['priorityId'],
                "issue_status"  => IssueStatus::getFirstStatusByProjectID($params['projectId'])
            ];

            if (!empty($params['assignee'])) {
                $insertIssue['assignee'] = (int)$params['assignee'];
            }
            if (!empty($params['linkedIssueType']) && !$params['issueId']) {
                return redirect()->back()->withInput()->withErrors(['issueId'=> 'Phải chọn cùng loại lỗi liên kết']);
            }
            if (!$params['linkedIssueType'] && !empty($params['issueId'])) {
                return redirect()->back()->withInput()->withErrors(['linkedIssueType'=> 'Phải chọn cùng lỗi liên kết']);
            }

            if (!empty($params['linkedIssueType']) && !empty($params['issueId'])) {
                $insertedIssueLinkId = IssueLink::create([
                    'link_type_id'  => (int)$params['linkedIssueType'],
                    'issue_id'      => (int)$params['issueId']
                ]);
                $insertIssue['issue_link'] = (int)$insertedIssueLinkId->id;
            }
            if (!empty($params['dueDate'])) {
                $insertIssue['due_date'] = Carbon::parse(trim($params['dueDate']))->format("Y-m-d H:i:s");
            }

            Issue::create($insertIssue);
            $request->flash();
            \Session::flash('success', 'Tạo lỗi thành công!');
            return view('board::close-iframe')->with('message','');
        }

        return view('board::create-issue')
            ->with('projectId', $projectId)
            ->with('projects', $projects)
            ->with('linkedIssueTypes', $linkedIssueTypes)
            ->with('issues', $issues)
            ->with('assignees', $assignees)
            ->with('priorities', $priorities);
    }
}
