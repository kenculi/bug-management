<?php

Route::group(['middleware' => ['web','auth'], 'prefix' => '', 'namespace' => 'Modules\Backlog\Http\Controllers'], function()
{
    Route::get('/', 'BacklogController@index');
});
