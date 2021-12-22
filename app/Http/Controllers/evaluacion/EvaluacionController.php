<?php

namespace App\Http\Controllers\evaluacion;

use App\Http\Controllers\Controller;
use App\Model\Examen\Examen;
use App\Model\Examen\ProgramacionExamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $programaciones=$this->programaciones();
        
        return view('evaluacion.index',['programaciones'=>$programaciones]);
    }

    public function programaciones(){
        $programaciones=ProgramacionExamen::join('admision.adm_examen as ex','ex.id_examen','admision.adm_programacion_examen.id_examen')
                        ->join('admision.adm_cupos as cu','cu.id_cupos','admision.adm_programacion_examen.id_cupos')
                        ->join('admision.adm_examen_admision as adm','adm.id_examen','ex.id_examen')
                        ->join('admision.adm_aula as au','au.id_aula','admision.adm_programacion_examen.id_aula')
                        ->join('bdsig.vw_sig_seccion_especialidad as esp','esp.codi_espe_esp','cu.codi_espe_esp')
                        ->join('admision.adm_periodo as p','p.id_periodo','cu.id_periodo')
                        ->where('admision.adm_programacion_examen.estado','A')
                        ->where('ex.estado','A')
                        ->where('adm.flag_jura','S')
                        ->select('admision.adm_programacion_examen.descripcion',
                                 'admision.adm_programacion_examen.id_programacion_examen',
                                 'fecha_resol',
                                 'minutos',
                                 'modalidad',
                                 'ex.id_examen',
                                 'cu.id_cupos',
                                 'au.id_aula',
                                 'esp.codi_espe_esp',
                                 'esp.abre_espe_esp',
                                 'p.anio',
                                 'ex.nombre as examen',
                                 'au.nombre as aula',
                                 'p.codi_secc_sec')->distinct();
        if(getSeccion()){
            $programaciones=$programaciones->where('codi_secc_sec',getCodSeccion());
        } if(getTipoUsuario()=='Administrador'){
            $programaciones=$programaciones->get();
        }else if(getTipoUsuario()=='Jurado'){
            $programaciones=$programaciones->join('admision.adm_jurado as jr','admision.adm_programacion_examen.id_programacion_examen','jr.id_programacion_examen')
                                           ->join('bdsig.persona as pe','pe.codi_pers_per','jr.codi_doce_per')
                                           ->where('pe.nume_docu_per',Auth::user()->ndocumento)->get();
                                          // return "entro aqui";
        }
        return $programaciones;
    }
    public function Evaluar(Request $request){
        return $request;
    }
    public function Cargar(Request $request){
        $postulantes=DB::table('bdsigunm.ad_postulacion as ad')
                        ->join('admision.adm_postulante as adm','adm.nume_docu_sol','ad.nume_docu_per')
                        ->where('esta_post_pos','V')
                        ->where('adm.id_programacion_examen',$request->id_programacion_examen)
                        ->where('adm.estado','P')
                        ->select('adm.id_programacion_examen',
                                 'adm.id_postulante',
                                 'ad.nume_docu_per',
                                 'ad.nomb_pers_per',
                                 'ad.apel_pate_per',
                                 'ad.apel_mate_per')->distinct()->get();
        $jurado = DB::table('admision.adm_jurado as jr')
                    ->join('bdsig.persona as pe','pe.codi_pers_per','jr.codi_doce_per')
                    ->where('pe.nume_docu_per',Auth::user()->ndocumento)
                    ->where('jr.estado','A')
                    ->select('jr.id_jurado')
                    ->first();
        $parametros=DB::table('admision.adm_seccion_examen')
                        ->where('estado','A')
                        ->where('id_examen',$request->id_examen)
                        ->select('id_seccion_examen',
                                'id_examen',
                                'descripcion')->get();
        $examen=Examen::find($request->id_examen);
        $contenido="<div class='row'>
                    <div class='col'>Alumno</div>";
        foreach ($parametros as $key => $par) {
            $contenido=$contenido."<div class='col'>".$par->descripcion."</div>";
        }
        $contenido=$contenido."<div class='col'>Observaciòn</div>
                               <div class='col'>Acciones</div>
                               </div>
                               ";
        foreach ($postulantes as $key => $pos) {
            $contenido=$contenido."<form action='".route('evaluacion.evaluar')."' id='$pos->nume_docu_per' 
            class='evaluar' method='GET'><div class='row'>
            <input type='text' name='id_jurado' value='$jurado->id_jurado' style='display: none'/>
            <input type='text' name='id_postulante' value='$pos->id_postulante' style='display: none'/>
                                    <div class='col'>$pos->nomb_pers_per $pos->apel_pate_per $pos->apel_mate_per</div>";
            foreach ($parametros as $key => $par) {
                $contenido=$contenido."<div class='col'><input class='form-control des$pos->nume_docu_per' name='sec$par->id_seccion_examen' min='0' max='$examen->nota_maxi' required type='number'></div>";
            }
            $contenido=$contenido."<div class='col'><textarea></textarea></div>
                                   <div class='col'>
                                   <div class='row'>
                                   <button onclick='formeval()' class='col btn btn-success des$pos->nume_docu_per'><i class='fas fa-check'></i></button>
                                   <button class='col btn btn-primary des$pos->nume_docu_per'><i class='fas fa-forward'></i> </button>
                                   </div>
                                   </div>
                                   
                                   </div></form>";
        }
        //$contenido=$contenido."";
        return $contenido;
    }
}
