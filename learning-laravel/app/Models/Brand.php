<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
  use HasFactory;

  protected $table = 'brands';

  public static function getBrandDb($searchData)
  {
    $dataBrands = self::select("*");
    if (!empty($searchData["key"]) && $searchData["selectChoose"] == "name") {
      $dataBrands->where('name', 'like', '%' . $searchData["key"] . '%');
    }
    if (!empty($searchData["key"]) && $searchData["selectChoose"] == "address") {
      $dataBrands->where('address', 'like', '%' . $searchData["key"] . '%');
    }
    return $dataBrands->paginate(config("constant.paginate"));
  }
}
