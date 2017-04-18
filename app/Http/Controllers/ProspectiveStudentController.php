<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use Session;
use URL;

use App\ProspectiveStudent;
use App\GreScore;
use App\IeltsScore;
use App\ToeflScore;

//for demotion checks
use App\StudentProgram;
use App\Assistantship;
use App\TuitionWaiver;
use App\GceResult;
use App\GqeResult;

class ProspectiveStudentController extends Controller
{
	private $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'id' => 'required|size:7|regex:/\d{7}/|unique:students',
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
        'ranking' => 'Ranking',
        'id' => 'EMPLID',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    public function promote(ProspectiveStudent $student)
    {
        \App\Student::create([
            'id' => $student->id,
            'email' => $student->email,
            'undergrad_gpa' => $student->undergrad_gpa,
            'faculty_supported' => $student->faculty_supported,
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
        ]);

        $name = $student->full_name;

        $student->delete();

        Session::flash('alert-success',$name . " was successfully promoted to full student.");

        return Redirect::to('/prospective_student');
    }

    public function demote(\App\Student $student)
    {
        $name = $student->full_name;
        //do a bunch of checks on the tables that reference students
        if(
            StudentProgram::where('student_id',$student->id)->exists() ||
            Assistantship::where('student_id',$student->id)->exists() ||
            TuitionWaiver::where('student_id',$student->id)->exists() ||
            GceResult::where('student_id',$student->id)->exists() ||
            GqeResult::where('student_id',$student->id)->exists()
        )
        {
            Session::flash('alert-danger',$name . " has information that would be deleted by demoting him/her. Please delete this information before attempting demotion.");

            return Redirect::to(URL::previous());
        }

        ProspectiveStudent::create([
            'id' => $student->id,
            'email' => $student->email,
            'undergrad_gpa' => $student->undergrad_gpa,
            'faculty_supported' => $student->faculty_supported,
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
        ]);

        $student->delete();

        Session::flash('alert-success',$name . " was successfully demoted to prospective student.");

        return Redirect::to('/student');
    }

    public function index_filter(Request $request)
    {
        $sort_by = $request->get('sort_by','last_name');
        $sort_out_of_db = in_array($sort_by, ['ranking']);

        $query = ProspectiveStudent::with('gre','ielts','toefl');
        if(!$sort_out_of_db) // ie sort by a db field
            $query->orderBy($sort_by);


        if($request->has('first_name'))
            $query->where('first_name', 'like', '%'.$request->get('first_name').'%');
        if($request->has('last_name'))
            $query->where('last_name', 'like', '%'.$request->get('last_name').'%');

        if($request->has('faculty_supported'))
        {
            if($request->get('faculty_supported') === 'Yes')
                $query->where('faculty_supported',true);
            else
                $query->where('faculty_supported',false);
        }

        $students = $query->distinct()->get(['prospective_students.*']);
        $showRank = false;
        if($sort_out_of_db)
        {
            if($sort_by === 'ranking')
            {
                $students = $students->sortByDesc(function($stud){
                    return $stud->ranking;
                });
                $showRank = true;
            }
        }

        return view('/prospective_student/index', [
            'students' => $students,
            'yesNo' => ['Yes' => 'Yes', 'No' => 'No'],
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'faculty_supported' => $request->get('faculty_supported'),
            'sort_options' => $this->sort_options,
            'sort_by' => $sort_by,
            'showRank' => $showRank,
        ]);
    }

    public function delete(ProspectiveStudent $student)
    {
    	$student->delete();
    	return Redirect::to('/prospective_student');
    }

    public function store()
    {
    	return view('/prospective_student/store', [
    		'student' => null,
    	]);
    }

    private function checkboxConvert($onoff) {
        return $onoff === 'on';
    }

    public function store_submit(Request $request, ProspectiveStudent $student)
    {
    	$request->merge([
            "faculty_supported" => $this->checkboxConvert($request->get("faculty_supported","off")),
    	]);

    	$this->validate($request,$this->rules,$this->messages);

        $student->create($request->except(['gre_score','toefl_score','ielts_score']));

        if($request->has('gre_score'))
            $gre = GreScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('gre_score')]);

        if($request->has('ielts_score'))
            $ielts = IeltsScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('ielts_score')]);

        if($request->has('toefl_score'))
            $toefl = ToeflScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('toefl_score')]);

    	return Redirect::to('/prospective_student');
    }

    public function update(ProspectiveStudent $student)
    {
        $student->load('gre','toefl','ielts');
    	return view('/prospective_student/update', [
    		'student' => $student,
    	]);
    }

    public function update_submit(Request $request, ProspectiveStudent $student)
    {
    	$this->rules['id'] = 'required|size:7|regex:/\d{7}/|unique:students,id,'.$student->id;
    	$request->merge([
            "faculty_supported" => $this->checkboxConvert($request->get("faculty_supported","off")),
    	]);

    	$this->validate($request,$this->rules,$this->messages);

    	$student->update($request->except(['gre_score','toefl_score','ielts_score']));


        if($request->has('gre_score'))
            $gre = GreScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('gre_score')]);

        if($request->has('ielts_score'))
            $ielts = IeltsScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('ielts_score')]);

        if($request->has('toefl_score'))
            $toefl = ToeflScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('toefl_score')]);

    	return Redirect::to('/prospective_student');
    }
}
