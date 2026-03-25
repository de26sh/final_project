<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'product_id',
        'customer_id',
        'quantity',
        'unit_price',
        'total_price',
        'payment_method',
        'status',
        'notes',
        'razorpay_order_id',
        'payment_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Generate unique order number like ORD-2026-48291
    public static function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . date('Y') . '-' . random_int(10000, 99999);
        } while (self::where('order_number', $number)->exists());

        return $number;
    }
}