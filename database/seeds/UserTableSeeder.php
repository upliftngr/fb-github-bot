<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
                [
                    [
                        'name' => 'Light Chinaka',
                        'email' => 'admin@gmail.com',
                        'password' => bcrypt('secret'),
                        'level' => 1,
                        'status' => 1,
                        'remember_token' => NULL,
                        'created_at' => date('Y-m-d H:m:s'),
                        'updated_at' => date('Y-m-d H:m:s')
                    ],
                    [
                        'name' => 'Abubakar Ango',
                        'password' => bcrypt('secret'),
                        'email'=> 'admin2@gmail.com',
                        'level' => 1,
                        'status' => 1,
                        'remember_token' => NULL,
                        'created_at' => date('Y-m-d H:m:s'),
                        'updated_at' => date('Y-m-d H:m:s')
                    ]
                ]
            );
    }
}
