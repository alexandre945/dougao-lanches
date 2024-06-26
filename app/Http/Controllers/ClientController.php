<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Additional;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Toggle;
use App\Models\WaitingTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
      public function index(Request $request)
      {
            $user      = Auth::user();
            $users     = $user->id;

            $order = Order::where('user_id', $users)->latest()->first();

            $toggle = Toggle::first();

            $time = WaitingTime::latest()->first();

            $adde = Additional::all();

            $productCount = Order_product::where('user_id', $users)->with('orderProductProduct')->count();

            $product = Product::where('category_id', 1)->where('status', 0)->simplePaginate(10);



            return view('dashboard', compact('product', 'adde',  'order', 'toggle', 'productCount', 'time'));
      }
      public function toggle(Request $resquest)
      {

            $toggle = Toggle::first();
            $toggle->is_open = !$toggle->is_open;
            $toggle->save();

            return redirect()->back();
      }
}
