<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function destroy(Request $request)
    {
        $user = Auth::user(); // Isso retorna o modelo User
    
        Auth::logout();       // Faz logout antes de deletar
    
        $user->delete();      // Agora isso vai funcionar corretamente
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/')->with('success', 'Conta excluída com sucesso.');
    }
}
