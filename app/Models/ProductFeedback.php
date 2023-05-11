<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'product_id',
        'user_id',
    ];

    public function products()
    {
        $this->belongsTo(Product::class, 'product_id');
    }

    public function users()
    {
        $this->belongsTo(User::class);
    }
}
