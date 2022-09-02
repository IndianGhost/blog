<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  =   Factory::create();
        Post::truncate();
        for ($i=50; $i<160; $i++)
        {
            $post = Post::create([
                'title'      =>  $faker->name,
                'content'     =>  $faker->email,
                'user_id'  =>  $faker->rand(1, 4)
            ]);
        }
    }
}
