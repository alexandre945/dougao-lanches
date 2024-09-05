<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{

    use HasFactory;

    protected $fillable = [
        'blind_carts_id',
        'order_id',
        'product_id',
        'quamtity',
        'value',
        'additional_id',
        'observation',
        'address_user_types_id'

    ];

    public function order()
         {
            return $this->belongsTo(Order::class);
         }


     public function product()
         {
            return $this->belongsTo( Product::class);
         }

    public function blindCart()
         {
            return $this->belongsTo( BlindCart::class, 'blind_carts_id', 'id');
         }


     public function orderAdditional()
         {
            return $this->belongsToMany(Additional::class,
             'additional_orders',
              'order_id',
              'additional_id',
              'id')->withPivot('quantity');
         }

    public function addressUserType()
         {
             return $this->belongsTo(AddressUserType::class, 'address_user_types_id');
         }

    public function addressType()
     {
        return $this->belongsTo(AddressType::class,'address_type_id');
     }

     public function address()
     {
         return $this->belongsTo(Address::class);
     }

}
