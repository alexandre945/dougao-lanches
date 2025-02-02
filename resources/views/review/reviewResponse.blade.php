<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/03e947ed86.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index-cart.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @vite('resources/css/app.css')
</head>
<body>

            @php
            $ratingsDescripitions = array(
                    5 => "Execlente",
                    4 =>  "Muito bom",
                    3 =>  "Bom",
                    2 =>   "Regular",
                    1 =>  "Ruim"
            );
            @endphp

    <div class="container max-auto mt-4 ">
          <h1 class="text-center  font-bold text-sm">Responder aos Comentários dos Clientes</h1>
        <h4 class="text-center pb-4 font-semibold ">Avaliações</h4>
           <div class="bg-white ">
                    <!-- Exibe as avaliações -->
                    @foreach ($reviews as $review)
                        <div class="bg-blue-50 border-l-4 border-blue-500 text-bluee p-4 mt-4 rounded-lg shadow-md">
                            <strong>Avaliação: </strong>{{ $ratingsDescripitions[$review->rating] }} {{$review->rating}} /5<br>
                            <strong>Comentário: </strong>{{ $review->comment }}<br>
                            <em>Enviado por: {{ $review->user->name }} em {{ $review->created_at->format('d/m/Y') }}</em>

                            @if ($review->response)
                                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mt-4 rounded-lg shadow-md">
                                    <div>
                                        <strong>Respondido por:</strong> {{ $review->response->user->name ?? ''}}
                                    </div>
                                    <div>
                                        <strong>Resposta:</strong> {{ $review->response->response }}
                                    </div>
                                    <div>
                                        <em>Respondido em: {{ $review->response->created_at->format('d/m/Y H:i') }}</em>
                                    </div>
                                    <div class="mt-2 flex gap-2">
                                        <!-- Botão para abrir o modal -->
                                        <button type="button"
                                            class="px-2 py-1 text-sm border border-emerald-400 bg-emerald-300 text-white rounded hover:bg-emerald-400"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editResponseModal-{{ $review->response->id }}">
                                            EDITAR
                                        </button>

                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"  onsubmit="return confirm('Tem certeza que deseja excluir este comentário e a resposta?');">
                                            @csrf
                                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 border-2 text-white p-2 rounded hover:bg-red-700">
                                                Excluir
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @else
                                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mt-4 rounded-lg shadow-md">
                                        <em>Sem resposta do administrador ainda.</em> <br>
                                        <!-- Botão para abrir o modal -->
                                        <button type="button"
                                            style="background-color: #1d4ed8; color: white; padding: 0.5rem 1rem; margin-top: 0.5rem; border-radius: 0.375rem; cursor: pointer; border: none;"
                                            onmouseover="this.style.backgroundColor='#2563eb';"
                                            onmouseout="this.style.backgroundColor='#1d4ed8';"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalResposta-{{ $review->id }}">
                                            Responder
                                        </button>

                                </div>

                                @if (session('success'))
                                    <div class="bg-lime-300 p-2">
                                        <p>{{ session('success') }}</p>
                                    </div>
                                @endif


                                <!-- Modal para resposta -->
                                <div class="modal fade" id="modalResposta-{{ $review->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $review->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel-{{ $review->id }}">Responder ao Comentário</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('response.store',$review->id)}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                                                    <div class="mb-3">
                                                        <label for="response-{{ $review->id }}" class="form-label">Resposta:</label>
                                                        <textarea name="response" id="response-{{ $review->id }}" rows="4" class="form-control" placeholder="Digite sua resposta aqui"></textarea>
                                                    </div>
                                                </div>
                                                <div style="display: flex; justify-content: flex-end; gap: 1rem; padding: 1rem; border-top: 1px solid #ddd;">
                                                    <!-- Botão Cancelar -->
                                                    <button type="button"
                                                        style="background-color: #6c757d; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; cursor: pointer;"
                                                        onmouseover="this.style.backgroundColor='#5a6268';"
                                                        onmouseout="this.style.backgroundColor='#6c757d';"
                                                        data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>

                                                    <!-- Botão Enviar Resposta -->
                                                    <button type="submit"
                                                        style="background-color: #007bff; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; cursor: pointer;"
                                                        onmouseover="this.style.backgroundColor='#0056b3';"
                                                        onmouseout="this.style.backgroundColor='#007bff';">
                                                        Enviar Resposta
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endif
                                {{-- Modal para  edição --}}
                                @if ($review->response)
                                <div class="modal fade" id="editResponseModal-{{ $review->response->id }}" tabindex="-1" aria-labelledby="editResponseModalLabel-{{ $review->response->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('response.update', $review->response->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editResponseModalLabel-{{ $review->response->id }}">Editar Resposta</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="response-{{ $review->response->id }}" class="form-label">Resposta:</label>
                                                        <textarea name="response" id="response-{{ $review->response->id }}" rows="4" class="form-control">{{ $review->response->response }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="bg-slate-400 rounded border-2 p-2 hover:bg-neutral-500 text-white" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="bg-indigo-500 rounded border-2 p-2 text-white  hover:bg-emerald-300 hover:text-black ">Salvar Alterações</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                        </div>
                    <hr>
                    @endforeach


           </div>


        <!-- Links de paginação -->
        <div class="d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
        <a href="{{ route('client.show') }}">
            <button class="bg-gradient-to-r from-yellow-400 to-bluee border-l-4 border-blue hover:bg-gradient-to-l hover:from-blue-600 hover:to-yellow-400  font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Voltar
            </button>
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    @vite('resources/js/app.js')
</body>
</html>
