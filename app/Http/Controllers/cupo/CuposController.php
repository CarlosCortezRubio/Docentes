<?php

namespace App\Http\Controllers\cupo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cupos.index');
    }
    
}
