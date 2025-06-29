<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_name',
        'phone',
        'order_type',
        'street',
        'district',
        'number',
        'reference',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'observation',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function additionals()
    {
        return $this->belongsToMany(Additional::class, 'manual_cart_additionals')
                    ->withPivot('quantity', 'unit_price', 'total_price');
    }

}
