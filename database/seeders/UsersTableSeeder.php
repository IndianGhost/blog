<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker  =   Factory::create();
        User::truncate();
        for ($i=5; $i<16; $i++)
        {
            $user = User::create([
                'name'      =>  $faker->name,
                'email'     =>  $faker->email,
                'password'  =>  $faker->password(8, 20)
            ]);
        }
    }
}
