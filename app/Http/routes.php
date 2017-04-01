<?php

use App\Task;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('/welcome');
});

Route::auth();

Route::get('/{returnroute}/semesters/add',['as' => 'semester.store', 'uses' => 'SemesterController@store']);
Route::post('/{returnroute}/semesters/add', ['as' => 'semester.store_submit', 'uses' => 'SemesterController@store_submit']);

Route::get('/home', 'HomeController@index');
Route::get('/home/chart', 'HomeController@chart');
Route::get('/home/drilldown', 'HomeController@drilldown');
Route::get('/home/budget/{budget}', 'HomeController@budget_show');
Route::patch('/home/budget/{budget}', ['as' => 'budget.update', 'uses' => 'HomeController@budget_update']);

Route::get('/student', ['as' => 'student.index_filter', 'uses' => 'StudentController@index_filter']);
Route::get('/student/add', ['as' => 'student.store', 'uses' => 'StudentController@store']);
Route::post('/student/add', ['as' => 'student.store_submit', 'uses' => 'StudentController@store_submit']);
Route::get('/student/{student}', ['as' => 'student.update', 'uses' => 'StudentController@update']);
Route::patch('/student/{student}', ['as' => 'student.update_submit', 'uses' => 'StudentController@update_submit']);
Route::delete('/student/{student}', ['as' => 'student.delete', 'uses' => 'StudentController@delete']);

Route::post('/student_program/add', ['as' => 'student_program.store_submit', 'uses' => 'StudentProgramController@store_submit']);
Route::get('/student_program/add/{student_program}', ['as' => 'student_program.store', 'uses' => 'StudentProgramController@store']);
Route::get('/student_program/{student_program}', ['as' => 'student_program.update', 'uses' => 'StudentProgramController@update']);
Route::patch('/student_program/{student_program}', ['as' => 'student_program.update_submit', 'uses' => 'StudentProgramController@update_submit']);
Route::delete('/student_program/{student_program}', ['as' => 'student_program.delete', 'uses' => 'StudentProgramController@delete']);

Route::get('/advisor', 'AdvisorController@index');
Route::get('/advisor/info/{advisor}', ['as' => 'advisor.info', 'uses' => 'AdvisorController@info']);
Route::get('/advisor/add', ['as' => 'advisor.store', 'uses' => 'AdvisorController@store']);
Route::post('/advisor/add', ['as' => 'advisor.store_submit', 'uses' => 'AdvisorController@store_submit']);
Route::get('/advisor/{advisor}', ['as' => 'advisor.update', 'uses' => 'AdvisorController@update']);
Route::patch('/advisor/{advisor}', ['as' => 'advisor.update_submit', 'uses' => 'AdvisorController@update_submit']);
Route::delete('/advisor/{advisor}', ['as' => 'advisor.delete', 'uses' => 'AdvisorController@delete']);

Route::get('/gce/add', ['as' => 'gce.store', 'uses' => 'GceController@store']);
Route::post('/gce/add', ['as' => 'gce.store_submit', 'uses' => 'GceController@store_submit']);
Route::get('/gce/{gce}', ['as' => 'gce.update', 'uses' => 'GceController@update']);
Route::patch('/gce/{gce}', ['as' => 'gce.update_submit', 'uses' => 'GceController@update_submit']);
Route::delete('/gce/{gce}', ['as' => 'gce.delete', 'uses' => 'GceController@delete']);

