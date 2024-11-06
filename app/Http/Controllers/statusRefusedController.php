<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class statusRefusedController extends Controller
{
     public function update(Request $request, $id)
     {
          $order = Order::findOrFail($id);
          $order->update([
            'status' => 'recusado',
            'rejection_reason' => $request->input('rejection_reason')
        ]);
      

          return redirect()->back()->with('refused', 'você recusou este pedido');
     }
}
