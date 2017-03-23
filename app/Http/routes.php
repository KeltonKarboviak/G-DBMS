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

// Route::get('/student', 'StudentController@index');
Route::get('/student', ['as' => 'student.index_filter', 'uses' => 'StudentController@index_filter']);

Route::get('/student/add', ['as' => 'student.store', 'uses' => 'StudentController@store']);
Route::post('/student/add', ['as' => 'student.store_submit', 'uses' => 'StudentController@store_submit']);

// Route::get('/student/{student}', 'StudentController@update');
Route::get('/student/{student}', ['as' => 'student.update', 'uses' => 'StudentController@update']);
Route::patch('/student/{student}', ['as' => 'student.update_submit', 'uses' => 'StudentController@update_submit']);
Route::delete('/student/{student}', ['as' => 'student.delete', 'uses' => 'StudentController@delete']);

Route::get('/advisor', 'AdvisorController@index');

Route::get('/advisor/info/{advisor}', ['as' => 'advisor.info', 'uses' => 'AdvisorController@info']);

Route::get('/advisor/add', ['as' => 'advisor.store', 'uses' => 'AdvisorController@store']);
Route::post('/advisor/add', ['as' => 'advisor.store_submit', 'uses' => 'AdvisorController@store_submit']);

Route::get('/advisor/{advisor}', ['as' => 'advisor.update', 'uses' => 'AdvisorController@update']);
Route::patch('/advisor/{advisor}', ['as' => 'advisor.update_submit', 'uses' => 'AdvisorController@update_submit']);
Route::delete('/advisor/{advisor}', ['as' => 'advisor.delete', 'uses' => 'AdvisorController@delete']);

