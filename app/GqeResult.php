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
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['student_id', 'offer_id', 'score'];

    /**
     *
     */
    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     *
     */
    public function offering() {
        return $this->belongsTo(GqeOffering::class, 'offer_id');
    }

    /**
     *
     */
    public function pass_level() {
        return $this->belongsTo(PassLevel::class, 'pass_level_id');
    }
}
