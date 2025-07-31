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
            RolePermissionSeeder::class,
            UsersTableSeeder::class,

            // RolesTableSeeder::class,
            // PermissionsTableSeeder::class,
            // RoleHasPermissionsTableSeeder::class,
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
        $this->call(UsersTableSeeder::class);
        $this->call(CulturalBooksTableSeeder::class);
        $this->call(BookLoansTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(TextBooksTableSeeder::class);
        $this->call(SupervisorsTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(StudentTextbookSalesTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(EducationalLevelSubjectsTableSeeder::class);
    }
}
