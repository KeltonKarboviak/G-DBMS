<?php

use Illuminate\Database\Seeder;

class SemesterNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $names = [
            ['id' => 1, 'name' => 'Fall',    ],
            ['id' => 2, 'name' => 'Spring',  ],
            ['id' => 3, 'name' => 'Summer1', ],
            ['id' => 4, 'name' => 'Summer2', ],
        ];

        // Uncomment the below to run the seeder
        DB::table('semester_names')->insert($names);
    }
}
