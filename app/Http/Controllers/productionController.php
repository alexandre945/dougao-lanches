<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class productionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $date = now()->format('d/m/y H:i:s');
        $user      = Auth::user();
        $users     = $user->id ?? '';
        $order = Order::all();


        $userAddresses = Address::where('user_id', $users)->with('userAdress')->get();

        $order = Order::orderBy('id', 'desc')->where(['status' => ('produção')])->get();

        return view('status.production', compact('userAddresses', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontre o pedido pelo ID

        $order = Order::findOrFail($id);
        $orderId = $order->id;

        // Atualize o status do pedido

        $order->update(['status' => 'saiu para entrega']);



            // $phone = $order->orderUser->address->first()->fone;

            // $userName = $order->orderUser->name;

            // $message = "Seu pedido de número: " . $orderId . " acabou de sair para entrega. " . $userName . ", obrigado por comprar no Dougão Lanches.";


            // $data = [
            //     "instance_id" => "BA4B88RMNQQZE9SA7ZMEEZT5",
            //     "instance_token" => "3ed00a88-733d-4b1a-bbec-6fe1d4a7d22e",
            //     "message" => [$message],
            //     "phone" => [$phone]
            // ];

            // // Envie a mensagem
            // $response = Http::withHeaders([
            //     'Content-Type' => 'application/json',
            //     'user_token_id' => 'd68f5c6e-3def-4273-b368-79144c0214ab',
            // ])->post('https://api.gzappy.com/v1/message/send-message', $data);


        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
