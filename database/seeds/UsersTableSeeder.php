<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('users')->delete();

        $users = [
            [
                'email' => 'kelton.karboviak@und.edu', 'first_name' => 'Kelton',
                'last_name' => 'Karboviak', 'password' => bcrypt('password'),
                'role_id' => 1, 'created_at' => new DateTime, 'updated_at' => new DateTime,
            ],
            [
                'email' => 'connor.bowley@und.edu', 'first_name' => 'Connor',
                'last_name' => 'Bowley', 'password' => bcrypt('password'),
                'role_id' => 1, 'created_at' => new DateTime, 'updated_at' => new DateTime,
            ],
        ];

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }
}
