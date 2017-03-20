<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
    	return "{$this->name} {$this->calendar_year}";
    }
}
