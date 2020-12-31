<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'victor',
            'email' => 'savanyu@savanyu.ch',
            'password' => bcrypt('1234'),
        ]);
    }
}
