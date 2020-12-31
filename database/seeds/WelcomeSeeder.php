<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WelcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('welcome')->insert(['text' => '']);
    }
}
