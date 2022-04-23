<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    
    protected $fillable = [
        'customer_id',
        'orders_note',
    ];
    
    public function cus()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
