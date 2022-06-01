<?php

namespace App\Models;

use App\Enums\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable, SoftDeletes;
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
        'allow_notifications' => 'boolean'
    ];



    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all purchases of the User
     *
     *
     */
    public function purchases()
    {
        return $this->hasManyThrough(OrderProduct::class, Order::class);
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
    /**
     * Get all of the notifications for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
