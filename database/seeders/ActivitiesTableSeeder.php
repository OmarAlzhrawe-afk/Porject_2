<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activities')->delete();
        
        \DB::table('activities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'Title' => 'football match',
                'class_room_id' => 1,
                'education_level_id' => 1,
                'term_id' => 1,
                'Description' => 'football match with another school',
                'activity_type' => 'sports',
                'date' => '2026-08-08',
                'location' => 'Campno stadium',
                'target_group' => 'all',
                'is_paid' => 0,
                'cost' => 0,
                'seats_limit' => 11,
                'registration_deadline' => '2026-08-25',
                'is_open' => 1,
                'gallery_urls' => '["uploads\\/Activity\\/gallery_urls\\/17571081440_sport_activity.jpg","uploads\\/Activity\\/gallery_urls\\/17571081441_sport_activity.jpg","uploads\\/Activity\\/gallery_urls\\/17571081442_sport_activity.jpg"]',
                'required_skills' => '["football","running"]',
                'auto_filter_participants' => 0,
                'created_at' => '2025-09-06 00:35:44',
                'updated_at' => '2025-09-06 00:35:44',
            ),
            1 => 
            array (
                'id' => 2,
                'Title' => 'football match',
                'class_room_id' => 1,
                'education_level_id' => 1,
                'term_id' => 1,
                'Description' => 'football match with another school',
                'activity_type' => 'sports',
                'date' => '2026-08-08',
                'location' => 'Campno stadium',
                'target_group' => 'all',
                'is_paid' => 0,
                'cost' => 0,
                'seats_limit' => 11,
                'registration_deadline' => '2026-08-25',
                'is_open' => 1,
                'gallery_urls' => '["uploads\\/Activity\\/gallery_urls\\/17571081620_sport_activity.jpg","uploads\\/Activity\\/gallery_urls\\/17571081621_sport_activity.jpg","uploads\\/Activity\\/gallery_urls\\/17571081622_sport_activity.jpg"]',
                'required_skills' => '["football","running"]',
                'auto_filter_participants' => 0,
                'created_at' => '2025-09-06 00:36:02',
                'updated_at' => '2025-09-06 00:36:02',
            ),
            2 => 
            array (
                'id' => 3,
                'Title' => 'playing org',
                'class_room_id' => 1,
                'education_level_id' => 1,
                'term_id' => 1,
                'Description' => 'playing org with special trainer',
                'activity_type' => 'art',
                'date' => '2026-08-08',
                'location' => 'school',
                'target_group' => 'all',
                'is_paid' => 0,
                'cost' => 0,
                'seats_limit' => 11,
                'registration_deadline' => '2026-08-25',
                'is_open' => 1,
                'gallery_urls' => '["uploads\\/Activity\\/gallery_urls\\/17571082850_music_lesson.jpg","uploads\\/Activity\\/gallery_urls\\/17571082851_music_lesson2.jpg","uploads\\/Activity\\/gallery_urls\\/17571082852_music_lesson.jpg"]',
                'required_skills' => '["music","music"]',
                'auto_filter_participants' => 0,
                'created_at' => '2025-09-06 00:38:05',
                'updated_at' => '2025-09-06 00:38:05',
            ),
        ));
        
        
    }
}