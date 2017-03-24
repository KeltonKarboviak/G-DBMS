<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGqeResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gqe_results', function (Blueprint $table) {
            $table->char('student_id', 7);
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('gqe_offerings')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(['student_id', 'offer_id']);

            $table->float('score', 5, 2)->unsigned()->nullable()->default(null);

            $table->integer('pass_level_id')->unsigned()->nullable()->default(null);
            $table->foreign('pass_level_id')->references('id')->on('pass_levels')
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
        Schema::drop('gqe_results');
    }
}
