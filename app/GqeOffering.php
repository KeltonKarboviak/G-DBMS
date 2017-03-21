<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GqeOffering extends Model
{
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
