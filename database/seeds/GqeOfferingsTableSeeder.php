<?php

use Illuminate\Database\Seeder;

class GqeOfferingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('gqe_offerings')->delete();

        $offers = [
            ['id' => 1, 'gqe_section_id' => 1, 'semester_id' => 1, 'date' => '2015-09-10', 'cutoff_ms' => 76.88, 'cutoff_phd' => 82.17],
            ['id' => 2, 'gqe_section_id' => 2, 'semester_id' => 1, 'date' => '2015-09-10', 'cutoff_ms' => 71.50, 'cutoff_phd' => 79.45],
            ['id' => 3, 'gqe_section_id' => 3, 'semester_id' => 2, 'date' => '2016-02-25', 'cutoff_ms' => 70.92, 'cutoff_phd' => 80.00],
            ['id' => 4, 'gqe_section_id' => 4, 'semester_id' => 2, 'date' => '2016-02-25', 'cutoff_ms' => 78.11, 'cutoff_phd' => 81.99],

            ['id' => 5, 'gqe_section_id' => 1, 'semester_id' => 5, 'date' => '2016-09-10', 'cutoff_ms' => 76.88, 'cutoff_phd' => 82.17],
            ['id' => 6, 'gqe_section_id' => 2, 'semester_id' => 5, 'date' => '2016-09-10', 'cutoff_ms' => 71.50, 'cutoff_phd' => 79.45],
            ['id' => 7, 'gqe_section_id' => 3, 'semester_id' => 6, 'date' => '2017-02-25', 'cutoff_ms' => 70.92, 'cutoff_phd' => 80.00],
            ['id' => 8, 'gqe_section_id' => 4, 'semester_id' => 6, 'date' => '2017-02-25', 'cutoff_ms' => 78.11, 'cutoff_phd' => 81.99],

            ['id' => 9,  'gqe_section_id' => 1, 'semester_id' => 9,  'date' => '2017-09-10', 'cutoff_ms' => 76.88, 'cutoff_phd' => 82.17],
            ['id' => 10, 'gqe_section_id' => 2, 'semester_id' => 9,  'date' => '2017-09-10', 'cutoff_ms' => 71.50, 'cutoff_phd' => 79.45],
            ['id' => 11, 'gqe_section_id' => 3, 'semester_id' => 10, 'date' => '2018-02-25', 'cutoff_ms' => 70.92, 'cutoff_phd' => 80.00],
            ['id' => 12, 'gqe_section_id' => 4, 'semester_id' => 10, 'date' => '2018-02-25', 'cutoff_ms' => 78.11, 'cutoff_phd' => 81.99],
        ];

        // Uncomment the below to run the seeder
        DB::table('gqe_offerings')->insert($offers);
    }
}
