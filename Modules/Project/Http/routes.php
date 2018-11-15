<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => 'project', 'namespace' => 'Modules\Project\Http\Controllers'], function()
{
    Route::get('/', 'ProjectController@index');

    Route::get('/create', 'ProjectController@create');
    Route::post('/create', 'ProjectController@create');
    Route::get('/edit/{id}', 'ProjectController@edit')->where('id', '[0-9]+');
    Route::post('/edit/{id}', 'ProjectController@edit')->where('id', '[0-9]+');
    Route::get('/delete/{id}', 'ProjectController@delete')->where('id', '[0-9]+');
    Route::post('/delete/{id}', 'ProjectController@delete')->where('id', '[0-9]+');

    Route::get('/active-project/{id}', 'ProjectController@activeProject')->where('id', '[0-9]+');
});
