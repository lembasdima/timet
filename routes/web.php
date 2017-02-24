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

Route::get('/home', 'HomeController@index');
Route::get('/timesheets', 'TimeSheetsController@showTimeSheets');

Route::get('/projects', 'ProjectController@showProjects');
Route::get('/projects/add', 'ProjectController@addProject');
Route::post('/projects/saveProject', 'ProjectController@saveProject');

Route::get('/admin/showUsers', 'Admin\AddNewUserController@showUsers');
Route::get('/admin/addUser', 'Admin\AddNewUserController@addUser');
Route::post('/admin/saveUser', 'Admin\AddNewUserController@saveUser');

Route::get('/admin/showDepartments', 'Admin\DepartmentController@showDepartments');
Route::get('/admin/addDepartments', 'Admin\DepartmentController@addDepartments');
Route::post('/admin/saveDepartments', 'Admin\DepartmentController@saveDepartments');