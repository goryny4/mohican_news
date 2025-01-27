<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Politics'],
            ['name' => 'Economics'],
            ['name' => 'Social'],
            ['name' => 'Tech'],
            ['name' => 'Entertainment'],
        ]);
    }
}
