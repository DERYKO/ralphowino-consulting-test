<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'email' => 'john@doe.com',
       'name' => str_random(12),
        'password' => bcrypt('secret')
    ]);
    }
}
