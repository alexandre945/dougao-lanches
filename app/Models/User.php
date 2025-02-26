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
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'access_level'
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

    public function address()

      {
        return $this->hasMany(Address::class, 'user_id', 'id');
      }

    public function UserOrder()

      {
        return $this->hasMany(Order::class, 'user_id', 'id');
      }

      public function addressUserTypes()

      {
        return $this->belongsToMany(Address::class, 'address_user_types')
        ->withPivot('address_type_id')
        ->withTimestamps();
      }
      public function reviews()
      {
          return $this->hasMany(Review::class);
      }

      public function productsInffo()
       {
        return $this->hasOne(ProductInfo::class);
       }

       public function poitsUser()
         {
            return $this->hasMany(LoyaltyPoint::class);
         }

         public function setAccessLevelAttribute($value)
        {
            $this->attributes['access_level'] = trim($value);
        }


}
