<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'parentId'=>0,
            'status'=>1,
            'name'=> 'Áo khoác dày',
            'description'=>'thời trang cho thể thao',
            'avatar'=>null,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=>null
        ]);
    }
}
