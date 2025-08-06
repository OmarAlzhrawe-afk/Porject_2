<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{


    public function run()
    {


        \DB::table('activities')->delete();

        \DB::table('activities')->insert(array(
            0 =>
            array(
                'id' => 2,
                'Title' => 'Aleppo Tour',
                'class_room_id' => 1,
                'education_level_id' => NULL,
                'Description' => 'visit tourism places in damascus',
                'activity_type' => 'trip',
                'date' => '2026-08-08',
                'location' => 'center city',
                'target_group' => 'all',
                'is_paid' => 1,
                'cost' => 25000,
                'seats_limit' => 200,
                'registration_deadline' => '2026-08-25',
                'is_open' => 1,
                'gallery_urls' => '[]',
                'required_skills' => NULL,
                'auto_filter_participants' => 0,
                'created_at' => '2025-08-06 15:49:42',
                'updated_at' => '2025-08-06 15:49:42',
            ),
            1 =>
            array(
                'id' => 3,
                'Title' => 'Aleppo Tour',
                'class_room_id' => 1,
                'education_level_id' => NULL,
                'Description' => 'visit tourism places in damascus',
                'activity_type' => 'trip',
                'date' => '2026-08-08',
                'location' => 'center city',
                'target_group' => 'all',
                'is_paid' => 1,
                'cost' => 25000,
                'seats_limit' => 200,
                'registration_deadline' => '2026-08-25',
                'is_open' => 1,
                'gallery_urls' => '["uploads\\/Activity\\/gallery_urls\\/17544849030_Black Modern Professional Resume (1).pdf","uploads\\/Activity\\/gallery_urls\\/17544849031_Black Modern Professional Resume (1).pdf","uploads\\/Activity\\/gallery_urls\\/17544849032_School Managment  System.pdf"]',
                'required_skills' => NULL,
                'auto_filter_participants' => 0,
                'created_at' => '2025-08-06 15:55:03',
                'updated_at' => '2025-08-06 15:55:03',
            ),
            2 =>
            array(
                'id' => 4,
                'Title' => 'Aleppo Tour',
                'class_room_id' => 1,
                'education_level_id' => NULL,
                'Description' => 'visit tourism places in damascus',
                'activity_type' => 'trip',
                'date' => '2026-08-08',
                'location' => 'center city',
                'target_group' => 'all',
                'is_paid' => 1,
                'cost' => 25000,
                'seats_limit' => 200,
                'registration_deadline' => '2026-08-25',
                'is_open' => 1,
                'gallery_urls' => '["uploads\\/Activity\\/gallery_urls\\/17544850700_Black Modern Professional Resume (1).pdf","uploads\\/Activity\\/gallery_urls\\/17544850701_Black Modern Professional Resume (1).pdf","uploads\\/Activity\\/gallery_urls\\/17544850702_School Managment  System.pdf"]',
                'required_skills' => '"[\\"drawing\\",\\"swimming\\"]"',
                'auto_filter_participants' => 0,
                'created_at' => '2025-08-06 15:57:50',
                'updated_at' => '2025-08-06 15:57:50',
            ),
            3 =>
            array(
                'id' => 5,
                'Title' => 'Aleppo Tour',
                'class_room_id' => 1,
                'education_level_id' => NULL,
                'Description' => 'visit tourism places in damascus',
                'activity_type' => 'trip',
                'date' => '2026-08-08',
                'location' => 'center city',
                'target_group' => 'all',
                'is_paid' => 1,
                'cost' => 25000,
                'seats_limit' => 200,
                'registration_deadline' => '2026-08-25',
                'is_open' => 1,
                'gallery_urls' => '["uploads\\/Activity\\/gallery_urls\\/17544853100_Black Modern Professional Resume (1).pdf","uploads\\/Activity\\/gallery_urls\\/17544853101_Black Modern Professional Resume (1).pdf","uploads\\/Activity\\/gallery_urls\\/17544853102_School Managment  System.pdf"]',
                'required_skills' => '"[\\"drawing\\",\\"swimming\\"]"',
                'auto_filter_participants' => 0,
                'created_at' => '2025-08-06 16:01:50',
                'updated_at' => '2025-08-06 16:01:50',
            ),
            4 =>
            array(
                'id' => 6,
                'Title' => 'Aleppo Tour',
                'class_room_id' => 1,
                'education_level_id' => NULL,
                'Description' => 'visit tourism places in damascus',
                'activity_type' => 'trip',
                'date' => '2026-08-08',
                'location' => 'center city',
                'target_group' => 'all',
                'is_paid' => 1,
                'cost' => 25000,
                'seats_limit' => 200,
                'registration_deadline' => '2026-08-25',
                'is_open' => 1,
                'gallery_urls' => '["uploads\\/Activity\\/gallery_urls\\/17544854110_Black Modern Professional Resume (1).pdf","uploads\\/Activity\\/gallery_urls\\/17544854111_Black Modern Professional Resume (1).pdf","uploads\\/Activity\\/gallery_urls\\/17544854112_School Managment  System.pdf"]',
                'required_skills' => '["drawing","swimming"]',
                'auto_filter_participants' => 0,
                'created_at' => '2025-08-06 16:03:31',
                'updated_at' => '2025-08-06 16:03:31',
            ),
        ));
    }
}
