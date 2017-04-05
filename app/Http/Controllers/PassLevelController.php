<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\PassLevel;

class PassLevelController extends Controller
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
        return view('gqe/pass_level/index', [
            'levels' => PassLevel::all(),
        ]);
    }

    public function store() {
        return view('/gqe/pass_level/store', [
            'level' => new PassLevel,
        ]);
    }

    public function store_submit(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:30|unique:pass_levels'
        ]);

        $level = PassLevel::create($request->all());

        session()->flash('alert-success', 'The GQE Pass Level has been successfully created.');

        return redirect('/gqe/passlevel');
    }

    public function update(PassLevel $level) {
        return view('/gqe/pass_level/update', [
            'level' => $level,
        ]);
    }

    public function update_submit(Request $request, PassLevel $level) {
        $this->validate($request, [
            'name' => 'required|max:30|unique:pass_levels,name,' . $level->name,
        ]);

        $level->update($request->all());

        session()->flash('alert-success', 'The GQE Pass Level has been succesfully updated.');

        return redirect('/gqe/passlevel');
    }

    public function delete(PassLevel $level) {
        $level->delete();
        session()->flash('alert-success', 'The GQE Pass Level has been successfully deleted.');
        return redirect('/gqe/passlevel');
    }
}
