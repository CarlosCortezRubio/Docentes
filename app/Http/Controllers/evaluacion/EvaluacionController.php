<?php

namespace App\Http\Controllers\evaluacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('evaluacion.index');
    }
}
