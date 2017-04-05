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

Route::get('/gqe/result', 'GqeResultController@index');
Route::get('/gqe/result/add', ['as' => 'gqe_result.store', 'uses' => 'GqeResultController@store']);
Route::post('/gqe/result', ['as' => 'gqe_result.store_submit', 'uses' => 'GqeResultController@store_submit']);
Route::get('/gqe/result/{student_id}/{offer_id}/edit', ['as' => 'gqe_result.update', 'uses' => 'GqeResultController@update']);
Route::patch('/gqe/result/{student_id}/{offer_id}', ['as' => 'gqe_result.update_submit', 'uses' => 'GqeResultController@update_submit']);
Route::delete('/gqe/result/{student_id}/{offer_id}', ['as' => 'gqe_result.delete', 'uses' => 'GqeResultController@delete']);

Route::get('/gqe/offering', 'GqeOfferingController@index');
Route::get('/gqe/offering/add', ['as' => 'gqe_offering.store', 'uses' => 'GqeOfferingController@store']);
Route::post('/gqe/offering', ['as' => 'gqe_offering.store_submit', 'uses' => 'GqeOfferingController@store_submit']);
Route::get('/gqe/offering/{offering}/edit', ['as' => 'gqe_offering.update', 'uses' => 'GqeOfferingController@update']);
Route::patch('/gqe/offering/{offering}', ['as' => 'gqe_offering.update_submit', 'uses' => 'GqeOfferingController@update_submit']);
Route::delete('/gqe/offering/{offering}', ['as' => 'gqe_offering.delete', 'uses' => 'GqeOfferingController@delete']);

Route::get('/gqe/section', 'GqeSectionController@index');
Route::get('/gqe/section/add', ['as' => 'gqe_section.store', 'uses' => 'GqeSectionController@store']);
Route::post('/gqe/section', ['as' => 'gqe_section.store_submit', 'uses' => 'GqeSectionController@store_submit']);
Route::get('/gqe/section/{section}/edit', ['as' => 'gqe_section.update', 'uses' => 'GqeSectionController@update']);
Route::patch('/gqe/section/{section}', ['as' => 'gqe_section.update_submit', 'uses' => 'GqeSectionController@update_submit']);
Route::delete('/gqe/section/{section}', ['as' => 'gqe_section.delete', 'uses' => 'GqeSectionController@delete']);

Route::get('/gqe/passlevel', 'PassLevelController@index');
Route::get('/gqe/passlevel/add', ['as' => 'pass_level.store', 'uses' => 'PassLevelController@store']);
Route::post('/gqe/passlevel', ['as' => 'pass_level.store_submit', 'uses' => 'PassLevelController@store_submit']);
Route::get('/gqe/passlevel/{level}/edit', ['as' => 'pass_level.update', 'uses' => 'PassLevelController@update']);
Route::patch('/gqe/passlevel/{level}', ['as' => 'pass_level.update_submit', 'uses' => 'PassLevelController@update_submit']);
Route::delete('/gqe/passlevel/{level}', ['as' => 'pass_level.delete', 'uses' => 'PassLevelController@delete']);

Route::get('/assistantship/add', ['as' => 'assistantship.store', 'uses' => 'AssistantshipController@store']);
Route::post('/assistantship/add', ['as' => 'assistantship.store_submit', 'uses' => 'AssistantshipController@store_submit']);
Route::get('/assistantship/{assist}', ['as' => 'assistantship.update', 'uses' => 'AssistantshipController@update']);
Route::patch('/assistantship/{assist}', ['as' => 'assistantship.update_submit', 'uses' => 'AssistantshipController@update_submit']);
Route::delete('/assistantship/{assist}', ['as' => 'assistantship.delete', 'uses' => 'AssistantshipController@delete']);
