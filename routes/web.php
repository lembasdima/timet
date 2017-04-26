<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'TimeSheetsController@showTimeSheets');
Route::get('/timesheets', 'TimeSheetsController@showTimeSheets');
Route::post('/getJsonData', 'TimeSheetsController@getJsonData');
Route::post('/getCalendarDate', 'TimeSheetsController@getCalendarDate');
Route::post('/getDataToSave', 'TimeSheetsController@getDataToSave');
Route::post('/addNewRecord', 'TimeSheetsController@addNewRecord');
Route::post('/deleteRecord', 'TimeSheetsController@deleteRecord');



Route::get('/projects', 'ProjectController@showProjects');
Route::get('/projects/add', 'ProjectController@addProject');
Route::post('/projects/saveProject', 'ProjectController@saveProject');

Route::get('/admin/showUsers', 'Admin\AddNewUserController@showUsers');
Route::get('/admin/addUser', 'Admin\AddNewUserController@addUser');
Route::post('/admin/saveUser', 'Admin\AddNewUserController@saveUser');

Route::get('/admin/showDepartments', 'Admin\DepartmentController@showDepartments');
Route::get('/admin/addDepartments', 'Admin\DepartmentController@addDepartments');
Route::post('/admin/saveDepartments', 'Admin\DepartmentController@saveDepartments');

Route::get('/admin/showCategories', 'Admin\CategoryController@showCategories');
Route::get('/admin/addCategories', 'Admin\CategoryController@addCategories');
Route::post('/admin/saveCategories', 'Admin\CategoryController@saveCategories');

Route::get('/admin/showClients', 'Admin\CustomerController@showClients');
Route::get('/admin/addClient', 'Admin\CustomerController@addClient');
Route::post('/admin/saveClient', 'Admin\CustomerController@saveClient');


Route::get('/reports', 'Reports\ReportController@showReport');
Route::post('/showReportResult', 'Reports\ReportController@showReportResult');

Route::get('/admin/settings', 'Admin\CompanyController@showSettings');


