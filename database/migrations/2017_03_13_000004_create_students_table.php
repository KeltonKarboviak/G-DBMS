<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->char('id', 7);
            $table->primary('id');

            $table->string('first_name', 50);
            $table->string('last_name', 50);

            $table->char('advisor_id', 7)->default('0001111');  // @TODO make Reza default advisor
            $table->foreign('advisor_id')->references('id')->on('advisors')
                ->onUpdate('cascade');

            $table->string('email');

            $table->integer('semester_started_id')->unsigned();
            $table->foreign('semester_started_id')->references('id')->on('semesters')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('program_id')->unsigned();
            $table->foreign('program_id')->references('id')->on('programs')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->float('undergrad_gpa', 4, 3);
            $table->boolean('faculty_supported');
            $table->boolean('has_program_study');
            $table->boolean('is_current')->default(true);
            $table->boolean('is_graduated')->default(false);
            $table->boolean('has_committee')->default(false);

            $table->integer('semester_graduated_id')->unsigned()->nullable()->default(null);
            $table->foreign('semester_graduated_id')->references('id')->on('semesters')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('students');
    }
}
