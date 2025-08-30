<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CulturalBooksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cultural_books')->delete();
        
        \DB::table('cultural_books')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'الأمل',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'paper',
                'format_url' => NULL,
                'copies_available' => 2,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-30 19:45:17',
                'updated_at' => '2025-08-30 19:57:42',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'التفوق',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-30 19:45:28',
                'updated_at' => '2025-08-30 19:45:28',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'النجاح',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-30 19:45:38',
                'updated_at' => '2025-08-30 19:45:38',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'العمل',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-30 19:45:48',
                'updated_at' => '2025-08-30 19:45:48',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'الكفاح',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-30 19:45:59',
                'updated_at' => '2025-08-30 19:45:59',
            ),
        ));
        
        
    }
}