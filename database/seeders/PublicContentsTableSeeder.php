<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublicContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('public_contents')->delete();
        
        \DB::table('public_contents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'content_type' => 'Frequently_asked_questions',
                'content' => 'How To Register IN your School ? 

you can register by visit our school or just download our up and send regesteration order for us  with your papers and just pay the cost of  order 1$',
                'created_at' => '2025-09-05 21:08:39',
                'updated_at' => '2025-09-05 21:08:39',
            ),
            1 => 
            array (
                'id' => 2,
                'content_type' => 'Frequently_asked_questions',
                'content' => 'what about the installment system IN your School ? 
we have many installment plan for each education level you surfing it also from our app',
                'created_at' => '2025-09-05 21:10:44',
                'updated_at' => '2025-09-05 21:10:44',
            ),
            2 => 
            array (
                'id' => 3,
                'content_type' => 'Frequently_asked_questions',
                'content' => 'what about the services IN your School ? 
we provides your children with alot of services  and keep the parent in every  events in school that refer to his children like attendance and marks an others...',
                'created_at' => '2025-09-05 21:12:29',
                'updated_at' => '2025-09-05 21:12:29',
            ),
            3 => 
            array (
                'id' => 4,
                'content_type' => 'Frequently_asked_questions',
                'content' => 'do you have transportation service  IN your School ? 
we so sorry for that service we will provide it as soon as we can',
                'created_at' => '2025-09-05 21:13:38',
                'updated_at' => '2025-09-05 21:13:38',
            ),
            4 => 
            array (
                'id' => 5,
                'content_type' => 'vision',
                'content' => 'We aspire to provide a unique educational and pedagogical environment.',
                'created_at' => '2025-09-05 21:15:37',
                'updated_at' => '2025-09-05 21:15:37',
            ),
            5 => 
            array (
                'id' => 6,
                'content_type' => 'vision',
                'content' => 'Graduating students with a high academic level',
                'created_at' => '2025-09-05 21:16:11',
                'updated_at' => '2025-09-05 21:16:11',
            ),
            6 => 
            array (
                'id' => 7,
                'content_type' => 'vision',
                'content' => 'Preparing students not only academically but also socially and psychologically',
                'created_at' => '2025-09-05 21:16:56',
                'updated_at' => '2025-09-05 21:16:56',
            ),
            7 => 
            array (
                'id' => 8,
                'content_type' => 'about',
                'content' => 'school location :
Damascus , Mazeh',
                'created_at' => '2025-09-05 21:18:03',
                'updated_at' => '2025-09-05 21:18:03',
            ),
            8 => 
            array (
                'id' => 9,
                'content_type' => 'about',
                'content' => 'Time are open:
from 8 morning to 5 evening',
                'created_at' => '2025-09-05 21:18:53',
                'updated_at' => '2025-09-05 21:18:53',
            ),
        ));
        
        
    }
}