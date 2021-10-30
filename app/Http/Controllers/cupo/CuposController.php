<?php

namespace App\Http\Controllers\cupo;

use App\Http\Controllers\Controller;
use App\Model\Cupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $secciones =DB::table('bdsig.vw_sig_seccion')->get();
        if(getSeccion()){
            $cupos= Cupos::join('admision.adm_periodo','admision.adm_periodo.id_periodo','=','admision.adm_cupos.id_periodo')
                            ->where('codi_secc_sec',getCodSeccion())->get();
        }else{
            $cupos= Cupos::all();
        }
        return view('cupos.index',['cupos'=>$cupos,'secciones'=>$secciones]);
    }

}
