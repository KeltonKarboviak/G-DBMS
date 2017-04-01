<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentProgramsTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('student_programs', function (Blueprint $table) {
    		$table->increments('id');
    		// $table->primary('id');

    		$table->char('student_id',7);
    		$table->foreign('student_id')->references('id')->on('students')
    			->onDelete('cascade')
    			->onUpdate('cascade');

    		$table->integer('program_id')->unsigned();
            $table->foreign('program_id')->references('id')->on('programs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

    		$table->char('advisor_id', 7)->default('0001111');  // @TODO make Reza default advisor
            $table->foreign('advisor_id')->references('id')->on('advisors')
                ->onUpdate('cascade');

            $table->integer('semester_started_id')->unsigned();
            $table->foreign('semester_started_id')->references('id')->on('semesters')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->boolean('has_program_study')->default(false);
            $table->boolean('is_current')->default(true);
            $table->boolean('is_graduated')->default(false);
            $table->boolean('has_committee')->default(false);

            $table->integer('semester_graduated_id')->unsigned()->nullable()->default(null);
            $table->foreign('semester_graduated_id')->references('id')->on('semesters')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('topic');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_programs');
    }
}