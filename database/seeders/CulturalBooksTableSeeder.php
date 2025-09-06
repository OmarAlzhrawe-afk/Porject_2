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
                'title' => 'طبائع الاستبداد وصارع الاستعباد',
                'author' => 'عبد الرحمن الكواكبي',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'paper',
                'format_url' => 'uploads/books/1757109578_SE2_2022-2023-2.pdf',
                'copies_available' => 0,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'يتحدث عن استبداد الدولة العثمانية',
                'created_at' => '2025-09-06 00:59:38',
                'updated_at' => '2025-09-06 00:59:38',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'الروح والجسد',
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
                'description' => 'طرفان نقيضان يتصارعان وبينهما يعيش الإنسان في كبد تحلق به الروح في علياء المعاني السامية ويقيده الجسد الفاني باغلال محكمة من شهوات ورغبات.. هذا الصراع الذي تكلم فيه رجال الدين والفلاسفة والمفكرون والمتصوفون.. وحسمه لصالح الروح االأنبياء ومن خطا على نهجهم،',
                'created_at' => '2025-09-06 01:03:59',
                'updated_at' => '2025-09-06 01:03:59',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'الروح والجسد',
                'author' => 'مصطفى محمود',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'pdf',
                'format_url' => 'uploads/books/1757109856_SE2_2022-2023-2.pdf',
                'copies_available' => 0,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'طرفان نقيضان يتصارعان وبينهما يعيش الإنسان في كبد تحلق به الروح في علياء المعاني السامية ويقيده الجسد الفاني باغلال محكمة من شهوات ورغبات.. هذا الصراع الذي تكلم فيه رجال الدين والفلاسفة والمفكرون والمتصوفون.. وحسمه لصالح الروح االأنبياء ومن خطا على نهجهم،',
                'created_at' => '2025-09-06 01:04:16',
                'updated_at' => '2025-09-06 01:04:16',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'الداء والدواء',
                'author' => 'ابن القيم',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'pdf',
                'format_url' => 'uploads/books/1757109988_SE2_2022-2023-2.pdf',
                'copies_available' => 0,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'عالج ابن القيم من خلال هذا الكتاب قضايا النفس البشرية وأدوارها، ورسم سبل إصلاحها وتزكيتها، فبين معنى المعصية وأسبابها وآثارها على النفس والمجتمع، ومآلاتها في الدنيا والآخرة، ثم عرض لبيان الدواء الناجح لهذا الداء، مستلهماً توجيهات القرآن الكريم والسنة النبوية في إصلاح النفوس والمجتمع. وقد اتسمت معالجته لهذا الموضوع بالدقة والموضوعية البالغة، فكان العالم الاجتماعي والمربي ا يعالج ابن القيم من خلال هذا الكتاب قضايا النفس البشرية وأدوارها، ورسم سبل إصلاحها وتزكيتها، فبين معنى المعصية وأسبابها وآثارها على النفس والمجتمع، ومآلاتها في الدنيا والآخرة، ثم عرض لبيان الدواء الناجح لهذا الداء، مستلهماً توجيهات القرآن الكريم والسنة النبوية في إصلاح النفوس والمجتمع',
                'created_at' => '2025-09-06 01:06:28',
                'updated_at' => '2025-09-06 01:06:28',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'الداء والدواء',
                'author' => 'ابن القيم',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'عالج ابن القيم من خلال هذا الكتاب قضايا النفس البشرية وأدوارها، ورسم سبل إصلاحها وتزكيتها، فبين معنى المعصية وأسبابها وآثارها على النفس والمجتمع، ومآلاتها في الدنيا والآخرة، ثم عرض لبيان الدواء الناجح لهذا الداء، مستلهماً توجيهات القرآن الكريم والسنة النبوية في إصلاح النفوس والمجتمع. وقد اتسمت معالجته لهذا الموضوع بالدقة والموضوعية البالغة، فكان العالم الاجتماعي والمربي ا يعالج ابن القيم من خلال هذا الكتاب قضايا النفس البشرية وأدوارها، ورسم سبل إصلاحها وتزكيتها، فبين معنى المعصية وأسبابها وآثارها على النفس والمجتمع، ومآلاتها في الدنيا والآخرة، ثم عرض لبيان الدواء الناجح لهذا الداء، مستلهماً توجيهات القرآن الكريم والسنة النبوية في إصلاح النفوس والمجتمع',
                'created_at' => '2025-09-06 01:06:41',
                'updated_at' => '2025-09-06 01:06:41',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'البداية والنهاية',
                'author' => 'ابن كثير',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'paper',
                'format_url' => NULL,
                'copies_available' => NULL,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'كتاب يجمع بين التاريخ الاسلامي والفقه والعبر في عصور الدول الاسلامية',
                'created_at' => '2025-09-06 01:10:55',
                'updated_at' => '2025-09-06 01:10:55',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'البداية والنهاية',
                'author' => 'ابن كثير',
                'publisher' => 'مكتبة القاهرة',
                'publication_year' => '1990-01-01',
                'type' => 'pdf',
                'format_url' => 'uploads/books/1757110269_SE2_2022-2023-2.pdf',
                'copies_available' => 0,
                'avg_student_rating' => '0.00',
                'avg_teacher_rating' => '0.00',
                'total_student_reviews' => 0,
                'total_teacher_reviews' => 0,
                'description' => 'كتاب يجمع بين التاريخ الاسلامي والفقه والعبر في عصور الدول الاسلامية',
                'created_at' => '2025-09-06 01:11:09',
                'updated_at' => '2025-09-06 01:11:09',
            ),
        ));
        
        
    }
}