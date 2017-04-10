<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Redirect;
use URL;
use Session;

use App\Assistantship;
use App\Semester;
use App\Student;
use App\FundingSource;
use App\TuitionWaiver;
use App\AssistantshipStatus;
use App\Position;
use App\Program;

class AssistantshipController extends Controller
{

    private $rules = [
        'position' => 'required|exists:positions,name',
        'date_offered' => 'date|required',
        'date_responded' => 'date',
        'date_deferred' => 'date',
        'current_status_id' => 'required|exists:assistantship_statuses,id',
        'stipend' => 'numeric|min:0',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_filter(Request $request)
    {
        $sort_by = $request->get('sort_by','last_name');
        $query = Assistantship::with('status','student','semester','corresponding_waiver','funding_source')
            ->join('students','students.id','=','assistantships.student_id')
            ->join('student_programs','students.id','=','student_programs.student_id');

        $query->orderBy($sort_by);

        if($request->has('first_name'))
            $query->where('first_name',$request->get('first_name'));
        if($request->has('last_name'))
            $query->where('last_name',$request->get('last_name'));

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
        if ($request->has('semester_id')) 
        {
            $ids = $request->get('semester_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('semester_id',$id);
                }
            }); 
        }
        if ($request->has('funding_source_id')) 
        {
            $ids = $request->get('funding_source_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('funding_source_id',$id);
                }
            }); 
        }
        if ($request->has('current_status_id')) 
        {
            $ids = $request->get('current_status_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('current_status_id',$id);
                }
            }); 
        }

        $assists = $query->distinct()->get(['assistantships.*']);

        return view('/assistantship/index', [
            'assists' => $assists,
            'programs' => Program::lists("name","id"), 
            'semesters' => Semester::all()->lists("full_name","id"),
            'statuses' => AssistantshipStatus::all()->lists('description','id'),
            'funding_sources' => FundingSource::all()->lists('name','id'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'program_id' => $request->get('program_id'),
            'sort_by' => $sort_by,
            'sort_options' => ['last_name' => 'Last Name','current_status_id' => 'Current Status','semester_id' => 'Semester'],
            'current_status_id' => $request->get('current_status_id'),
            'funding_source_id' => $request->get('funding_source_id'),
            'semester_id' => $request->get('semester_id'),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = Student::join('student_programs','student_programs.student_id','=','students.id')->where('is_current',true)->distinct()->get(['students.*'])->lists('full_name','id');
        $assist_amounts = [];
        foreach($students as $id => $name)
        {
            $max_semesters = Program::join('student_programs','student_programs.program_id','=','programs.id')->where('student_id',$id)->max('assistantship_semesters_allowed');
            $taken_semesters = Assistantship::where('student_id',$id)->count();
            $assist_amounts[$id] = $taken_semesters . " semester(s) already awarded.<br>" . $max_semesters . " semester(s) max.";
        }

        return view('assistantship/store', [
            'assist' => null,
            'assist_amounts' => $assist_amounts,
            'semesters' => Semester::orderBy('calendar_year','desc')->orderBy('id','desc')->get()->lists('full_name','id'),
            'positions' => Position::all()->lists('name','name'),
            'students' => $students,
            'statuses' => AssistantshipStatus::all()->lists('description','id'),
            'funding_sources' => FundingSource::all()->lists('name','id'),
            'tuition_waivers' => TuitionWaiver::all()->lists('description','id'),
        ]);
    }

    public function store_submit(Request $request, Assistantship $assist)
    {
        $this->rules['student_id'] = 'required';

        if($request->has('stipend') && $request->get('stipend') > 0)
        {
            $this->rules['funding_source_id'] = 'required|exists:funding_sources,id';
        }

        $this->validate($request,$this->rules);

        $except = [];
        foreach(['defer_date','date_responded','date_offered','corresponding_tuition_waiver_id'] as $attr)
            if(!$request->has($attr))
                $except[] = $attr;

        $assist->create($request->except($except));

        Session::flash('alert-success','Assistantship added successfully');

        return redirect()->route('assistantship.store');
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
        return view('assistantship/update', [
            'assist' => $assist,
            'assist_amounts' => [],
            'semesters' => Semester::orderBy('calendar_year','desc')->orderBy('id','desc')->get()->lists('full_name','id'),
            'positions' => Position::all()->lists('name','name'),
            'students' => Student::join('student_programs','student_programs.student_id','=','students.id')->where('is_current',true)->distinct()->get(['students.*'])->lists('full_name','id'),
            'statuses' => AssistantshipStatus::all()->lists('description','id'),
            'funding_sources' => FundingSource::all()->lists('name','id'),
            'tuition_waivers' => TuitionWaiver::all()->lists('description','id'),
            'readonly' => true,
        ]);
    }

    public function update_submit(Request $request, Assistantship $assist)
    {
        // dd($request->has('defer_date'),$request->get('defer_date'));
        if($request->has('stipend') && $request->get('stipend') > 0)
        {
            $this->rules['funding_source_id'] = 'required|exists:funding_sources,id';
        }

        $this->validate($request,$this->rules);
        
        $except = [];
        $save = false;
        foreach(['defer_date','date_responded','date_offered','corresponding_tuition_waiver_id'] as $attr)
        {
            if(!$request->has($attr))
            {
                $except[] = $attr;
                if($assist[$attr] != null)
                {
                    $assist[$attr] = null;
                    $save = true;
                }
            }
        }
        if($save)
            $assist->save();

        $assist->update($request->except($except));

        Session::flash('alert-success','Assistantship updated successfully');

        return redirect('/assistantship');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Assistantship $assist)
    {
        $assist->delete();
        return Redirect::to(URL::previous());
    }
}
