<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'role' => 'admin',
            'hire_date' => '2023-01-01',
            'ID_documents' => ['id_card.pdf', 'passport.jpg'],
            'phone_number' => '01012345678',
            'birth_date' => '1990-05-15',
            'gender' => 'male',
            'address' => '123 Admin Street, City',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin->assignRole('admin');
    }
}
