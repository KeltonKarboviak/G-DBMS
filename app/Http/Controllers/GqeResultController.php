<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GqeResult;
use App\GqeSection;
use App\GqeOffering;
use App\Student;

class GqeResultController extends Controller
{
    private $rules = [
        'score' => 'numeric|min:0'
	];

	private $messages = [
        'student_id.required' => 'The Student field is required.',
        'offer_id.required' => 'The GQE Offering field is required.',
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
        $sections = GqeSection::orderBy('id', 'asc')->get();

        $students = Student::with('gqe_results.offering.section', 'gqe_results.pass_level', 'programs.program')
            ->whereHas('programs', function ($query) {
                return $query->where('student_programs.is_current', 1);
            })
            ->get(['id', 'first_name', 'last_name'])
            ->each(function ($student, $key) {
                $student->current_program = $student->programs->filter(function ($program) {
                    return $program->is_current === 1;
                })
                ->last();
            });

        return view('/gqe/result/index', [
            'sections' => $sections,
            'students' => $students,
        ]);
    }

    public function store(GqeResult $result) {
        $students = Student::with('programs')
            ->whereHas('programs', function ($query) {
                return $query->where('student_programs.is_current', 1);
            })
            ->get()
            ->pluck('full_name', 'id');

        $offerings = GqeOffering::orderBy('date', 'desc')
            ->with('semester', 'section')
            ->get()
            ->pluck('full_name', 'id');

        return view('/gqe/result/store', [
            'result' => $result,
            'students' => $students,
            'offerings' => $offerings,
        ]);
    }

    public function store_submit(Request $request) {
        $this->rules['student_id'] = 'required|exists:students,id';
        $this->rules['offer_id'] = 'required|exists:gqe_offerings,id';

        $this->validate($request, $this->rules, $this->messages);

        $result = GqeResult::create($request->except(['score']));
        $result->score = $request->get('score') ?: null;
        $result->save();

        session()->flash('alert-success', 'The GQE Result has been successfully created.');

        return redirect('/gqe/result');
    }

    public function update($student_id, $offer_id) {
        $result = GqeResult::find(['student_id' => $student_id, 'offer_id' => $offer_id])
            ->load('student', 'offering');

        return view('/gqe/result/update', [
            'result' => $result,
        ]);
    }

    public function update_submit(Request $request, $student_id, $offer_id) {
        $result = GqeResult::find(['student_id' => $student_id, 'offer_id' => $offer_id]);

        $this->validate($request, $this->rules, $this->messages);

        $result->score = $request->get('score') ?: null;
        $result->save();

        session()->flash('alert-success', 'The GQE Result has been successfully updated.');

        return redirect('/gqe/result');
    }

    public function delete($student_id, $offer_id) {
        $result = GqeResult::find(['student_id' => $student_id, 'offer_id' => $offer_id]);
        $result->delete();

        session()->flash('alert-success', 'The GQE Result has been successfully deleted.');

        return redirect('/gqe/result');
    }
}
