<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsUseController extends Controller
{
    public function index()
        {

            return view('privacidade.termsUse');
        }

    public function deletion()
        {
            return view('privacidade.datadeletion');

        }
}
