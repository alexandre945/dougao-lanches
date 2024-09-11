<?php

namespace App\Http\Controllers;

use App\Models\WaitingTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WaitingTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $time = WaitingTime::all();
        return view('time.time',compact('time'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
          // Validar os dados recebidos do formulário
          $validator = Validator::make($request->all(), [
            'time' => 'required',
          ],[
            'time.required' => 'este campo é obrigatorío.',

        ]);

           // Se a validação falhar, redireciona com os erros
           if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $time = $request->time;

            // Obtém os dois últimos registros
        $lastTwoTimes = WaitingTime::latest()->take(1)->get();

        // Deleta todos os registros anteriores
        WaitingTime::whereNotIn('id', $lastTwoTimes->pluck('id'))->delete();

        WaitingTime::create([
            'waitingtime' => $time,
        ]);

        return redirect()->back()->with('time', 'tempo ajustado com sucesso');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(WaitingTime $waitingTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaitingTime $waitingTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaitingTime $waitingTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaitingTime $waitingTime)
    {
        //
    }
}
