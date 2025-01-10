<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductInfo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UpdateTotalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function show(Request $request)
    {
        $userId = Auth::user()->id;
        $productInfo = ProductInfo::where('user_id', $userId)->first();
        return view('cart.index', compact('productInfo'));
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
    public function updatepaymente(Request $request)
    {

         $payment = ProductInfo::first();
         $payment->delivery = !$payment->delivery;
         $payment->save();

         return view('cart.index', compact('payment'));

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
