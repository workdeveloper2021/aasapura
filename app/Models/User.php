<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'wallet',
        'email_verify',
        'phone',
        'address_1',
        'address_2',
        'pincode',
        'image',
        'card_details',
        'is_block',
        'owner_image',
        'business_location_image',
        'owner_last_name',
        'owner_first_name',
        'gst_number',
        'is_active',
        'details_verify',
        'current_address',
        'current_address_document',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static public function GetSingleEmail($email){
        return User::where('email', '=', $email)->first();
    }
    static public function GetSingleToken($token){
        return User::where('remember_token', '=', $token)->first();
    }
}