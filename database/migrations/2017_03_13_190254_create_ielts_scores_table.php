<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIeltsScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ielts_scores', function (Blueprint $table) {
            $table->char('student_id');
            $table->primary('student_id');
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->float('score', 3, 2)->unsigned;
        });
        // Need to add this afterwards because the Blueprint class does not
        // support adding CHECK constraints
        DB::statement('ALTER TABLE ielts_scores ADD CHECK (score >= 0 AND score <= 9.5);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ielts_scores');
    }
}
