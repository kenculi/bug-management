<?php

namespace Modules\Board\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // $open = DB::table('issue')
        //         ->join('issue_status', 'issue.issue_status', '=', 'issue_status.id')
        //         ->where('issue_status.id','=','1')
        //         ->select('issue.*');
        // $todo = DB::table('issue')
        //         ->join('issue_status', 'issue.issue_status', '=', 'issue_status.id')
        //         ->where('issue_status.id','=','2')
        //         ->select('issue.*');
        // $in_progress = DB::table('issue')
        //         ->join('issue_status', 'issue.issue_status', '=', 'issue_status.id')
        //         ->where('issue_status.id','=','4')
        //         ->select('issue.*');
        // $complete = DB::table('issue')
        //         ->join('issue_status', 'issue.issue_status', '=', 'issue_status.id')
        //         ->where('issue_status.id','=','3')
        //         ->select('issue.*');
        // return view('board::index',['open'=>$open,'todo'=>$todo,'in_progress'=>$in_progress,'complete'=>$complete]);
        return view('board::index');
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
