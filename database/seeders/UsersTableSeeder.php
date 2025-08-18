<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->admin()->create()->each(function ($user) {
            $user->createToken('faker-token');
        });
        User::factory(200)->student()->create()->each(function ($user) {
            $user->createToken('faker-token');
        });
        User::factory(10)->teacher()->create()->each(function ($user) {
            $user->createToken('faker-token');
        });
        User::factory(5)->supervisor()->create()->each(function ($user) {
            $user->createToken('faker-token');
        });
        User::factory(200)->parent()->create()->each(function ($user) {
            $user->createToken('faker-token');
        });
        User::factory(1)->librarian()->create()->each(function ($user) {
            $user->createToken('faker-token');
        });
    }
}
