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
    private $rules = [
        'date' => 'required|date',
        'student_id' => 'required',
    ];

    private function checkboxConvert($onoff)
    {
        if($onoff == "on")
            return true;
        else
            return false;
    }

    private function dateConvert($mmddyyyy)
    {
        $firstSlash = strpos($mmddyyyy,'/');
        $month = substr($mmddyyyy,0,$firstSlash);
        $secondSlash = strpos($mmddyyyy,'/',$firstSlash+1);
        $day = substr($mmddyyyy, $firstSlash + 1, $secondSlash - $firstSlash - 1);
        $year = substr($mmddyyyy, $secondSlash+1);

        $output = $year . '-' . $month . '-' . $day;
        // dd($output);
        return $output;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // dd(Student::join('student_programs','students.id','=','student_programs.student_id')->join('programs','student_programs.program_id','=','programs.id')->where('programs.needs_gce',true)->distinct()->get(['students.*'])->lists('full_name','id'));

        return view('gce/store', [
            'gce' => null,
            'students' => Student::orderBy('first_name')->join('student_programs','students.id','=','student_programs.student_id')->join('programs','student_programs.program_id','=','programs.id')->where('programs.needs_gce',true)->distinct()->get(['students.*'])->lists('full_name','id'),
        ]);
    }

    public function store_submit(Request $request, GceResult $gce)
    {
        // dd(date('Y-m-d',strtotime(str_replace('/','-',$request->get('date')))));
        $request->merge([
            "passed" => $this->checkboxConvert($request->get("passed","off")),
            "date" => $this->dateConvert($request->get('date')),
        ]);

        $this->validate($request,$this->rules);

        $gce->create($request->all());

        Session::flash('alert-success','GCE Result added successfully');

        return view('gce/store', [
            'gce' => null,
            'students' => Student::orderBy('first_name')->join('student_programs','students.id','=','student_programs.student_id')->join('programs','student_programs.program_id','=','programs.id')->where('programs.needs_gce',true)->distinct()->get(['students.*'])->lists('full_name','id'),
        ]);
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
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(GceResult $gce)
    {
        //
    }
}
