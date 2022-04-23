<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
  use HasFactory;

  public $table = 'products';

  public static function getProducts($searchProduct)
  {
    $dataProduct = DB::table('products');
    //self::select("*");
    if ($searchProduct != "") {
      $dataProduct->where('name', 'like', '%' . $searchProduct["key"] . '%');
    }
    return $dataProduct->paginate(config("constant.paginate"));
  }

  public function category()
  {
      return $this->belongsTo(Category::class,'categories_id','id');

  }
}
