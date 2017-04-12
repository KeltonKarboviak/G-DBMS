<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Position;

class PositionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('assistantship/positions/index', [
            'positions' => Position::all(),
        ]);
    }

    public function store() {
        return view('/assistantship/positions/store', [
            'position' => null,
        ]);
    }

    public function store_submit(Request $request) {
        $this->validate($request, [
            'name' => 'required|size:3|unique:positions'
        ]);

        $position = Position::create($request->all());

        session()->flash('alert-success', 'The Assistantship Position has been successfully created.');

        return redirect('/assistantship/positions');
    }

    public function update(Position $position) {
        return view('/assistantship/positions/update', [
            'position' => $position,
        ]);
    }

    public function update_submit(Request $request, Position $position) {
        $this->validate($request, [
            'name' => 'required|size:3|unique:positions,name,' . $position->name . ',name',
        ]);

        $position->update($request->all());

        session()->flash('alert-success', 'The Assistantship Position has been succesfully updated.');

        return redirect('/assistantship/positions');
    }

    public function delete(Position $position) {
        $position->delete();
        session()->flash('alert-success', 'The Assistantship Position has been successfully deleted.');
        return redirect('/assistantship/positions');
    }
}
