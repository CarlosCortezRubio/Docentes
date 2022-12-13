<?php

use App\Model\Aula;
use App\Model\DetalleUsuario;
use App\Model\Examen\Examen;
use App\Model\Periodo;
use App\Model\TipoUsuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as DB;

if (! function_exists('getSeccion')) {
    function getSeccion() {
        if(Auth::check()){
            $usuario= DetalleUsuario::where('id_usuario',Auth::user()->id)->first();
            if($usuario->id_seccion){
                $seccion=DB::table('bdsig.vw_sig_seccion as sec')
                ->join('admision.adm_seccion_estudios as asec','sec.codi_secc_sec','asec.codi_secc_sec')
                ->where('id_seccion',$usuario->id_seccion)->select('abre_secc_sec')->first()->abre_secc_sec;
                return $seccion;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
}
if (! function_exists('getCodSeccion')) {
    function getCodSeccion() {
        if(Auth::check()){
            $usuario= DetalleUsuario::where('id_usuario',Auth::user()->id)->first();
            return DB::table('admision.adm_seccion_estudios')->where('id_seccion',$usuario->id_seccion)->first()->codi_secc_sec ;
        }else{
            return null;
        }
    }
}
if (! function_exists('getIdSeccion')) {
    function getIdSeccion() {
        if(Auth::check()){
            $usuario= DetalleUsuario::where('id_usuario',Auth::user()->id)->first();
            return $usuario->id_seccion;
        }else{
            return null;
        }
    }
}

if (! function_exists('getTipoUsuario')) {
    function getTipoUsuario() {
        if(Auth::check()){
            $usuario= DetalleUsuario::where('id_usuario',Auth::user()->id)->first();
            $tipousuario= TipoUsuario::where('id_tipo_usuario',$usuario->id_tipo_usuario)->first();
            return $tipousuario->descripcion;
        }else{
            return null;
        }
    }
}
if (! function_exists('getImagen')) {
    function getImagen() {
        if(Auth::check()){
            $usuario= DetalleUsuario::where('id_usuario',Auth::user()->id)->first();
            if ($usuario->imagen) {
                return $usuario->imagen;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
}

if (! function_exists('is_admin_secc')) {
    function is_admin_secc() {
        if(Auth::check()){
            $usuario= DetalleUsuario::where('id_usuario',Auth::user()->id)->first();
            $tipo= TipoUsuario::find($usuario->id_tipo_usuario)->descripcion;
            if ($tipo=='Administrador' && $usuario->id_seccion) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

if (! function_exists('is_admin')) {
    function is_admin() {
        if(Auth::check()){
            $usuario= DetalleUsuario::where('id_usuario',Auth::user()->id)->first();
            $tipo= TipoUsuario::find($usuario->id_tipo_usuario)->descripcion;
            if ($tipo=='Administrador' && !$usuario->id_seccion) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
if (! function_exists('getAulas')) {
    function getAulas() {
        $aulas = Aula::where("estado", "A")->get();
        return $aulas;
    }
}
if (! function_exists('getSecciones')) {
    function getSecciones() {
        $secciones = DB::table('bdsig.vw_sig_seccion as sec')
            ->join('admision.adm_seccion_estudios as asec', 'asec.codi_secc_sec', 'sec.codi_secc_sec')
            ->select('sec.abre_secc_sec', 'asec.*')
            ->where('asec.estado', 'A')
            ->get();
        return $secciones;
    }
}
if (! function_exists('getAnios')) {
    function getAnios() {
        $anioexist = DB::table('admision.adm_periodo as pe')->distinct('anio')->get();
        return $anioexist;
    }
}
if (! function_exists('getProgramas')) {
    function getProgramas() {
        $programas = DB::table('bdsig.vw_sig_seccion_especialidad');
        if (getSeccion()) {
            $programas = $programas->where('codi_secc_sec', getCodSeccion())->get();
        } else if (getTipoUsuario() == 'Administrador') {

            $programas = $programas->distinct('codi_espe_esp')->get();
        }
        return $programas;
    }
}
if (! function_exists('getPeriodos')) {
    function getPeriodos() {
        $periodos = Periodo::join('admision.adm_seccion_estudios as asec', 'asec.id_seccion', 'admision.adm_periodo.id_seccion')
        ->join('bdsig.vw_sig_seccion as sec', 'sec.codi_secc_sec', 'asec.codi_secc_sec')
        ->select('admision.adm_periodo.*', 'sec.*', 'asec.categoria')
        ->where('asec.estado', 'A')
        ->where('admision.adm_periodo.estado', 'A');
        if (getSeccion()) {
            $periodos = $periodos->where('asec.id_seccion', getIdSeccion())->get();
        } else if (getTipoUsuario() == 'Administrador') {

            $periodos = $periodos->get();
        }
        return $periodos;
    }
}
if (! function_exists('getExamenes')) {
    function getExamenes() {
        $examenes = Examen::join('admision.adm_examen_admision as exd', 'exd.id_examen', 'admision.adm_examen.id_examen')
            ->join('admision.adm_seccion_estudios as asec', 'asec.id_seccion', 'exd.id_seccion')
            ->join('bdsig.ttablas_det as t', 'asec.codi_secc_sec', 't.codi_tabl_det')
            ->where('admision.adm_examen.estado', 'A')
            ->where('asec.estado', 'A')
            ->select('exd.id_examen', 'nombre', 'asec.id_seccion', 'abre_tabl_det', 'asec.codi_secc_sec');
        if (getSeccion()) {
            $examenes = $examenes->where('asec.id_seccion', getIdSeccion())->get();
        } else if (getTipoUsuario() == 'Administrador') {
            $examenes = $examenes->get();
        }
        return $examenes;
    }
}
if (! function_exists('getExamenesJurado')) {
    function getExamenesJurado() {
        $examenes = Examen::join('admision.adm_examen_admision as exd', 'exd.id_examen', 'admision.adm_examen.id_examen')
            ->join('admision.adm_seccion_estudios as asec', 'asec.id_seccion', 'exd.id_seccion')
            ->join('bdsig.ttablas_det as t', 'asec.codi_secc_sec', 't.codi_tabl_det')
            ->where('admision.adm_examen.estado', 'A')
            ->where('asec.estado', 'A')
            ->where('exd.flag_jura', 'S')
            ->select('exd.id_examen', 'nombre', 'asec.id_seccion', 'abre_tabl_det', 'asec.codi_secc_sec');
        if (getSeccion()) {
            $examenes = $examenes->where('asec.id_seccion', getIdSeccion())->get();
        } else if (getTipoUsuario() == 'Administrador') {
            $examenes = $examenes->get();
        }
        return $examenes;
    }
}
if (! function_exists('getExamenesTeoricos')) {
    function getExamenesTeoricos() {
        $examenes = Examen::join('admision.adm_examen_admision as exd', 'exd.id_examen', 'admision.adm_examen.id_examen')
            ->join('admision.adm_seccion_estudios as asec', 'asec.id_seccion', 'exd.id_seccion')
            ->join('bdsig.ttablas_det as t', 'asec.codi_secc_sec', 't.codi_tabl_det')
            ->where('admision.adm_examen.estado', 'A')
            ->where('asec.estado', 'A')
            ->where('exd.flag_jura', 'N')
            ->select('exd.id_examen', 'nombre', 'asec.id_seccion', 'abre_tabl_det', 'asec.codi_secc_sec');
        if (getSeccion()) {
            $examenes = $examenes->where('asec.id_seccion', getIdSeccion())->get();
        } else if (getTipoUsuario() == 'Administrador') {
            $examenes = $examenes->get();
        }
        return $examenes;
    }
}
