<?php

namespace App\Http\Controllers\examen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('examen.index');
    }

    public function programacion()
    {
        return view('examen.programacion');
    }
}
