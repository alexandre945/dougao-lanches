<?php

namespace App\Http\Controllers;

use App\Models\BlindCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoyaltyPoint;
use App\Models\Order_product;
use App\Models\Order;

class BlindCartController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        $users = Auth::user()->id;
        $name = $request->name;
        $points = $request->points;
        $blindCartId = $request->id;

            // Verificar se o usuário tem itens no carrinho
        $cartItems = Order_product::where('user_id', $users)->count();

        if ($cartItems == 0) {
            return redirect()->back()->with('emptyCart', 'Você precisa adicionar itens ao carrinho antes de resgatar um brinde.');
        }


        $totalPointsEarned = 0;


        $loyaut = LoyaltyPoint::where('user_id', $users)->first();

        if (!$loyaut || $loyaut->points_earned < $points) {
            return redirect()->back()->with('denied', 'Você não possui pontos suficientes para resgatar este brinde');
        }


        $blind = BlindCart::create([
            'user_id' => $users,
            'name'  => $name,
            'points' => $points,
            ]);

          $blindCartId = $blind->id;

            $cart = Order_product::create([
                'blind_carts_id' => $blindCartId,
                'product_id' => $products ?? 0,
                'quanty' => $request->quanty ?? 0,
                'observation' => $request->observation ?? '',
                'user_id' => $users,
                'price' => $price ?? 0

            ]);

                return redirect()->back()->with('remuve', 'Seu Blinde foi solicitado com sucesso confira no seu carrinho!');
    }


}
