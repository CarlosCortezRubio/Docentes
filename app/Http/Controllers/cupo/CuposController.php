<?php

namespace App\Http\Controllers\cupo;

use App\Http\Controllers\Controller;
use App\Model\Cupos;
use App\Model\Periodo;
use Exception;
use Illuminate\Database\QueryException;
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
        try{
            $cupos= Cupos::join('admision.adm_periodo as pe','pe.id_periodo','admision.adm_cupos.id_periodo')
                        ->join('bdsig.vw_sig_seccion as sec','sec.codi_secc_sec','pe.codi_secc_sec') 
                        ->join('bdsig.vw_sig_seccion_especialidad as esp','esp.codi_espe_esp','admision.adm_cupos.codi_espe_esp')
                        ->select('admision.adm_cupos.*','esp.codi_espe_esp','esp.abre_espe_esp','pe.*','sec.abre_secc_sec')
                        ->distinct('id_cupos')
                        ->where('admision.adm_cupos.estado','A');

            $programas= DB::table('bdsig.vw_sig_seccion_especialidad');
            $periodos=Periodo::join('bdsig.vw_sig_seccion','bdsig.vw_sig_seccion.codi_secc_sec','=','admision.adm_periodo.codi_secc_sec');
            if(getSeccion()){
                $cupos=$cupos->where('sec.codi_secc_sec',getCodSeccion())->get();
                $programas=$programas->where('codi_secc_sec',getCodSeccion())->get();
                $periodos=$periodos->where('admision.adm_periodo.codi_secc_sec',getCodSeccion())->get();
            }else if(getTipoUsuario()=='Administrador'){
                $programas=$programas->distinct('codi_espe_esp')->get();
                $cupos=$cupos->get();
                $periodos=$periodos->get();
            }else{
                $cupos=null;
            }
            
            return view('cupos.index',['cupos'=>$cupos,'programas'=>$programas,'periodos'=>$periodos]);
        }catch(QueryException $e){
            DB::rollBack();
            dd($e);
        }
    }

    public function insert(Request $request){
        $cupo=new Cupos();
        try {
            DB::beginTransaction();
            $cupo->cant_cupo=$request->cant_cupo;
            $cupo->id_periodo=$request->id_periodo;
            $cupo->codi_espe_esp=$request->codi_espe_esp;
            $cupo->estado='A';
            $cupo->user_regi=Auth::user()->id;
            $cupo->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
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
            $cupo->user_actu=Auth::user()->id;
            $cupo->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->back();
    }
    public function delete(Request $request){
        $cupo=Cupos::find($request->id_cupos);
        try {
            DB::beginTransaction();
            $cupo->estado='E';
            $cupo->user_actu=Auth::user()->id;
            $cupo->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->back();
    }

}
