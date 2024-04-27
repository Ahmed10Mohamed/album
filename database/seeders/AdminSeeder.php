<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'user_name' => 'admin',
                'phone' => '01149671770',
                'email' => 'info@test.com',
                'password' => bcrypt('123456'),
                'email_verified_at'=>now(),
                'added_by'=>1
            ] ,
            [
                'name' => 'Ahmed M Bakri',
                'user_name' => 'Beko',
                'phone' => '01149671773',
                'email' => 'ahmed.bakri@madar.it',
                'password' => bcrypt('123456'),
                'email_verified_at'=>now(),
                'added_by'=>1
            ],
           



            ]);
    }
}
