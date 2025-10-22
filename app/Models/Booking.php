<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'order_id',
        'product_id',
        'seller_id',
        'user_id',
        'check_in',
        'quantity',
        'refund_status',
        'refund_details',
        'check_out',
        'check_in_image',
        'checkout_image',
        'phone',
        'name',
        'address_1',
        'address_2',
        'pincode',
        'verify',
        'payment_verify',
        'booking_status_user',
        'owner_status',
        'owner_accept_images',
        'booking_status',
        'checkout_payment_id', 
        'checkout_amount',     
        'discount',     
        'securityamount',     
    ];

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}