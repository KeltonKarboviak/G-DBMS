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

Route::get('/register','Auth\AuthController@showRegistrationForm');

Route::get('/user/{user}/edit', ['as' => 'user.update', 'uses' => 'UserController@update']);
Route::patch('/user/{user}/pass', ['as' => 'user.update_pass', 'uses' => 'UserController@update_pass']);
Route::patch('/user/{user}/info', ['as' => 'user.update_info', 'uses' => 'UserController@update_info']);

Route::group(['middleware' => ['auth', 'first_login']], function () {
	//Lowest View Level - Faculty, Secretary, Chair, Director
	Route::group(['middleware' => 'has_role:Director_Chair_Faculty_Secretary'], function () {
		Route::get('/home', 'HomeController@index');
		Route::get('/home/chart', 'HomeController@chart');
		Route::get('/home/drilldown', 'HomeController@drilldown');
		Route::get('/home/budget/{budget}', ['as' => 'budget.show', 'uses' => 'HomeController@budget_show']);

		Route::get('/student', ['as' => 'student.index_filter', 'uses' => 'StudentController@index_filter']);
		Route::get('/prospective_student', ['as' => 'prospective_student.index_filter', 'uses' => 'ProspectiveStudentController@index_filter']);
		Route::get('/advisor', 'AdvisorController@index');
		Route::get('/advisor/info/{advisor}', ['as' => 'advisor.info', 'uses' => 'AdvisorController@info']);
	});

	//Ferpa View level - Director, Chair
	Route::group(['middleware' => 'has_role:Director_Chair'], function () {
		Route::get('/gqe/result', 'GqeResultController@index');
		Route::get('/gqe/offering', 'GqeOfferingController@index');
		Route::get('/gqe/section', 'GqeSectionController@index');
		Route::get('/gqe/passlevel', 'PassLevelController@index');
	});

	//Money View level - Director, Chair, Secretary
	Route::group(['middleware' => 'has_role:Director_Chair_Secretary'], function () {
		Route::get('/assistantship', ['as' => 'assistantship.index_filter', 'uses' => 'AssistantshipController@index_filter']);
		Route::get('/assistantship/positions', ['as' => 'position.index', 'uses' => 'PositionController@index']);
		Route::get('/assistantship/status', ['as' => 'status.index', 'uses' => 'StatusController@index']);
		Route::get('/assistantship/gta_assignments/',['as' => 'gta_assignment.index_filter', 'uses' => 'GtaAssignmentController@index_filter']);
		Route::get('/waiver', 'TuitionWaiverController@index');
		Route::get('/source', 'FundingSourceController@index');
	});

	//Lowest Edit level - Director, Secretary
	Route::group(['middleware' => 'has_role:Director_Secretary'], function () {
		Route::get('/{returnroute}/semesters/add',['as' => 'semester.store', 'uses' => 'SemesterController@store']);
		Route::post('/{returnroute}/semesters/add', ['as' => 'semester.store_submit', 'uses' => 'SemesterController@store_submit']);

		Route::get('/student/add', ['as' => 'student.store', 'uses' => 'StudentController@store']);
		Route::post('/student/add', ['as' => 'student.store_submit', 'uses' => 'StudentController@store_submit']);
		Route::get('/student/{student}', ['as' => 'student.update', 'uses' => 'StudentController@update']);
		Route::patch('/student/{student}', ['as' => 'student.update_submit', 'uses' => 'StudentController@update_submit']);

		Route::get('/prospective_student/add', ['as' => 'prospective_student.store', 'uses' => 'ProspectiveStudentController@store']);
		Route::post('/prospective_student/add', ['as' => 'prospective_student.store_submit', 'uses' => 'ProspectiveStudentController@store_submit']);
		Route::get('/prospective_student/{student}', ['as' => 'prospective_student.update', 'uses' => 'ProspectiveStudentController@update']);
		Route::patch('/prospective_student/{student}', ['as' => 'prospective_student.update_submit', 'uses' => 'ProspectiveStudentController@update_submit']);
	});

	//Highest Edit level - Director Only
	Route::group(['middleware' => 'has_role:Director'], function () {
		Route::get('/user', 'UserController@index');
		Route::delete('/user/{user}', ['as' => 'user.delete', 'uses' => 'UserController@delete']);

		Route::post('/home/budget', ['as' => 'budget.store', 'uses' => 'HomeController@budget_store']);
		Route::patch('/home/budget/{budget}', ['as' => 'budget.update', 'uses' => 'HomeController@budget_update']);

		Route::delete('/student/{student}', ['as' => 'student.delete', 'uses' => 'StudentController@delete']);
		Route::delete('/prospective_student/{student}', ['as' => 'prospective_student.delete', 'uses' => 'ProspectiveStudentController@delete']);

		Route::match(['post','delete'],'/prospective_student/promote/{student}', ['as' => 'prospective_student.promote', 'uses' => 'ProspectiveStudentController@promote']);
		Route::match(['post','delete'],'/prospective_student/demote/{student}', ['as' => 'prospective_student.demote', 'uses' => 'ProspectiveStudentController@demote']);

		Route::post('/student_program/add', ['as' => 'student_program.store_submit', 'uses' => 'StudentProgramController@store_submit']);
		Route::get('/student_program/add/{student_program}', ['as' => 'student_program.store', 'uses' => 'StudentProgramController@store']);
		Route::get('/student_program/{student_program}', ['as' => 'student_program.update', 'uses' => 'StudentProgramController@update']);
		Route::patch('/student_program/{student_program}', ['as' => 'student_program.update_submit', 'uses' => 'StudentProgramController@update_submit']);
		Route::delete('/student_program/{student_program}', ['as' => 'student_program.delete', 'uses' => 'StudentProgramController@delete']);

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

		Route::get('/gqe/result/add', ['as' => 'gqe_result.store', 'uses' => 'GqeResultController@store']);
		Route::post('/gqe/result', ['as' => 'gqe_result.store_submit', 'uses' => 'GqeResultController@store_submit']);
		Route::get('/gqe/result/{student_id}/{offer_id}/edit', ['as' => 'gqe_result.update', 'uses' => 'GqeResultController@update']);
		Route::patch('/gqe/result/{student_id}/{offer_id}', ['as' => 'gqe_result.update_submit', 'uses' => 'GqeResultController@update_submit']);
		Route::delete('/gqe/result/{student_id}/{offer_id}', ['as' => 'gqe_result.delete', 'uses' => 'GqeResultController@delete']);

		Route::get('/gqe/offering/add', ['as' => 'gqe_offering.store', 'uses' => 'GqeOfferingController@store']);
		Route::post('/gqe/offering', ['as' => 'gqe_offering.store_submit', 'uses' => 'GqeOfferingController@store_submit']);
		Route::get('/gqe/offering/{offering}/edit', ['as' => 'gqe_offering.update', 'uses' => 'GqeOfferingController@update']);
		Route::patch('/gqe/offering/{offering}', ['as' => 'gqe_offering.update_submit', 'uses' => 'GqeOfferingController@update_submit']);
		Route::delete('/gqe/offering/{offering}', ['as' => 'gqe_offering.delete', 'uses' => 'GqeOfferingController@delete']);

		Route::get('/gqe/section/add', ['as' => 'gqe_section.store', 'uses' => 'GqeSectionController@store']);
		Route::post('/gqe/section', ['as' => 'gqe_section.store_submit', 'uses' => 'GqeSectionController@store_submit']);
		Route::get('/gqe/section/{section}/edit', ['as' => 'gqe_section.update', 'uses' => 'GqeSectionController@update']);
		Route::patch('/gqe/section/{section}', ['as' => 'gqe_section.update_submit', 'uses' => 'GqeSectionController@update_submit']);
		Route::delete('/gqe/section/{section}', ['as' => 'gqe_section.delete', 'uses' => 'GqeSectionController@delete']);

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

		Route::get('/assistantship/positions/add', ['as' => 'position.store', 'uses' => 'PositionController@store']);
		Route::post('/assistantship/positions/add', ['as' => 'position.store_submit', 'uses' => 'PositionController@store_submit']);
		Route::get('/assistantship/positions/{position}', ['as' => 'position.update', 'uses' => 'PositionController@update']);
		Route::patch('/assistantship/positions/{position}', ['as' => 'position.update_submit', 'uses' => 'PositionController@update_submit']);
		Route::delete('/assistantship/positions/{position}', ['as' => 'position.delete', 'uses' => 'PositionController@delete']);

		Route::get('/assistantship/status/add', ['as' => 'status.store', 'uses' => 'StatusController@store']);
		Route::post('/assistantship/status/add', ['as' => 'status.store_submit', 'uses' => 'StatusController@store_submit']);
		Route::get('/assistantship/status/{status}', ['as' => 'status.update', 'uses' => 'StatusController@update']);
		Route::patch('/assistantship/status/{status}', ['as' => 'status.update_submit', 'uses' => 'StatusController@update_submit']);
		Route::delete('/assistantship/status/{status}', ['as' => 'status.delete', 'uses' => 'StatusController@delete']);

		Route::get('/waiver/add', ['as' => 'tuition_waiver.store', 'uses' => 'TuitionWaiverController@store']);
	    Route::post('/waiver', ['as' => 'tuition_waiver.store_submit', 'uses' => 'TuitionWaiverController@store_submit']);
	    Route::get('/waiver/{waiver}/edit', ['as' => 'tuition_waiver.update', 'uses' => 'TuitionWaiverController@update']);
	    Route::patch('/waiver/{waiver}', ['as' => 'tuition_waiver.update_submit', 'uses' => 'TuitionWaiverController@update_submit']);
	    Route::delete('/waiver/{waiver}', ['as' => 'tuition_waiver.delete', 'uses' => 'TuitionWaiverController@delete']);

	    Route::get('/source/add', ['as' => 'funding_source.store', 'uses' => 'FundingSourceController@store']);
		Route::post('/source', ['as' => 'funding_source.store_submit', 'uses' => 'FundingSourceController@store_submit']);
		Route::get('/source/{source}/edit', ['as' => 'funding_source.update', 'uses' => 'FundingSourceController@update']);
		Route::patch('/source/{source}', ['as' => 'funding_source.update_submit', 'uses' => 'FundingSourceController@update_submit']);
		Route::delete('/source/{source}', ['as' => 'funding_source.delete', 'uses' => 'FundingSourceController@delete']);
	});
});