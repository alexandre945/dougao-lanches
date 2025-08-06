<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

   protected $fillable = ['name',
   'price',
   'quanty',
   'description',
   'category_id',
   'photo'
];

    public function category_product(){
        return $this->hasOne(Category::class, 'category_id', 'id');
    }
        public function additionals()
    {
        return $this->belongsToMany(Additional::class, 'manual_product_additionals', 'product_id', 'additional_id')
                    ->withPivot('quantity');
    }
    public function cart()
    {  
    return $this->belongsTo(ManualAdminCart::class);
    }

}
