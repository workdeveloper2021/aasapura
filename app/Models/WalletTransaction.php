<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;


    protected $table = 'wallet_transactions';
    
    protected $fillable = [
    'user_id',
    'amount',
    'mode', // credit/debit
    'type', // e.g., checkout_remain_refund
    'reason',
    'booking_id',
    'status',
];


}