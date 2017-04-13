<?php

use Illuminate\Database\Seeder;

class GreScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('gre_scores')->delete();

        $scores = [
            ['student_id' => '3331111', 'score' => 280],
        ];

        // Uncomment the below to run the seeder
        DB::table('gre_scores')->insert($scores);
    }
}
