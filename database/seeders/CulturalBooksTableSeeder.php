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
                'title' => 'book1',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-02-02',
                'type' => 'Paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-10 05:20:07',
                'updated_at' => '2025-08-10 05:20:07',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'book2',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-02-02',
                'type' => 'Paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-10 05:20:13',
                'updated_at' => '2025-08-10 05:20:13',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'book3',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-02-02',
                'type' => 'Paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-10 05:20:18',
                'updated_at' => '2025-08-10 05:20:18',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'book4',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-02-02',
                'type' => 'Paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن حالة المجتمع وعلاقات الزواج والارتباط وما يعرف بالحب بأسلوب هزلي ساخر ناقد',
                'created_at' => '2025-08-10 05:20:24',
                'updated_at' => '2025-08-10 05:20:24',
            ),
        ));
        
        
    }
}