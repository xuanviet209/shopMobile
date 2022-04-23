<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
             'name'=> 'tất',
             'slug'=>'tat-dep',
             'categories_id'=>0,
             'brands_id'=> 3,
             'description'=>'Tất',
             'image'=>'https://giaysecondhand.com/wp-content/uploads/2019/10/tai-sao-goi-la-tat-1024x655.jpg',
             'price'=>10000,
             'quantity'=>1000,
             'status'=>1,
             'created_at'=> date('Y-m-d H:i:s'),
             'updated_at'=>null

        ]);
    }
}
