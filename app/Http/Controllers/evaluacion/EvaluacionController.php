<?php

namespace App\Http\Controllers\evaluacion;

use App\Http\Controllers\Controller;
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
        
        
        $programaciones=ProgramacionExamen::join('admision.adm_examen as ex','ex.id_examen','admision.adm_programacion_examen.id_examen')
                        ->join('admision.adm_cupos as cu','cu.id_cupos','admision.adm_programacion_examen.id_cupos')
                        ->join('admision.adm_aula as au','au.id_aula','admision.adm_programacion_examen.id_aula')
                        ->join('bdsig.vw_sig_seccion_especialidad as esp','esp.codi_espe_esp','cu.codi_espe_esp')
                        ->join('admision.adm_periodo as p','p.id_periodo','cu.id_periodo')
                        ->where('admision.adm_programacion_examen.estado','A')
                        ->where('ex.','A')
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
        return view('evaluacion.index',['programaciones'=>$programaciones]);
    }

    public function Evaluar(Request $request){
        $postulantes=DB::table('bdsigunm.ad_postulacion as ad')
                        ->join('admision.adm_postulante as adm','adm.nume_docu_sol','ad.nume_docu_per')
                        ->where('esta_post_pos','V')
                        ->select('adm.id_programacion_examen',
                                 'ad.nume_docu_per',
                                 'ad.nomb_pers_per',
                                 'ad.apel_pate_per',
                                 'ad.apel_mate_per');
        $parametros=DB::table('bdsigunm.adm_seccion_examen')
                        ->where('estado','A')
                        ->select('adm.id_programacion_examen',
                                'ad.nume_docu_per',
                                'ad.nomb_pers_per',
                                'ad.apel_pate_per',
                                'ad.apel_mate_per');
        return $request;
    }
}
