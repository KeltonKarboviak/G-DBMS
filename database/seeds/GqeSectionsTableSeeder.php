<?php

use Illuminate\Database\Seeder;

class GqeSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('gqe_sections')->delete();

        $sections = [
            ['id' => 1, 'name' => 'DB'],
            ['id' => 2, 'name' => 'SD'],
            ['id' => 3, 'name' => 'TF'],
            ['id' => 4, 'name' => 'OS'],
        ];

        // Uncomment the below to run the seeder
        DB::table('gqe_sections')->insert($sections);
    }
}
