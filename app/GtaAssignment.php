<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GtaAssignment extends Model
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

    public $timestamps = false;

    protected $fillable = [
        'assistantship_id','instructor_id','course',
    ];

    public function assistantship() 
    {
    	return $this->belongsTo(Assistantship::class);
    }

    public function instructor()
    {
    	return $this->belongsTo(Advisor::class);
    }
}
