<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Redirect;

use URL;
use Validator;

use App\Semester;
use App\SemesterName;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    public function store($returnroute)
    {
        return view('/semester/store', [
            'semester' => null,
            'names' => SemesterName::all()->lists('name','id'),
            'returnroute' => $returnroute,
        ]);
    }

    public function store_submit(Request $request, Semester $semester)
    {
        $this->validate($request,$this->rules,$this->messages);

        if(YearlyBudget::where("academic_year", $request->get("academic_year"))->get()->count() == 0)
        {
            $yearly_budget = new YearlyBudget();
            $yearly_budget->academic_year = $request->get("academic_year");
            $yearly_budget->budget = 0;
            $yearly_budget->funding_source_id = 1;
            $yearly_budget->save();
        }

        $semester->create($request->except("returnroute"));

        return Redirect::to(str_replace("SLASH","/",$request->get("returnroute")));
    }
}
