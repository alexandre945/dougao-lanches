<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderList;
use App\Models\Order_product;
use App\Models\LoyaltyPoint;
use App\Models\blind;
use App\Models\BlindCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class adminController extends Controller
{
  public function store(Request $request)

  {

    $user      = Auth::user();
    $users       = $user->id;
    $product    = Order_product::where('user_id', $users)->get();

    if (Order_product::where('user_id', $users)->exists()) {
    } else {
      return redirect()->back()->with('menssagem', 'Vocẽ presisa relizar uma compra para conseguir enviar um pedido');
    }



    $payment  = $request->payment;
    $selectedCreditCard = $request->input('credit_card');
    $observation = $request->observation;
    $delivery  = $request->delivery;
    $total     = $request->total;
    $user      = Auth::user();
    $users     =$user->id;
    $total      = str_replace(",", ".", $total);
    $product    = Order_product::where('user_id', $users)->get();
    $quantity   = $product[0]->quanty;
    $blindCartIds = $request->input('blindCartId');






    if ( $total < 20.00)
    {
     return redirect()->back()->with('total', 'o valor de sua compra precisa ser maior que 20,00 reais');
    }

    // verificando se usuario tem endereço e depois criando pedido


    if (Address::where('user_id', $users)->exists()) {

      $total = ($delivery == 1 ? ($total + 6) : $total);

      $order = Order::create([
        'observation' => $observation ?? $selectedCreditCard,
        'payment'     =>  $payment,
        'user_id'     => $user->id ?? '',
        'total'       => $total,
        'delivery'    => $delivery,
        'quantity'    => $quantity ?? 0,
      ]);



      $orderId = $order->id;

      // criando itens do pedido

      foreach ($product as $item) {

        $orderlist = OrderList::create([
          'blind_carts_id'=> $blindCartIds  ?? null,
          'order_id'      => $orderId,
          'product_id'    => $item->product_id ?? '',
          'observation'   => $item->observation,
          'quamtity'      => $item->quanty ?? 0,
          'value'         => $item->price ?? 0
        ]);

        $orderlist->orderAdditional()->attach($item->orderProductAdditional);

      }

       //buscar todos os pedidos do usuario e somar

      $orderPoints = Order::where('user_id', $users)->get();


      $totalOrderAmount = 0;

      foreach ($orderPoints as $order) {
        $totalOrderAmount += $order->total;

      }
          //buscar todos os blindes que o usuario já resgatou



         //transformando total gasto em pontos

      $totalPointsEarned = floor($totalOrderAmount / 50) * 5;



      $totalBlindPointsCart  = BlindCart::where('user_id', $users)->sum('points');

      $totalBlindPointsDirect = blind::where('user_id', $users)->sum('points');

      // Somar pontos dos dois tipos de resgate
      $totalBlindPoints = $totalBlindPointsCart + $totalBlindPointsDirect;

      //subtrair pontos resgatados do total de pontos
      $totalPointsEarned -= $totalBlindPoints;





         //se existir pontos na tabela faz opdate no numero de pontos se não cria

      LoyaltyPoint::updateOrCreate(
          ['user_id' => $users],
          ['points_earned' =>   $totalPointsEarned ?? '']
      );




      $product = Order_product::where('user_id', $users)->delete();


      return redirect()->back()->with('sucessesmessagem', 'pedido enviado com sucesso');
    } else {
      return redirect()->back()->with('menssagem', 'Vocẽ presisa cadastrar um endereço');
    }
  }


  public function index(Request $request)

      {

        $user      = Auth::user();
        $userId     = $user->id ?? '';

        $date = now()->format('d/m/y H:i:s');

        $orders = Order::orderBY('id', 'desc')
          ->with('orderUser', 'orderlist', 'orderAdditional')
          ->where('status', 'processando')
          ->get();

          $lists = OrderList::with('blindCart')->get();

        return view('cart.order', compact('date', 'userId', 'orders', 'lists'));
      }

  public function update(Request $request, $id)

      {
        $order = Order::findOrFail($id);

        $order->update(['status' => ('aceito')]);

        // $blindCartId = BlindCart::findOrFail($blindCartId);

        // $blindCartId->update(['status' => ('impresso')]);


        return redirect()->back();
      }
}
