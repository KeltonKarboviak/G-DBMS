<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
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
        'id', 'first_name', 'last_name', 'email', 'undergrad_gpa','faculty_supported',
    ];


    protected $appends = ['full_name', 'proper_name', 'ranking'];

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getProperNameAttribute() {
        return "{$this->last_name}, {$this->first_name}";
    }

    public function getRankingAttribute()
    {
        $this->load('gre','toefl','ielts');

        //gpa * 100 + GRE + English_Prof + Faculty_Sponsored

        //get gre contribution
        $gre_score = $this->gre == null ? 300 : $this->gre->score;

        //get english speaking contribution
        $toefl_score = $this->toefl == null ? -1 : $this->toefl->score / 120.0 * 100;
        $ielts_score = $this->ielts == null ? -1 : $this->ielts->score / 9.5 * 100;
        if($ielts_score == -1 && $toefl_score == -1) //natural english speaker
            $english = 100;
        else
            $english = $toefl_score > $ielts_score ? $toefl_score : $ielts_score;

        //get faculty sponsor contribution
        $sponsor = $this->faculty_supported ? 100 : 0;

        $rank = $this->undergrad_gpa * 100.0 + $gre_score + $english + $sponsor;

        return sprintf('%0.0f',number_format($rank));
    }

    /**
     *
     */
    public function gre() {
        return $this->hasOne(GreScore::class);
    }

    /**
     *
     */
    public function toefl() {
        return $this->hasOne(ToeflScore::class);
    }

    /**
     *
     */
    public function ielts() {
        return $this->hasOne(IeltsScore::class);
    }

    /**
     *
     */
    public function programs() {
        return $this->hasMany(StudentProgram::class,'student_id','id');
    }

    /**
     *
     */
    public function gqe_results() {
        return $this->hasMany(GqeResult::class, 'student_id');
    }

    /**
     *
     */
    public function gce_results() {
        return $this->hasMany(GceResult::class, 'student_id');
    }

    /**
     *
     */
    public function assitantships() {
        return $this->hasMany(Assistantship::class, 'student_id');
    }

    /**
     *
     */
    public function waivers() {
        return $this->hasMany(TuitionWaiver::class, 'student_id');
    }
}
