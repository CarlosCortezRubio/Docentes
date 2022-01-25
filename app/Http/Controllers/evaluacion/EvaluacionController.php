<?php

namespace App\Http\Controllers\evaluacion;

use App\Http\Controllers\Controller;
use App\Model\Comentario;
use App\Model\Examen\Examen;
use App\Model\Examen\ProgramacionExamen;
use App\Model\Jurado;
use App\Model\JuradoPostulante;
use App\Model\Nota;
use App\Model\Postulante;
use Exception;
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
                        ->join('admision.adm_seccion_estudios as asec','p.id_seccion','asec.id_seccion')
                        ->where('admision.adm_programacion_examen.estado','A')
                        ->where('ex.estado','A')
                        ->where('cu.estado','A')
                        ->where('au.estado','A')
                        ->where('asec.estado','A')
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
                                 'asec.codi_secc_sec',
                                 'p.id_seccion')->distinct();
        if(getSeccion()){
            $programaciones=$programaciones->where('p.id_seccion',getIdSeccion());
        } if(getTipoUsuario()=='Administrador'){
            $programaciones=$programaciones->get();
        }else if(getTipoUsuario()=='Jurado'){
            $programaciones=$programaciones->join('admision.adm_jurado as jr','admision.adm_programacion_examen.id_programacion_examen','jr.id_programacion_examen')
                                           ->join('bdsig.persona as pe','pe.codi_pers_per','jr.codi_doce_per')
                                            ->where('jr.estado','A')
                                           ->where('pe.nume_docu_per',Auth::user()->ndocumento)->get();
        }
        return $programaciones;
    }
    public function Evaluar(Request $request){
        try {
            foreach ($request->idnotas as $idnota) {
                $modelnota=Nota::find($idnota);
                DB::beginTransaction();
                $modelnota->nota=$request->get("nota".$idnota);
                $modelnota->estado='E';
                $modelnota->update();
                if ($request->get("nota".$idnota)==null || $request->get("nota".$idnota)>$request->nota_maxi) {
                    DB::rollBack();
                    return $this->Cargar($request);
                }
            }
            $comentario=Comentario::where('id_jurado_postulante',$request->id_jurado_postulante)->first();
            $comentario->comentario=$request->comentario;
            $comentario->update();
            
        DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        $postulante=Postulante::find($request->id_postulante);
        $jurados=JuradoPostulante::where('estado','A')->where('id_postulante',$request->id_postulante);
        $Notas=Nota::where('admision.adm_nota_jurado.id_jurado_postulante',$request->id_jurado_postulante)
                   ->where('admision.adm_nota_jurado.estado','E')
                   ->where('sec.estado','A')
                   ->select('sec.porcentaje','admision.adm_nota_jurado.nota')
                   ->join('admision.adm_seccion_examen as sec','sec.id_seccion_examen','admision.adm_nota_jurado.id_seccion_examen');
        $count=$jurados->count();
        $promedio=0;
        $Notas=$Notas->get();
        foreach ($Notas as $key => $nota) {
            $promedio=$promedio+((($nota->porcentaje/100)*$nota->nota)/$count);
        }
        $postulante->nota=$promedio;
        $postulante->estado='E';
        
        return $this->Cargar($request);
    }
    public function Cargar(Request $request){
        $postulantes=DB::table('bdsigunm.ad_postulacion as ad')
                        ->join('admision.adm_postulante as adm','adm.nume_docu_sol','ad.nume_docu_per')
                        ->where('esta_post_pos','V')
                        ->where('adm.id_programacion_examen',$request->id_programacion_examen)
                        ->where('adm.estado','P')
                        ->select('adm.id_programacion_examen',
                                 'adm.id_postulante',
                                 'adm.estado',
                                 'ad.nume_docu_per',
                                 'ad.nomb_pers_per',
                                 'ad.apel_pate_per',
                                 'ad.apel_mate_per')->distinct()->get();
        $jurado = DB::table('admision.adm_jurado as jr')
                    ->join('bdsig.persona as pe','pe.codi_pers_per','jr.codi_doce_per')
                    ->where('pe.nume_docu_per',Auth::user()->ndocumento)
                    ->where('jr.id_programacion_examen',$request->id_programacion_examen)
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
                    <div class='col-3'>Alumno</div>";
        foreach ($parametros as $key => $par) {
            $contenido=$contenido."<div class='col'>".$par->descripcion."</div>";
        }
        $contenido=$contenido."<div class='col'>Observaciòn</div>
                               <div class='col'>Acciones</div>
                               </div>
                               <hr width='100%' size='5' noshade=''>
                               ";
        foreach ($postulantes as $key => $pos) {
            
            
            $estadoeval='';
            foreach ($parametros as $key => $par) {
                $contenido=$contenido."<form action='".route('evaluacion.evaluar')."' id='$pos->nume_docu_per' 
            class='evaluar' method='GET'><div class='row'>
            <input type='text' name='id_postulante' value='$pos->id_postulante' style='display: none'/>
            <input type='text' name='id_jurado' value='$jurado->id_jurado' style='display: none'/>
            <input type='text' name='id_programacion_examen' value='$request->id_programacion_examen' style='display: none'/>
            <input type='text' name='id_examen' value='$request->id_examen' style='display: none'/>
            <input type='text' name='id_seccion_examen' value='$par->id_seccion_examen' style='display: none'/>
            <div class='col-3'>$pos->nomb_pers_per $pos->apel_pate_per $pos->apel_mate_per</div>";
                $nota=DB::table('admision.adm_nota_jurado as n')
                        ->join('admision.adm_jurado_postulante as jp','jp.id_jurado_postulante','n.id_jurado_postulante')
                        ->select('n.id_notajurado','nota','n.estado','jp.id_jurado_postulante')
                        ->where('jp.id_jurado',$jurado->id_jurado)
                        ->where('jp.id_postulante',$pos->id_postulante)
                        ->where('id_seccion_examen',$par->id_seccion_examen)->first();
                $estadoeval=$nota->estado;
                if ($nota->estado=='A' ){
                    $contenido=$contenido."<div class='col'><input class='form-control' name='nota$nota->id_notajurado' min='0' max='$examen->nota_maxi' required type='number'></div>
                    <input type='text' name='idnotas[]' value='$nota->id_notajurado' style='display: none'/>
                    <input type='text' name='id_jurado_postulante' value='$nota->id_jurado_postulante' style='display: none'/>
                    <input type='text' name='nota_maxi' value='$examen->nota_maxi' style='display: none'/>";
                    
                }else{
                    $contenido=$contenido."<div class='col'><input class='form-control' value='$nota->nota' disabled></div>";
                }
                
            }
            $comentario=DB::table('admision.adm_comentarios as c')
                            ->join('admision.adm_jurado_postulante as jp','jp.id_jurado_postulante','c.id_jurado_postulante')
                            ->select('comentario')
                            ->where('jp.id_jurado',$jurado->id_jurado)
                            ->where('jp.id_postulante',$pos->id_postulante)->first();
            
            if ($estadoeval=='A') {
                $contenido=$contenido."<div class='col'><textarea name='comentario'></textarea></div>";
            } else {
                $contenido=$contenido."<div class='col'><textarea disabled>$comentario->comentario</textarea></div>";
            }
            $contenido=$contenido."<div class='col'>
                                   <div class='row'>";
            if ($estadoeval=='A') {
                $contenido=$contenido."<a href='#' onclick='formulario(`#$pos->nume_docu_per`)' class='col btn btn-success des$pos->nume_docu_per'><i class='fas fa-check'></i></a>
                <a href='#'  class='col btn btn-primary des$pos->nume_docu_per'><i class='fas fa-forward'></i> </a>";
            } else {
                $contenido=$contenido."<a disabled class='col btn btn-success'><i class='fas fa-check'></i></a>
                <a  disabled class='col btn btn-primary'><i class='fas fa-forward'></i> </a>";
            }
            $contenido=$contenido."</div></div></div></form>";
        }
        return $contenido;
    }
}
