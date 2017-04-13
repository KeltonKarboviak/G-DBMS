<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGtaAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gta_assignments', function (Blueprint $table) {
            $table->increments('id');
 
            $table->integer('assistantship_id')->unsigned();
            $table->foreign('assistantship_id')->references('id')->on('assistantships')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->char('instructor_id', 7);
            $table->foreign('instructor_id')->references('id')->on('advisors')
                ->onUpdate('cascade');

            $table->string('course',30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gta_assignments');
    }
}
