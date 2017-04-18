<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\FundingSource;

class FundingSourceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    public function index() {
        return view('funding_source/index', [
            'sources' => FundingSource::all(),
        ]);
    }

    public function store() {
        return view('/funding_source/store', [
            'source' => new FundingSource,
        ]);
    }

    public function store_submit(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:50|unique:gqe_sections'
        ]);

        $to_fill = $request->except('is_grant');
        $to_fill['is_grant'] = $request->has('is_grant');

        $source = FundingSource::create($to_fill);

        session()->flash('alert-success', 'The Funding Source has been successfully created.');

        return redirect('/source');
    }

    public function update(FundingSource $source) {
        return view('/funding_source/update', [
            'source' => $source,
        ]);
    }

    public function update_submit(Request $request, FundingSource $source) {
        $this->validate($request, [
            'name' => 'required|max:50|unique:gqe_sections,name,' . $source->name,
        ]);

        $source->name = $request->get('name');
        $source->is_grant = $request->has('is_grant');

        $source->save();

        session()->flash('alert-success', 'The Funding Source has been succesfully updated.');

        return redirect('/source');
    }

    public function delete(FundingSource $source) {
        $source->delete();
        session()->flash('alert-success', 'The Funding Source has been successfully deleted.');
        return redirect('/source');
    }
}
