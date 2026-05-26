<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarCategory extends Model
{

protected $table = 'categoriess';
    protected $fillable = [
        'categoryName',
        'image'
    ];

    public function carPosts()
    {
        return $this->hasMany(CarPost::class, 'car_category_id');
    }
}
