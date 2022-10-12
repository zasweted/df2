<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as F;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        DB::table('users')->insert([
            'name' => 'bebras',
            'email' => 'bebras@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'briedis',
            'email' => 'briedis@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => $time,
            'updated_at' => $time,
            'role' => 10
        ]);

        

        foreach([
            'Total Recall 2',
            'Tom and Tom 3',
            'Cobra and Robocop 5',
            'Shark and Cats',
            'Fast and  Furryous 12',
            'Lara and Tombs 17'
            ] as $movie) {
            DB::table('movies')->insert([
                'title' => $movie,
                'price' => rand(100, 1000) / 100,
                'created_at' => $time->addSeconds(rand(1, 100000)),
                'updated_at' => $time->addSeconds(5)
            ]);


        }
        $faker = F::create('lt_LT');
        foreach(range(1, 22) as $_) {
            DB::table('comments')->insert([
                'post' => $faker->paragraph(rand(1, 10)),
                'movie_id' => rand(1, 6),
                'created_at' => $time->addSeconds(1),
                'updated_at' => $time
            ]);
        }

        foreach([
            'Nice',
            'Super',
            'Very nice',
            '18+',
            'Very Blue',
            'Animalistic',
            'Perfect'
            ] as $tag) {
            DB::table('tags')->insert([
                'title' => $tag,
                'created_at' => $time->addSeconds(rand(1, 100000)),
                'updated_at' => $time->addSeconds(5)
            ]);


        }


    }
}