<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('user_roles')->delete();

        $roles = [
            ['id' => 1, 'name' => 'Director'],
            ['id' => 2, 'name' => 'Chair'],
            ['id' => 3, 'name' => 'Secretary'],
            ['id' => 4, 'name' => 'Faculty'],
        ];

        // Uncomment the below to run the seeder
        DB::table('user_roles')->insert($roles);
    }
}
