<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'user_id',
        'product_id',
    ];

    public function products()
    {
      return  $this->belongsTo(Product::class);
    }

    public function users()
    {
      return  $this->belongsTo(User::class);
    }
}
