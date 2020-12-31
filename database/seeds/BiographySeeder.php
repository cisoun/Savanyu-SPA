<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BiographySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('biography')->insert(['text' => '']);
    }
}
