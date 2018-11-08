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
        $project = Project::where('id', $request->proj_id)->select('name')->first();
        
        $project_name = $project->name;

        $issue_status = IssueStatus::where('proj_id', $request->proj_id)->orWhere('proj_id', null)->get();
        
        $issues = Issue::where('proj_id', $request->proj_id)->get();

        return view('board::index', ['project_name' => $project_name, 'issues' => $issues, 'issue_statuss' => $issue_status]);
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

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function bugDetail(Request $request)
    {
        return view('board::bug-detail');
    }
}
