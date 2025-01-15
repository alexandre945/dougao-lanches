<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserPointsController extends Controller
{
    public function show(Request $request)
    {
        $userPoints = User::with('poitsUser')->paginate(10);

        
        return view('users.userPoints', compact('userPoints'));
    }
}
