<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            'name'=> 'Adidas',
            'address'=> 'USA',
            'description'=> 'thời trang thể thao nổi tiếng',
            'logo'=>'adidas-001.jpg',
            'status'=>1,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>null
        ]);
    }
}
