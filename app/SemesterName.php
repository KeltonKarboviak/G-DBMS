<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SemesterName extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'name',
	];

    public function semesters()
    {
    	return $this->hasMany('semesters','name_id','id');
    }
}
