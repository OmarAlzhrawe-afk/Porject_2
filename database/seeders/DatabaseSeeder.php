<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            // RolePermissionSeeder::class,
            // UsersTableSeeder::class,
            // UsersTableSeeder::class,
            // SupervisorTableSeeder::class,
            // EducationLevelsTableSeeder::class,
            // ClassRoomsTableSeeder::class,
            // ActivitiesTableSeeder::class,
            // TeachersTableSeeder::class,

            // ClassSessionsTableSeeder::class,
            // EducationalLevelSubjectsTableSeeder::class,
            // ModelHasRolesTableSeeder::class,
            // PersonalAccessTokensTableSeeder::class,
            // QrCodesTableSeeder::class,
            // RolesTableSeeder::class,
            // SubjectsTableSeeder::class,
        ]);
        // $this->call(UsersTableSeeder::class);
        // $this->call(CulturalBooksTableSeeder::class);
        // $this->call(BookLoansTableSeeder::class);
        // $this->call(ReportsTableSeeder::class);
        // $this->call(TextBooksTableSeeder::class);
        // $this->call(SupervisorsTableSeeder::class);
        // $this->call(TransactionsTableSeeder::class);
        // $this->call(StudentTextbookSalesTableSeeder::class);
        // $this->call(PersonalAccessTokensTableSeeder::class);
        // $this->call(EducationalLevelSubjectsTableSeeder::class);
        // $this->call(ActivitiesTableSeeder::class);
        // $this->call(ModelHasRolesTableSeeder::class);
        // $this->call(QrCodesTableSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(SubjectsTableSeeder::class);
        // $this->call(TeachersTableSeeder::class);
        // $this->call(EducationLevelsTableSeeder::class);
        // $this->call(ClassSessionsTableSeeder::class);
        // $this->call(ClassRoomsTableSeeder::class);
    }
}
