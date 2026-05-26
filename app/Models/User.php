<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // A user has many car posts (existing feature)
    public function carPosts()
    {
        return $this->hasMany(CarPost::class);
    }

    // A user has many likes (existing feature)
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // E-commerce: user has many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // E-commerce: user has many cart items
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Check if this user is an admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
