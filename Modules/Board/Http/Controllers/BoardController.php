<?php

namespace Modules\Board\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Issue;
use App\IssueStatus;
use App\Project;
use App\Priority;
use App\IssueLinkType;
use App\IssueLink;
use App\Invite;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $projectId = !empty($params['proj_id']) ? (int)$params['proj_id'] : 0;
        $project = Project::where('id', $projectId)->select('name')->first();

        $project_name = !empty($project->name) ? $project->name : "Unknow";

        $issue_status = IssueStatus::where('proj_id', $projectId)->orWhere('proj_id', null)->get();

        $issues = Issue::where('proj_id', $projectId)->get();

        return view('board::index', ['project_name' => $project_name, 'issues' => $issues, 'issue_statuss' => $issue_status]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function bugDetail(Request $request)
    {
        return view('board::bug-detail');
    }

    public function createIssue(Request $request)
    {
        $projects = Project::getAllProject(['id', 'name']);
        $priorities = Priority::getAllPriority(['id', 'name']);
        $linkedIssueTypes = IssueLinkType::getAllLinkType(['id', 'link_name']);
        $issues = Issue::where('proj_id', 1)->get();
        $assignees = Invite::getAllByProject(1);

        if ($request->isMethod('post')) {
            $params = $request->all();
            $validator = Validator::make($params, [
                'projectId' => 'required|numeric',
                'summary' => 'required|string|max:255',
                'priorityId' => 'required|numeric',
                'linkedIssueType' => 'numeric',
                'issueId' => 'numeric',
                'dueDate' => 'date_format:"d-m-Y"',
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
                return redirect()->back()->withInput()->withErrors(['issueId'=> 'Must be chose with Issue link type']);
            }
            if (!$params['linkedIssueType'] && !empty($params['issueId'])) {
                return redirect()->back()->withInput()->withErrors(['linkedIssueType'=> 'Must be chose with Issue']);
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
            return redirect("/board?proj_id=" . (int)$params['projectId']);
        }

        return view('board::create-issue')
            ->with('projects', $projects)
            ->with('linkedIssueTypes', $linkedIssueTypes)
            ->with('issues', $issues)
            ->with('assignees', $assignees)
            ->with('priorities', $priorities);
    }
}
