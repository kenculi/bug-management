<?php

namespace Modules\Board\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Issue;
use App\IssueStatus;
use App\Project;

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
        
        $project_name = !empty($project->name) ?: "Unknow";

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
        return view('board::create-issue');
    }
}
