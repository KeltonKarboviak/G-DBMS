<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name_id', 'calendar_year', 'academic_year',
    ];

    protected $appends = ['full_name', 'sort_num'];

    public function getFullNameAttribute() {
    	return "{$this->name->name} {$this->calendar_year}";
    }

    private function getSemesterNum()
    {
        if($this->name->name === "Spring")
            return 10;
        if($this->name->name === "Summer1")
            return 20;
        if($this->name->name === "Summer2")
            return 30;
        if($this->name->name === "Fall")
            return 40;
        return 0;
    }

    public function getSortNumAttribute() {

        return (int)$this->calendar_year * 100 + $this->getSemesterNum();
    }

    public function name()
    {
    	return $this->hasOne(SemesterName::class, 'id','name_id');
    }

    public static function getAcademicYear($name_id, $calendar_year)
    {
        //to have new semesters be in the same academic year as calendar year, put name in array with Fall
        $ids_where_calendar_equal_academic = SemesterName::whereIn('name',['Fall'])->get()->lists('id')->toArray();

        // dd($ids_where_calendar_equal_academic);

        if(in_array($name_id, $ids_where_calendar_equal_academic))
            $academic_year = $calendar_year;
        else
            $academic_year = $calendar_year - 1;

        if(!YearlyBudget::where('academic_year',$academic_year)->exists())
        {
            YearlyBudget::create(['academic_year' => $academic_year, 'budget' => 0, 'funding_source_id' => 1]);
        }

        return $academic_year;
    }


}
