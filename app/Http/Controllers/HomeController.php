<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Response;

use App\Assistantship;
use App\TuitionWaiver;
use App\YearlyBudget;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/home', [
            'years' => YearlyBudget::all()->lists('full_name', 'academic_year'),
        ]);
    }

    public function chart(Request $request) {
        $year = $request->input('year');

        $budget = YearlyBudget::find($year, ['budget']);

        if ($budget == null)
            return Response::json(['success' => false]);

        $budget = (double)$budget->budget;

        $assistantships = (double)Assistantship
            ::join('semesters', 'assistantships.semester_id', '=', 'semesters.id')
            ->where('semesters.academic_year', '=', $year)
            ->where('assistantships.funding_source_id', '=', 1)
            ->sum('assistantships.stipend');

        $waivers = (double)TuitionWaiver
            ::join('semesters', 'tuition_waivers.semester_id', '=', 'semesters.id')
            ->where('semesters.academic_year', '=', $year)
            ->where('tuition_waivers.funding_source_id', '=', 1)
            ->sum('tuition_waivers.amount_received');

        $remaining = $budget - $assistantships - $waivers;

        return Response::json([
            'success' => true,
            'budget' => $budget,
            'assistantships' => $assistantships,
            'waivers' => $waivers,
            'remaining' => $remaining,
        ]);
    }

    public function drilldown(Request $request) {
        $year = $request->input('year');
        $name = $request->input('name');

        $budget = YearlyBudget::find($year, ['budget']);

        if ($budget == null)
            return Response::json(['success' => false]);

        if ($name === 'Assistantships') {
            $data = Assistantship
                ::selectRaw('concat(students.first_name, " ", students.last_name) as full_name, sum(assistantships.stipend) as sum')
                ->join('semesters', 'assistantships.semester_id', '=', 'semesters.id')
                ->join('students', 'assistantships.student_id', '=', 'students.id')
                ->where('semesters.academic_year', $year)
                ->where('assistantships.funding_source_id', 1)
                ->groupBy('assistantships.student_id')
                ->lists('sum', 'full_name');
        } else if ($name === 'Tuition Waivers') {
            $data = TuitionWaiver
                ::selectRaw('concat(students.first_name, " ", students.last_name) as full_name, sum(tuition_waivers.amount_received) as sum')
                ->join('semesters', 'tuition_waivers.semester_id', '=', 'semesters.id')
                ->join('students', 'tuition_waivers.student_id', '=', 'students.id')
                ->where('semesters.academic_year', '=', $year)
                ->where('tuition_waivers.funding_source_id', '=', 1)
                ->groupBy('tuition_waivers.student_id')
                ->lists('sum', 'full_name');
        } else {
            return Response::json(['success' => false]);
        }

        $drilldownData = [];
        foreach ($data as $student_name => $amount) {
            $drilldownData[] = [$student_name, (double)$amount];
        }

        return Response::json([
           'success' => true,
           'drilldowns' => ['name' => $name, 'data' => $drilldownData]
        ]);
    }
}
