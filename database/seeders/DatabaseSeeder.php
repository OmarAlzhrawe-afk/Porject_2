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
            AdminSeeder::class,
            // RolePermissionSeeder::class,
            // UsersTableSeeder::class,

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
    }
}
