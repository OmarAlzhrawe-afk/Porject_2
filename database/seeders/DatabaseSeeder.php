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
        // Creating Acadimic Year 
        $this->call(AcadimicYearSeeder::class);
        // Creating Term Seeder 
        $this->call(TermSeeder::class);
        // Creating Roles For Users 
        $this->call(RolesTableSeeder::class);
        // Users (teachers, students, supervisors, librarians, parents, etc.)
        $this->call(UsersTableSeeder::class);
        // Education levels and Classes
        $this->call(EducationLevelsTableSeeder::class);
        $this->call(ClassRoomsTableSeeder::class);
        // Subjects and pivot table educational_level_subjects
        $this->call(SubjectsTableSeeder::class);
        $this->call(EducationLevelSubjectSeeder::class);
        // Teachers and their sessions
        $this->call(SessionsSeeder::class);
        // Students and profiles
        // $this->call(StudentSeeder::class);
        $this->call(StudentProfilesTableSeeder::class);
        // Marks and HomeWorks
        $this->call(MarkSeeder::class);
        $this->call(HomeWorkSeeder::class);
        $this->call(HomeworkSolvingSeeder::class);
        // Library: TextBooks, CulturalBooks, Loans, Sales
        $this->call(TextBookSeeder::class);
        $this->call(CulturalBooksTableSeeder::class);
        $this->call(BookLoansTableSeeder::class);
        $this->call(StudentTextbookSalesTableSeeder::class);
        // Activities and Participants
        $this->call(ActivitiesTableSeeder::class);
        $this->call(ActivityParticipantsTableSeeder::class);
        // Salaries and Deductions
        $this->call(StaffDeducationsSeeder::class);
        $this->call(SalarySeeder::class);
        // Payment & Transaction tables
        $this->call(PaymentMethodSeeder::class);
        $this->call(InstallmentPlanSeeder::class);
        $this->call(InstallmentPaymentSeeder::class);
        $this->call(TransactionSeeder::class);
        // QR codes & Staff Attendances
        $this->call(QRCodeSeeder::class);
        $this->call(StaffAttendanceSeeder::class);
        // Student Attendances
        $this->call(StudentAttendanceSeeder::class);
        // Public Contents & Education Contents
        $this->call(PublicContentTableSeeder::class);
        $this->call(EducationContentSeeder::class);
        // Pre-registrations
        $this->call(PreRegistrationSeeder::class);
        $this->call(PostSeeder::class);
    }
}
