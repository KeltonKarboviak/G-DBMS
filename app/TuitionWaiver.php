<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TuitionWaiver extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'semester_id',
        'student_id',
        'date_received',
        'amount_received',
        'credit_hours',
        'funding_source_id',
        'received'
    ];

    public $appends = [
        'description',
    ];

    public function getDescriptionAttribute() {
        return "{$this->student->full_name} - {$this->semester->full_name} - {$this->credit_hours} credits";
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
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     *
     */
    public function funding_source() {
        return $this->belongsTo(FundingSource::class, 'funding_source_id');
    }
}
