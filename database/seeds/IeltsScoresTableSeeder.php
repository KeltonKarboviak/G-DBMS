<?php

use Illuminate\Database\Seeder;

class IeltsScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('ielts_scores')->delete();

        $scores = [
            ['student_id' => '3334444', 'score' => 8.25],
        ];

        // Uncomment the below to run the seeder
        DB::table('ielts_scores')->insert($scores);
    }
}
