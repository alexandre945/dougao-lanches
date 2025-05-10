<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use App\Models\ProductInfo;
use App\Models\AddressUserType;
use App\Models\OrderList;
use App\Models\Order_product;
use App\Models\LoyaltyPoint;
use App\Models\blind;
use App\Models\BlindCart;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class adminController extends Controller
{
  public function store(Request $request)

        {


            $user      = Auth::user();
            $users       = $user->id;
            $product    = Order_product::where('user_id', $users)->get();

            if (Order_product::where('user_id', $users)->exists()) {
                } else {
                return redirect()->back()->with('menssagem', 'Vocẽ presisa relizar uma compra com valor minimo de R$ 20,00 para conseguir enviar um pedido !');
                }



            $payment  = $request->payment;
            $selectedCreditCard = $request->input('credit_card');
            $observation = $request->observation;
            $total     = $request->total;
            $user      = Auth::user();
            $userName  = Auth::user()->name;
            $users     = $user->id;
            $total      = str_replace(",", ".", $total);
            $product    = Order_product::where('user_id', $users)->get();
            $quantity   = $product[0]->quanty;
            $blindCartIds = $request->input('blindCartId',[]);
            $selectedAddressTypeId = $request->input('addressType');
            $addressId = $request->input('address_id');
            $addressUserTypesId = $request->input('address_user_types_id');
            $productInfo = ProductInfo::where('user_id', $users)->first();
            $request->merge(['delivery' => $productInfo->delivery ?? 0]);
            $delivery = $productInfo->delivery;


            if ( $total < 20.00)
                {
                return redirect()->back()->with('total', 'o valor de sua compra precisa ser maior que 20,00 reais');
                }

                $request->validate([
                    'payment' => 'required',
                    'observation' => $request->payment == 1 ? 'required' : 'nullable',
                ], [
                    'observation.required' => 'Você selecionou a opção de dinheiro, por favor informe valor do troco!',
                ]);

            // verificando se usuario tem endereço e depois criando pedido


            if (Address::where('user_id', $users)->exists()) {

            // $total = ($delivery == 1 ? ($total + 6) : $total);

            $order = Order::create([
                'observation' => $observation ?? $selectedCreditCard,
                'user_id'     => $user->id ?? '',
                'payment'     => $payment,
                'delivery'    => $delivery,
                'total'       => $total,
                'quantity'    => $quantity ?? 0,
            ]);



            $orderId = $order->id;

            // criando itens do pedido
            // dd($blindCartIds);
            foreach ($product as $index => $item) {

                $orderlist = OrderList::create([
                'blind_carts_id' => $blindCartIds[$index] ?? null, // Pega o valor correto do array
                'order_id'      => $orderId,
                'product_id'    => $item->product_id ?? '',
                'observation'   => $item->observation,
                'quamtity'      => $item->quanty ?? 0,
                'value'         => $item->price ?? 0,
                'address_type_id' =>  $selectedAddressTypeId ?? '',
                'address_id' => $addressId,
                'address_user_types_id' => $addressUserTypesId
                ]);


                foreach ($item->orderProductAdditional as $additional) {
                    $orderlist->orderAdditional()->attach($additional->id, [
                        'quantity' => $additional->pivot->quantity
                    ]);
                }

            }


            $product = Order_product::where('user_id', $users)->delete();

                //enviar mensagens via gzappy
            // Dados da mensagem e credenciais da instância
        //     $data = [
        //       "instance_id" => "BA4B88RMNQQZE9SA7ZMEEZT5",
        //       "instance_token" => "3ed00a88-733d-4b1a-bbec-6fe1d4a7d22e",
        //       "message" => ["Novo pedido - Pedido de numero:" . $orderId . " feito por " . $userName . ". Verifique seu painel admin."],
        //       "phone" => ["5535998464219"]
        //   ];


        //   $response = Http::withHeaders([
        //       'Content-Type' => 'application/json',
        //       'user_token_id' => 'd68f5c6e-3def-4273-b368-79144c0214ab',
        //   ])->post('https://api.gzappy.com/v1/message/send-message', $data);

        // Verifica se a resposta foi bem-sucedida
        //   if ($response->successful()) {
        //       // Mensagem enviada com sucesso
        //       return response()->json(['message' => 'Mensagem enviada com sucesso']);
        //   } else {
        //       // Falha ao enviar a mensagem
        //       return response()->json(['error' => 'Falha ao enviar mensagem'], $response->status());
        //   }


                // Envie uma mensagem para o admin do sistema
                //   $sid = env('TWILIO_SID');
                //   $token = env('TWILIO_AUTH_TOKEN');
                //   $twilio = new Client($sid, $token);

                // $adminPhoneNumber = "+5535998464219";


                // $message = $twilio->messages
                //     ->create("whatsapp:{$adminPhoneNumber}",
                //         array(
                //             "from" => "whatsapp:+14155238886",
                //             "body" => "Novo pedido recebido. Verifique o painel de administração para detalhes."
                //         )
                //     );
                // Verifique se o número está presente

                // $admin = User::where('access_level', 'admin')
                // ->with(['address' => function ($query) {
                //     $query->whereNotNull('fone');
                // }])
                // ->first();

                // if ($admin) {
                //     $admin->notify(new NewOrderNotification($order));
                // }



            return redirect()->back()->with('new_order', true)
                                     ->with('successmessage', 'Pedido enviado com sucesso, aconpanhe o estatus do seu pedido na área de vendas, clicando no botão continuar comprando');



        } else {
            // Redirecionar de volta com mensagem de erro

            return redirect()->back()->with('messagem', 'Você precisa cadastrar um endereço.');
        }
        }

        public function index(Request $request)
        {
            $newOrder = true;
            $user = Auth::user();
            $userId = $user->id ?? '';

            $date = now()->format('d/m/y H:i:s');

            // Carregar pedidos do usuário com as relações necessárias
            $orders = Order::orderBy('id', 'desc')
            ->with([
            'orderUser',  // Relação com o usuário que fez o pedido
            'orderList' => function($query) {
            $query->with([
                'addressUserType.address',  // Relação com o tipo de endereço e o endereço em si
                'orderAdditional' => function($q) {
                    $q->withPivot('quantity');  // Inclui a quantidade de cada adicional
                },
                'blindCart'  // Certifique-se de carregar o relacionamento com BlindCart
            ]);
            }
            ])
            ->where('status', 'processando')
            ->get();

            //metados para contar os pedidos do usuario


           $items = Order::with('orderUser')->get();

           $userOrderCount = [];

               // Itera sobre os pedidos para contar quantos pedidos cada usuário fez
                foreach ($items as $item) {
                    if ($item->user_id) { // Verifica se o pedido tem um user_id
                        // Se o usuário já estiver no array, incrementa a contagem
                        if (isset($userOrderCount[$item->user_id])) {
                            $userOrderCount[$item->user_id]++;
                        } else {
                            // Caso contrário, começa a contagem com 1
                            $userOrderCount[$item->user_id] = 1;
                        }
                    }
                }

            return view('cart.order', compact('date', 'userId', 'orders', 'newOrder', 'items', 'userOrderCount'));
        }

        public function update(Request $request, $id)
        {
            $order = Order::findOrFail($id);
            $order->update(['status' => 'aceito']);

            // ID do usuário
            $userId = $order->user_id;

            // ID do pedido
            $orderId = $order->id;


            // Buscar todos os pedidos apenas com status "aceito"
            $orderPoints = Order::where('user_id', $userId)
                ->where('status', 'aceito')
                ->where('id', $orderId)
                ->get();

            // Calcular o total gasto em pedidos aceitos
            $totalOrderAmount = $orderPoints->sum('total');

            // Converter total gasto em pontos (1 ponto para cada R$5)
            $totalPointsEarned = floor($totalOrderAmount / 5); // arredondando para baixo

            // Buscar os pontos atuais do usuário
            $loyalty = LoyaltyPoint::where('user_id', $userId)->first();
            $currentPoints = $loyalty ? $loyalty->points_earned : 0;

            // Buscar os pontos de blind resgatados nesse pedido específico na tabela correta
            $blindPointsUsed = OrderList::where('order_id', $order->id)
                ->whereNotNull('blind_carts_id')
                ->join('blind_carts', 'order_lists.blind_carts_id', '=', 'blind_carts.id')
                ->sum('blind_carts.points');

            // Calcular o saldo final corretamente
            $finalPoints = max(0, $currentPoints + $totalPointsEarned - $blindPointsUsed);

            // Atualizar ou criar o registro de pontos de fidelidade
            LoyaltyPoint::updateOrCreate(
                ['user_id' => $userId],
                ['points_earned' => $finalPoints]
            );

            // Buscar o BlindCart associado ao pedido e atualizar o status para "entregue"
            $blindCartUpDate = BlindCart::whereIn('id', function ($query) use ($orderId) {
                $query->select('blind_carts_id')
                    ->from('order_lists')
                    ->where('order_id', $orderId)
                    ->whereNotNull('blind_carts_id');
            })->update(['status' => 'entregue']);

            return redirect()->back()->with('acept', 'Você aceitou este pedido, pode encontrá-lo nos pedidos aceitos no menu acima!');
        }


}
