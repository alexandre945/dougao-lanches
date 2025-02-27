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
use App\Models\LoyaltyPoint;
use App\Models\Point;
use App\Models\ProductInfo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function PHPSTORM_META\map;

class OrderProductController extends Controller
{
    public function store(Request $request, $id)
    {
         // Simular um atraso de 3 segundos
        //  sleep(5);
        $product = Product::findOrFail($id);
        $user = auth::user();
        $users = auth::id();

        $productInfo = ProductInfo::where('user_id', $user->id)->first();

        if (!$productInfo) {
            $productInfo = new ProductInfo(['user_id' => $user->id, 'payment' => 0, 'delivery' => 0]);
            $productInfo->save();
        }

        $selectedAdditionals = $request->input('additional_ids', []);
        $additionalQuantities = $request->input('additional_quantities', []);

        $quantity = $request->quanty;
        $total = $product->price * $quantity;

          // Verifica se já há produtos no carrinho do usuário
        $cartItemCount = Order_product::where('user_id', $user->id)->count();

        $deliveryFee = 7;
         $applyDeliveryFee = ($cartItemCount == 0 && $productInfo->delivery == 1); // Só aplica a taxa no primeiro item

        foreach ($selectedAdditionals as $additionalId) {
            $additional = Additional::find($additionalId);
            $additionalQuantity = $additionalQuantities[$additionalId] ?? 1;
            if ($additional) {
                $total += $additional->price * $additionalQuantity;
            }
        }

        // *** Lógica da taxa de entrega MOVIDA PARA CÁ ***
        $deliveryFee = 7;

        if ($applyDeliveryFee) {
            $total += $deliveryFee;
        }


        $cart = Order_product::create([
            'blind_carts_id' => $blindCartId ?? null,
            'product_id' => $product->id, // Use $product->id aqui
            'quanty' => $request->quanty,
            'observation' => $request->observation,
            'user_id' => $user->id, // Use $user->id aqui
            'price' => $product->price, // Use $product->price aqui
            'total' => $total, // O total já inclui a taxa, se aplicável
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
        $user = Auth::user();
        $users = $user->id ?? '';

        // Endereço do usuário
        $address = Address::where('user_id', $users)->with('userAdress')->latest()->first();

        // Tipos de endereço e associações do usuário
        $addressTypes = AddressType::all();
        $addressUserTypes = AddressUserType::where('user_id', $users)->with('addressType')->get();

        // Recuperar os itens do carrinho do usuário
        $cart = Order_product::where('user_id', $users)
            ->with([
                'orderProductAdditional' => function ($query) {
                    $query->withPivot('quantity');
                },
                'orderProductProduct',
                'blindCart',
            ])
            ->get();

        // Calcular o total somando os valores do campo 'total'
        $total = $cart->sum('total');

        // Pegar os dados da tabela `products_infos`
        $productInfo = ProductInfo::where('user_id', $users)->first();

        // Verificar se há produtos no carrinho e pegar adicionais, se necessário
        $additionalOrderProducts = $cart->isNotEmpty()
            ? DB::table('additional_order_products')
                ->whereIn('order_product_id', $cart->pluck('id'))
                ->get()
            : collect();

        // Verificar se o usuário tem pedidos e pegar o último
        $lastOrder = Order::where('user_id', $users)->latest()->first();
        $orderId = $lastOrder->id ?? null;

        // Pegar os pontos de fidelidade do usuário
        $points = LoyaltyPoint::where('user_id', $users)->get();
        $point = Point::all();

        // Pegar as últimas avaliações
        $reviews = Review::with('user','response','admin')->orderby('created_at', 'desc')->take(3)->get();

        // Retornar a view com os dados necessários
        return view('cart.index', compact(
            'cart',
            'address',
            'total',
            'users',
            'addressTypes',
            'addressUserTypes',
            'additionalOrderProducts',
            'orderId',
            'reviews',
            'points',
            'point',
            'productInfo',
            'total'
        ));
    }



    public function delete(Request $request, $id)
    {
        $product = Order_product::findOrFail($id);
        $product->delete();
        return redirect()->route('cart.show')->with('delete', 'produto excluido');
    }

    public function updatepayment(Request $request)
    {
        // Validar os dados recebidos
        $request->validate([
            'payment' => 'required|in:0,1',
        ]);

        $userId = Auth::id();

        // Buscar o registro correspondente no banco de dados
        $productInfo = ProductInfo::where('user_id', $userId)->first();

        if (!$productInfo) {
            return redirect()->back()->withErrors('Informações do produto não encontradas.');
        }

        // Alternar o valor de pagamento
        $newPaymentValue = $request->payment == 1 ? 0 : 1;

        // Atualizar no banco de dados
        $productInfo->payment = $newPaymentValue;
        $productInfo->save();

        // Redirecionar com mensagem de sucesso
        return redirect()->back()->with('success', 'Forma de pagamento atualizada com sucesso!');
    }

    public function updateDelivery(Request $request)
    {
        $request->validate([
            'delivery' => 'required|in:0,1',
        ]);

        $userId = Auth::id();
        $productInfo = ProductInfo::where('user_id', $userId)->first();

        if (!$productInfo) {
            return redirect()->back()->withErrors('Informações do produto não encontradas.');
        }

        $newDeliveryValue = $request->delivery; // Valor diretamente do formulário

        // Atualizar o total na tabela Order_product
        $orderProduct = Order_product::where('user_id', $userId)->first();

        if ($orderProduct) {
            $deliveryFee = 7;

            // Lógica de atualização do total
            if ($newDeliveryValue == 1 && $productInfo->delivery == 0) {
                // Adicionar taxa se delivery mudou de 0 para 1
                $orderProduct->total += $deliveryFee;
            } elseif ($newDeliveryValue == 0 && $productInfo->delivery == 1) {
                // Remover taxa se delivery mudou de 1 para 0
                $orderProduct->total -= $deliveryFee;
            }

            $orderProduct->save();
        }

        $productInfo->delivery = $newDeliveryValue;
        $productInfo->save();

        return redirect()->back()->with('success', 'Forma de entrega atualizada com sucesso!');
    }

}
