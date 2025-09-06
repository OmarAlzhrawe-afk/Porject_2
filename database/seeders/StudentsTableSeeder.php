<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('students')->delete();

        DB::table('students')->insert(array(
            0 =>
            array(
                'id' => 1,
                'user_id' => 17,
                'class_id' => 1,
                'parent_id' => 14,
                'Student_number' => '1001',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-06 00:00:33',
                'updated_at' => '2025-09-06 00:00:33',
            ),
            1 =>
            array(
                'id' => 2,
                'user_id' => 19,
                'class_id' => 2,
                'parent_id' => 14,
                'Student_number' => '1002',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-06 00:01:34',
                'updated_at' => '2025-09-06 00:01:34',
            ),
            2 =>
            array(
                'id' => 3,
                'user_id' => 21,
                'class_id' => 3,
                'parent_id' => 14,
                'Student_number' => '1003',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-06 00:02:16',
                'updated_at' => '2025-09-06 00:02:16',
            ),
            3 =>
            array(
                'id' => 4,
                'user_id' => 22,
                'class_id' => 3,
                'parent_id' => 14,
                'Student_number' => '1004',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-06 00:02:35',
                'updated_at' => '2025-09-06 00:02:35',
            ),
            4 =>
            array(
                'id' => 5,
                'user_id' => 23,
                'class_id' => 3,
                'parent_id' => 14,
                'Student_number' => '1005',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-06 00:02:47',
                'updated_at' => '2025-09-06 00:02:47',
            ),
            5 =>
            array(
                'id' => 6,
                'user_id' => 24,
                'class_id' => 4,
                'parent_id' => 14,
                'Student_number' => '1006',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-06 00:03:16',
                'updated_at' => '2025-09-06 00:03:16',
            ),
            6 =>
            array(
                'id' => 7,
                'user_id' => 27,
                'class_id' => 6,
                'parent_id' => 14,
                'Student_number' => '1007',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-06 00:04:22',
                'updated_at' => '2025-09-06 00:04:22',
            ),
            7 =>
            array(
                'id' => 8,
                'user_id' => 33,
                'class_id' => 9,
                'parent_id' => 14,
                'Student_number' => '1008',
                'installment_total_amount' => NULL,
                'installment_count' => NULL,
                'installment_interval_days' => NULL,
                'status' => 'active',
                'created_at' => '2025-09-06 00:06:08',
                'updated_at' => '2025-09-06 00:06:08',
            ),
        ));
    }
}
