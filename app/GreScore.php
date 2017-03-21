<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GreScore extends Model
{
    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'student_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     *
     */
    public function student() {
        return $this->hasOne(Student::class, 'id');
    }
}
