<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasedplans extends Model
{
    use HasFactory;

    protected $table = 'purchasedplans';

    protected $fillable = [
        'user_id',
        'package_id',
        'start_date',
        'end_date',
        'remaining_days',
        'remaining_value',
        'amount_paid',
        'post_quantity ',
        'used_posts',
        'status',
        'notes',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
