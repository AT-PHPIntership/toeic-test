<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Answer;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 10)->create();
    }
}
