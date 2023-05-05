<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'quantity',
        'product_id',
        'price',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function subtotal()
    {
        return $this->quantity * $this->price;
    }

    // public function calculateSubtotal()
    // {
    //     $this->subtotal = $this->quantity * $this->price;
    //     $this->save();
    // }


}

