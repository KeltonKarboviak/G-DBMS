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
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    public $timestamps = false;

    /**
     *
     */
    public function funding_source() {
        return $this->belongsTo(FundingSource::class, 'funding_source_id');
    }
}
