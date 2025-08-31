<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AcademicYearsTableSeeder::class);
        $this->call(ActivityLogTableSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SupervisorsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(EducationLevelsTableSeeder::class);
        $this->call(EducationalLevelSubjectsTableSeeder::class);
        $this->call(ClassRoomsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(InstallmentPlansTableSeeder::class);
        $this->call(InstallmentPaymentsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(SalariesTableSeeder::class);
        $this->call(StaffAttendancesTableSeeder::class);
        $this->call(StaffLeavesTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(TextBooksTableSeeder::class);
        $this->call(TransactionsTableSeeder::class);
        $this->call(CulturalBooksTableSeeder::class);
        $this->call(TextBooksTableSeeder::class);
        $this->call(BookLoansTableSeeder::class);
        $this->call(StudentTextbookSalesTableSeeder::class);
        // $this->call(::class);

        // $roles = ['admin', 'teacher', 'librarian', 'supervisor', 'student', 'parent'];
        // foreach ($roles as $role) {
        //     Role::firstOrCreate(['name' => $role]);
        //     $this->call(EducationContentsTableSeeder::class);
        $this->call(ClassSessionsTableSeeder::class);
        $this->call(MarksTableSeeder::class);
        $this->call(StudentProfilesTableSeeder::class);
    }
        // $user = User::create([
        //     'name' => 'System Admin',
        //     'email' => 'admin@school.com',
        //     'password' => Hash::make('password123'), // استخدم هاش للباسورد
        //     'role' => 'admin',
        //     'phone_number' => '123456789',
        //     'address' => 'Head Office',
        // ]);
        // $user->assignRole('admin');
    }
}
