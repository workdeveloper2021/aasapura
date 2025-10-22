<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRating extends Model
{
    use HasFactory;

      protected $fillable = [
        'product_id',
        'user_id',
        'order_id',
        'rating',
        'feedback',
        'vendor_id',
    ];

     protected $table = 'customer_ratings';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Booking::class, 'order_id');
    }

    
}