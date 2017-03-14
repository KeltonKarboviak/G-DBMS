<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGqeOfferingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gqe_offerings', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gqe_section_id')->unsigned();
            $table->foreign('gqe_section_id')->references('id')->on('gqe_sections')->onDelete('cascade');

            $table->integer('semester_id')->unsigned();
            $table->foreign('semester_id')->references('id')->on('semesters')->onDelete('cascade');

            $table->date('date');
            $table->float('cutoff_ms', 5, 2)->unsigned()->nullable()->default(null);
            $table->float('cutoff_phd', 5, 2)->unsigned()->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gqe_offerings');
    }
}
