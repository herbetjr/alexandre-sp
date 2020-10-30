<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
	   DB::table('admins')->insert([
          	'role_id' => 1,
            'name' => 'Herbet',
            'email' => 'herbet@gmail.com',
            'password' => Hash::make('01072015'),
        ]);
    }
}
