<?php

Route::group(['middleware' => ['web','AuthCheck','Permission'], 'prefix' => 'attendance', 'namespace' => 'Modules\Attendance\Http\Controllers'], function()
{
    Route::get('attendance-user-check-in', [
    	'as' => 'attendance-user-check-in', 
    	'uses' => 'AttendanceController@getUserCheckIn', 
    	'module' => 'Attendance', 
    	'permission_type' => 'can_check_in'
    	]);

    Route::get('list-attendance', [
    	'as' => 'list-attendance', 
    	'uses' => 'AttendanceController@getListUserAttendance', 
    	'module' => 'Attendance', 
    	'permission_type' => 'can_view_todays_attendance'
    	]);

    Route::get('list-attendance-history', [
    	'as' => 'list-attendance-history', 
    	'uses' => 'AttendanceController@getListUserAttendanceHistory', 
    	'module' => 'Attendance', 
    	'permission_type' => 'can_view_attendance_history'
    	]);

    Route::get('attendance-user-check-out', [
        'as' => 'attendance-user-check-out', 
        'uses' => 'AttendanceController@getUserCheckOut', 
        'module' => 'Attendance', 
        'permission_type' => 'can_check_out'
        ]);

});

//AjAX ROUTES AND FUNCTION ARE DEFINED IN APP/HTTP/CONTROLLERS/AJAXCONTROLLER AND ROUTES/AJAX_ROUTES.PHP