<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id', 'quantity', 'unit_price',
        'total_price', 'payment_method', 'status', 'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
