<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearlyBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearly_budgets', function (Blueprint $table) {
            $table->decimal('budget', 9, 2);

            $table->integer('funding_source_id')->unsigned();
            $table->foreign('funding_source_id')->references('id')->on('funding_sources')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        // Need to add this afterwards because the Blueprint class does not
        // support adding MySQL YEAR data type
        DB::statement('ALTER TABLE yearly_budgets ADD COLUMN academic_year YEAR(4) PRIMARY KEY;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('yearly_budgets');
    }
}
