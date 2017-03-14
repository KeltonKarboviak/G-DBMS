<?php

use Illuminate\Database\Seeder;

class GceResultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('gce_results')->delete();

        $results = [
            ['id' => 1, 'student_id' => '8883333', 'passed' => false, 'date' => '2017-02-14'],
            ['id' => 2, 'student_id' => '8884444', 'passed' => true,  'date' => '2016-09-15'],
        ];

        // Uncomment the below to run the seeder
        DB::table('gce_results')->insert($results);
    }
}
