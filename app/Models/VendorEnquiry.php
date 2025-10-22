<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorEnquiry extends Model
{
    use HasFactory;

    protected $table = 'bulk_enquiries';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address_1',
        'check_in_date',
        'check_out_date',
        'quantity',
        'vendor_id',
    ];

    /**
     * Relationship: Each enquiry belongs to one vendor (user).
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    
}