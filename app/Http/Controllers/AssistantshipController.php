<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Semester;
use App\Student;
use App\FundingSource;
use App\TuitionWaiver;
use App\AssistantshipStatus;
use App\Position;

class AssistantshipController extends Controller
{

    $rules = [
        'student_id' => 'required',
        'position' => 'required',
        'date_offered' => 'date',
        'date_responded' => 'date',
        'date_deferred' => 'date',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('assistantship/store', [
            'assist' => null,
            'semesters' => Semester::all()->lists('full_name','id'),
            'positions' => Position::all()->lists('name','name'),
            'students' => Student::join('student_programs','student_programs.student_id','=','students.id')->where('is_current',true)->distinct()->get(['students.*'])->lists('full_name','id'),
            'statuses' => AssistantshipStatus::all()->lists('description','id'),
            'funding_sources' => FundingSource::all()->lists('name','id'),
            'tuition_waivers' => TuitionWaiver::all()->lists('description','id'),
        ]);
    }

    public function store_submit(Request $request, Assistantship $assist)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assistantship $assist)
    {
        //
    }

    public function update_submit(Request $request, Assistantship $assist)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
