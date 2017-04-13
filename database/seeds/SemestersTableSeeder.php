<?php

use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('semesters')->delete();

        $semesters = [
            ['id' => 1, 'name_id' => 1, 'calendar_year' => 2015, 'academic_year' => 2015],
            ['id' => 2, 'name_id' => 2, 'calendar_year' => 2016, 'academic_year' => 2015],
            ['id' => 3, 'name_id' => 3, 'calendar_year' => 2016, 'academic_year' => 2015],
            ['id' => 4, 'name_id' => 4, 'calendar_year' => 2016, 'academic_year' => 2015],

            ['id' => 5, 'name_id' => 1, 'calendar_year' => 2016, 'academic_year' => 2016],
            ['id' => 6, 'name_id' => 2, 'calendar_year' => 2017, 'academic_year' => 2016],
            ['id' => 7, 'name_id' => 3, 'calendar_year' => 2017, 'academic_year' => 2016],
            ['id' => 8, 'name_id' => 4, 'calendar_year' => 2017, 'academic_year' => 2016],

            ['id' => 9,  'name_id' => 1, 'calendar_year' => 2017, 'academic_year' => 2017],
            ['id' => 10, 'name_id' => 2, 'calendar_year' => 2018, 'academic_year' => 2017],
        ];

        // Uncomment the below to run the seeder
        DB::table('semesters')->insert($semesters);
    }
}
