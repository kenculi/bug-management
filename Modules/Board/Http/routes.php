<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'board', 'namespace' => 'Modules\Board\Http\Controllers'], function()
{
    Route::get('/', 'BoardController@index');
    Route::get('/bug-detail/{id}', 'BoardController@bugDetail')->where('id', '[0-9]+');
    Route::post('/update-status', 'BoardController@updateStatus');
    Route::post('/update-sequence', 'BoardController@updateSequence');

    Route::get('/create-issue', 'BoardController@createIssue');
    Route::post('/create-issue', 'BoardController@createIssue');

    Route::post('/update-desc', 'IssueController@updateDescription');
    Route::post('/update-status-issue', 'IssueController@updateStatus');
    Route::post('/update-assignee', 'IssueController@updateAssignee');
    Route::post('/update-priority', 'IssueController@updatePriority');
    Route::post('/update-label', 'IssueController@updateLabel');
    Route::post('/add-comment', 'IssueController@addComment');

    Route::get('/browse/{id}', 'IssueController@browseIssue')->where('id', '[0-9]+');
    Route::get('/announce', 'BoardController@closeIframe');

    Route::get('/create-status', 'IssueStatusController@createStatus')->where('id', '[0-9]+');
    Route::post('/create-status', 'IssueStatusController@createStatus')->where('id', '[0-9]+');

    Route::post('/attach-file', 'IssueController@attachFile');
    Route::get('/download-file/{fileName}', 'IssueController@downloadFile');
    Route::post('/delete-attachment', 'IssueController@deleteAttachment');
});

Route::group(['middleware' => ['web','auth'], 'prefix' => 'search', 'namespace' => 'Modules\Board\Http\Controllers'], function()
{
    Route::get('/', 'IssueController@search');
});
