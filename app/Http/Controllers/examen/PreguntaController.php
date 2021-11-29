<?php

namespace App\Http\Controllers\examen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    public function index(Request $request)
    {
        return view('examen.preguntas');
    }
}
