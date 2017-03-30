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
        'id', 'first_name', 'last_name', 'email', 'advisor_id', 'program_id', 'undergrad_gpa', 'has_program_study',
        'semester_started_id', 'is_current', 'semester_graduated_id', 'is_graduated','has_committee','faculty_supported','topic',
    ];


    protected $appends = ['ranking'];

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
        // return floatval($rank);
    }

    /**
     *
     */
    public function advisor() {
        return $this->belongsTo(Advisor::class, 'advisor_id');
    }

    /**
     *
     */
    public function program() {
        return $this->belongsTo(Program::class, 'program_id');
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
    public function semester_started() {
        return $this->belongsTo(Semester::class, 'semester_started_id');
    }

    /**
     *
     */
    public function semester_graduated() {
        return $this->belongsTo(Semester::class, 'semester_graduated_id');
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
