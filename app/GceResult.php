<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GceResult extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'student_id','passed','date',
	];
    /**
     *
     */
    public function students() {
        return $this->hasMany(Student::class, 'id', 'student_id');
    }
}
