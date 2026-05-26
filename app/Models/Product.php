<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description',
        'price', 'stock', 'image', 'category_id'
    ];

    // Auto-generate slug before creating
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name) . '-' . time();
        });
    }

    // Product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Product has many cart entries
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Helper: get the full URL of the product image
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/no-image.png');
    }

    // Helper: stock status label
    public function stockStatus()
    {
        if ($this->stock <= 0)  return 'Out of Stock';
        if ($this->stock <= 5)  return 'Low Stock';
        return 'In Stock';
    }

    // Helper: stock badge color class
    public function stockColor()
    {
        if ($this->stock <= 0)  return 'bg-red-100 text-red-700';
        if ($this->stock <= 5)  return 'bg-yellow-100 text-yellow-700';
        return 'bg-green-100 text-green-700';
    }
}
