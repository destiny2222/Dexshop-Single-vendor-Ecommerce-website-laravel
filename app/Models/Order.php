<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'lastname',
        'email',
        'phone_number',
        'address',
        'shipping_fee',
        'subtotal',
        'total',
        'reference',
        'status',
        'city',
        'country',
        'payment_date'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function totals(){
        return $this->items->price - $this->discount + $this->shippingFee;
    }
}
