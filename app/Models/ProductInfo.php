<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory;

    protected $table = 'products_info'; // Nome exato da tabela no banco de dados

    protected $fillable =
    [
        'payment',
        'delivery',
        'user_id',
    ];
       /**
     * Relacionamento com o modelo User.
     */
    public function user()
     {
        return $this->belongsTo(user::class);
     }
}
