<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GqeResult;
use App\GqeSection;
use App\GqeOffering;
use App\Student;
use App\Semester;

class GqeResultController extends Controller
{
    private $rules = [
        'score' => 'numeric|min:0'
	];

	private $messages = [
        'student_id.required' => 'The Student field is required.',
        'offer_id.required' => 'The GQE Offering field is required.',
	];

	private $sort_options = [
        'last_name' => 'Last Name',
        'id' => 'EMPLID',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $sort_by = $request->get('sort_by', 'last_name');
        $current_students_choice = $request->get('current_students', [1]);

        $sections = GqeSection::orderBy('id', 'asc');

        $students = Student::with([
            'gqe_results.offering.section',
            'gqe_results.pass_level',
            'programs' => function ($query) use ($current_students_choice) {
                $query->whereIn('student_programs.is_current', $current_students_choice)
                    ->with('program');
            }
        ]);

        if ($request->has('gqe_section_id'))
            $sections->whereIn('id', $request->get('gqe_section_id'));

        if ($request->has('semester_id') || $request->has('gqe_section_id'))
            $students->with(['gqe_results' => function ($query) use ($request) {
                $query->whereHas('offering', function($query) use ($request) {
                    if ($request->has('semester_id'))
                        $query->whereIn('gqe_offerings.semester_id', $request->get('semester_id'));
                    if ($request->has('gqe_section_id'))
                        $query->whereIn('gqe_offerings.gqe_section_id', $request->get('gqe_section_id'));
                })->with('offering');
            }]);

        $sections = $sections->pluck('name', 'id');
        $students = $students->orderBy($sort_by)
            ->get(['id', 'first_name', 'last_name']);
        $semesters = Semester::orderBy('calendar_year', 'desc')
            ->orderBy('id', 'desc')
            ->get()
            ->pluck('full_name', 'id');

        $display_aggs = $sections->count() < 4;

        if ($display_aggs)
            $aggregates = Student::selectRaw(
                'gqe_offerings.gqe_section_id,
                COUNT(gqe_results.score) as total,
                MAX(gqe_results.score) as max,
                MIN(gqe_results.score) as min,
                AVG(gqe_results.score) as avg')
                ->join('student_programs', 'students.id', '=', 'student_programs.student_id')
                ->join('programs', 'student_programs.program_id', '=', 'programs.id')
                ->join('gqe_results', 'students.id', '=', 'gqe_results.student_id')
                ->join('gqe_offerings', 'gqe_results.offer_id', '=', 'gqe_offerings.id')
                ->where('student_programs.is_current', 1)
                ->groupBy('gqe_offerings.gqe_section_id')
                ->get()
                ->keyBy('gqe_section_id');
        else
            $aggregates = [];

        return view('/gqe/result/index', [
            'students' => $students,
            'sort_options' => $this->sort_options,
            'sort_by' => $request->get('sort_by'),
            'current_students_choices' => [1 => 'Yes', 0 => 'No'],
            'current_students_choice' => $current_students_choice,
            'semesters' => $semesters,
            'semester_id' => $request->get('semester_id'),
            'sections' => $sections,
            'gqe_section_id' => $request->get('gqe_section_id'),
            'display_aggs' => $display_aggs,
            'aggregates' => $aggregates,
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
