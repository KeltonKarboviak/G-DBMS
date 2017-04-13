<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gre_scores', function (Blueprint $table) {
            $table->char('student_id');
            $table->primary('student_id');
            $table->foreign('student_id')->references('id')->on('prospective_students')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('score')->unsigned;
        });

        // Need to add this afterwards because the Blueprint class does not
        // support adding CHECK constraints
        DB::statement('ALTER TABLE gre_scores ADD CHECK (score >= 260 AND score <= 340);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gre_scores');
    }
}
