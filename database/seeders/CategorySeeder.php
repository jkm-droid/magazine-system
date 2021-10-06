<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Category');
        for ($i = 1; $i <= 10; $i++) {
            $title = str_replace(".", " ", $faker->sentence(1));

            DB::table('categories')->insert([
                'title' => ucfirst($title),
                'author' => Admin::pluck('name')->random(),
                'slug' => str_replace(" ", "_", strtolower($title)),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'admin_id' => Admin::pluck('id')->random(),
            ]);
        }
    }
}
