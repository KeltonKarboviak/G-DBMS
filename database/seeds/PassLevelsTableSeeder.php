<?php

use Illuminate\Database\Seeder;

class PassLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('pass_levels')->delete();

        $levels = [
            ['id' => 1, 'name' => 'Fail'],
            ['id' => 2, 'name' => 'MS'],
            ['id' => 3, 'name' => 'PhD'],
        ];

        // Uncomment the below to run the seeder
        DB::table('pass_levels')->insert($levels);
    }
}
