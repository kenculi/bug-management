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

class IssueController extends Controller
{
	public function addComment(Request $request)
	{
		if ($request->isMethod('post') && Auth::check()) {
			$params = $request->all();
			$insertComment = [
                "user_id"      	=> Auth::id(),
                "proj_id"       => 1,
                "issue_id"      => (int)$params['issueId'],
                "description"   => htmlentities(trim($params['comment']))
            ];

            Comment::create($insertComment);
            \Session::flash('success', 'Comment was added!');
            return response()->json(['error' => 0]);
		}
	}

	public function updateDescription(Request $request)
	{
		if ($request->isMethod('post')) {
			$params = $request->all();
			$issueId = (int)$params['issueId'];
			$findIssue = Issue::find($issueId);
			if (!empty($findIssue)) {
				$findIssue->description = htmlentities(trim($params['description']));
            	$findIssue->save();
			}
			return response()->json(['error' => 0]);
		}
	}

	public function updateAssignee(Request $request)
	{
		if ($request->isMethod('post')) {
			$params = $request->all();
			$issueId = (int)$params['issueId'];
			$findIssue = Issue::find($issueId);
			if (!empty($findIssue)) {
				$findIssue->assignee = (int)$params['assignee'];
            	$findIssue->save();
			}
			return response()->json(['error' => 0]);
		}
	}

	public function updateStatus(Request $request)
	{
		if ($request->isMethod('post')) {
			$params = $request->all();
			$issueId = (int)$params['issueId'];
			$findIssue = Issue::find($issueId);
			if (!empty($findIssue)) {
				$findIssue->issue_status = (int)$params['issueStatus'];
            	$findIssue->save();
			}
			return response()->json(['error' => 0]);
		}
	}

	public function updatePriority(Request $request)
	{
		if ($request->isMethod('post')) {
			$params = $request->all();
			$issueId = (int)$params['issueId'];
			$findIssue = Issue::find($issueId);
			if (!empty($findIssue)) {
				$findIssue->priority_id = (int)$params['priorityId'];
            	$findIssue->save();
			}
			return response()->json(['error' => 0]);
		}
	}

	public function updateLabel(Request $request)
	{
		if ($request->isMethod('post')) {
			$params = $request->all();
			$issueId = (int)$params['issueId'];
			if (empty($params['labels'])) {
				return response()->json(['error' => 1, 'message' => 'Không cập nhật được nhãn']);
			}

			$labelToInsert = [];
			foreach ($params['labels'] as $value) {
				$checkLabelExisted = Label::find($value);
				if (empty($checkLabelExisted)) {
					$inserted = Label::create(['proj_id' => 1, 'label' => trim($value)]);
					$labelToInsert[] = $inserted->id;
				} else {
					$labelToInsert[] = $value;
				}
			};

			if (!empty($labelToInsert)) {
				Issue::where('id', $issueId)->update(['label'=>implode(",", $labelToInsert)]);
			}
			return response()->json(['error' => 0]);
		}
	}
}