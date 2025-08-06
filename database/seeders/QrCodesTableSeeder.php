<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QrCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('qr_codes')->delete();
        
        \DB::table('qr_codes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'class_id' => 1,
                'user_id' => 1,
                'expires_at' => '2025-08-13 16:05:26',
                'Unique_code' => '7a51fce0-da26-4fb9-85db-e668218e5828',
                'Code_type' => 'teacher',
                'is_Active' => 1,
                'created_at' => '2025-08-06 16:05:26',
                'updated_at' => '2025-08-06 16:05:26',
            ),
        ));
        
        
    }
}