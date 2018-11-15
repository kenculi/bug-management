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

class IssueStatusController extends Controller
{
	public function createStatus(Request $request)
	{
		if ($request->isMethod('post')) {
			$params = $request->all();

			if (!empty($params['projectId']) && !$params['projectId']) {
                return redirect()->back()->withInput()->withErrors(['projectId'=> 'Chọn project!']);
            }

            if (!empty($params['name']) && !$params['name']) {
                return redirect()->back()->withInput()->withErrors(['name'=> 'Nhập tên trạng thái!']);
            }

			$sequence = IssueStatus::where('proj_id', $params['projectId'])->max('sequence');			
			$insertStatus = [
                "proj_id"       => (int)$params['projectId'],
                "name"      	=> $params['name'],
                "sequence"      => $sequence + 1,
                "description"   => $params['description']
            ];

            IssueStatus::insert($insertStatus);
            $request->flash();
            \Session::flash('success', 'Tạo thành công trạng thái mới!');
            return view('board::close-iframe')->with('message','');
		} else {
			$projects = Project::getAllProject(['id', 'name']);
			return view('board::create-issue-status')->with("projects", $projects);
		}
		
	}
}