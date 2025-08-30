<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => '016d6fce-dddc-4b91-81a2-c616f742e388',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 11,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:47:39.263929Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:47:39',
                'updated_at' => '2025-08-30 19:47:39',
            ),
            1 => 
            array (
                'id' => '07b07146-dca4-43c8-b483-6c7a737fd965',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 9,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:47:01.296962Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:47:01',
                'updated_at' => '2025-08-30 19:47:01',
            ),
            2 => 
            array (
                'id' => '08552d44-a067-43ba-9440-7e8d098869a4',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 7,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:46:51.913626Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:46:51',
                'updated_at' => '2025-08-30 19:46:51',
            ),
            3 => 
            array (
                'id' => '31a5ace0-ad9a-45d9-8ad8-66fffc3b10d3',
                'type' => 'App\\Notifications\\NewBookSale',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"type":"New Book Sale Notification","message":null}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:48:17',
                'updated_at' => '2025-08-30 19:48:17',
            ),
            4 => 
            array (
                'id' => '33ae3ede-a794-42be-a8a4-929e9daf5094',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 6,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:46:46.044875Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:46:46',
                'updated_at' => '2025-08-30 19:46:46',
            ),
            5 => 
            array (
                'id' => '3cef84b0-23c2-4afc-b61c-1b6bdf415b0e',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:54:25.311115Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:54:25',
                'updated_at' => '2025-08-30 19:54:25',
            ),
            6 => 
            array (
                'id' => '4cb0f84c-9089-429c-8354-bb4e982ad471',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 5,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:46:40.175629Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:46:40',
                'updated_at' => '2025-08-30 19:46:40',
            ),
            7 => 
            array (
                'id' => '58f89db6-8e1c-43a2-aa26-2340460b2092',
                'type' => 'App\\Notifications\\NewBookSale',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"type":"New Book Sale Notification","message":null}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:48:27',
                'updated_at' => '2025-08-30 19:48:27',
            ),
            8 => 
            array (
                'id' => '6d56f030-072d-4e20-a855-58d6f1b20037',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 8,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:46:55.599388Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:46:55',
                'updated_at' => '2025-08-30 19:46:55',
            ),
            9 => 
            array (
                'id' => '721e5b18-ee0f-4410-827d-d3a3b3ad6d77',
                'type' => 'App\\Notifications\\NewBookSale',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"type":"New Book Sale Notification","message":null}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:48:02',
                'updated_at' => '2025-08-30 19:48:02',
            ),
            10 => 
            array (
                'id' => '73f819dc-5b1e-4879-a2e1-cdd3d6443059',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:55:19.628773Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:55:19',
                'updated_at' => '2025-08-30 19:55:19',
            ),
            11 => 
            array (
                'id' => '79802179-a0e0-4fd1-9a10-1fd7071b8f65',
                'type' => 'App\\Notifications\\NewBookSale',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"type":"New Book Sale Notification","message":null}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:48:34',
                'updated_at' => '2025-08-30 19:48:34',
            ),
            12 => 
            array (
                'id' => '8bc5ae62-9dc9-4dfc-ab38-dc6fde500f8a',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:49:29.498740Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:49:29',
                'updated_at' => '2025-08-30 19:49:29',
            ),
            13 => 
            array (
                'id' => '8cd97521-77d4-4ef9-9f22-96fdabd2ecbd',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 12,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:47:32.123790Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:47:32',
                'updated_at' => '2025-08-30 19:47:32',
            ),
            14 => 
            array (
                'id' => 'a1f86900-32b9-4f4c-aa2d-4abccd6f5aa2',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:57:05.494138Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:57:05',
                'updated_at' => '2025-08-30 19:57:05',
            ),
            15 => 
            array (
                'id' => 'a684a404-4057-4005-8794-ff71de16b4ba',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:47:05.888316Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:47:05',
                'updated_at' => '2025-08-30 19:47:05',
            ),
            16 => 
            array (
                'id' => 'b99bd9bf-003f-48b1-8231-ddeceb2242ae',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 4,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:46:30.923459Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:46:31',
                'updated_at' => '2025-08-30 19:46:31',
            ),
            17 => 
            array (
                'id' => 'bef3bd12-c753-4cc0-87a1-d5491bfcc52d',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 11,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:47:10.481700Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:47:10',
                'updated_at' => '2025-08-30 19:47:10',
            ),
            18 => 
            array (
                'id' => 'cc8ad186-3255-4095-acc6-47b6be0f0264',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:53:56.508187Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:53:56',
                'updated_at' => '2025-08-30 19:53:56',
            ),
            19 => 
            array (
                'id' => 'cdec122b-184c-4bd0-b0de-2cfb829d67ee',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:49:14.677337Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:49:14',
                'updated_at' => '2025-08-30 19:49:14',
            ),
            20 => 
            array (
                'id' => 'ce35f9e3-066d-4915-97f9-5218a803d8cf',
                'type' => 'App\\Notifications\\NewBookSale',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"type":"New Book Sale Notification","message":null}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:48:11',
                'updated_at' => '2025-08-30 19:48:11',
            ),
            21 => 
            array (
                'id' => 'd03ed084-a947-4d1d-978c-51bacbb51d82',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 10,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:47:45.324539Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:47:45',
                'updated_at' => '2025-08-30 19:47:45',
            ),
            22 => 
            array (
                'id' => 'd893cd87-e6e2-4efa-afaa-21f1e099498d',
                'type' => 'App\\Notifications\\NewBookSale',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"type":"New Book Sale Notification","message":null}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:48:22',
                'updated_at' => '2025-08-30 19:48:22',
            ),
            23 => 
            array (
                'id' => 'e9363658-74d6-41ef-9d3e-a9e548357e33',
                'type' => 'App\\Notifications\\NewBookLoan',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 12,
                'data' => '{"type":"New Book Loan Notification","you Will Return the Book At ":"2025-09-30T16:47:17.772080Z"}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:47:17',
                'updated_at' => '2025-08-30 19:47:17',
            ),
            24 => 
            array (
                'id' => 'fc4443d7-c2fa-4181-a0b7-3e2b7bee046f',
                'type' => 'App\\Notifications\\NewBookSale',
                'notifiable_type' => 'App\\Models\\User',
                'notifiable_id' => 1,
                'data' => '{"type":"New Book Sale Notification","message":null}',
                'read_at' => NULL,
                'created_at' => '2025-08-30 19:48:07',
                'updated_at' => '2025-08-30 19:48:07',
            ),
        ));
        
        
    }
}