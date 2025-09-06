<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SchoolPostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('school_posts')->delete();
        
        \DB::table('school_posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Draeing lesson',
                'description' => 'interesting drawing lesson',
                'post_type' => 'lesson',
                'file_url' => 'uploads/Posts/1757094847_medium-shot-kids-sunday-school.jpg',
                'is_public' => 1,
                'created_at' => '2025-09-05 20:54:07',
                'updated_at' => '2025-09-05 20:54:07',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'sport activity',
                'description' => 'interesting sport lesson',
                'post_type' => 'lesson',
                'file_url' => 'uploads/Posts/1757095199_sport_activity.jpg',
                'is_public' => 1,
                'created_at' => '2025-09-05 20:59:59',
                'updated_at' => '2025-09-05 20:59:59',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'sport activity',
                'description' => 'interesting sport lesson',
                'post_type' => 'event',
                'file_url' => 'uploads/Posts/1757095224_sport_activity.jpg',
                'is_public' => 1,
                'created_at' => '2025-09-05 21:00:24',
                'updated_at' => '2025-09-05 21:00:24',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'drawing activity',
                'description' => 'interesting drawing lesson',
                'post_type' => 'event',
                'file_url' => 'uploads/Posts/1757095255_our_kids_drawing.jpg',
                'is_public' => 1,
                'created_at' => '2025-09-05 21:00:55',
                'updated_at' => '2025-09-05 21:00:55',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'our beautiful school',
                'description' => 'We have refurbished the school.',
                'post_type' => 'news',
                'file_url' => 'uploads/Posts/1757095353_new_view_in_our_school.jpg',
                'is_public' => 1,
                'created_at' => '2025-09-05 21:02:33',
                'updated_at' => '2025-09-05 21:02:33',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'our beautiful class',
                'description' => 'We have refurbished the school.',
                'post_type' => 'news',
                'file_url' => 'uploads/Posts/1757095373_new_classes.jpg',
                'is_public' => 1,
                'created_at' => '2025-09-05 21:02:53',
                'updated_at' => '2025-09-05 21:02:53',
            ),
        ));
        
        
    }
}