<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $this->call(UsersTableSeeder::class);
        $this->call(EducationLevelsTableSeeder::class);
        $this->call(ClassRoomsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(EducationLevelSubjectSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(PreRegistrationsTableSeeder::class);
        $this->call(StaffLeavesTableSeeder::class);
    }
}
