<?php

namespace Database\Seeders;

use App\Models\Class_room;
use Illuminate\Database\Seeder;

class ClassRoomsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Class_room::factory()->count(20)->create();
    }
}
