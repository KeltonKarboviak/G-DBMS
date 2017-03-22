<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;

use App\Student;
use App\Advisor;
use App\Program;
use App\Semester;

class StudentController extends Controller
{
	private $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'id' => 'required|size:7|regex:/\d{7}/|unique:students',
		'email' => 'email',
		'advisor_id' => 'required',
		'undergrad_gpa' => 'required|numeric|between:0,4',
		'program_id' => 'required', 
		'semester_graduated_id' => 'required_if:is_graduated,on',
		'semester_started_id' => 'required'
	];

	private $messages = [
		'semester_graduated_id.required_if' => 'You must supply the semester the student graduated.',
		'id.regex' => 'The EMPLID must in format of DDDDDDD where D is a digit.',
		'id.required' => 'The EMPLID is required.',
		'id.size' => 'The EMPLID must be 7 digits.'
	];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the list of students.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/student/index');
    }

    public function delete(Student $student)
    {
    	$student->delete();
    	return Redirect::to('/student');
    }

    private function checkboxConvert($onoff)
    {
    	if($onoff == "on")
    		return true;
    	else
    		return false;
    }

    public function store()
    {
    	// dd("hi");
    	// session()->forget('previousURL');
    	return view('/student/store', [
    		'student' => null,
    		'advisors' => Advisor::all()->lists("full_name","id"),
    		'programs' => Program::lists("name","id"), 
    		'semesters' => Semester::all()->lists("full_name","id")
    	]);
    }

    public function store_submit(Request $request, Student $student)
    {
    	// global $rules, $messages;
    	$request->merge([
    		"has_program_study" => $this->checkboxConvert($request->get("has_program_study","off")),
    		"is_current" => $this->checkboxConvert($request->get("is_current","off")),
    		"is_graduated" => $this->checkboxConvert($request->get("is_graduated","off")),
    	]);

    	$this->validate($request,$this->rules,$this->messages);

    	if($request->semester_graduated_id == "")
    	{
    		$student->create($request->except(['semester_graduated_id']));
    	}
    	else
    	{
    		$student->create($request->all());
    	}

    	return Redirect::to('/student');
    }

    public function update(Student $student)
    {
    	return view('/student/update', [
    		'student' => $student,
    		'advisors' => Advisor::all()->lists("full_name","id"),
    		'programs' => Program::lists("name","id"), 
    		'semesters' => Semester::all()->lists("full_name","id")
    	]);
    	//return view('/student/update')->with('student', $student);
    }

    public function update_submit(Request $request, Student $student)
    {
    	// global $rules, $messages;
    	$request->merge([
    		"has_program_study" => $this->checkboxConvert($request->get("has_program_study","off")),
    		"is_current" => $this->checkboxConvert($request->get("is_current","off")),
    		"is_graduated" => $this->checkboxConvert($request->get("is_graduated","off")),
    	]);

    	// dd($request->all());

    	$this->validate($request,$this->rules,$this->messages);

    	if($request->semester_graduated_id == "")
    	{
    		$student->update($request->except(['semester_graduated_id']));
    	}
    	else
    	{
    		$student->update($request->all());
    	}

    	return Redirect::to('/student');
    }
}
