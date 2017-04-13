<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectiveStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospective_students', function (Blueprint $table) {
            $table->char('id', 7);
            $table->primary('id');

            $table->string('first_name', 50);
            $table->string('last_name', 50);

            $table->string('email');

            $table->float('undergrad_gpa', 4, 3);
            $table->boolean('faculty_supported');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prospective_students');
    }
}
