<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('programs')->delete();

        $programs = [
            ['id' => 1, 'name' => 'Non-Degree Seeking', 'needs_committee' => false, 'needs_gce' => false, 'gqes_needed' => 0, 'pass_level_needed_id' => 1],
            ['id' => 2, 'name' => 'MS Thesis', 'needs_committee' => true, 'needs_gce' => false, 'gqes_needed' => 3, 'pass_level_needed_id' => 2],
            ['id' => 3, 'name' => 'MS Non-Thesis', 'needs_committee' => false, 'needs_gce' => false, 'gqes_needed' => 3, 'pass_level_needed_id' => 2],
            ['id' => 4, 'name' => 'PhD Scientific Computing', 'needs_committee' => true, 'needs_gce' => true, 'gqes_needed' => 4, 'pass_level_needed_id' => 3],
        ];

        // Uncomment the below to run the seeder
        DB::table('programs')->insert($programs);
    }
}
