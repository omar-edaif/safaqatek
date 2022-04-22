<?php

namespace App\Models;

use App\Enums\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;
    // Roles
    /**
     * @var string
     */
    const ADMIN = 'admin';

    /**
     * @var string
     */
    const CUSTOMER = 'customer';


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'device_token',
        'role'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function wishlists()
    {
        return $this->belongsToMany(Product::class, UserWishlist::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }
    public function residence()
    {
        return $this->belongsTo(Country::class, 'residence_id');
    }
}
