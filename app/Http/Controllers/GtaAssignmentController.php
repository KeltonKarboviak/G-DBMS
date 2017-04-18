<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\GtaAssignment;
use App\Assisantship;
use App\Student;
use App\Advisor;
use App\Semester;

class GtaAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_filter(Request $request)
    {
        $sort_by = $request->get('sort_by','course');
        $query = GtaAssignment::with('assistantship','instructor')
        	->join('assistantships','assistantships.id','=','gta_assignments.assistantship_id')
        	->join('students','students.id','=','assistantships.student_id')
        	->join('advisors','gta_assignments.instructor_id','=','advisors.id');

        if($sort_by !== 'semester')
        	$query->orderBy($sort_by);

        if($request->has('first_name'))
            $query->where('first_name',$request->get('first_name'));
        if($request->has('last_name'))
            $query->where('last_name',$request->get('last_name'));

        if ($request->has('semester_id'))
        {
            $ids = $request->get('semester_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('semester_id',$id);
                }
            });
        }
        if($request->has('instructor_id'))
        	$query->whereIn($request->get('instructor_id'));

        $gtas = $query->distinct()->get(['gta_assignments.*']);

        if($sort_by === 'semester')
        {
        	$gtas = $gtas->sortByDesc(function($gta){
        		return $gta->assistantship->semester->sort_num;
        	});
        }

        return view('/assistantship/gta_assignments/index', [
            'gtas' => $gtas,
            'semesters' => Semester::all()->lists("full_name","id"),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'sort_by' => $sort_by,
            'sort_options' => ['students.last_name' => 'Student','advisors.last_name' => 'Instructor','semester' => 'Semester', 'course' => 'Course'],
            'semester_id' => $request->get('semester_id'),
            'instructor_id' => $request->get('instructor_id'),
            'instructors' => Advisor::all()->lists('full_name','id'),
        ]);
    }
}
