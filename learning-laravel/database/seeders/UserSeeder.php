<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'nxk2009',
            'password'=>'kien@cz',
            'email'=>'xuankien2009@gmail.com',
            'phone'=> '0327769339',
            'email_verified_at'=>date('Y-m-d H:i:s'),
            'remember_token'=> '123456789',
            'fullname'=>'Nguyễn Xuân Kiên',
            'address'=> 'Hà Nội',
            'gender'=> 'Nam',
            'birthday'=> '2009/04/20',
            'avatar'=> '',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>null
        ]);
    }
}
