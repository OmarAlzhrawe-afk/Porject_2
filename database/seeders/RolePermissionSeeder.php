<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset Cashed Roles and permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Defines All roles And Permissions 
        $permissions = [
            'view dashborad',
            'manage users',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }


        // 'admin', 'teacher', 'librarian', 'supervisor', 'student', 'parent'
        // Admin Role
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());
        // Teacher Role
        $teacher = Role::firstOrCreate(['name' => 'teacher']);
        $teacher->givePermissionTo(Permission::all());
        // Librarian Role
        $librarian = Role::firstOrCreate(['name' => 'librarian']);
        $librarian->givePermissionTo(Permission::all());
        // Supervisor Role
        $supervisor = Role::firstOrCreate(['name' => 'supervisor']);
        $supervisor->givePermissionTo(Permission::all());
        // Student  Role
        $student = Role::firstOrCreate(['name' => 'student']);
        $student->givePermissionTo(Permission::all());
        // Parent  Role
        $parent = Role::firstOrCreate(['name' => 'parent']);
        $parent->givePermissionTo(Permission::all());
    }
}
