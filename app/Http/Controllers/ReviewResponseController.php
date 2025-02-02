<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReviewResponse;
use App\Models\Review;
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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $response = ReviewResponse::findOrFail($id);
        $response->update([
            'response' => $validated['response'],
        ]);

        return redirect()->back()->with('success', 'Resposta atualizada com sucesso!');
    }
    public function destroy(Request $request, $review)
    {
        dd('aqui');
        $review = $request->review_id;
        dd($review);
        $review->delete(); // Isso já deletará a resposta associada, graças ao `booted` no model

        return redirect()->back()->with('success', 'Comentário e resposta excluídos com sucesso!');
    }




}
