<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Allowed statuses for an order
    const STATUSES = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

    protected $fillable = [
        'user_id', 'total_price', 'status',
        'address', 'phone'
    ];

    // Order belongs to a user (customer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order has many items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper: badge color for status
    public function statusColor()
    {
        return match($this->status) {
            'pending'    => 'bg-yellow-100 text-yellow-700',
            'processing' => 'bg-blue-100 text-blue-700',
            'shipped'    => 'bg-indigo-100 text-indigo-700',
            'delivered'  => 'bg-green-100 text-green-700',
            'cancelled'  => 'bg-red-100 text-red-700',
            default      => 'bg-gray-100 text-gray-700',
        };
    }
}
