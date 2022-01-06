<?php

use App\Model\DetalleUsuario;
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
