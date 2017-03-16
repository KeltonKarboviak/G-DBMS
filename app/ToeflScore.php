<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToeflScore extends Model
{
    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'student_id';

    /**
-     * Indicates if the IDs are auto-incrementing.
-     *
-     * @var bool
-     */
    public $incrementing = false;
}
