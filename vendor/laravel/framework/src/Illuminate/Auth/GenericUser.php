<?php

namespace Illuminate\Auth;

use App\Model\DetalleUsuario;
use App\Model\TipoUsuario;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GenericUser implements UserContract
{
    /**
     * All of the user's attributes.
     *
     * @var array
     */
    protected $attributes;

    /**
     * Create a new generic User object.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->attributes[$this->getAuthIdentifierName()];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    /**
     * Get the "remember me" token value.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->attributes[$this->getRememberTokenName()];
    }

    /**
     * Set the "remember me" token value.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->attributes[$this->getRememberTokenName()] = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Dynamically access the user's attributes.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->attributes[$key];
    }

    /**
     * Dynamically set an attribute on the user.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Dynamically check if a value is set on the user.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Dynamically unset a value on the user.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }



    //codigo personalizado adminlte
    public function adminlte_image(){
        $user=Auth::user()->id;
        $user_det=DetalleUsuario::where('id_usuario',$user)->first();
        if(!$user_det->imagen){
            return 'img/user.png';
        }else{
            return 'img/'.$user_det->imagen;
        }
    }
    public function adminlte_desc(){
        $user=Auth::user()->id;
        $user_det=DetalleUsuario::where('id_usuario',$user)
                                ->select('id_tipo_usuario','id_seccion')->first();
        $secc=DB::table('bdsig.vw_sig_seccion as sec')
                 ->join('admision.adm_seccion_estudios as asec','sec.codi_secc_sec','asec.codi_secc_sec')
                 ->where('asec.id_seccion',$user_det->id_seccion)
                 ->select('sec.*','asec.categoria')->first();
        $tipo=TipoUsuario::where('id_tipo_usuario',$user_det->id_tipo_usuario)->first()->descripcion;
        
        if($tipo){
            $desc=$tipo;
            if($secc){
                $desc=$desc.' ('.$secc->abre_secc_sec;
                if($secc->categoria){
                    $desc=$desc.' - '.$secc->categoria;
                }
                $desc=$desc.')';
            }


        }else{
            $desc= '';
        }
        return $desc;
    }
    public function adminlte_profile_url(){
        return 'perfilurl';
    }
}
