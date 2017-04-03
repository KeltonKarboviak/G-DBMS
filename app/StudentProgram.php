<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentProgram extends Model
{
    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'advisor_id', 'program_id', 'has_program_study','semester_started_id', 'is_current', 
        'semester_graduated_id', 'is_graduated','has_committee','topic','student_id',
    ];

    protected $appends = [
        'num_gqes_passed',  //int
        'num_gqes_needed',  //int
        'passed_gqes',      //boolean
    ];

    public function getNumGqesPassedAttribute()
    {
        $section_results = $this
            ->gqe_results->sortBy(function ($result) {
                return sprintf('%-12s%s', $result->offering->gqe_section_id, $result->offering->date);
            })
            ->values()
            ->groupBy(function ($result) {
                return $result->offering->section->id;
            });

        $pass_level_needed = $this->program->pass_level_needed_id;

        $finished_gqes = $section_results->sum(function ($section) use ($pass_level_needed) {
            return $section->contains(function ($index, $result) use ($pass_level_needed) {
                return $result->pass_level_id >= $pass_level_needed;
            });
        });

        return $finished_gqes;
    }

    public function getNumGqesNeededAttribute()
    {
        return $this->program->gqes_needed;
    }

    public function getPassedGqesAttribute()
    {
        return $this->num_gqes_passed >= $this->num_gqes_needed;
    }

    /**
     *
     */
    public function advisor() {
        return $this->hasOne(Advisor::class, 'id','advisor_id');
    }

    /**
     *
     */
    public function program() {
        return $this->hasOne(Program::class, 'id', 'program_id');
    }

    /**
     *
     */
    public function semester_started() {
        return $this->belongsTo(Semester::class, 'semester_started_id');
    }

    /**
     *
     */
    public function semester_graduated() {
        return $this->belongsTo(Semester::class, 'semester_graduated_id');
    }

    /**
     *
     */
    public function gce_results() {
        return $this->hasMany(GceResult::class, 'student_id','student_id');
    }

    public function gqe_results() {
        return $this->hasMany(GqeResult::class, 'student_id','student_id');
    }

    public function student() {
        return $this->hasOne(Student::class, 'id','student_id');
    }
}
