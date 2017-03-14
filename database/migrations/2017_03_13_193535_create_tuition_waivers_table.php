<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuitionWaiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuition_waivers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

            $table->char('student_id', 7);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->date('date_received')->nullable()->default(null);
            $table->decimal('amount_received', 8, 2);
            $table->integer('credit_hours')->unsigned();

            $table->integer('funding_source_id')->unsigned();
            $table->foreign('funding_source_id')->references('id')->on('funding_sources')->onDelete('cascade');

            $table->boolean('received')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tuition_waivers');
    }
}
