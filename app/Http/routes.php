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

Route::post('/semesters/add', ['as' => 'semester.store_submit', 'uses' => 'SemesterController@store_submit']);


Route::get('/home', 'HomeController@index');

Route::get('/semesters/add',['as' => 'semester.store', 'uses' => 'SemesterController@store']);

Route::get('/student', 'StudentController@index');

Route::get('/student/add', ['as' => 'student.store', 'uses' => 'StudentController@store']);
Route::post('/student/add', ['as' => 'student.store_submit', 'uses' => 'StudentController@store_submit']);

// Route::get('/student/{student}', 'StudentController@update');
Route::get('/student/{student}', ['as' => 'student.update', 'uses' => 'StudentController@update']);
Route::patch('/student/{student}', ['as' => 'student.update_submit', 'uses' => 'StudentController@update_submit']);
Route::delete('/student/{student}', ['as' => 'student.delete', 'uses' => 'StudentController@delete']);

