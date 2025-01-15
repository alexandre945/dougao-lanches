<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReviewResponse;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ReviewResponseController extends Controller
{

    //   Salvar a resposta de uma avaliação.

    public function store(Request $request, $review_id)
    {
        // Obtém o ID do usuário logado
        
        $user      = Auth::user();
        $user_id   = $user->id;
    
        $response = $request->response;
    
        // Criação de uma nova resposta
        ReviewResponse::create([
            'review_id' => $review_id,  // ID do review relacionado
            'user_id' => $user_id,// ID do administrador logado 
            'response' => $response, // Conteúdo da resposta
        ]);
    
        // Redireciona de volta com mensagem de sucesso
        return redirect()->back()->with('success', 'Resposta criada com sucesso!');
    }
    
}
