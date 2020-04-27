<?php

Route::get('ajax-get-job-list-from-department-id', [
	'as' => 'ajax-get-job-list-from-department-id', 
	'uses' => 'AjaxController@getJobListFromDepartmentId'
	]);

Route::get('ajax-get-attendance-history-from-date-and-user-id', [
	'as' => 'ajax-get-attendance-history-from-date-and-user-id', 
	'uses' => 'AjaxController@getAttendanceHistoryFromDateAndUserId'
	]);

Route::get('ajax-get-search-user', [
	'as' => 'ajax-get-search-user', 
	'uses' => 'AjaxController@getSearchUser'
	]);

Route::get('ajax-get-leave-history-from-date-and-user-id', [
	'as' => 'ajax-get-leave-history-from-date-and-user-id', 
	'uses' => 'AjaxController@getLeaveHistoryFromDateUserIdandAttendance'
 	]);

Route::get('ajax-get-leave-logs-from-user-id', [
	'as' => 'ajax-get-leave-logs-from-user-id', 
	'uses' => 'AjaxController@getLeaveLogsFromUserId'
	]);

Route::get('ajax-get-daily-report-history-from-date-and-user-id', [
	'as' => 'ajax-get-daily-report-history-from-date-and-user-id', 
	'uses' => 'AjaxController@getDailyReportHistoryFromDateandUserId'
	]);