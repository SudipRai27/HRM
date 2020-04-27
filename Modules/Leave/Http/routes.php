<?php

Route::group(['middleware' => ['web','AuthCheck','Permission'], 'prefix' => 'leave', 'namespace' => 'Modules\Leave\Http\Controllers'], function()
{
//GET ROUTES
    Route::get('list-leave', [
    	'as' => 'list-leave', 
    	'uses' => 'LeaveController@getListLeaveRequest', 
    	'module' => 'Leave', 
    	'permission_type' => 'can_view_leave_request'
    	]);

    Route::get('create-leave', [
    	'as' => 'create-leave', 
    	'uses' => 'LeaveController@getCreateLeaveRequest',  
    	'module' => 'Leave', 
    	'permission_type' => 'can_create_leave_request'
    	]);

    Route::get('approve-leave/{id}', [
        'as' => 'approve-leave', 
        'uses' => 'LeaveController@getApproveLeaveRequest', 
        'module' => 'Leave', 
        'permission_type' => 'can_approve_leave_request'
        ]);

    Route::get('reject-leave/{id}',[
        'as' => 'reject-leave', 
        'uses' => 'LeaveController@getRejectLeaveRequest', 
        'module' => 'Leave', 
        'permission_type' => 'can_reject_leave_request'
        ]);

    Route::get('view-leave/{id}', [
        'as' => 'view-leave', 
        'uses' => 'LeaveController@getViewLeaveRequest', 
        'module' => 'Leave', 
        'permission_type' => 'can_view_leave_request'
        ]);

    Route::get('delete-leave/{id}', [
        'as' => 'delete-leave', 
        'uses' => 'LeaveController@getDeleteLeaveRequest', 
        'module' => 'Leave', 
        'permission_type' => 'can_delete_leave_request'
        ]);

    Route::get('edit-leave/{id}', [
        'as' => 'edit-leave', 
        'uses' => 'LeaveController@getEditLeaveRequest', 
        'module' => 'Leave', 
        'permission_type' => 'can_edit_leave_request'
        ]);  

    Route::get('leave-history', [
        'as' => 'leave-history', 
        'uses' => 'LeaveController@getLeaveRequestHistory', 
        'module' => 'Leave', 
        'permission_type' => 'can_view_leave_history'
        ]);

    Route::get('leave-logs', [
        'as' => 'leave-logs', 
        'uses' => 'LeaveController@getViewLeaveLogs',
        'module' => 'Leave', 
        'permission_type' => 'can_view_leave_logs'
        ]);

//POST ROUTES

    Route::post('create-leave-post', [
        'as' => 'create-leave-post', 
        'uses' => 'LeaveController@postCreateLeaveRequestPost', 
        'module' => 'Leave',  
        'permission_type' => 'can_create_leave_request'
        ]);

    Route::post('edit-leave-post/{id}', [
        'as' => 'edit-leave-post', 
        'uses' => 'LeaveController@postEditLeaveRequest', 
        'module' => 'Leave', 
        'permission_type' => 'can_edit_leave_request'
        ]);
});
