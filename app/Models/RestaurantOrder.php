<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrder extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function order_products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
