<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'brands',
        'category',
        'size',
        'large_desc',
        'title',
        'slug',
        'description',
        'price',
        'state',
        'district',
        'area',
        'pincode',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'image7',
        'image8',
        'user_id',
        'is_verify',
        'verify_status',
        'status',
        'model_name',
        'color',
        'other_color',
        'rent',
        'frame_size',
        'frame_no',
        'frame_material',
        'speed',
        'fork',
        'shifters',
        'front_gear',
        'rear_gear',
        'front_derailleur',
        'rear_derailleur',
        'brake',
        'repair_status',
        'service_days_count',
        'last_repair_date',
        'auditor',
        'offer_30',
        'offer_15',
        'offer_7',
        'quantity',
        'mlocation',
        'added_vendor',
        'auditor_id',
    ];


    public function bookings()
{
    return $this->hasMany(Booking::class, 'product_id');
}

public function stateRelation()
{
    return $this->belongsTo(State::class, 'state');
}

public function districtRelation()
{
    return $this->belongsTo(District::class, 'district');
}


public function reviews()
{
    return $this->hasMany(Productreviews::class, 'product_id');
}

}