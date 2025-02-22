<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\OrderList;

use Illuminate\Http\Request;

class pdfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {

        $order = Order::with('orderUser') // Inclui a relação com o usuário do pedido
        ->where('status', 'aceito')  // Filtra pelo status "aceito"
        ->orderBy('id', 'desc')      // Ordena pela mais recente
        ->first();                   // Busca apenas o primeiro resultado

        if (!$order) {
            return response()->json(['error' => 'Nenhum pedido encontrado com o status "aceito".'], 404);
        }
        $date = now()->format( 'd/m/y H:i:s'); // Data e hora
      
        $order->update(['status' => 'produção']);

        // Gera o PDF usando a view 'status.impress'
        $pdf = Pdf::loadView('status.impress', compact('order', 'date'));

        // Retorna o PDF com os cabeçalhos apropriados
        return response($pdf->output(), 200)
       ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="pedido.pdf"'); // Exibe diretamente no navegador

        // Converte o PDF para imagem usando Imagick
        // $imagick = new Imagick();
        // $imagick->readImageBlob($pdf->output());
        // $imagick->setImageFormat('png');

        // return response($imagick->getImagesBlob(), 200)
        //     ->header('Content-Type', 'image/png');

        // $date = now()->format('d/m/y H:i:s');
        // $user      = Auth::user();
        // $users     = $user->id ?? '';
        // $order = Order::all();



        //     $order = Order::with(['orderUser.address' => function ($query) {
        //     $query->latest('created_at')->limit(1); // Obtém o último endereço
        //    }])->where('status', 'aceito')->orderBy('id', 'desc')->get();


        // $order = Order::orderBy('id', 'desc')->with('orderUser')->where(['status' => ('aceito')])->get();

        // return view('status.impress', compact('order', 'date', 'users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function impresso(Request $request)
    {
        $order = Order::with('orderUser') // Inclui a relação com o usuário do pedido
        ->where('status', 'produção')  // Filtra pelo status "aceito"
        ->orderBy('id', 'desc')      // Ordena pela mais recente
        ->get();                   // Busca apenas o primeiro resultado

       return view('status.statusImpresso', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     */
 
    public function readyUpdate(Request $request, $id)
    {
        
       $order = Order::findOrFail($id);
       $order->update(['status' => 'pronto']);
       return redirect()->back()->with('message','sstatus do pedio alterado para pronto');
    }

    /**
     * Display the specified resource.
     */
    public function ready(Request $request)
    {
        $date = now()->format( 'd/m/y H:i:s');
        $order = Order::with('orderUser') // Inclui a relação com o usuário do pedido
        ->where('status', 'pronto')  // Filtra pelo status "aceito"
        ->orderBy('id', 'desc')      // Ordena pela mais recente
        ->get(); 
        return view('status.ready',compact('order','date'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
