<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{

    protected $guarded = [];

     public function orderProductProduct()

       {
        return $this->belongsTo(Product::class,'product_id', 'id');
       }

    public function blindCart()

       {
        return $this->belongsTo(BlindCart::class,'blind_carts_id', 'id');
       }

    public function orderProductAdditional()

        {
            return $this->BelongsToMany(Additional::class, 'additional_order_products', 'order_product_id','additional_id', 'id')->withPivot('quantity');
        }

    public function orderPorductUser()

       {
        return $this->belongsTo(User::class, 'user_id', 'id');
       }
    public function orderBlind()
       {
        return $this->belongsTo(blind::class, 'user_id', 'id');
       }
       public function user() {
    return $this->belongsTo(User::class, 'user_id'); // Certifique-se de que o campo 'user_id' é correto
}
}
