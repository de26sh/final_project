<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'company_name',
        'email', 'phone', 'country',
        'address_line1', 'address_line2',
        'city', 'state', 'postcode',
        'ship_to_different',
        'shipping_first_name', 'shipping_last_name', 'shipping_company_name',
        'shipping_email', 'shipping_phone', 'shipping_country',
        'shipping_address_line1', 'shipping_address_line2',
        'shipping_city', 'shipping_state', 'shipping_postcode',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
