<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolePermissionSeeder::class);
        $this->call(UsersTableSeeder::class);

        // $this->call(SupervisorTableSeeder::class);
        // $this->call(EducationLevelsTableSeeder::class);
        // $this->call(ClassRoomsTableSeeder::class);
        // $this->call(SubjectsTableSeeder::class);
        // $this->call(EducationLevelSubjectSeeder::class);
        // $this->call(TeachersTableSeeder::class);
        // $this->call(PreRegistrationsTableSeeder::class);
        // $this->call(StaffLeavesTableSeeder::class);

        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'teacher']);
        // Role::create(['name' => 'student']);
        // Role::create(['name' => 'supervisor']);
        // Role::create(['name' => 'librarian']);
        // Role::create(['name' => 'parent']);
    }
}
