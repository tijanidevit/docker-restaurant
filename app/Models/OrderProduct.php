<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(RestaurantProduct::class);
    }

    public function order()
    {
        return $this->belongsTo(RestaurantOrder::class);
    }
}
