<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GqeSection extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    /**
     *
     */
    public function offerings() {
        return $this->hasMany(GqeOffering::class);
    }
}
