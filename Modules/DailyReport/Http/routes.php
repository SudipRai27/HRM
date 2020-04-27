<?php

Route::group(['middleware' => ['web','AuthCheck','Permission'], 'prefix' => 'dailyreport', 'namespace' => 'Modules\DailyReport\Http\Controllers'], function()
{
	//GET ROUTES
    Route::get('list-report', [
    	'as' => 'list-report', 
    	'uses' => 'DailyReportController@getListDailyReport', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_view_daily_report'
    	]);

    Route::get('create-report', [
    	'as' => 'create-report', 
    	'uses' => 'DailyReportController@getCreateDailyReport', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_create_daily_report'
    	]);

    Route::get('delete-report/{id}', [
    	'as' => 'delete-report', 
    	'uses' => 'DailyReportController@getDeleteReport', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_delete_daily_report'
    	]);

    Route::get('edit-report/{id}', [
    	'as' => 'edit-report', 
    	'uses' => 'DailyReportController@getEditReport', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_edit_daily_report'
    	]);

    Route::get('view-report/{id}', [
    	'as' => 'view-report', 
    	'uses' => 'DailyReportController@getViewReport', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_view_daily_report'
    	]);

    Route::get('download-report-file/{id}', [
    	'as' => 'download-report-file', 
    	'uses' => 'DailyReportController@getDownloadReportFile', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_download_daily_report'
    	]);

    Route::get('daily-report-history', [
    	'as' => 'daily-report-history', 
    	'uses' => 'DailyReportController@getreportHistory', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_view_report_history' 
    	]);

    //POST ROUTES}

    Route::post('create-report-post', [
    	'as' => 'create-report-post', 
    	'uses' => 'DailyReportController@postCreateDailyReport', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_create_daily_report'
    	]);

    Route::post('edit-report-post/{id}', [
    	'as' => 'edit-report-post', 
    	'uses' => 'DailyReportController@postEditReport', 
    	'module' => 'DailyReport', 
    	'permission_type' => 'can_edit_daily_report'
    	]);
});
