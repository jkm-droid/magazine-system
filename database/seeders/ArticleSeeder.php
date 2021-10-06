<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Article');
        for ($i = 1; $i <= 50; $i++) {
            $title = $faker->sentence(8);
            $image = $faker->image(public_path('article_covers'), 900, 400, null, false);
            $author_name = Admin::pluck('name')->random();

            DB::table('articles')->insert([
                'title' => ucfirst($title),
                'body' => $faker->sentence(1000),
                'author' => $author_name,
                'slug' => str_replace(" ", "-", $title),
                'image' => $image,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'admin_id' => Admin::where('name', $author_name)->pluck('id')->random(),
            ]);

        }

    }
}
