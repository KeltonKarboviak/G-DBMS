<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssistantshipStatus extends Model
{
    public $timestamps = false;

    protected $fillable = ['description', 'id'];
}
