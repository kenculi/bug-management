<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\IssueStatus;
use App\Project;
use App\Invite;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $projects = Project::getAllProjectOfUser(['project.id','name','project.created_at','lead_id']);
        return view('project::index')
            ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $validator = Validator::make($params, [
                'projectName' => 'required|string',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $newProjectId = Project::create(['name' => trim($params['projectName']), 'lead_id' => Auth::user()->id]);
            IssueStatus::addFourFirstStatus($newProjectId->id);
            Invite::create([
                'proj_id'           => $newProjectId->id,
                'user_send_id'      => 0,
                'user_receive_id'   => Auth::user()->id,
                'type'              => 2
            ]);

            \Session::flash('success', 'Thêm dự án mới thành công!');
            return view('board::close-iframe')->with('message','');
        }
        return view('project::create');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $projectId   = (int)$request->route('id');
        $findProject = Project::find($projectId);

        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $validator = Validator::make($params, [
                'projectName' => 'required|string',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $findProject->name = htmlentities(trim($params['projectName']));
            $findProject->save();

            \Session::flash('success', 'Cập nhật dự án thành công!');
            return view('board::close-iframe')->with('message','');
        }
        return view('project::edit')
            ->with("project", $findProject);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete(Request $request)
    {
        $projectId   = (int)$request->route('id');
        $findProject = Project::find($projectId);

        if ($request->isMethod('post') && Auth::check()) {
            $findProject->delete();
            \Session::flash('success', 'Xóa dự án thành công!');
            return view('board::close-iframe')->with('message','');
        }
        return view('project::delete')
            ->with("project", $findProject);
    }

    public function activeProject(Request $request)
    {
        $projectId = (int)$request->route('id');
        if ($projectId) {
            \Cookie::queue(\Cookie::make('projectId', $projectId, 86400));
        }
        return redirect("/board");
    }
}
