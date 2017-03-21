<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
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
    public $incrementing = false;

    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
    	return "{$this->first_name} {$this->last_name}";
    }

    /**
     *
     */
    public function students() {
        return $this->hasMany(Student::class);
    }
}
