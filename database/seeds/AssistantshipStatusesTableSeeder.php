<?php

use Illuminate\Database\Seeder;

class AssistantshipStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('assistantship_statuses')->delete();

        $statuses = [
            ['id' => 1, 'description' => 'Pending'],
            ['id' => 2, 'description' => 'Accepted'],
            ['id' => 3, 'description' => 'Declined'],
            ['id' => 4, 'description' => 'Deferred'],
            ['id' => 5, 'description' => 'Terminated'],
        ];

        // Uncomment the below to run the seeder
        DB::table('assistantship_statuses')->insert($statuses);
    }
}
