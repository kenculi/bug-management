<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Project;
use App\Invite;
use App\ActivitiesLog;
use Mail;

class InviteController extends Controller
{
	public function inviteMember(Request $request)
	{
		$projectId = (int)$request->route('id');
		$invitedList = Invite::getAllByProjectAndType($projectId);
		$acceptedInvite = [];
		$pendingInvite = [];
		$deniedInvite = [];
		if (!empty($invitedList)) {
			foreach ($invitedList as $value) {
				switch ($value->type) {
					case '1':
						$pendingInvite[] = $value->getUserInvited()->email;
						break;
					case '2':
						$acceptedInvite[] = $value->getUserInvited()->email;
						break;
					case '3':
						$deniedInvite[] = $value->getUserInvited()->email;
						break;
				}
			}
		}

		$userNotBeInvited = User::getUserNotBeInvited($projectId);

		if ($request->isMethod('post') && Auth::check()) {
			$params = $request->all();
			$validator = Validator::make($params, [
                'emailInvite' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            if (!empty($params['emailInvite'])) {
	            foreach ($params['emailInvite'] as $invitedId) {
	            	$checkExist = Invite::where("user_receive_id", $invitedId)->where("proj_id", $projectId)->first();
	            	if (!empty($checkExist) || !is_numeric($invitedId)) {
	            		\Session::flash('error', 'Thành viên không tồn tại hoặc đã mời!');
		        		return view('board::close-iframe')->with('message','');
	            	}

	            	$newInvite = Invite::create([
		                'proj_id'           => $projectId,
		                'user_send_id'      => Auth::user()->id,
		                'user_receive_id'   => (int)$invitedId,
		                'type'              => 1
		            ]);

		            $userInfo = User::getUserInfo($invitedId);
		            $content = [
		            	'acceptLink' => 'http://trucna.xyz/project/invite-link/'.base64_encode($newInvite->id . "_2"),
		            	'denyLink' => 'http://trucna.xyz/project/invite-link/'.base64_encode($newInvite->id . "_3")
		            ];
		            Mail::send('project::emails.invite-link', ['content' => $content], function ($message) use ($userInfo){
			            $message->to($userInfo->email)->subject('Email mời tham gia dự án');
			        });
	            }
	            \Session::flash('success', 'Mời thành viên thành công!');
		        return view('board::close-iframe')->with('message','');
            }

		}
		$request->flash();

		return view('project::invite-member')
			->with('pendingInvite', implode(", ", $pendingInvite))
			->with('acceptedInvite', implode(", ", $acceptedInvite))
			->with('deniedInvite', implode(", ", $deniedInvite))
			->with('userNotBeInvited', $userNotBeInvited);
	}

	public function inviteAcceptOrDeny(Request $request)
	{
		$arrCode = trim($request->route('code'));
		if (!$arrCode) {
			return view('project::invite-link')
				->with('message', 'Đường dẫn không chính xác!');
		}
		$decodedString = base64_decode($arrCode);
		$arrString = explode("_", $decodedString);
		$invitedId = (int)$arrString[0];
		$type = (int)$arrString[1];

		$findInviteLink = Invite::find($invitedId);
		if (empty($findInviteLink)) {
			return view('project::invite-link')
				->with('message', 'Đường dẫn không chính xác!');
		}

		$findInviteLink->type = $type;
		$findInviteLink->save();

		return view('project::invite-link')
				->with('message', $type);
	}
}