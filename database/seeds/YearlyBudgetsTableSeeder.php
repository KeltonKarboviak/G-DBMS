<?php

use Illuminate\Database\Seeder;

class YearlyBudgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('yearly_budgets')->delete();

        $budgets = [
            ['academic_year' => 2015, 'budget' => 100000, 'funding_source_id' => 1],
            ['academic_year' => 2016, 'budget' => 100000, 'funding_source_id' => 1],
            ['academic_year' => 2017, 'budget' => 100000, 'funding_source_id' => 1],
        ];

        // Uncomment the below to run the seeder
        DB::table('yearly_budgets')->insert($budgets);
    }
}
