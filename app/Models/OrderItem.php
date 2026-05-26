<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price'
    ];

    // This item belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // This item refers to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Subtotal for this line item
    public function subtotal()
    {
        return $this->price * $this->quantity;
    }
}
