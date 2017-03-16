<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GqeResult extends Model
{
    use Traits\HasCompositePrimaryKey;

    /**
     * The primary keys of the table.
     *
     * @var array
     */
    protected $primaryKey = ['student_id', 'offer_id'];

    /**
-     * Indicates if the IDs are auto-incrementing.
-     *
-     * @var bool
-     */
    public $incrementing = false;
}
