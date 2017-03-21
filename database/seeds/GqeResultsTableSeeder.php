<?php

use Illuminate\Database\Seeder;

class GqeResultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('gqe_results')->delete();

        $results = [
            // Kelton for 2015-2016 School Year
            ['student_id' => '8881111', 'offer_id' => 1, 'score' => 84.00, 'pass_level_id' => 3], // DB Pass-PhD
            ['student_id' => '8881111', 'offer_id' => 2, 'score' => 69.50, 'pass_level_id' => 1], // SD Fail #1
            ['student_id' => '8881111', 'offer_id' => 3, 'score' => 77.00, 'pass_level_id' => 2], // TF Pass-MS
            ['student_id' => '8881111', 'offer_id' => 4, 'score' => 76.99, 'pass_level_id' => 1], // OS Fail #1

            // Kelton for 2016-2017 School Year
            ['student_id' => '8881111', 'offer_id' => 6, 'score' => 70.50, 'pass_level_id' => 1],   // SD Fail #2
            ['student_id' => '8881111', 'offer_id' => 8, 'score' => null, 'pass_level_id' => null], // OS Pending

            // Kelton for 2017-2018 School Year
            ['student_id' => '8881111', 'offer_id' => 10, 'score' => null, 'pass_level_id' => null], // SD Try #3 INVALID!!!

            // Connor for 2015-2016 School Year
            ['student_id' => '8882222', 'offer_id' => 1, 'score' => 87.25, 'pass_level_id' => 3], // DB Pass-PhD
            ['student_id' => '8882222', 'offer_id' => 2, 'score' => 81.75, 'pass_level_id' => 3], // SD Pass-PhD
            ['student_id' => '8882222', 'offer_id' => 3, 'score' => 72.00, 'pass_level_id' => 2], // TF Pass-MS
            ['student_id' => '8882222', 'offer_id' => 4, 'score' => 80.00, 'pass_level_id' => 2], // OS Pass-MS
        ];

        // Uncomment the below to run the seeder
        DB::table('gqe_results')->insert($results);
    }
}
