<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;
class Category extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ["name", "description"];

 function orders()
 {
    return $this->hasMany(Order::class);
 }
 function products()
 {
    return $this->hasMany(Product::class);
 }



}
