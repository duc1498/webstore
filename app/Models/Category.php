<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id',
        'position',
        'is_active',
        ];
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
