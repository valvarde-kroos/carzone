<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'car_post_id'
    ];//

        // A like belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A like belongs to a car post
    public function carPost()
    {
        return $this->belongsTo(CarPost::class);
    }
}
