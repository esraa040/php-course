<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order_Item;
use App\Models\Payment;
class Order extends Model
{
    protected $fillable = ["user_id"];

    //

    function user()
    {
        return $this->belongsTo(User::class);
    }
    function category()
    {
        return $this->belongsTo(Category::class);
    }
    function products()
    {
        return $this->hasMany(Product::class);
    }
    function order_items()
    {
        return $this->hasMany(Order_Item::class);
    }
    function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
