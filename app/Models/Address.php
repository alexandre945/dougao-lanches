<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    // protected $filable = ['city','district','street','number','zipcode','complement','user_id'];
    protected $guarded = [];

    public function usersAddresstype()
        {
            return $this->belongsToMany(User::class, 'address_user_types')
                        ->withPivot('address_type_id')
                        ->withTimestamps();
        }

    public function userAdress()

      {
        return $this->belongsTo(User::class, 'user_id', 'id');
      }

      public function addressUserTypes()
      {
          return $this->hasMany(AddressUserType::class);
      }


}
