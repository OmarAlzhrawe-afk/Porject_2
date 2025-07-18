<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Models\User;

class SupervisorTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('supervisors')->insert([
            'id' => 1,
            'user_id' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
