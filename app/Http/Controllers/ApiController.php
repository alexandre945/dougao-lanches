<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ApiController extends Controller
{
    public function index()
    {

        return response()->json([
            'lanches' => Product::where('category_id', 1)->where('status', 0)->get(),
            'bebidas' => Product::where('category_id', 2)->where('status', 0)->get(),
            'combos' => Product::where('category_id', 3)->where('status', 0)->get(),
            'bomboniere' => Product::where('category_id', 4)->where('status', 0)->get(),
            'promocoes =>' => Product::where('category_id', 5)->where('status', 0)->get(),
        ]);
    }
}
