<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckNewOrderController extends Controller
{
    public function index()
     {
        // Obter o último pedido com status 'processando' e baseado na data de criação
       $latestOrder = Order::where('status', 'processando')->orderBy('created_at', 'desc')->first();

       if ($latestOrder) {
           //Retornar o taimetamp de criação do pedido
           return response()->json(['ultimo_pedido' => $latestOrder->created_at]);
       }
         //se não houver pedido no status processando retorna null
         return response()->json(['ultimo_pedido' => null]);
     }
}
