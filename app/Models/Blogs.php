<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'short_description',
        'slug',
        'image',
        'writer_name',
        'category',
        'description',
        'meta_title',
        'meta_tag',
        'meta_description',
        'status',
    ];


}
