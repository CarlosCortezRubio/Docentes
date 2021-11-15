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
        return view('examen.index',["secciones"=>$secciones]);
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
            $examen->nota_mini=$request->nota_mini;
            $examen->estado='A';
            $examen->user_regi=Auth::user()->id;
            $examen->id_tipo_examen=$tipo->id_tipo_examen;
            $examen->save();
            DB::commit();

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

    public function update(){

    }

    public function delete(){

    }

    //////////////////////////////////////////////////
    public function programacion()
    {
        return view('examen.programacion');
    }
}
