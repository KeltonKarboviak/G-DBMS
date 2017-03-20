<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Student;
use App\Advisor;
use App\Program;
use App\Semester;

class StudentController extends Controller
{
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
}
