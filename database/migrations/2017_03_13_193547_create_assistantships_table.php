<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistantships', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

            $table->char('student_id', 7);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->char('position_id', 5);
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');

            $table->date('date_offered');
            $table->date('date_responded')->nullable()->default(null);
            $table->date('defer_date')->nullable()->default(null);

            $table->integer('current_status_id')->unsigned();
            $table->foreign('current_status_id')->references('id')->on('assistantship_statuses')->onDelete('cascade');

            $table->integer('corresponding_tuition_waiver_id')->unsigned();
            $table->foreign('corresponding_tuition_waiver_id')->references('id')->on('tuition_waivers')->onDelete('cascade');

            $table->decimal('stipend', 8, 2);

            $table->integer('funding_source_id')->unsigned();
            $table->foreign('funding_source_id')->references('id')->on('funding_sources')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assistantships');
    }
}
