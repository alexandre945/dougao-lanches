<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliticaPrivacidadeController extends Controller
{
    public function index(){
        return view('privacidade.politica');
    }
}
