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

            $additional = Additional::all();

            $productCount = Order_product::where('user_id', $users)
                  ->whereHas('user', function ($query) {
                        $query->where('access_level', '<>', 'admin');
                  })
                  ->count();


            $product = Product::where('category_id', 1)->where('status', 0)->get();
            $productBeer = Product::where('category_id', 2)->where('status', 0)->get();
            $productCombo = Product::where('category_id', 3)->where('status', 0)->get();
            $productBomboniere = Product::where('category_id', 4)->where('status', 0)->get();
            $productPromo = Product::where('category_id', 5)->where('status', 0)->get();



            return view('dashboard', compact (
            'product',
            'additional',
             'order',
             'toggle',
             'productCount',
             'time',
             'productBeer',
             'productCombo',
             'productBomboniere',
             'productPromo'
              ));
      }
      public function toggle(Request $resquest)
      {

            $toggle = Toggle::first();
            $toggle->is_open = !$toggle->is_open;
            $toggle->save();

            return redirect()->back()->with('toggle','Modo de abertura e fechamento alterado com sucesso');
      }
}
