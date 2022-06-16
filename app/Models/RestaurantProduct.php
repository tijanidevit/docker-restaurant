<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantProduct extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    protected $guarded = [];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsToThrough(User::class, Restaurant::class);
    }
}
