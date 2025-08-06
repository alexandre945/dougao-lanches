<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Models\ProductInfo;
use App\Models\Order_product;
use app\Models\WaitingTime;
use Illuminate\Support\Facades\Auth;
use App\Models\Toggle;
use App\Models\ManualAdminCart;
use App\Models\ManualProductAdditional;
use App\Models\Additional;



class ManualOrderController extends Controller
{
    public function create()
    {
          $user      = Auth::user();
            $users     = $user->id;

            $order = Order::where('user_id', $users)->latest()->first();

            $toggle = Toggle::first();

            $additional = Additional::all();

            // $productCount = Order_product::where('user_id', $users)->with('orderProductProduct')->count();

            $product = Product::where('category_id', 1)->where('status', 0)->get();
            $productBeer = Product::where('category_id', 2)->where('status', 0)->get();
            $productCombo = Product::where('category_id', 3)->where('status', 0)->get();
            $productBomboniere = Product::where('category_id', 4)->where('status', 0)->get();
            $productPromo = Product::where('category_id', 5)->where('status', 0)->get();
            $productCount = Order_product::where('user_id', $users)->with('orderProductProduct')->count();

        return view('admin.manual-order-create',
        compact
        (    'product',
            'additional',
             'order',
             'productBeer',
             'productCombo',
             'productBomboniere',
             'productPromo',
             'productCount'
    ));

    }

   public function store(Request $request)
{
  
}



    public function index(Request $request)
    {
      
     $user = Auth::user();
     $users = $user->id ?? '';
        // Recuperar os itens do carrinho do usuário
        $cart = Order_product::where('user_id', $users)
            ->with([
                'orderProductAdditional' => function ($query) {
                    $query->withPivot('quantity');
                },
                'orderProductProduct',
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

        // Retornar a view com os dados necessários
 
      return view('admin.index-manual', compact(
            'cart',
            'total',
            'users',
            'additionalOrderProducts',
            'orderId',
            'productInfo',
            'total',
            
    ));
    }

    public function destroy(Request $request, $id)
    {
        $product = Order_product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success','produto excluido com sucesso!');
    }    

    public function updatePayment(Request $request)
     {
         
    $newPaymentValue = $request-> payment == 1 ? 0 : 1;

    // Busca o primeiro registro
    $payment = ManualAdminCart::first(); // Corrigido para 'first()'

    // Verifica se um registro foi encontrado antes de tentar atualizar
    if ($payment) {
        // Atualiza o tipo de pagamento
        $payment->payment_type = $newPaymentValue;
        $payment->save();

        // Redireciona com a mensagem de sucesso
        return redirect()->back()->with('success', 'Modo de pagamento ajustado com sucesso!');
    }

    // Se não encontrou um registro, pode retornar uma mensagem de erro
    return redirect()->back()->with('error', 'Nenhum registro encontrado para atualizar.');

     }

     public function updateDelivery(Request $request)
       {
         // Validação dos dados recebidos
    $validatedData = $request->validate([
        'delivery' => 'required|in:0,1',
    ]);

    // Busca o primeiro registro
    $productInfo = ManualAdminCart::first(); // Corrigido para 'first()'

    // Verifica se um registro foi encontrado antes de tentar atualizar
    if ($productInfo) {
        $newDeliveryValue = $validatedData['delivery']; // Valor validado direto do formulário
        
        // Atualiza o tipo de entrega
        $productInfo->delivery_type = $newDeliveryValue;

        // Salva as mudanças na ProductInfo
        $productInfo->save(); 
        
        // Redireciona com a mensagem de sucesso
        return redirect()->back()->with('success', 'Forma de entrega atualizada com sucesso!');
    }

    // Se não encontrou um registro, retorna uma mensagem de erro
    return redirect()->back()->with('error', 'Nenhum registro de produto encontrado para atualizar.');
}

       
}
