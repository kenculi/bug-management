<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'board', 'namespace' => 'Modules\Board\Http\Controllers'], function()
{
    Route::get('/', 'BoardController@index');
    Route::get('/bug-detail/{id}', 'BoardController@bugDetail')->where('id', '[0-9]+');
    Route::get('/bug-detail/{id}', 'BoardController@bugDetail')->where('id', '[0-9]+');
    Route::post('/update-status', 'BoardController@updateStatus');
});
