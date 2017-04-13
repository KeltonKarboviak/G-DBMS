<?php

use Illuminate\Database\Seeder;

class GtaAssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gta_assignments = [
        	[
        		'assistantship_id' => 2,
        		'instructor_id' => '0001111',
        		'course' => 'CS455',
        	],
        	[
        		'assistantship_id' => 3,
        		'instructor_id' => '0002222',
        		'course' => 'CS364',
        	],
        	[
        		'assistantship_id' => 7,
        		'instructor_id' => '0001111',
        		'course' => 'CS463s',
        	],
        ];

        // Uncomment the below to run the seeder
        DB::table('gta_assignments')->insert($gta_assignments);
    }
}
