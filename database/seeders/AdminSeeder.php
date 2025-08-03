<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{

    public function run()
    {
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);
        $teacherRole = Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'api']);
        $librarianRole = Role::firstOrCreate(['name' => 'librarian', 'guard_name' => 'api']);
        $supervisorRole = Role::firstOrCreate(['name' => 'supervisor', 'guard_name' => 'api']);
        $studentRole = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'api']);
        $parentRole = Role::firstOrCreate(['name' => 'parent', 'guard_name' => 'api']);
        $admin = User::create([
            'id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'role' => 'admin',
            'hire_date' => '2023-01-01',
            'ID_documents' => '["id_card.pdf","passport.jpg"]',
            'phone_number' => '01012345678',
            'birth_date' => '1990-05-15',
            'gender' => 'male',
            'email_verified_at' => NULL,
            'address' => '123 Admin Street, City',
            'remember_token' => NULL,
            'created_at' => '2025-07-30 23:07:38',
            'updated_at' => '2025-07-30 23:07:38',
        ]);
        $admin->assignRole($adminRole);
    }
}
