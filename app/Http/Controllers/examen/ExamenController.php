<?php

namespace App\Http\Controllers\examen;

use App\Http\Controllers\Controller;
use App\Model\Examen\DetalleExamen;
use App\Model\Examen\Examen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $secciones =DB::table('bdsig.vw_sig_seccion')->get();
        $examenes= Examen::join('admision.adm_examen_admision as exd','exd.id_examen','admision.adm_examen.id_examen')
                         ->join('bdsig.ttablas_det as t','exd.codi_secc_sec','t.codi_tabl_det')
                         ->where('estado','A')
                         ->select('exd.*','nombre','descripcion','nota_apro','nota_maxi','abre_tabl_det');
        if(getSeccion()){
            $examenes= $examenes->where('codi_secc_sec',getCodSeccion())->get();
        }else if(getTipoUsuario()=='Administrador'){
            $examenes= $examenes->get();
        }
        return view('examen.index',["secciones"=>$secciones,"examenes"=>$examenes]);
    }

    public function insert(Request $request){
        $examen=new Examen();
        $examendet=new DetalleExamen();
        $tipo=DB::table('admision.adm_tipo_examen')->where('nombre','LIKE','Examen de Admision')->first();
        
        try {
            DB::beginTransaction();
            $examen->nombre=$request->nombre;
            $examen->descripcion=$request->descripcion;
            $examen->nota_apro=$request->nota_apro;
            $examen->nota_maxi=$request->nota_maxi;
            $examen->estado='A';
            $examen->user_regi=Auth::user()->id;
            $examen->id_tipo_examen=$tipo->id_tipo_examen;
            $examen->save();

            if(!$request->cara_elim){
                $examendet->cara_elim='N';
            }else {
                $examendet->cara_elim=$request->cara_elim;
            }
            if(!$request->flag_jura){
                $examendet->flag_jura='N';
            }else{
                $examendet->flag_jura=$request->flag_jura;
            }
            $examendet->codi_secc_sec=$request->codi_secc_sec;
            $examendet->id_examen=$examen->id_examen;
            $examendet->save();

            DB::commit();
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }

    public function update(Request $request){
        $examen= Examen::find($request->id_examen);
        $examendet=DetalleExamen::find($request->id_examen_admision);
        try {
            DB::beginTransaction();
            $examen->nombre=$request->nombre;
            $examen->descripcion=$request->descripcion;
            $examen->nota_apro=$request->nota_apro;
            $examen->nota_maxi=$request->nota_maxi;
            $examen->user_actu=Auth::user()->id;
            $examen->update();

            if(!$request->cara_elim){
                $examendet->cara_elim='N';
            }else {
                $examendet->cara_elim=$request->cara_elim;
            }
            if(!$request->flag_jura){
                $examendet->flag_jura='N';
            }else{
                $examendet->flag_jura=$request->flag_jura;
            }
            $examendet->codi_secc_sec=$request->codi_secc_sec;
            $examendet->update();

            DB::commit();
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }

    public function delete(Request $request){
        $examen=Examen::find($request->id_examen);
        try {
            DB::beginTransaction();
            $examen->estado='E';
            $examen->user_actu=Auth::user()->id;
            $examen->update();
            DB::commit();
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }


    //////////////////////////////////////////////////
    public function programacion()
    {
        return view('examen.programacion');
    }
}
