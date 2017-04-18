<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\AssistantshipStatus;

class StatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    public function index() {
        return view('assistantship/statuses/index', [
            'statuses' => AssistantshipStatus::all(),
        ]);
    }

    public function store() {
        return view('/assistantship/statuses/store', [
            'status' => null,
        ]);
    }

    public function store_submit(Request $request) {
        $this->validate($request, [
            'description' => 'required|between:0,50|unique:assistantship_statuses'
        ]);

        $status = AssistantshipStatus::create($request->all());

        session()->flash('alert-success', 'The Assistantship Status has been successfully created.');

        return redirect('/assistantship/status');
    }

    public function update(AssistantshipStatus $status) {
        return view('/assistantship/statuses/update', [
            'status' => $status,
        ]);
    }

    public function update_submit(Request $request, AssistantshipStatus $status) {
        $this->validate($request, [
            'description' => 'required|between:0,50|unique:assistantship_statuses,description,' . $status->description,
        ]);

        $status->update($request->all());

        session()->flash('alert-success', 'The Assistantship Status has been succesfully updated.');

        return redirect('/assistantship/status');
    }

    public function delete(AssistantshipStatus $status) {
        $status->delete();
        session()->flash('alert-success', 'The Assistantship Status has been successfully deleted.');
        return redirect('/assistantship/status');
    }
}
