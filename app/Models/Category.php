<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'parent_id',
        'position',
        'is_active',
        'types',
        ];
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
