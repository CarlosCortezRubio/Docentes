<?php

namespace App\Http\Controllers\examen;

use App\Http\Controllers\Controller;
use App\Model\Aula;
use App\Model\Examen\Examen;
use App\Model\Examen\ProgramacionExamen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramacionController extends Controller
{
    public function index()
    {
        $secciones =DB::table('bdsig.vw_sig_seccion')->get();
        $aulas= Aula::where("estado","A")->get();
        $examenes= Examen::join('admision.adm_examen_admision as exd','exd.id_examen','admision.adm_examen.id_examen')
                         ->join('bdsig.ttablas_det as t','exd.codi_secc_sec','t.codi_tabl_det')
                         ->where('estado','A')
                         ->select('exd.id_examen','nombre','abre_tabl_det','exd.codi_secc_sec');
        if(getSeccion()){
            $examenes= $examenes->where('codi_secc_sec',getCodSeccion())->get();
        }else if(getTipoUsuario()=='Administrador'){
            $examenes= $examenes->get();
        }
        return view('examen.programacion',['secciones'=>$secciones,"examenes"=>$examenes,"aulas"=>$aulas]);
    }

    public function insert(Request $request){
        $program=new ProgramacionExamen();
        try {
            DB::beginTransaction();
            $program->descripcion=$request->descripcion;
            $program->fecha_resol=$request->fecha_resol;
            $program->minutos=$request->minutos;
            $program->modalidad=$request->modalidad;
            $program->estado='A';
            $program->user_regi=Auth::user()->id;
            $program->id_examen=$request->id_examen;
            $program->id_aula=$request->id_aula;
            $program->codi_doce_per=$request->codi_doce_per;
            $program->save();
            DB::commit();
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }

    public function update(Request $request){
        $program= ProgramacionExamen::find($request->id_programacion_examen);
        try {
            DB::beginTransaction();
            $program->descripcion=$request->descripcion;
            $program->fecha_resol=$request->fecha_resol;
            $program->minutos=$request->minutos;
            $program->modalidad=$request->modalidad;
            $program->user_actu=Auth::user()->id;
            $program->id_examen=$request->id_examen;
            $program->id_aula=$request->id_aula;
            $program->codi_doce_per=$request->codi_doce_per;
            $program->update();
            DB::commit();
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->back();
    }
}
