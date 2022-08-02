<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'email',
        'phone',
        'image',
        'website',
        'address',
        'position',
        'is_active',
    ];
}
