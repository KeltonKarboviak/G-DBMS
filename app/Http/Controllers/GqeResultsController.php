<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\GqeOffering;
use App\GqeSection;
use App\Semester;
use App\Student;

class GqeResultsController extends Controller
{
    private $rules = [

	];

	private $messages = [

	];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        // $students->each(function ($student) use ($semester) {
        //     $student->gqe_results->filter(function ($result) use ($semester) {
        //         return $result->offering->semester_id == $semester->id;
        //     });
        // });
        //
        // $stu_results->whereHas('offering', function ($query) use ($semester->id) { $query->where('gqe_offerings.semester_id', $semester->id); })->get();

        // SELECT
        // 	sections.student,
        // 	SUM(sections.sum)
        // FROM
        // 	(
        // 		SELECT
        // 			s.id as 'student',
        // 			SUM(
        // 				IF(r.pass_level_id >= 2, 1, 0)
        // 			) as 'sum'
        // 		FROM
        // 			students s
        // 			LEFT JOIN gqe_results r ON s.id = r.student_id
        // 			LEFT JOIN gqe_offerings o ON r.offer_id = o.id
        // 		WHERE
        // 			s.is_current
        // 		GROUP BY
        // 			s.id,
        // 			o.gqe_section_id
        // 	) as sections
        // GROUP BY
        // 	sections.student;

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

    public function add() {

    }

    public function store(Request $request) {

    }

    public function edit(GqeOffering $offering) {

    }

    public function update(Request $request, GqeOffering $offering) {

    }

    public function destroy(GqeOffering $offering) {

    }
}
