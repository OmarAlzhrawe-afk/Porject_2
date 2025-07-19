<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        $user =  User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123456',
            'role' => 'admin',
            'hire_date' => '2025-07-03',
            'ID_documents' => '',
            'phone_number' => '0968339198',
            'birth_date' => '2025-07-16',
            'gender' => 'male',
            'email_verified_at' => now(),
            'address' => 'adscscdasaas',
            'remember_token' =>  Str::random(60),
        ]);
        $user->assignRole('admin');
    }
}
