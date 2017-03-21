<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GqeSection extends Model
{
    /**
     *
     */
    public function offerings() {
        return $this->hasMany(GqeOffering::class);
    }
}
