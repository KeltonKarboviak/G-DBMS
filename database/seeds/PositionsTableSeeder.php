<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('positions')->delete();

        $positions = [
            ['id' => '00001', 'name' => 'GTA', 'program_id' => 2, 'semesters_allowed' => 4],
            ['id' => '00002', 'name' => 'GTA', 'program_id' => 3, 'semesters_allowed' => 4],
            ['id' => '00003', 'name' => 'GTA', 'program_id' => 4, 'semesters_allowed' => 4],

            ['id' => '00004', 'name' => 'GRA', 'program_id' => 2, 'semesters_allowed' => 4],
            ['id' => '00005', 'name' => 'GRA', 'program_id' => 3, 'semesters_allowed' => 4],
            ['id' => '00006', 'name' => 'GRA', 'program_id' => 4, 'semesters_allowed' => 4],

            ['id' => '00007', 'name' => 'GSA', 'program_id' => 2, 'semesters_allowed' => 4],
            ['id' => '00008', 'name' => 'GSA', 'program_id' => 3, 'semesters_allowed' => 4],
            ['id' => '00009', 'name' => 'GSA', 'program_id' => 4, 'semesters_allowed' => 8],
        ];

        // Uncomment the below to run the seeder
        DB::table('positions')->insert($positions);
    }
}
