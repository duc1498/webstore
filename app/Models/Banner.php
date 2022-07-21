<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'image',
        'target',
        'description',
        'type',
        'position',
        'is_active',
        'url',
    ];
}
