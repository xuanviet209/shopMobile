<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer')->insert([
            'name'=> 'viet',
            'password'=>'123456',
            'email'=>'vietd8k11@gmail.com',
            'phone'=> '0327769339',
            'remember_token'=> '123456789',
            'address'=> 'Hà Nội',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>null
        ]);
    }
}
