<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;
use URL;
use Session;
use Route;

use App\Student;
use App\GceResult;

class GceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    private $rules = [
        'date' => 'required|date',
    ];

    private $messages  = [];

    private function checkboxConvert($onoff) {
        return $onoff === 'on';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $students = Student::orderBy('first_name')
            ->join('student_programs','students.id','=','student_programs.student_id')
            ->join('programs','student_programs.program_id','=','programs.id')
            ->where('programs.needs_gce',true)->distinct()->get(['students.*']);
        $students = $students->filter(function ($student){
            $sps = $student->programs->filter(function ($sp){
                return $sp->program->needs_gce;
            });
            $passed = false;
            foreach($sps as $sp)
                $passed = $passed || $sp->passed_gqes;
            return $passed;
        });
        $students = $students->lists('full_name','id');
        return view('gce/store', [
            'gce' => null,
            'students' => $students,
        ]);
    }

    public function store_submit(Request $request, GceResult $gce)
    {
        $request->merge([
            "passed" => $this->checkboxConvert($request->get("passed","off")),
        ]);
        $this->rules['student_id'] = 'required';

        if($request->get('passed'))
        {
            $this->rules['student_id'] = 'unique:gce_results,student_id,NULL,id,passed,1';
            $this->messages['student_id.unique'] = 'The student has already passed the GCE.';
        }

        $this->validate($request,$this->rules,$this->messages);

        $gce->create($request->all());

        Session::flash('alert-success','GCE Result added successfully');

        return redirect()->route('gce.store');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GceResult $gce)
    {
        return view('gce/update', [
            'gce' => $gce,
            'students' => Student::orderBy('first_name')->join('student_programs','students.id','=','student_programs.student_id')->join('programs','student_programs.program_id','=','programs.id')->where('programs.needs_gce',true)->distinct()->get(['students.*'])->lists('full_name','id'),
            'readonly' => true,
        ]);
    }

    public function update_submit(Request $request, GceResult $gce)
    {
        $request->merge([
            "passed" => $this->checkboxConvert($request->get("passed","off")),
        ]);

        if($request->get('passed'))
        {
            $this->rules['student_id'] = 'unique:gce_results,student_id,NULL,id,passed,1';
            $this->messages['student_id.unique'] = 'The student has already passed the GCE.';
        }

        $this->validate($request,$this->rules,$this->messages);

        $gce->update($request->all());

        Session::flash('alert-success','GCE Result updated successfully');

        return view('gce/update', [
            'gce' => $gce,
            'students' => Student::orderBy('first_name')->join('student_programs','students.id','=','student_programs.student_id')->join('programs','student_programs.program_id','=','programs.id')->where('programs.needs_gce',true)->distinct()->get(['students.*'])->lists('full_name','id'),
            'readonly' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  GceResult  $gce
     */
    public function delete(GceResult $gce)
    {
        $gce->delete();
        Session::flash('alert-success', 'GCE Result deleted.');
        return Redirect::to('/student');
    }
}

