<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(FundingSourcesTableSeeder::class);
        $this->call(YearlyBudgetsTableSeeder::class);

        $this->call(PassLevelsTableSeeder::class);

        $this->call(SemesterNamesTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(ProgramsTableSeeder::class);
        $this->call(AdvisorsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(StudentProgramsTableSeeder::class);

        $this->call(ToeflScoresTableSeeder::class);
        $this->call(IeltsScoresTableSeeder::class);
        $this->call(GreScoresTableSeeder::class);

        $this->call(GqeSectionsTableSeeder::class);
        $this->call(GqeOfferingsTableSeeder::class);
        $this->call(GqeResultsTableSeeder::class);
        $this->call(GceResultsTableSeeder::class);

        $this->call(PositionsTableSeeder::class);
        $this->call(AssistantshipStatusesTableSeeder::class);
        $this->call(TuitionWaiversTableSeeder::class);
        $this->call(AssistantshipsTableSeeder::class);
    }
}
