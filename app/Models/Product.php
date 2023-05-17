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
        'sold',
        'is_featured',
        'badge',
        'keyfeature',
        'specification',
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

    public function getRatingPercentage($stars)
    {
        $totalReviews = $this->total_reviews; // Assuming `$total_reviews` is the total number of reviews for the product
        if ($totalReviews > 0) {
            $ratingCount = $this->rating_count($stars); // Assuming `rating_count($stars)` returns the count of reviews with the given number of stars
            $percentage = ($ratingCount / $totalReviews) * 100;
            return round($percentage, 2); // Rounding to 2 decimal places
        }
        return 0;
    }


    public function averageRating()
    {
        $ratings = $this->ratings;

        if ($ratings->isEmpty()) {
            return 0;
        }

        $total = $ratings->sum('rating');
        $count = $ratings->count();

        return round($total / $count, 1);
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
