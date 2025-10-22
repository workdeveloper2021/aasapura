<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sitesetting extends Model
{
    use HasFactory;

    protected $table = 'site_setting';

    protected $fillable = [
        'info_first',
        'info_second',
        'image',
        'favicon',
        'image_back',
        'meta_title',
        'meta_tag',
        'meta_description',
    ];


}
