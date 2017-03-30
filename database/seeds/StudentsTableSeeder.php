<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('students')->delete();

        $students = [
            [
                'id' => '8881111', 'first_name' => 'Kelton', 'last_name' => 'Karboviak',
                'advisor_id' => '0001111', 'email' => 'kelton.karboviak@und.edu',
                'semester_started_id' => 5, 'program_id' => 3, 'undergrad_gpa' => 3.250,
                'faculty_supported' => false, 'has_program_study' => false,
                'is_current' => true, 'is_graduated' => false,
                'semester_graduated_id' => null,
                'has_committee' => false,
                'topic' => 'Making NGAFID work using BigData',
            ],
            [
                'id' => '8882222', 'first_name' => 'Connor', 'last_name' => 'Bowley',
                'advisor_id' => '0002222', 'email' => 'connor.bowley@und.edu',
                'semester_started_id' => 5, 'program_id' => 2, 'undergrad_gpa' => 3.925,
                'faculty_supported' => true, 'has_program_study' => true,
                'is_current' => true, 'is_graduated' => false,
                'semester_graduated_id' => null,
                'has_committee' => true,
                'topic' => 'Finding avian species in UAV imagery with CNNs',
            ],
            [
                'id' => '8883333', 'first_name' => 'Joe', 'last_name' => 'Schmo',
                'advisor_id' => '0002222', 'email' => 'joe.schmo@und.edu',
                'semester_started_id' => 1, 'program_id' => 4, 'undergrad_gpa' => 3.102,
                'faculty_supported' => false, 'has_program_study' => false,
                'is_current' => true, 'is_graduated' => false,
                'semester_graduated_id' => null,
                'has_committee' => false,
                'topic' => '',
            ],
            [
                'id' => '8884444', 'first_name' => 'John', 'last_name' => 'Smith',
                'advisor_id' => '0001111', 'email' => 'john.smith@und.edu',
                'semester_started_id' => 1, 'program_id' => 4, 'undergrad_gpa' => 3.555,
                'faculty_supported' => true, 'has_program_study' => true,
                'is_current' => true, 'is_graduated' => true,
                'semester_graduated_id' => 6,
                'has_committee' => true,
                'topic' => 'Saving the world with BigData and Hadoop',
            ],
        ];

        // Uncomment the below to run the seeder
        DB::table('students')->insert($students);
    }
}
