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
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                                                   'fecha_resol',
                                                   'minutos',
                                                   'modalidad',
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
        return view('examen.programacion',['secciones'=>$secciones,"examenes"=>$examenes,"aulas"=>$aulas,"cupos"=>$cupos,'docentes'=>$docentes,'programaciones'=>$programaciones]);
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
                $contrasena = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 8);
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
            DB::rollBack();
            dd($e);
        }
        return redirect()->back();
    }
}
