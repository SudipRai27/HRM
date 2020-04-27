<?php

Route::group(['middleware' => ['web','AuthCheck','Permission'] , 'prefix' => 'job', 'namespace' => 'Modules\Job\Http\Controllers'], function()
{

//GET ROUTES

    Route::get('list',  [
    	'as' => 'list-job', 
    	'uses' => 'JobController@getListJob', 
    	'module' => 'Job', 
    	'permission_type' => 'can_view_job'
    	]);

    Route::get('create', [
    	'as' => 'create-job', 
    	'uses' => 'JobController@getCreateJob', 
    	'module' => 'Job', 
    	'permission_type' => 'can_create_job'
    	]);

    Route::get('edit-job/{id}', [
    	'as' => 'edit-job', 
    	'uses' => 'JobController@getEditJob', 
    	'module'=> 'Job', 
    	'permission_type' => 'can_edit_job'
    	]);

    Route::get('delete-job/{id}', [
    	'as' => 'delete-job', 
    	'uses' => 'JobController@getDeleteJob', 
    	'module' => 'Job', 
    	'permission_type' => 'can_delete_job'
    	]);

//POST ROUTES

    Route::post('create-job-post', [
    	'as' => 'create-job-post', 
    	'uses' => 'JobController@postCreateJob', 
    	'module' => 'Job', 
    	'permission_type' => 'can_create_job' 
    	]);

    Route::post('edit-job-post/{id}', [
    	'as' => 'edit-job-post', 
    	'uses' => 'JobController@postEditJob', 
    	'module' => 'Job', 
    	'permission_type' => 'can_edit_job'
    	]);

});
