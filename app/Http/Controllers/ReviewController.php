<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      $reviews = Review::with('user','response')->orderBy('created_at', 'desc')->paginate(10);
      return view('review.index', compact('reviews'));
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
        $userId = auth()->id();


       // Verifica se o usuário possui algum pedido
       $hasOrders = Order::where('user_id', $userId)->exists();

       if (!$hasOrders) {
           return redirect()->back()->with('notOrder', 'Não é possível avaliar sem ter feito um pedido!');
       }


        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        Review::create([
            'user_id' => $userId,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Avaliação enviada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(review $review)
    {
        // Pegar as últimas avaliações
        $reviews = Review::with('user','response','admin')->orderby('created_at', 'desc')->paginate(5);
        return view('review.reviewResponse', compact('reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(review $review)
    {
        //
    }
}
