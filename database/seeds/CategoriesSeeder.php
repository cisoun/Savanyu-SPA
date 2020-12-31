<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'painting'],
            ['id' => 2, 'name' => 'photography'],
            ['id' => 3, 'name' => 'sculpture'],
            ['id' => 4, 'name' => 'video'],
        ]);
    }
}
