<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use DB;

use App\Advisor;
use App\Student;
use App\StudentProgram;

class AdvisorController extends Controller
{
	private $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'id' => 'required|size:7|regex:/\d{7}/|unique:advisors',
		'email' => 'email',
	];

	private $messages = [
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
        return view('/advisor/index',[
        	'advisors' => Advisor::orderBy('last_name')->get()
        ]);
    }

    public function info(Advisor $advisor)
    {
        // dd(Student::with('programs')->join('student_programs','student_programs.student_id','=','students.id')
        //     ->where('student_programs.advisor_id', $advisor->id)->distinct()->get(['students.*']));
    	return view('/advisor/info', [
    		'advisor' => $advisor,
    		// 'students' => Student::where('advisor_id',$advisor->id)->where('is_current',true)->orderBy('last_name')->get(),
            'students' => Student::with('programs')->join('student_programs','students.id','=','student_programs.student_id')
                ->where('student_programs.advisor_id', $advisor->id)->where('is_current',true)->distinct()->get(['students.*']),
    	]);
    }

    public function delete(Request $request, Advisor $advisor)
    {
    	// $query = 'SELECT COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "students" AND COLUMN_NAME = "advisor_id";';
    	$numAdvisees = Student::where('advisor_id',$advisor->id)->count();
    	// if(array_pluck(DB::select($query),'COLUMN_DEFAULT')[0] === $advisor->id)
    	if($numAdvisees != 0)
    	{
    		$request->session()->flash('alert-danger', $advisor->full_name . " has students that he/she advises. You must re-assign all his/her students on the Student Info page before deleting.");
    		return Redirect::to('/advisor');
    	}
    	else
    	{
    		$request->session()->flash('alert-success', $advisor->full_name . " has been successfully deleted.");
	    	$advisor->delete();
	    	return Redirect::to('/advisor');
    	}
    }

    public function store()
    {
    	return view('/advisor/store', [
    		'advisor' => null,
    	]);
    }

    public function store_submit(Request $request, Advisor $advisor)
    {
    	// global $rules, $messages;

    	$this->validate($request,$this->rules,$this->messages);

    	$advisor->create($request->all());

    	return Redirect::to('/advisor');
    }

    public function update(Advisor $advisor)
    {
    	return view('/advisor/update', [
    		'advisor' => $advisor,
    	]);
    	//return view('/student/update')->with('student', $advisor);
    }

    public function update_submit(Request $request, Advisor $advisor)
    {
    	// global $rules, $messages;
    	$this->rules['id'] = 'required|size:7|regex:/\d{7}/|unique:advisors,id,'.$advisor->id;

    	// dd($request->all());

    	$this->validate($request,$this->rules,$this->messages);

    	$advisor->update($request->all());

    	return Redirect::to('/advisor');
    }
}
