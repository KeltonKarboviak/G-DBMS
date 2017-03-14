<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToeflScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toefl_scores', function (Blueprint $table) {
            $table->char('student_id');
            $table->primary('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->integer('score')->unsigned;
        });
        // Need to add this afterwards because the Blueprint class does not
        // support adding CHECK constraints
        DB::statement('ALTER TABLE toefl_scores ADD CONSTRAINT CHK_score CHECK (score >= 0 AND score <= 120);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('toefl_scores');
    }
}
