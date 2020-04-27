<?php

Route::group(['middleware' => ['web','AuthCheck','Permission'], 'prefix' => 'department', 'namespace' => 'Modules\Department\Http\Controllers'], function()
{

//GET ROUTES

    Route::get('list', [
    	'as' => 'list-department', 
    	'uses' => 'DepartmentController@getListDepartment', 
    	'module' => 'Department', 
    	'permission_type' => 'can_view_department'
    	]);

    Route::get('create', [
    	'as' => 'create-department', 
    	'uses' => 'DepartmentController@getCreateDepartment', 
    	'module' => 'Department', 
    	'permission_type' => 'can_create_department'
    	]);

    Route::get('edit-department/{id}',  [
    	'as' => 'edit-department', 
    	'uses' => 'DepartmentController@getEditDepartment', 
    	'module' => 'Department', 
    	'permission_type' => 'can_edit_department'
    	]);

    Route::get('delete-department/{id}', [
    	'as' => 'delete-department', 
    	'uses' => 'DepartmentController@getDeleteDepartment', 
    	'module' => 'Department', 
    	'permission_type' => 'can_delete_department'
    	]);

// POST ROUTES
    Route::post('create-department-post', [
    	'as' => 'create-department-post', 
    	'uses' => 'DepartmentController@postCreateDepartment', 
    	'module' => 'Department', 
    	'permission_type' => 'can_create_department'
    	]);

    Route::post('edit-department-post/{id}', [
    	'as' => 'edit-department-post', 
    	'uses' => 'DepartmentController@postEditDepartment', 
    	'module' => 'Department',  
    	'permission_type' => 'can_edit_department'
    	]);


});

Route::get('api/v1/create-department', [
    'as' => 'api-create-department', 
    'uses' => 'Modules\Department\Http\Controllers\DepartmentController@postApiCreateDepartment'
    ]);