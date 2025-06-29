<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ManualCart;
use App\Models\Additional;

class ManualOrderController extends Controller
{
    public function create()
    {
        $product = Product::where('category_id', 1)->get(); // ou ->with('additionals'), conforme o nome certo
        $productPromo = Product::where('category_id', 5)->get();
        $productBeer = Product::where('category_id', 2)->get();
        $productCombo = Product::where('category_id', 3)->get();
        $productBomboniere = Product::where('category_id', 4)->get();
        $additional = Additional::get();
        return view('admin.manual-order-create',
        compact
        ('product',
        'productPromo',
        'additional',
        'productBeer',
        'productCombo',
        'productBomboniere',
    ));

    }

    public function store(Request $request)
    {
        dd($request->all());
            $request->validate([
                'client_name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'order_type' => 'required|in:retirar,entregar',
                'street' => 'nullable|string|max:255',
                'district' => 'nullable|string|max:255',
                'number' => 'nullable|string|max:255',
                'reference' => 'nullable|string|max:255',
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'observation' => 'nullable|string',
            ]);

            // Buscar o preço do produto
            $product = Product::findOrFail($request->product_id);
            $unitPrice = $product->price;
            $totalPrice = $unitPrice * $request->quantity;
            
            // Criar item no carrinho manual
            ManualCart::create([
                'client_name' => $request->client_name,
                'phone' => $request->phone,
                'order_type' => $request->order_type,
                'street' => $request->street,
                'district' => $request->district,
                'number' => $request->number,
                'reference' => $request->reference,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $unitPrice,
                'total_price' => $totalPrice,
                'observation' => $request->observation,
                'status' => 'aberto',
            ]);

            return redirect()->back()->with('success', 'Produto adicionado ao carrinho com sucesso!');

    }
}
