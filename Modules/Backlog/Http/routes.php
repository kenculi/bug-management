<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Backlog\Http\Controllers'], function()
{
    Route::get('/', 'BacklogController@index');
});
