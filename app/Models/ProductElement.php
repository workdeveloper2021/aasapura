<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductElement extends Model
{
    use HasFactory;

     protected $table = 'product_elements';

    protected $fillable = [
        'element_name',
        'element_type',
        'options',
    ];
    
}
