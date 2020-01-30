<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Category;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 15;
        $fullTexts = json_decode(file_get_contents("https://baconipsum.com/api/?type=meat-and-filler&start-with-lorem=1&paras=$i"),true);
        while ($i--) {
            DB::table('news')->insert([
                'title' => file_get_contents("https://baconipsum.com/api/?type=meat-and-filler&sentences=1&format=text"),
                'full_text' => array_shift($fullTexts),
                'category_id' => rand(1, Category::count()),
                'created_at' => date("Y-m-d H:i:s",mt_rand(1162055681,1580378982))
            ]);
        }
    }
}
