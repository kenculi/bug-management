<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'board', 'namespace' => 'Modules\Board\Http\Controllers'], function()
{
    Route::get('/', 'BoardController@index');
    Route::get('/bug-detail/{id}', 'BoardController@bugDetail')->where('id', '[0-9]+');
    Route::post('/update-status', 'BoardController@updateStatus');

    Route::get('/create-issue', 'BoardController@createIssue');
    Route::post('/create-issue', 'BoardController@createIssue');

    Route::post('/update-desc', 'IssueController@updateDescription');
    Route::post('/update-status', 'IssueController@updateStatus');
    Route::post('/update-assignee', 'IssueController@updateAssignee');
    Route::post('/update-priority', 'IssueController@updatePriority');
    Route::post('/update-label', 'IssueController@updateLabel');
    Route::post('/add-comment', 'IssueController@addComment');

    Route::get('/announce', 'BoardController@closeIframe');
});
