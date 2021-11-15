<?php

namespace App\Http\Controllers\evaluacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $postulantes=DB::table('bdsigunm.ad_postulacion')
                        ->where('codi_secc_sec',getCodSeccion())
                        ->select('codi_post_pos','nomb_pers_per','apel_pate_per','apel_mate_per')->get();
        return view('evaluacion.index',['postulantes'=>$postulantes]);
    }

    public function Evaluar(Request $request){
        return $request;
    }
}
