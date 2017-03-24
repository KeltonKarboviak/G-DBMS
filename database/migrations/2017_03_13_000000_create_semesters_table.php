<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 10);
        });
        // Need to add this afterwards because the Blueprint class does not
        // support adding MySQL YEAR data type
        DB::statement('ALTER TABLE semesters ADD calendar_year YEAR(4);');
        DB::statement('ALTER TABLE semesters ADD academic_year YEAR(4);');

        // DB::statement('ALTER TABLE semesters ADD CONSTRAINT FOREIGN KEY(academic_year) REFERENCES yearly_budgets(academic_year)
        //     ON DELETE CASCADE
        //     ON UPDATE CASCADE;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('semesters');
    }
}
