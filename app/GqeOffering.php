<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GqeOffering extends Model
{

    public $timestamps = false;

    protected $fillable = [];

    protected $appends = ['full_name'];

    public function getFullNameAttribute() {
        return "{$this->semester->full_name} - {$this->section->name}";
    }

    /**
     *
     */
    public function section() {
        return $this->belongsTo(GqeSection::class, 'gqe_section_id');
    }

    /**
     *
     */
    public function semester() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
