<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'discount',
        'status',
        'body',
        'images',
        'SKU',
        'cover_image',
        'subcategory_id',
        'slug',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }


    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }



    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(ProductFeedback::class, 'product_id');
    }

    public function getDiscountPriceAttribute()
    {
        if ($this->discount) {
            return $this->price - ($this->price * $this->discount / 100);
        } else {
            return null;
        }
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugAttribute(): string
    {
        return Str::slug($this->name);
    }

    protected $casts = [
        'images' => 'array'
    ];
}
