<?php

namespace Database\Seeders;

use App\Models\Student;
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
            UsersTableSeeder::class,
            SupervisorTableSeeder::class,
            EducationLevelsTableSeeder::class,
            ClassRoomsTableSeeder::class,
            StudentsTableSeeder::class,
            RolesTableSeeder::class,
            ModelHasRolesTableSeeder::class,
            PersonalAccessTokensTableSeeder::class,
            SubjectsTableSeeder::class,
            CulturalBooksTableSeeder::class,
            TextBooksTableSeeder::class,
            BookLoansTableSeeder::class,
            StudentTextbookSalesTableSeeder::class,
        ]);
    }
}
