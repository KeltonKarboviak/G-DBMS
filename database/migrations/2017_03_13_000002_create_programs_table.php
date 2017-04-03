<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->boolean('needs_committee');
            $table->boolean('needs_gce');
            $table->integer('gqes_needed');

            $table->integer('pass_level_needed_id')->unsigned();
            $table->foreign('pass_level_needed_id')->references('id')->on('pass_levels')
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
        Schema::drop('programs');
    }
}
