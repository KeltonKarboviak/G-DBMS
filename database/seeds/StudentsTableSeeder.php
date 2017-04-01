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
                'email' => 'kelton.karboviak@und.edu',
                'undergrad_gpa' => 3.250,
                'faculty_supported' => false,
            ],
            [
                'id' => '8882222', 'first_name' => 'Connor', 'last_name' => 'Bowley',
                'email' => 'connor.bowley@und.edu',
                'undergrad_gpa' => 3.925,
                'faculty_supported' => true,
            ],
            [
                'id' => '8883333', 'first_name' => 'Joe', 'last_name' => 'Schmo',
                'email' => 'joe.schmo@und.edu',
                'undergrad_gpa' => 3.102,
                'faculty_supported' => false, 
            ],
            [
                'id' => '8884444', 'first_name' => 'John', 'last_name' => 'Smith',
                'email' => 'john.smith@und.edu',
                'undergrad_gpa' => 3.555,
                'faculty_supported' => true, 
            ],
        ];

        // Uncomment the below to run the seeder
        DB::table('students')->insert($students);
    }
}
