<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'board', 'namespace' => 'Modules\Board\Http\Controllers'], function()
{
    Route::get('/', 'BoardController@index');
    Route::get('/bug-detail/{id}', 'BoardController@bugDetail')->where('id', '[0-9]+');

    Route::get('/create-issue', 'BoardController@createIssue');
    Route::post('/create-issue', 'BoardController@createIssue');
});
