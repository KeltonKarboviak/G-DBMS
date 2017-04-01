<?php

use Illuminate\Database\Seeder;

class StudentProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('student_program')->delete();

    	$student_programs = [
    		[
    			'student_id' => '8881111',
    			'advisor_id' => '0001111', 
    			'semester_started_id' => 5, 'program_id' => 3,
    			'has_program_study' => false,
    			'is_current' => true, 'is_graduated' => false,
                'semester_graduated_id' => null,
                'has_committee' => false, 
                'topic' => 'Making NGAFID work using BigData',
    		],
    		[
    			'student_id' => '8882222',
    			'advisor_id' => '0002222',
				'semester_started_id' => 5, 'program_id' => 2,
				'has_program_study' => true,
				'is_current' => true, 'is_graduated' => false,
                'semester_graduated_id' => null,
                'has_committee' => true,
                'topic' => 'Finding avian species in UAV imagery with CNNs',
    		],
    		[
    			'student_id' => '8883333',
    			'advisor_id' => '0002222',
				'semester_started_id' => 1, 'program_id' => 4,
				'has_program_study' => false,
				'is_current' => true, 'is_graduated' => false,
                'semester_graduated_id' => null,
                'has_committee' => false,
                'topic' => '',
    		],
            [
                'student_id' => '8884444',
                'advisor_id' => '0002222',
                'semester_started_id' => 1, 'program_id' => 3,
                'has_program_study' => true,
                'is_current' => false, 'is_graduated' => true,
                'semester_graduated_id' => 3,
                'has_committee' => true,
                'topic' => 'Saving the world with BigData and Hadoop',
            ],
    		[
    			'student_id' => '8884444',
    			'advisor_id' => '0001111',
				'semester_started_id' => 5, 'program_id' => 4,
				'has_program_study' => true,
				'is_current' => true, 'is_graduated' => false,
                'semester_graduated_id' => null,
                'has_committee' => true,
                'topic' => 'Saving the world with BigData and Hadoop (PhD version)',
    		],
    	];

        DB::table('student_programs')->insert($student_programs);
    }
}
