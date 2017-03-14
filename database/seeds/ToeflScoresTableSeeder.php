<?php

use Illuminate\Database\Seeder;

class ToeflScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('toefl_scores')->delete();

        $scores = [
            ['student_id' => '8883333', 'score' => 55],
        ];

        // Uncomment the below to run the seeder
        DB::table('toefl_scores')->insert($scores);
    }
}
