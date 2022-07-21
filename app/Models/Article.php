<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
        protected $fillable = [
        'title',
        'slug',
        'image',
        'summary',
        'description',
        'type',
        'position',
        'status',
        'url',
        'category_id',
        'meta_description'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
