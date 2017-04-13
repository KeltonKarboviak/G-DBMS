<?php

use Illuminate\Database\Seeder;

class TuitionWaiversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('tuition_waivers')->delete();

        $waivers = [
            // Tuition Waivers for Fall 2015
            [
                'id' => 1, 'semester_id' => 1, 'student_id' => '8881111',
                'date_received' => '2015-08-01', 'amount_received' => 1500.00,
                'credit_hours' => 6, 'funding_source_id' => 1, 'received' => true
            ],
            [
                'id' => 2, 'semester_id' => 1, 'student_id' => '8882222',
                'date_received' => '2015-08-01', 'amount_received' => 1500.00,
                'credit_hours' => 6, 'funding_source_id' => 1, 'received' => true
            ],
            [
                'id' => 3, 'semester_id' => 1, 'student_id' => '8883333',
                'date_received' => '2015-08-01', 'amount_received' => 2000.00,
                'credit_hours' => 9, 'funding_source_id' => 1, 'received' => true
            ],
            [
                'id' => 4, 'semester_id' => 1, 'student_id' => '8884444',
                'date_received' => '2015-08-01', 'amount_received' => 2000.00,
                'credit_hours' => 9, 'funding_source_id' => 1, 'received' => true
            ],

            // Tuition Waivers for Spring 2016
            [
                'id' => 5, 'semester_id' => 2, 'student_id' => '8881111',
                'date_received' => '2016-01-01', 'amount_received' => 1500.00,
                'credit_hours' => 6, 'funding_source_id' => 1, 'received' => true
            ],
            [
                'id' => 6, 'semester_id' => 2, 'student_id' => '8882222',
                'date_received' => '2016-01-01', 'amount_received' => 1500.00,
                'credit_hours' => 6, 'funding_source_id' => 1, 'received' => true
            ],
            [
                'id' => 7, 'semester_id' => 2, 'student_id' => '8883333',
                'date_received' => null, 'amount_received' => 2000.00,
                'credit_hours' => 9, 'funding_source_id' => 1, 'received' => false
            ],
            [
                'id' => 8, 'semester_id' => 2, 'student_id' => '8884444',
                'date_received' => '2016-01-01', 'amount_received' => 2000.00,
                'credit_hours' => 9, 'funding_source_id' => 1, 'received' => true
            ],
        ];

        // Uncomment the below to run the seeder
        DB::table('tuition_waivers')->insert($waivers);
    }
}
