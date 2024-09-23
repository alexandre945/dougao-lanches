<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\AdditionalOrder;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Models\BlindCart;
use App\Models\Order_product;
use App\Models\Product;
use App\Models\AddressType;
use App\Models\AddressUserType;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function PHPSTORM_META\map;

class OrderProductController extends Controller
{
    public function store(Request $request, $id)
    {
         // Simular um atraso de 3 segundos
        //  sleep(5);

        $product = Product::findOrFail($id);
        $products = $product->id;
        $user = auth::user();
        $users = $user->id;
        $price = $product->price;

        $selectedAdditionals = $request->input('additional_ids', []); // IDs dos adicionais
        $additionalQuantities = $request->input('additional_quantities', []); // Quantidades dos adicionais


        // $blindCart = BlindCart::findOrFail($id);
        // $blindCartId = $blindCart->id ?? '';
         // Capturar os IDs e Quantidades

    // dd($selectedAdditionals, $additionalQuantities);
        $cart = Order_product::create([
            'blind_carts_id' => $blindCartId ?? null,
            'product_id' => $products,
            'quanty' => $request->quanty,
            'observation' => $request->observation,
            'user_id' => $users,
            'price' => $price
        ]);

        // $selectedAdditionals = $request->input('additional', []);


        foreach ($selectedAdditionals as $additionalId) {
            // Verificar se existe uma quantidade correspondente para o adicional
            if (isset($additionalQuantities[$additionalId]) && is_numeric($additionalQuantities[$additionalId])) {
                $quantity = (int) $additionalQuantities[$additionalId];
                // Inserir na tabela pivot com a quantidade
                $cart->orderProductAdditional()->attach($additionalId, ['quantity' => $quantity]);
            } else {
                // Inserir na tabela pivot com a quantidade padrão de 1
                $cart->orderProductAdditional()->attach($additionalId, ['quantity' => 1]);
            }
        }



        $cart = Order_product::where('user_id', $users)
            ->with('orderProductProduct', 'orderProductAdditional', 'blindCart')
            ->get();
        $blindCart = BlindCart::where('user_id', $users)->get();

        return redirect()->back()->with('success', 'produto adicionado ao carrinho com sucesso');
    }

    public function storebeer(Request $request, $id)

    {
        $product = Product::findOrFail($id);
        $user = auth::user();
        $users = $user->id;
        $products = $product->id;
        $price =  $product->price;

        $cart = Order_product::create([
            'product_id' => $products,
            'quanty' => $request->quanty,
            'user_id' => $users,
            'price'   => $price ?? 0,
        ]);

        return view('cart.index', compact('cart', 'user'));
    }

    public function show(Request $request)
    {
        $product = Product::all();
        $user = Auth::user();
        $users = $user->id ?? '';

        $address = Address::where('user_id', $users)->with('userAdress')->latest()->first();


        $addressTypes = AddressType::all();

        $addressUserTypes = AddressUserType::where('user_id', $users)->with('addressType')->get();


        $cart = Order_product::where('user_id', $users)
        ->with([
            'orderProductAdditional' => function ($query) {
                $query->withPivot('quantity'); // Certifica-se de que a quantidade está sendo carregada
            },
            'orderProductProduct',
            'blindCart'
        ])->get();



    // Verifique se há produtos no carrinho

        if ($cart->isNotEmpty()) {
            $orderId = $cart[0]->id;

            // Recuperar os dados diretamente da tabela additional_order_products

            $additionalOrderProducts = DB::table('additional_order_products')
                ->where('order_product_id', $orderId)
                ->get();
        } else {
            $additionalOrderProducts = collect(); // Coleção vazia se o carrinho estiver vazio
        }

        $total = 0;

        $cart->each(function ($item) use (&$total) {
            // Calcula o total para o produto principal
            $total += ($item->orderProductProduct ? $item->orderProductProduct->price : 0) * $item->quanty;

            if ($item->orderProductAdditional) {
                // Itera sobre os adicionais
                $item->orderProductAdditional->each(function ($additional) use (&$total) {
                    // Obtém a quantidade do adicional da tabela pivot
                    $quantity = $additional->pivot->quantity ?? 1;
                    // Calcula o total do adicional multiplicando o preço pela quantidade
                    $total += $additional->price * $quantity;
                });
            }
        });
            $orderId = null;
        //  verificando se o usuario tem pedidos pegar o ultimo

         $lastOrder = Order::where('user_id', $users )->latest()->first();
         if ($lastOrder) {
            $orderId = $lastOrder->id;

        }

        $reviews = Review::with('user')->orderby('created_at', 'desc')->take(3)->get();

        return view('cart.index', compact('cart', 'address', 'total', 'users', 'addressTypes', 'addressUserTypes', 'additionalOrderProducts', 'orderId', 'reviews'));
    }

    public function delete(Request $request, $id)
    {
        $product = Order_product::findOrFail($id);
        $product->delete();
        return redirect()->route('cart.show')->with('delete', 'produto excluido');
    }
}
