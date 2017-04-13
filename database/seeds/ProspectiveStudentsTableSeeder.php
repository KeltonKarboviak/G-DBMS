<?php

use Illuminate\Database\Seeder;

class ProspectiveStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
            [
                'id' => '3331111', 'first_name' => 'Malcom', 'last_name' => 'Reynolds',
                'email' => 'malcom.reynolds@gmail.com',
                'undergrad_gpa' => 3.250,
                'faculty_supported' => false,
            ],
            [
                'id' => '3332222', 'first_name' => 'Morgan', 'last_name' => 'Freeman',
                'email' => 'morgan.freeman@gmail.com',
                'undergrad_gpa' => 3.925,
                'faculty_supported' => true,
            ],
            [
                'id' => '3333333', 'first_name' => 'Bruce', 'last_name' => 'Willis',
                'email' => 'bruce.willis@gmail.com',
                'undergrad_gpa' => 3.102,
                'faculty_supported' => false, 
            ],
            [
                'id' => '3334444', 'first_name' => 'John', 'last_name' => 'Malkovich',
                'email' => 'john.malkovich@gmail.com',
                'undergrad_gpa' => 3.555,
                'faculty_supported' => true, 
            ],
        ];

        // Uncomment the below to run the seeder
        DB::table('prospective_students')->insert($students);
    }
}
