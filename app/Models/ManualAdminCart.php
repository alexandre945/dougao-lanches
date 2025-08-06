<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualAdminCart extends Model
{
    use HasFactory;
    
   

    // Se você deseja especificar quais campos podem ser preenchidos em massa
    protected $fillable = [
        'product_id',
        'observation',
        'quantity',
        'unit_price',
        'total',
        'additional_id',
         'delivery_type', 
        'payment_type',  
    ];

    // Método para definir a relação com o modelo Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    // Método para definir a relação com a tabela pivot, se necessário
   public function manualProductAdditionals()
    {
        return $this->belongsToMany(
            ManualProductAdditional::class,  // Classe do modelo relacionado
            'manual_product_additionals',     // Nome da tabela pivô
            'manual_admin_cart_id',           // Nome da coluna que referencia o id do modelo ManualAdminCart
            'manual_additional_id',            // Nome da coluna que referencia o id do modelo ManualProductAdditional
        )->withPivot('quantity');             // Coluna adicional do pivô
    }
   
}
