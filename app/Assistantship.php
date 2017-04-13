<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistantship extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'student_id','semester_id','position','date_offered','date_responded','defer_date','current_status_id','corresponding_tuition_waiver_id',
        'stipend','funding_source_id','time',
    ];
    /**
     *
     */
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     *
     */
    public function semester() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    /**
     *
     */
    // public function position() {
    //     return $this->belongsTo(Position::class, 'position');
    // }

    /**
     *
     */
    public function status() {
        return $this->belongsTo(AssistantshipStatus::class, 'current_status_id');
    }

    /**
     *
     */
    public function corresponding_waiver() {
        return $this->belongsTo(TuitionWaiver::class, 'corresponding_tuition_waiver_id');
    }

    /**
     *
     */
    public function funding_source() {
        return $this->belongsTo(FundingSource::class, 'funding_source_id');
    }

    public function gta_assignment() {
        return $this->hasOne(GtaAssignment::class);
    }
}
