<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundingSource extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'is_grant'];

    /**
     *
     */
    public function assistantships() {
        return $this->hasMany(Assistantship::class);
    }

    /**
     *
     */
    public function waivers() {
        return $this->hasMany(TuitionWaiver::class);
    }
}
