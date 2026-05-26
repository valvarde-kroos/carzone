<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarPost extends Model
{
    protected $fillable = [
        'post_title',
        'post_description',
        'image',
        'category_id',
        'user_id'
    ];

    // A post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A post belongs to a category
    public function category()
    {
        return $this->belongsTo(CarCategory::class, 'category_id');
    }

    // A post has many likes
    public function likes()
    {
        return $this->hasMany(Like::class, 'car_post_id');
    }
    // Check if the current user has liked this post
    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // Get the total number of likes
    public function likesCount()
    {
        return $this->likes()->count();
    }
}
