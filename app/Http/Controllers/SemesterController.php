<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Redirect;

use URL;
use Validator;

use App\Semester;
use App\YearlyBudget;

class SemesterController extends Controller
{

    private $rules = [
        'calendar_year' => 'required|regex:/\d{4}/',
        'name' => 'required',
        'academic_year' => 'required|regex:/\d{4}/',
    ];

    private $messages = [
        'regex' => 'Years must be 4 digits.',
    ];

    private $names = ["Fall"=>"Fall","Spring"=>"Spring","Summer1"=>"Summer1","Summer2"=>"Summer2"];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($returnroute)
    {
        // echo "after " . session('previousURL');
        return view('/semester/store', [
            'semester' => null,
            'names' => $this->names,
            'returnroute' => $returnroute,
            // 'previousURL' => session('previousURL')
        ]);
    }

    public function store_submit(Request $request, Semester $semester)
    {
        $this->validate($request,$this->rules,$this->messages);
        // $validator = Validator::make($request->all(),$this->rules,$this->messages);
        // if($validator->fails())
        // {
        //     return Redirect::to(str_replace("SLASH","/",$request->get("returnroute")) . '/semesters/add')->withErrors($validator)->withInput();
        // }

        if(YearlyBudget::where("academic_year", $request->get("academic_year"))->get()->count() == 0)
        {
            $yearly_budget = new YearlyBudget();
            $yearly_budget->academic_year = $request->get("academic_year");
            $yearly_budget->budget = 0;
            $yearly_budget->funding_source_id = 1;
            $yearly_budget->save();
        }

        $semester->create($request->except("returnroute"));
        // $semester->create($request->all());

        return Redirect::to(str_replace("SLASH","/",$request->get("returnroute")));
        // return Redirect::to(session()->pull('previousURL','/home'));
    }
}
