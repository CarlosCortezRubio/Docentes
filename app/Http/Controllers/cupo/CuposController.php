<?php

namespace App\Http\Controllers\cupo;

use App\Http\Controllers\Controller;
use App\Model\Cupos;
use App\Model\Periodo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $secciones =DB::table('bdsig.vw_sig_seccion')->get();
        $cupos= Cupos::join('admision.adm_periodo','admision.adm_periodo.id_periodo','=','admision.adm_cupos.id_periodo');
        $programas= DB::table('bdsig.vw_sig_seccion_especialidad');
        $periodos=Periodo::join('bdsig.vw_sig_seccion','bdsig.vw_sig_seccion.codi_secc_sec','=','admision.adm_periodo.codi_secc_sec');
        if(getSeccion()){
            $cupos=$cupos->where('codi_secc_sec',getCodSeccion())->get();
            $programas=$programas->where('codi_secc_sec',getCodSeccion())->get();
            $periodos=$periodos->where('admision.adm_periodo.codi_secc_sec',getCodSeccion())->get();
        }else if(getTipoUsuario()=='Administrador'){
            $cupos= $cupos->get();
            $programas=$programas->distinct()->get();
            $periodos=$periodos->get();
        }
        return view('cupos.index',['cupos'=>$cupos,'secciones'=>$secciones,'programas'=>$programas,'periodos'=>$periodos]);
    }

    public function insert(Request $request){
        $cupo=new Cupos();
        try {
            DB::beginTransaction();
            $cupo->cant_cupo=$request->cant_cupo;
            $cupo->id_periodo=$request->id_periodo;
            $cupo->estado='A';
            $cupo->user_regi=Auth::user()->id;
            $cupo->save();
            DB::commit();
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }

    public function update(Request $request){
        $cupo=Cupos::find($request->id_cupos);
        try {
            DB::beginTransaction();
            $cupo->cant_cupo=$request->cant_cupo;
            $cupo->id_periodo=$request->id_periodo;
            $cupo->estado=$request->estado;
            $cupo->user_actu=Auth::user()->id;
            $cupo->update();
            DB::commit();
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }

}
