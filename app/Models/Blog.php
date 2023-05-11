<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $Fillable = [
        'title',
        'author',
        'category_id',
        'image',
        'slug',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->title);
    }
}
