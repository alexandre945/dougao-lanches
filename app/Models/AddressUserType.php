<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressUserType extends Model
{

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function addressType()
    {
        return $this->belongsTo(AddressType::class, 'address_type_id');
    }

    public function orderlist()
    {
        return $this->hasMany(OrderList::class);
    }


}
