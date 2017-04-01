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
        return $this->hasMany(GceResult::class, 'student_id');
    }

    public function student() {
        return $this->hasOne(Student::class, 'id','student_id');
    }
}
