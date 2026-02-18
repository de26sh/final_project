<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'family_id',
        'name',
        'price',
        'short_description',
        'long_description',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(\App\Models\SubCategory::class, 'sub_category_id');
    }

    public function family()
    {
        return $this->belongsTo(\App\Models\Family::class);
    }

    public function images()
    {
        return $this->hasMany(\App\Models\ProductImage::class);
    }
}
