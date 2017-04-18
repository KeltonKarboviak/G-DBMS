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
use App\SemesterName;
use URL;

class StudentProgramController extends Controller
{

    private $rules = [
        'student_id' => 'required|exists:students,id',
        'advisor_id' => 'required|exists:advisors,id',
        'program_id' => 'required|exists:programs,id',
        'semester_graduated_name_id' => 'required_if:is_graduated,on',
        'semester_started_name_id' => 'required',
        'semester_started_year' => 'required',
        'semester_graduated_name_id' => 'required_with:semester_graduated_year|required_if:is_graduated,on',
        'semester_graduated_year' => 'required_with:semester_graduated_name_id',
        'topic' => 'between:0,255',
    ];

    private $messages = [

    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }


    public function delete(StudentProgram $student_program)
    {
        $student_program->delete();
        return Redirect::to(URL::previous());
    }

    private function checkboxConvert($onoff) {
        return $onoff === 'on';
    }

    public function store($student_id)
    {
        $student = Student::where('id',$student_id)->get()[0];

        return view('/student_program/store', [
            'student_program' => null,
            'sent_student' => $student,
            'advisors' => Advisor::all()->lists("full_name","id"),
            'programs' => Program::lists("name","id"),
            'semester_names' => SemesterName::all()->lists("name","id"),
            'needs_committee' => Program::lists('needs_committee','id'),
        ]);
    }

    public function store_submit(Request $request, StudentProgram $student_program)
    {
        $request->merge([
            "has_program_study" => $this->checkboxConvert($request->get("has_program_study","off")),
            "has_committee" => $this->checkboxConvert($request->get("has_committee","off")),
            "is_current" => $this->checkboxConvert($request->get("is_current","off")),
            "is_graduated" => $this->checkboxConvert($request->get("is_graduated","off")),
        ]);

        if($request->has('semester_graduated_name_id')) // if student is graduated
        {
            $this->rules['is_graduated'] = 'Accepted';
            $this->messages['is_graduated.accepted'] = 'The student must be graduated to have a graduation semester';
            $this->rules['is_current'] = 'different:is_graduated';
            $this->messages['is_current.different'] = 'A student cannot be both current and graduated';
        }

        $this->validate($request,$this->rules,$this->messages);

        $semester_started_id = Semester::firstOrCreate([
            'name_id' => $request->get('semester_started_name_id'),
            'calendar_year' => $request->get('semester_started_year'),
            'academic_year' => Semester::getAcademicYear($request->get('semester_started_name_id'),$request->get('semester_started_year')),
        ])->id;

        $array_for_fill = $request->except(['id','semester_started_name_id','semester_started_year','semester_graduated_name_id','semester_graduated_year',]);
        $array_for_fill['semester_started_id'] = $semester_started_id;
        if($request->semester_graduated_name_id != "") // if have graduated
        {
            $array_for_fill['semester_graduated_id'] = Semester::firstOrCreate([
                'name_id' => $request->get('semester_graduated_name_id'),
                'calendar_year' => $request->get('semester_graduated_year'),
                'academic_year' => Semester::getAcademicYear($request->get('semester_graduated_name_id'),$request->get('semester_graduated_year')),
            ])->id;
        }

        $student_program->create($array_for_fill);

        return Redirect::to('/student');
    }

    public function update(StudentProgram $student_program)
    {
        return view('/student_program/update', [
            'student_program' => $student_program,
            'sent_student' => $student_program->student,
            'advisors' => Advisor::all()->lists("full_name","id"),
            'programs' => Program::lists("name","id"),
            'semester_names' => SemesterName::all()->lists('name','id'),
            'needs_committee' => Program::lists('needs_committee','id'),
        ]);
    }

    public function update_submit(Request $request, StudentProgram $student_program)
    {
        $request->merge([
            "has_program_study" => $this->checkboxConvert($request->get("has_program_study","off")),
            "has_committee" => $this->checkboxConvert($request->get("has_committee","off")),
            "is_current" => $this->checkboxConvert($request->get("is_current","off")),
            "is_graduated" => $this->checkboxConvert($request->get("is_graduated","off")),
        ]);

        if($request->has('semester_graduated_name_id'))
        {
            $this->rules['is_graduated'] = 'Accepted';
            $this->messages['is_graduated.accepted'] = 'The student must be graduated to have a graduation semester';
            $this->rules['is_current'] = 'different:is_graduated';
            $this->messages['is_current.different'] = 'A student cannot be both current and graduated';
        }

        $this->validate($request,$this->rules,$this->messages);

        $semester_started_id = Semester::firstOrCreate([
            'name_id' => $request->get('semester_started_name_id'),
            'calendar_year' => $request->get('semester_started_year'),
            'academic_year' => Semester::getAcademicYear($request->get('semester_started_name_id'),$request->get('semester_started_year')),
        ])->id;

        $array_for_fill = $request->except(['id','semester_started_name_id','semester_started_year','semester_graduated_name_id','semester_graduated_year',]);
        $array_for_fill['semester_started_id'] = $semester_started_id;
        if($request->semester_graduated_name_id != "") // if have graduated
        {
            $array_for_fill['semester_graduated_id'] = Semester::firstOrCreate([
                'name_id' => $request->get('semester_graduated_name_id'),
                'calendar_year' => $request->get('semester_graduated_year'),
                'academic_year' => Semester::getAcademicYear($request->get('semester_graduated_name_id'),$request->get('semester_graduated_year')),
            ])->id;
        }
        else
        {
            $student_program->semester_graduated_id = null;
            $student_program->save();
        }

        $student_program->update($array_for_fill);

        return Redirect::to('/student');
    }
}
