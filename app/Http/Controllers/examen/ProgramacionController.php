<?php

namespace App\Http\Controllers\examen;

use App\Http\Controllers\Controller;
use App\Model\Aula;
use App\Model\Cupos;
use App\Model\DetalleUsuario;
use App\Model\Examen\Examen;
use App\Model\Examen\ProgramacionExamen;
use App\Model\Jurado;
use App\Model\Persona;
use App\Model\Postulante;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProgramacionController extends Controller
{
    public function index(){
        $secciones =DB::table('bdsig.vw_sig_seccion')->get();
        $aulas= Aula::where("estado","A")->get();
        $examenes= Examen::join('admision.adm_examen_admision as exd','exd.id_examen','admision.adm_examen.id_examen')
                         ->join('bdsig.ttablas_det as t','exd.codi_secc_sec','t.codi_tabl_det')
                         ->where('estado','A')
                         ->select('exd.id_examen','nombre','abre_tabl_det','exd.codi_secc_sec');
        $cupos=Cupos::join('admision.adm_periodo as p',
                                'p.id_periodo',
                                'admision.adm_cupos.id_periodo')
                        ->join('bdsig.vw_sig_seccion as sec',
                                'sec.codi_secc_sec',
                                'p.codi_secc_sec')
                        ->join('bdsig.vw_sig_seccion_especialidad as esp',
                                'esp.codi_espe_esp',
                                'admision.adm_cupos.codi_espe_esp')
                        ->where('p.estado','A')
                         ->select('id_cupos',
                                    'esp.codi_espe_esp',
                                    'esp.abre_espe_esp',
                                    'p.id_periodo',
                                    'p.anio',
                                    'sec.codi_secc_sec',
                                    'sec.abre_secc_sec')->distinct();
        $docentes=Persona::where('flag_trab_per','S')->where('tipo_trab_per','03001')->get();
        $programaciones=ProgramacionExamen::join('admision.adm_examen as ex','ex.id_examen','admision.adm_programacion_examen.id_examen')
                                          ->join('admision.adm_cupos as cu','cu.id_cupos','admision.adm_programacion_examen.id_cupos')
                                          ->join('admision.adm_aula as au','au.id_aula','admision.adm_programacion_examen.id_aula')
                                          ->join('bdsig.vw_sig_seccion_especialidad as esp','esp.codi_espe_esp','cu.codi_espe_esp')
                                          ->join('admision.adm_periodo as p','p.id_periodo','cu.id_periodo')
                                          ->where('admision.adm_programacion_examen.estado','A')
                                          ->select('admision.adm_programacion_examen.descripcion',
                                                   'id_programacion_examen',
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
            $examenes= $examenes->where('codi_secc_sec',getCodSeccion())->get();
            $cupos= $cupos->where('codi_secc_sec',getCodSeccion())->get();
            $programaciones=$programaciones->where('codi_secc_sec',getCodSeccion())->get();
        }else if(getTipoUsuario()=='Administrador'){
            $examenes= $examenes->get();
            $cupos= $cupos->get();
            $programaciones=$programaciones->get();
        }
        $alumnos[]=[];
        $arrayalumnos[]=[];
        $arraydoc[]=[];
        foreach ($programaciones as $key => $pro) {
            $doc=DB::table('admision.adm_jurado')->where('id_programacion_examen',$pro->id_programacion_examen)->where('estado','A')->get();
            $arraydoc[$pro->id_programacion_examen]=[];
            foreach ($doc as $key => $v) {
                $arraydoc[$pro->id_programacion_examen][]=$v->codi_doce_per;
            }
            $alm=DB::table('admision.adm_postulante')->where('id_programacion_examen',$pro->id_programacion_examen)->where('estado','A')->get();
            $arrayalumnos[$pro->id_programacion_examen]=[];
            foreach ($alm as $key => $v) {
                $arrayalumnos[$pro->id_programacion_examen][]=$v->nume_docu_sol;
            }
            $cargaalumno=DB::table('bdsigunm.ad_postulacion')->where('codi_espe_esp',$pro->codi_espe_esp)
                                                     ->where('esta_post_pos','V')
                                                     ->whereYear('fech_regi_aud',$pro->anio)->get();
            $alumnos[$pro->id_programacion_examen]="[";
            foreach ($cargaalumno as $key => $v) {
                $alumnos[$pro->id_programacion_examen]=$alumnos[$pro->id_programacion_examen]."{documento:'$v->nume_docu_per',nombre:'$v->nomb_pers_per $v->apel_pate_per $v->apel_mate_per'},";
            }
            $alumnos[$pro->id_programacion_examen]=$alumnos[$pro->id_programacion_examen]."]";
            //return $alumnos[$pro->id_programacion_examen];
        }
        ///////////////////////////////////
        $cargaalumno=DB::table('bdsigunm.ad_postulacion')->where('esta_post_pos','V')->select('nomb_pers_per','apel_pate_per','apel_mate_per','nume_docu_per')->get();
        ///////////////////////////////////
        return view('examen.programacion',['cargaalumno'=>$cargaalumno,'arrayalumnos'=>$arrayalumnos,'arraydoc'=>$arraydoc,'secciones'=>$secciones,"examenes"=>$examenes,"aulas"=>$aulas,"cupos"=>$cupos,'docentes'=>$docentes,'programaciones'=>$programaciones]);
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
            $program->id_cupos=$request->id_cupos;
            $program->save();
            foreach ($request->codi_doce_per as $key => $doc) {
                $contrasena = '12345678';//substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 8);
                $persona=Persona::find($doc);
                $usuario=User::where('ndocumento',$persona->nume_docu_per);
                if ($usuario->count()==0) {
                    $usuario=new User();
                    $usuario->name=$persona->nomb_comp_per;
                    $usuario->ndocumento=$persona->nume_docu_per;
                    $usuario->email=$persona->mail_pers_per;
                    $usuario->password=Hash::make($contrasena);
                    $usuario->save();
                    ///////////////////////
                    $usuariodet=new DetalleUsuario();
                    $usuariodet->estado='A';
                    $usuariodet->id_usuario=$usuario->id;
                    $usuariodet->id_tipo_usuario=3;
                    $usuariodet->imagen=$persona->foto_pers_per;
                    $usuariodet->save();
                }
                ///////////////////////
                $docente= new Jurado();
                $docente->id_programacion_examen=$program->id_programacion_examen;
                $docente->codi_doce_per=$doc;
                $docente->estado='A';
                $docente->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->back();
    }
    public function update(Request $request){
        $program= ProgramacionExamen::find($request->id_programacion_examen);
       // return $program;
        try {
            DB::beginTransaction();
            $program->descripcion=$request->descripcion;
            $program->fecha_resol=$request->fecha_resol;
            $program->minutos=$request->minutos;
            $program->modalidad=$request->modalidad;
            $program->user_actu=Auth::user()->id;
            $program->id_examen=$request->id_examen;
            $program->id_aula=$request->id_aula;
            $program->id_cupos=$request->id_cupos;
            $docentes=Jurado::where('id_programacion_examen',$program->id_programacion_examen);
            if(!$docentes->count()==0){
                $docentes=$docentes->get();
                foreach ($docentes as $key => $docente) {
                    $docente->estado='I';
                    $docente->update();
                }
                foreach ($request->codi_doce_per as $key => $doc) {
                    $docente=Jurado::where('codi_doce_per',$doc)->where('id_programacion_examen',$program->id_programacion_examen);
                    if ($docente->count()==0) {
                        $contrasena = '12345678';//substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 8);
                        $persona=Persona::find($doc);
                        $usuario=User::where('ndocumento',$persona->nume_docu_per);
                        if ($usuario->count()==0) {
                            $usuario=new User();
                            $usuario->name=$persona->nomb_comp_per;
                            $usuario->ndocumento=$persona->nume_docu_per;
                            $usuario->email=$persona->mail_pers_per;
                            $usuario->password=Hash::make($contrasena);
                            $usuario->save();
                            ///////////////////////
                            $usuariodet=new DetalleUsuario();
                            $usuariodet->estado='A';
                            $usuariodet->id_usuario=$usuario->id;
                            $usuariodet->id_tipo_usuario=3;
                            $usuariodet->imagen=$persona->foto_pers_per;
                            $usuariodet->save();
                        }
                        ///////////////////////
                        $docente= new Jurado();
                        $docente->id_programacion_examen=$program->id_programacion_examen;
                        $docente->codi_doce_per=$doc;
                        $docente->estado='A';
                        $docente->save();
                    }else{
                        $docente=$docente->first();
                        $docente->estado='A';
                        $docente->update();
                        
                    }
                    
                }
            }
            $program->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->back();
    }
    public function addAlumno(Request $request){
        
            try {
                DB::beginTransaction();
                if($request->nume_docu_sol){
                    foreach ($request->nume_docu_sol as $key => $nume) {
                        $postulante=Postulante::where('id_programacion_examen',$request->id_programacion_examen)
                                            ->where('nume_docu_sol',$nume);
                        if ($postulante->count()==0) {
                            $postulante=new Postulante();
                            $postulante->id_programacion_examen=$request->id_programacion_examen;
                            $postulante->nume_docu_sol=$nume;
                            $postulante->estado='P';
                            $postulante->save();
                        }else{
                            $postulante=$postulante->first();
                            $postulante->estado='P';
                            $postulante->update();
                        }
                    } 
                }
                if($request->alumnodelete){
                    foreach ($request->alumnodelete as $key => $nume) {
                        $postulante=Postulante::where('id_programacion_examen',$request->id_programacion_examen)
                                            ->where('nume_docu_sol',$nume);
                        if ($postulante->count()!=0) {
                            $postulante=$postulante->first();
                            $postulante->estado='I';
                            $postulante->update();
                        }
                    }
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                dd($e);
            }
        return redirect()->back();
    }
    public function CargarAlumnos(Request $request){
        $program=ProgramacionExamen::join('admision.adm_examen as ex','ex.id_examen','admision.adm_programacion_examen.id_examen')
                                          ->join('admision.adm_cupos as cu','cu.id_cupos','admision.adm_programacion_examen.id_cupos')
                                          ->join('admision.adm_aula as au','au.id_aula','admision.adm_programacion_examen.id_aula')
                                          ->join('bdsig.vw_sig_seccion_especialidad as esp','esp.codi_espe_esp','cu.codi_espe_esp')
                                          ->join('admision.adm_periodo as p','p.id_periodo','cu.id_periodo')
                                          ->where('admision.adm_programacion_examen.estado','A')
                                          ->where('admision.adm_programacion_examen.id_programacion_examen',$request->id_programacion_examen)
                                          ->select('admision.adm_programacion_examen.descripcion',
                                                   'id_programacion_examen',
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
                                                   'p.codi_secc_sec')->distinct()->first();
        $alumnosdelete=DB::table('bdsigunm.ad_postulacion as pos')
                                                   ->join('admision.adm_postulante','nume_docu_sol','nume_docu_per')
                                                   ->where('codi_espe_esp',$program->codi_espe_esp)
                                                   ->where('codi_secc_sec',$program->codi_secc_sec)
                                                   ->where('id_programacion_examen',$program->id_programacion_examen)
                                                   ->where('esta_post_pos','V')
                                                   ->where('estado','A')
                                                   ->select('pos.*')->distinct()
                                                   //->whereYear('fech_regi_aud',$program->anio)
                                                   ->get();
        $alumnosadd=DB::table('bdsigunm.ad_postulacion as pos')
                                                    ->join('admision.adm_postulante','nume_docu_sol','nume_docu_per')
                                                    ->where('codi_espe_esp',$program->codi_espe_esp)
                                                    ->where('codi_secc_sec',$program->codi_secc_sec)
                                                    ->where('esta_post_pos','V')
                                                    ->whereNotIn('nume_docu_per',$alumnosdelete->pluck("nume_docu_per")->all())
                                                    //->whereYear('fech_regi_aud',$program->anio)
                                                   ->select('pos.*')->distinct()
                                                   ->get();
        //return $alumnosdelete;
        $texto="";
        $texto=$texto."<input type='text' value='$request->id_programacion_examen' id='id_programacion_examenA' name='id_programacion_examen' style='display: none'>";
        $texto=$texto.'<div class="col-5">'.'<select class="multi form-control"  multiple="multiple" size="10"  name="nume_docu_sol[]" id="nume_docu_sol">';
        foreach ($alumnosadd as $key => $alm) {
            $texto=$texto."<option value='$alm->nume_docu_per'> $alm->nomb_pers_per $alm->apel_pate_per $alm->apel_mate_per</option>";
        }
        $texto=$texto."</select>"."</div>
                    <div class='col' style='font-size: 50px;'>
                    <div class='row flex-center'><button style='background-color:green;border-radius: 100%;'><i class='fas fa-arrow-circle-right'></i></button></div>
                    <div class='row flex-center'><button style='background-color:red;border-radius: 100%;' class='button'><i class='fas fa-arrow-circle-left'></i></button></div></div>
                    <div class='col-5'><select class='multi form-control'  multiple='multiple' size='10'  name='alumnodelete[]' id='alumnodelete'>";
        foreach ($alumnosdelete as $key => $alm) {
            $texto=$texto."<option value='$alm->nume_docu_per'> $alm->nomb_pers_per $alm->apel_pate_per $alm->apel_mate_per</option>";
        }
        $texto=$texto."</select>"."</div>";
        //return "hola";


       return $texto;
    }
    public function delete(Request $request){
        $program=ProgramacionExamen::find($request->id_programacion_examen);
        try {
            DB::beginTransaction();
            $program->estado='E';
            $program->user_actu=Auth::user()->id;
            $program->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
        return redirect()->back();
    }
}
