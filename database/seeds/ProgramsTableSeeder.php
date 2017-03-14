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
            ['id' => 1, 'name' => 'Non-Degree Seeking'],
            ['id' => 2, 'name' => 'MS Thesis'],
            ['id' => 3, 'name' => 'MS Non-Thesis'],
            ['id' => 4, 'name' => 'PhD Scientific Computing'],
        ];

        // Uncomment the below to run the seeder
        DB::table('programs')->insert($programs);
    }
}
