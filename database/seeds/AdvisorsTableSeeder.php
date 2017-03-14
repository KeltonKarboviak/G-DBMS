<?php

use Illuminate\Database\Seeder;

class AdvisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('advisors')->delete();

        $advisors = [
            ['id' => '0001111', 'first_name' => 'Hassan', 'last_name' => 'Reza', 'email' => 'reza@cs.und.edu'],
            ['id' => '0002222', 'first_name' => 'Travis', 'last_name' => 'Desell', 'email' => 'tdesell@cs.und.edu'],
        ];

        // Uncomment the below to run the seeder
        DB::table('advisors')->insert($advisors);
    }
}
