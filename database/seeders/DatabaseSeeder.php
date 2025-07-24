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


        $this->call([
            RolesTableSeeder::class,
            // PermissionsTableSeeder::class,
            // RoleHasPermissionsTableSeeder::class,
            UsersTableSeeder::class,
            // ModelHasRolesTableSeeder::class,
            // ModelHasPermissionsTableSeeder::class,
            // StudentsTableSeeder::class,
            // TeachersTableSeeder::class,
        ]);
        // $this->call(SupervisorTableSeeder::class);
        // $this->call(EducationLevelsTableSeeder::class);
        // $this->call(ClassRoomsTableSeeder::class);
        // $this->call(SubjectsTableSeeder::class);
        // $this->call(EducationLevelSubjectSeeder::class);
        // $this->call(TeachersTableSeeder::class);
        // $this->call(PreRegistrationsTableSeeder::class);
        // $this->call(StaffLeavesTableSeeder::class);

        // $this->call(StudentsTableSeeder::class);
        // $this->call(StudentProfilesTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        // $this->call(ModelHasRolesTableSeeder::class);
        // $this->call(ModelHasPermissionsTableSeeder::class);
        // $this->call(RoleHasPermissionsTableSeeder::class);
    }
}
