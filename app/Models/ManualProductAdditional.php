<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualProductAdditional extends Model
{
    use HasFactory;
   protected $fillable = 
    [
        'manual_additional_id', 
        'manual_admin_cart_id', 
        'quantity'
    ];
      public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function additional()
    {
        return $this->belongsTo(Additional::class);
    }
     public function cart()
    {
        return $this->belongsTo(ManualAdminCart::class, 'manual_admin_cart_id');
    }

}
