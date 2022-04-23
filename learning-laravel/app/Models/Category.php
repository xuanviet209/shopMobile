<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;

  //để khai báo model này sử dụng cho bảng nào
  protected $table = 'categories';

  public static function getCategoryDb($searchCategories)
  {
    $categories = self::select("*");
    if ($searchCategories != "") {
      $categories->where('name', 'like', '%' . $searchCategories["key"] . '%');
    }
    return $categories->paginate(config("constant.paginate"));
  }

  // khai báo khóa chính
  protected $primaryKey = 'id';

  public function products()
  {
    return $this->hasMany(Product::class, 'categories_id', 'id')->orderBy('price', 'ASC');
  }
}
