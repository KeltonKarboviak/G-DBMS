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
            ['name' => 'GTA'],
            ['name' => 'GRA'],
            ['name' => 'GSA'],
        ];

        // Uncomment the below to run the seeder
        DB::table('positions')->insert($positions);
    }
}
