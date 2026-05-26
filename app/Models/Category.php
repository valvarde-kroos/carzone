<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = ['name', 'slug', 'description'];

    // Auto-generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    // One category has many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
