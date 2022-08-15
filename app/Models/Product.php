<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'stock',
        'price',
        'sale',
        'position',
        'is_acctive',
        'is_hot',
        'views',
        'category_id',
        'url',
        'sku',
        'color',
        'memory',
        'brand_id',
        'vendor_id',
        'summary',
        'description',
        'meta_id',
        'meta_description',
        'user_id',
        ];
        public function category()
        {
            return $this->belongsTo(Category::class, 'category_id', 'id');
        }

        public function brand()
        {
            return $this->belongsTo(Brand::class, 'brand_id', 'id');
        }

        public function vendor()
        {
            return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
        }

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }
}
