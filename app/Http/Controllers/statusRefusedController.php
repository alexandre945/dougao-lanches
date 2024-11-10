<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class statusRefusedController extends Controller
{
     public function update(Request $request, $id)
     {
          $order = Order::findOrFail($id);

                    // Verifica explicitamente se custom_rejection_reason está preenchido
            if ($request->filled('custom_rejection_reason')) {
                $rejectionReason = $request->input('custom_rejection_reason');
            } else {
                $rejectionReason = $request->input('rejection_reason');
            }

          $order->update([
            'status' => 'recusado',
            'rejection_reason' => $rejectionReason
        ]);


          return redirect()->back()->with('refused', 'você recusou este pedido');
     }
}
