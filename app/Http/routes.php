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

Route::get('/home', 'HomeController@index');

Route::get('/student', 'StudentController@index');
Route::get('/student/{student}', 'StudentController@update');
Route::get('/student/{student}', ['as' => 'student.update', 'uses' => 'StudentController@update']);
Route::post('/student/{student}', 'StudentController@update_submit');
