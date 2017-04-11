<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'calendar_year', 'academic_year',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
    	return "{$this->name} {$this->calendar_year}";
    }
}
