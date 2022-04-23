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
        // add du lieu mau vao bang admins
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => '123456789',
            'role' => -1,
            'email' => 'admin@gmail.com',
            'fullname' => 'Nguyen Xuan Viet',
            'phone' => '0971046025',
            'address' => 'Ha Noi',
            'birthday' => '1999-04-12',
            'avatar' => null,
            'status' => 1,
            'gender' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);
    }
}