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
    // public function index()
    // {
    //     return view('/student/index', [
    //         'students' => Student::orderBy('last_name')->get()
    //     ]);
    // }

    public function index_filter(Request $request)
    {
        $query = Student::orderBy('last_name');
        $vals = array();

        if($request->has('first_name'))
            $query->where('first_name',$request->get('first_name'));
        if($request->has('last_name'))
            $query->where('last_name',$request->get('last_name'));
        if($request->has('is_current'))
        {
            if($request->get('is_current') === 'Yes')
            {
                $query->where('is_current',true);
            }
            else
                $query->where('is_current',false);
        }
        if($request->has('has_committee'))
        {
            if($request->get('has_committee') === 'Yes')
                $query->where('has_committee',true);
            else
                $query->where('has_committee',false);
        }
        if($request->has('has_program_study'))
        {
            if($request->get('has_program_study') === 'Yes')
                $query->where('has_program_study',true);
            else
                $query->where('has_program_study',false);
        }
        if($request->has('is_graduated'))
        {
            if($request->get('is_graduated') === 'Yes')
                $query->where('is_graduated',true);
            else
                $query->where('is_graduated',false);
        }
        if($request->has('faculty_supported'))
        {
            if($request->get('faculty_supported') === 'Yes')
                $query->where('faculty_supported',true);
            else
                $query->where('faculty_supported',false);
        }
        if ($request->has('program_id')) 
        {
            $ids = $request->get('program_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('program_id',$id);
                }
            }); 
        }
        if ($request->has('advisor_id')) 
        {
            $ids = $request->get('advisor_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('advisor_id',$id);
                }
            }); 
        }
        if ($request->has('semester_started_id')) 
        {
            $ids = $request->get('semester_started_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('semester_started_id',$id);
                }
            }); 
        }
        if ($request->has('semester_graduated_id')) 
        {
            $ids = $request->get('semester_graduated_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('semester_graduated_id',$id);
                }
            }); 
        }

        return view('/student/index', [
            'students' => $query->get(),
            'advisors' => Advisor::all()->lists("full_name","id"),
            'programs' => Program::lists("name","id"), 
            'semesters' => Semester::all()->lists("full_name","id"),
            'yesNo' => ['Yes' => 'Yes', 'No' => 'No'],
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'advisor_id' => $request->get('advisor_id'),
            'program_id' => $request->get('program_id'),
            'semester_started_id' => $request->get('semester_started_id'),
            'semester_graduated_id' => $request->get('semester_graduated_id'),
            'is_current' => $request->get('is_current'),
            'is_graduated' => $request->get('is_graduated'),
            'has_program_study' => $request->get('has_program_study'),
            'faculty_supported' => $request->get('faculty_supported'),
            'has_committee' => $request->get('has_committee'),
        ]);
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
            "has_committee" => $this->checkboxConvert($request->get("has_committee","off")),
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
    }

    public function update_submit(Request $request, Student $student)
    {
    	// global $rules, $messages;
    	$this->rules['id'] = 'required|size:7|regex:/\d{7}/|unique:students,id,'.$student->id;
    	$request->merge([
    		"has_program_study" => $this->checkboxConvert($request->get("has_program_study","off")),
            "has_committee" => $this->checkboxConvert($request->get("has_committee","off")),
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
