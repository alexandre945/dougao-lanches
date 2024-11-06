<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class StatusDeniedController extends Controller
{
    public function show()
      {
        $orders = Order::orderBY('id', 'desc')->with('orderUser')->where('status', 'Recusado')->simplepaginate(5);

        return view('status.denied',compact('orders'));
      }
}
