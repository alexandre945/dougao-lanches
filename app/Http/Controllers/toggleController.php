<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toggle;

class toggleController extends Controller
{
  public function toggle(Request $resquest)
    {
        $toggle = Toggle::first();
        $toggle->is_open = !$toggle->is_open;
        $toggle->save();
        return view('dashboard', compact('toggle'));
    }

  public function status(Request $request)
    {
       $toggle = Toggle::first();
       $isOpen = $toggle ? $toggle->is_open : false;

       return response()->json(['isOpen' => $isOpen]);
    }
}
