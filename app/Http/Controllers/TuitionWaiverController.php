<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TuitionWaiver;
use App\Student;
use App\Semester;
use App\FundingSource;

class TuitionWaiverController extends Controller
{
    private $rules = [
        'date_received' => 'required_with:received|date',
        'amount_received' => 'required|numeric|min:0',
        'credit_hours' => 'required|numeric|min:0|max:21',
        'funding_source_id' => 'required|exists:funding_sources,id',
        'received' => 'required_with:date_received',
    ];

    private $messages = [

    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $waivers = TuitionWaiver::with('semester', 'student', 'funding_source')
            ->orderBy('date_received', 'desc')
            ->orderBy('semester_id', 'desc')
            ->get();

        return view('/tuition_waiver/index', [
            'waivers' => $waivers,
        ]);
    }

    public function store() {
        $students = Student::whereHas('programs', function($query) {
                return $query->where('student_programs.is_current', 1);
            })
            ->get()
            ->pluck('full_name', 'id');

        $semesters = Semester::orderBy('calendar_year', 'desc')
            ->orderBy('id', 'desc')
            ->get()
            ->pluck('full_name', 'id');

        $sources = FundingSource::pluck('name', 'id');

        return view('/tuition_waiver/store', [
            'waiver' => new TuitionWaiver,
            'students' => $students,
            'semesters' => $semesters,
            'sources' => $sources,
        ]);
    }

    public function store_submit(Request $request) {
        $this->rules['student_id'] = 'required|exists:students,id';
        $this->rules['semester_id'] = 'required|exists:semesters,id';

        $this->validate($request, $this->rules, $this->messages);

        // $waiver = new TuitionWaiver($request->all());
        // dd($request->all(), $waiver);

        $waiver = TuitionWaiver::create($request->all());

        $waiver->date_received = $request->get('date_received') ?: null;
        $waiver->save();

        session()->flash('alert-success', 'The GQE Offering has been successfully created.');

        return redirect('/waiver');
    }

    public function update(TuitionWaiver $waiver) {
        $waiver->load('student', 'semester', 'funding_source');

        $sources = FundingSource::pluck('name', 'id');

        return view('/tuition_waiver/update', [
            'waiver' => $waiver,
            'sources' => $sources,
        ]);
    }

    public function update_submit(Request $request, TuitionWaiver $waiver) {
        $this->validate($request, $this->rules, $this->messages);

        $waiver->date_received = $request->get('date_received') ?: null;
        $waiver->amount_received = $request->get('amount_received') ?: null;
        $waiver->credit_hours = $request->get('credit_hours') ?: null;
        $waiver->received = $request->has('received');

        // dd($request->all(), $waiver);

        $waiver->save();
        // $waiver->update($request->except('date_received', ''))

        session()->flash('alert-success', 'The Tuition Waiver has been successfully updated.');

        return redirect('/waiver');
    }

    public function delete(TuitionWaiver $waiver) {
        $waiver->delete();
        session()->flash('alert-success', 'The Tuition Waiver has been successfully deleted.');
        return redirect('/waiver');
    }
}
