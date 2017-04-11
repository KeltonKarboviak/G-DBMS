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

    protected $fillable = ['academic_year', 'budget', 'funding_source_id'];

    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
    	return $this->academic_year . '-' . ($this->academic_year+1);
    }

    /**
     *
     */
    public function funding_source() {
        return $this->belongsTo(FundingSource::class, 'funding_source_id');
    }
}
