<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use Session;

use App\Student;
use App\StudentProgram;
use App\Advisor;
use App\Program;
use App\Semester;
use App\GreScore;
use App\IeltsScore;
use App\ToeflScore;

class StudentController extends Controller
{
	private $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'id' => 'required|size:7|regex:/\d{7}/|unique:students', //overwritten in update_submit
		'email' => 'email',
		'undergrad_gpa' => 'required|numeric|between:0,4',
        'toefl_score' => 'integer|between:0,120',
        'gre_score' => 'integer|between:260,340',
        'ielts_score' => 'numeric|between:0,9.5',
	];

	private $messages = [
		'id.regex' => 'The EMPLID must in format of DDDDDDD where D is a digit.',
		'id.required' => 'The EMPLID is required.',
		'id.size' => 'The EMPLID must be 7 digits.',
        'toefl_score.between' => 'TOEFL score must be an integer between 0 and 120',
        'gre_score.between' => 'GRE score must be an integer between 260 and 340',
        'ielts_score.between' => 'IELTS score must be a number between 0 and 9.5',
        'toefl_score.integer' => 'TOEFL score must be an integer between 0 and 120',
        'gre_score.integer' => 'GRE score must be an integer between 260 and 340',
        'ielts_score.numeric' => 'IELTS score must be a number between 0 and 9.5',
	];

    private $sort_options = [
        'last_name' => 'Last name',
        'first_name' => 'First name',
        'id' => 'EMPLID',
        'has_committee' => 'Has committee',
        'has_program_study' => 'Has program of study',
        'semester_started' => 'Semester started',
        'program_id' => 'Program',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    public function index_filter(Request $request)
    {
        $sort_by = $request->get('sort_by','last_name');
        $sort_out_of_db = in_array($sort_by, ['semester_started']);

        $query = Student::with('gce_results','gqe_results','programs')->join('student_programs','student_programs.student_id','=','students.id','left outer');
        if(!$sort_out_of_db) // ie sort by a db field
            $query->orderBy($sort_by);


        if($request->has('first_name'))
            $query->where('first_name', 'like', '%'.$request->get('first_name').'%');
        if($request->has('last_name'))
            $query->where('last_name', 'like', '%'.$request->get('last_name').'%');

        if($request->all() == null)
        {
            $query->where(function($query)
            {
                $query->orWhere('is_current',true)->orWhere(function($query)
                {
                    $query->whereNull('is_current');
                });
            });
        }
        else if($request->has('is_current')) //the default is for current students only
        {
            if($request->get('is_current') === 'Yes')
            {
                $query->where(function($query)
                {
                    $query->orWhere('is_current',true)->orWhere(function($query)
                    {
                        $query->whereNull('is_current');
                    });
                });
            }
            else
                $query->where('is_current',false);
        }

        if ($request->has('has_committee'))
            $query->where('has_committee', $request->get('has_committee') === 'Yes');

        if ($request->has('has_program_study'))
            $query->where('has_program_study', $request->get('has_program_study') === 'Yes');

        if ($request->has('is_graduated'))
            $query->where('is_graduated', $request->get('is_graduated') === 'Yes');

        if ($request->has('faculty_supported'))
            $query->where('faculty_supported', $request->get('faculty_supported') === 'Yes');

        if ($request->has('program_id'))
            $query->whereIn('program_id', $request->get('program_id'));

        if ($request->has('advisor_id'))
            $query->whereIn('advisor_id', $request->get('advisor_id'));

        if ($request->has('semester_started_id'))
            $query->whereIn('semester_started_id', $request->get('semester_started_id'));

        if ($request->has('semester_graduated_id'))
            $query->whereIn('semester_graduated_id', $request->get('semester_graduated_id'));

        $students = $query->distinct()->get(['students.*']);
        $showRank = false;
        if($sort_out_of_db)
        {
            if($sort_by === 'semester_started')
            {
                $students = $students->sortByDesc(function($stud){
                    $last_start = -1;
                    foreach ($stud->programs as $sp) {
                        if($last_start == -1)
                            $last_start = $sp->semester_started->sort_num;
                        else if($sp->semester_started->sort_num > $last_start)
                            $last_start = $sp->semester_started->sort_num;
                    }
                    return $last_start;
                });
            }
        }

        return view('/student/index', [
            'students' => $students,
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
            'is_current' => $request->input('is_current','Yes'),
            'is_graduated' => $request->get('is_graduated'),
            'has_program_study' => $request->get('has_program_study'),
            'faculty_supported' => $request->get('faculty_supported'),
            'has_committee' => $request->get('has_committee'),
            'sort_options' => $this->sort_options,
            'sort_by' => $sort_by,
            'showRank' => $showRank,
        ]);
    }

    public function delete(Student $student)
    {
    	$student->delete();
    	return Redirect::to('/student');
    }

    public function store()
    {
    	return view('/student/store', [
    		'student' => null,
    		'advisors' => Advisor::all()->lists("full_name","id"),
    		'programs' => Program::lists("name","id"),
    		'semesters' => Semester::all()->lists("full_name","id")
    	]);
    }

    private function checkboxConvert($onoff) {
        return $onoff === 'on';
    }

    public function store_submit(Request $request, Student $student)
    {
    	$request->merge([
            "faculty_supported" => $this->checkboxConvert($request->get("faculty_supported","off")),
    	]);

    	$this->validate($request,$this->rules,$this->messages);

        $student->create($request->except(['gre_score','toefl_score','ielts_score']));

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
    	$this->rules['id'] = 'required|size:7|regex:/\d{7}/|unique:students,id,'.$student->id;
    	$request->merge([
            "faculty_supported" => $this->checkboxConvert($request->get("faculty_supported","off")),
    	]);

    	$this->validate($request,$this->rules,$this->messages);

    	$student->update($request->except(['gre_score','toefl_score','ielts_score']));

    	return Redirect::to('/student');
    }
}
