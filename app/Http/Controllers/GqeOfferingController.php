<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GqeOffering;
use App\GqeSection;
use App\Semester;

class GqeOfferingController extends Controller
{
    private $rules = [
        'gqe_section_id' => 'required|exists:gqe_sections,id',
        'semester_id' => 'required|exists:semesters,id',
        'date' => 'required|date',
        'cutoff_ms' => 'required_with:cutoff_phd|numeric|min:0',
        'cutoff_phd' => 'required_with:cutoff_ms|numeric|min:0',
    ];

    private $messages = [
        'gqe_section_id.required' => 'The GQE Section field is required.',
        'semester_id.required' => 'The Semester field is required.',
        'cutoff_ms.required_with' => 'The MS Cutoff Score field is required when PhD Cutoff Score is present.',
        'cutoff_ms.numeric' => 'The MS Cutoff Score must be a number.',
        'cutoff_ms.min' => 'The MS Cutoff Score must be at least 0',
        'cutoff_phd.required_with' => 'The PhD Cutoff Score field is required when MS Cutoff Score is present.',
        'cutoff_phd.numeric' => 'The PhD Cutoff Score must be a number',
        'cutoff_phd.min' => 'The PhD Cutoff Score must be at least 0',
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
        $offerings = GqeOffering::with('section', 'semester')
            ->orderBy('date', 'desc')
            ->get();

        return view('/gqe/offering/index', [
            'offerings' => $offerings,
        ]);
    }

    public function store() {
        return view('/gqe/offering/store', [
            'offering' => new GqeOffering,
            'sections' => GqeSection::pluck('name', 'id'),
            'semesters' => Semester::orderBy('calendar_year', 'desc')
                                ->orderBy('id', 'desc')
                                ->get()
                                ->pluck('full_name', 'id'),
        ]);
    }

    public function store_submit(Request $request) {
        $this->validate($request, $this->rules, $this->messages);

        $offering = GqeOffering::create($request->all());

        session()->flash('alert-success', 'The GQE Offering has been successfully created.');

        return redirect('/gqe/offering');
    }

    public function update(GqeOffering $offering) {
        return view('/gqe/offering/update', [
            'offering' => $offering,
            'sections' => GqeSection::pluck('name', 'id'),
            'semesters' => Semester::orderBy('calendar_year', 'desc')
                                ->orderBy('id', 'desc')
                                ->get()
                                ->pluck('full_name', 'id'),
        ]);
    }

    public function update_submit(Request $request, GqeOffering $offering) {
        $this->validate($request, $this->rules, $this->messages);

        $offering->cutoff_ms  = $request->get('cutoff_ms')  ?: null;
        $offering->cutoff_phd = $request->get('cutoff_phd') ?: null;
        $offering->save();
        $offering->update($request->except(['cutoff_ms', 'cutoff_phd']));

        session()->flash('alert-success', 'The GQE Offering has been successfully updated.');

        return redirect('/gqe/offering');
    }

    public function delete(GqeOffering $offering) {
        $offering->delete();
        session()->flash('alert-success', 'The GQE Offering has been successfully deleted.');
        return redirect('/gqe/offering');
    }
}
