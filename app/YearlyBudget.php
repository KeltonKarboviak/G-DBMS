<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearlyBudget extends Model
{
    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'academic_year';

    /**
-     * Indicates if the IDs are auto-incrementing.
-     *
-     * @var bool
-     */
    public $incrementing = false;
}
