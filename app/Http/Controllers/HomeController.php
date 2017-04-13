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
            'budget' => YearlyBudget::find( (int)date('m') >= 8 ? (int)date('Y') :  (int)date('Y') - 1 ),
            'years' => YearlyBudget::all()->lists('full_name', 'academic_year'),
        ]);
    }

    public function chart(Request $request) {
        // Check to see if the request is an AJAX call
        if (!$request->ajax()) {
            // @TODO return 404 page if it is not AJAX
        }

        $year = $request->input('year');

        $budget = YearlyBudget::find($year, ['budget']);

        if ($budget == null)
            return Response::json(['success' => false]);

        $budget = (double)$budget->budget;

        $assistantships = (double)Assistantship
            ::join('semesters', 'assistantships.semester_id', '=', 'semesters.id')
            ->join('assistantship_statuses','assistantships.current_status_id','=','assistantship_statuses.id')
            ->where('semesters.academic_year', '=', $year)
            ->where('assistantships.funding_source_id', '=', 1)
            ->whereIn('assistantship_statuses.description',['Accepted','Terminated'])
            ->sum('assistantships.stipend');

        $pending_assistantships = (double)Assistantship
            ::join('semesters', 'assistantships.semester_id', '=', 'semesters.id')
            ->join('assistantship_statuses','assistantships.current_status_id','=','assistantship_statuses.id')
            ->where('semesters.academic_year', '=', $year)
            ->where('assistantships.funding_source_id', '=', 1)
            ->where('assistantship_statuses.description','Pending')
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
            'pending_assistantships' => $pending_assistantships,
        ]);
    }

    public function drilldown(Request $request) {
        // Check to see if the request is an AJAX call
        if (!$request->ajax()) {
            // @TODO return 404 page if it is not AJAX
        }

        $year = $request->input('year');
        $name = $request->input('name');

        $budget = YearlyBudget::find($year, ['budget']);

        if ($budget == null)
            return Response::json(['success' => false]);

        if ($name === 'assistantships' || $name === 'pending_assistantships') {
            if($name === 'assistantships')
                $options = ['Accepted','Terminated'];
            else if($name == 'pending_assistantships')
                $options = ['Pending'];
            $data = Assistantship
                ::selectRaw('concat(students.first_name, " ", students.last_name) as full_name, sum(assistantships.stipend) as sum')
                ->join('semesters', 'assistantships.semester_id', '=', 'semesters.id')
                ->join('students', 'assistantships.student_id', '=', 'students.id')
                ->join('assistantship_statuses','assistantships.current_status_id','=','assistantship_statuses.id')
                ->where('semesters.academic_year', $year)
                ->where('assistantships.funding_source_id', 1)
                ->whereIn('assistantship_statuses.description',$options)
                ->groupBy('assistantships.student_id')
                ->lists('sum', 'full_name');
        } else if ($name === 'waivers') {
            $data = TuitionWaiver
                ::selectRaw('concat(students.first_name, " ", students.last_name) as full_name, sum(tuition_waivers.amount_received) as sum')
                ->join('semesters', 'tuition_waivers.semester_id', '=', 'semesters.id')
                ->join('students', 'tuition_waivers.student_id', '=', 'students.id')
                ->where('semesters.academic_year', '=', $year)
                ->where('tuition_waivers.funding_source_id', '=', 1)
                ->groupBy('tuition_waivers.student_id')
                ->lists('sum', 'full_name');
        } else if ($name === 'remaining') {
            $data = [];
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

    public function budget_show(Request $request, YearlyBudget $budget) {
        // $year = $request->input('year');
        // $budget = YearlyBudget::find($year);

        if ($request->ajax()) {
            return Response::json([
                'success' => $budget != null,
                'budget' => $budget,
            ]);
        }

        return view('/home', [
            'budget' => $budget,
            'years' => YearlyBudget::all()->lists('full_name', 'academic_year'),
        ]);
    }

    public function budget_update(Request $request, YearlyBudget $budget) {

        $budget->update($request->only(['academic_year', 'budget']));

        $request->session()->flash(
            'alert-success', "Budget update for {$budget->full_name} was successful! New amount: {$request->budget}"
        );

        return redirect("/home/budget/{$budget->academic_year}");
    }
}
