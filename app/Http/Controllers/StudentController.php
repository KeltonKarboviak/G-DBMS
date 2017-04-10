<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use Session;

use App\Student;
use App\StudentProgram;
use App\Advisor;
use App\Program;
use App\Semester;
use App\GreScore;
use App\IeltsScore;
use App\ToeflScore;

class StudentController extends Controller
{
	private $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'id' => 'required|size:7|regex:/\d{7}/|unique:students',
		'email' => 'email',
		'undergrad_gpa' => 'required|numeric|between:0,4',
        'toefl_score' => 'integer|between:0,120',
        'gre_score' => 'integer|between:260,340',
        'ielts_score' => 'numeric|between:0,9.5',
	];

	private $messages = [
		'id.regex' => 'The EMPLID must in format of DDDDDDD where D is a digit.',
		'id.required' => 'The EMPLID is required.',
		'id.size' => 'The EMPLID must be 7 digits.',
        'toefl_score.between' => 'TOEFL score must be an integer between 0 and 120',
        'gre_score.between' => 'GRE score must be an integer between 260 and 340',
        'ielts_score.between' => 'IELTS score must be a number between 0 and 9.5',
        'toefl_score.integer' => 'TOEFL score must be an integer between 0 and 120',
        'gre_score.integer' => 'GRE score must be an integer between 260 and 340',
        'ielts_score.numeric' => 'IELTS score must be a number between 0 and 9.5',
	];

    private $sort_options = ['last_name' => 'Last name',
        'first_name' => 'First name',
        'ranking' => 'Ranking',
        'id' => 'EMPLID',
        'has_committee' => 'Has committee',
        'has_program_study' => 'Has program of study',
        'semester_started_id' => 'Semester started',
        'program_id' => 'Program',
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

    public function rank_compare(Student $s1, Student $s2)
    {
        return $s2->ranking - $s1->ranking;
    }

    /**
     * Show the list of students.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('/student/index', [
    //         'students' => Student::orderBy('last_name')->get()
    //     ]);
    // }

    public function index_filter(Request $request)
    {
        $sort_by = $request->get('sort_by','last_name');

        $query = Student::with('gce_results','gqe_results','gre','ielts','toefl')->join('student_programs','student_programs.student_id','=','students.id','left outer');
        if($sort_by !== 'ranking')
            $query->orderBy($sort_by);


        if($request->has('first_name'))
            $query->where('first_name',$request->get('first_name'));
        if($request->has('last_name'))
            $query->where('last_name',$request->get('last_name'));
        // if($request->has('is_current'))
        if($request->all() == null)
        {
            // $query->where('is_current',true);
            $query->where(function($query)
            {
                $query->orWhere('is_current',true)->orWhere(function($query)
                {
                    $query->whereNull('is_current');
                });
            }); 
        }
        else if($request->has('is_current')) //the default is for current students only
        {
            if($request->get('is_current') === 'Yes')
            {
                // $query->where('is_current',true);
                $query->where(function($query)
                {
                    $query->orWhere('is_current',true)->orWhere(function($query)
                    {
                        $query->whereNull('is_current');
                    });
                }); 
            }
            else
                $query->where('is_current',false);
        }
        if($request->has('has_committee'))
        {
            if($request->get('has_committee') === 'Yes')
                $query->where('has_committee',true);
            else
                $query->where('has_committee',false);
        }
        if($request->has('has_program_study'))
        {
            if($request->get('has_program_study') === 'Yes')
                $query->where('has_program_study',true);
            else
                $query->where('has_program_study',false);
        }
        if($request->has('is_graduated'))
        {
            if($request->get('is_graduated') === 'Yes')
                $query->where('is_graduated',true);
            else
                $query->where('is_graduated',false);
        }
        if($request->has('faculty_supported'))
        {
            if($request->get('faculty_supported') === 'Yes')
                $query->where('faculty_supported',true);
            else
                $query->where('faculty_supported',false);
        }
        if ($request->has('program_id')) 
        {
            $ids = $request->get('program_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('program_id',$id);
                }
            }); 
        }
        if ($request->has('advisor_id')) 
        {
            $ids = $request->get('advisor_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('advisor_id',$id);
                }
            }); 
        }
        if ($request->has('semester_started_id')) 
        {
            $ids = $request->get('semester_started_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('semester_started_id',$id);
                }
            }); 
        }
        if ($request->has('semester_graduated_id')) 
        {
            $ids = $request->get('semester_graduated_id');
            $query->where(function($query) use ($ids)
            {
                foreach ($ids as $id) {
                    $query->orWhere('semester_graduated_id',$id);
                }
            }); 
        }
        $students = $query->distinct()->get(['students.*']);
        // $sArray = $students->all();
        $showRank = false;
        if($sort_by === 'ranking')
        {
            // usort($sArray,["App\Http\Controllers\StudentController","rank_compare"]);
            // $students->sortBy('ranking');
            $students = $students->sortByDesc(function($stud){
                return $stud->ranking;
            });
            $showRank = true;
            // dd($students,$students[0]->ranking);
        }

        return view('/student/index', [
            // 'students' => $sArray,
            'students' => $students,
            'advisors' => Advisor::all()->lists("full_name","id"),
            'programs' => Program::lists("name","id"), 
            'semesters' => Semester::all()->lists("full_name","id"),
            'yesNo' => ['Yes' => 'Yes', 'No' => 'No'],
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'advisor_id' => $request->get('advisor_id'),
            'program_id' => $request->get('program_id'),
            'semester_started_id' => $request->get('semester_started_id'),
            'semester_graduated_id' => $request->get('semester_graduated_id'),
            'is_current' => $request->input('is_current','Yes'),
            'is_graduated' => $request->get('is_graduated'),
            'has_program_study' => $request->get('has_program_study'),
            'faculty_supported' => $request->get('faculty_supported'),
            'has_committee' => $request->get('has_committee'),
            'sort_options' => $this->sort_options,
            'sort_by' => $sort_by,
            'showRank' => $showRank,
        ]);
    }

    public function delete(Student $student)
    {
    	$student->delete();
    	return Redirect::to('/student');
    }

    public function store()
    {
    	// dd("hi");
    	// session()->forget('previousURL');
    	return view('/student/store', [
    		'student' => null,
    		'advisors' => Advisor::all()->lists("full_name","id"),
    		'programs' => Program::lists("name","id"), 
    		'semesters' => Semester::all()->lists("full_name","id")
    	]);
    }

    private function checkboxConvert($onoff)
    {
        if($onoff == "on")
            return true;
        else
            return false;
    }

    public function store_submit(Request $request, Student $student)
    {
    	// global $rules, $messages;
    	$request->merge([
            "faculty_supported" => $this->checkboxConvert($request->get("faculty_supported","off")),
    	]);

    	$this->validate($request,$this->rules,$this->messages);     

        $student->create($request->except(['gre_score','toefl_score','ielts_score']));

        if($request->has('gre_score'))
            $gre = GreScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('gre_score')]);

        if($request->has('ielts_score'))
            $ielts = IeltsScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('ielts_score')]);

        if($request->has('toefl_score'))
            $toefl = ToeflScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('toefl_score')]);



    	return Redirect::to('/student');
    }

    public function update(Student $student)
    {
        $student->load('gre','toefl','ielts');
    	return view('/student/update', [
    		'student' => $student,
    		'advisors' => Advisor::all()->lists("full_name","id"),
    		'programs' => Program::lists("name","id"),
    		'semesters' => Semester::all()->lists("full_name","id")
    	]);
    }

    public function update_submit(Request $request, Student $student)
    {
    	// global $rules, $messages;
    	$this->rules['id'] = 'required|size:7|regex:/\d{7}/|unique:students,id,'.$student->id;
    	$request->merge([
            "faculty_supported" => $this->checkboxConvert($request->get("faculty_supported","off")),
    	]);

    	// dd($request->all());

    	$this->validate($request,$this->rules,$this->messages);

    	$student->update($request->except(['gre_score','toefl_score','ielts_score']));


        if($request->has('gre_score'))
            $gre = GreScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('gre_score')]);

        if($request->has('ielts_score'))
            $ielts = IeltsScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('ielts_score')]);

        if($request->has('toefl_score'))
            $toefl = ToeflScore::updateOrCreate(['student_id' => $request->get('id'), 'score' => $request->get('toefl_score')]);

    	return Redirect::to('/student');
    }
}
