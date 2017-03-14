<?php

use Illuminate\Database\Seeder;

class FundingSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('funding_sources')->delete();

        $sources = [
            ['id' => 1, 'name' => 'Computer Science Department', 'is_grant' => false],
            ['id' => 2, 'name' => 'Travis Desell - Grant 1', 'is_grant' => true],
        ];

        // Uncomment the below to run the seeder
        DB::table('funding_sources')->insert($sources);
    }
}
