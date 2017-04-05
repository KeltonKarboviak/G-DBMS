<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GqeSection;

class GqeSectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('gqe/section/index', [
            'sections' => GqeSection::all(),
        ]);
    }

    public function store() {
        return view('/gqe/section/store', [
            'section' => new GqeSection,
        ]);
    }

    public function store_submit(Request $request) {
        $this->validate($request, [
            'name' => 'required|size:2|unique:gqe_sections'
        ]);

        $section = GqeSection::create($request->all());

        session()->flash('alert-success', 'The GQE Section has been successfully created.');

        return redirect('/gqe/section');
    }

    public function update(GqeSection $section) {
        return view('/gqe/section/update', [
            'section' => $section,
        ]);
    }

    public function update_submit(Request $request, GqeSection $section) {
        $this->validate($request, [
            'name' => 'required|size:2|unique:gqe_sections,name,' . $section->name,
        ]);

        $section->update($request->all());

        session()->flash('alert-success', 'The GQE Section has been succesfully updated.');

        return redirect('/gqe/section');
    }

    public function delete(GqeSection $section) {
        $section->delete();
        session()->flash('alert-success', 'The GQE Section has been successfully deleted.');
        return redirect('/gqe/section');
    }
}
