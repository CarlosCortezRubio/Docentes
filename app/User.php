<?php

namespace App;

use App\Model\DetalleUsuario;
use App\Model\TipoUsuario;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\CustomModel;

class User extends Authenticatable
{
    use Notifiable;
    use CustomModel;

    protected $table ='admision.adm_usuario';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','ndocumento', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
                                ->select('id_tipo_usuario','codi_secc_sec')->first();
        $secc= DB::table('bdsig.vw_sig_seccion as sec')->where('sec.codi_secc_sec',$user_det->codi_secc_sec)->first();
        $tipo=TipoUsuario::where('id_tipo_usuario',$user_det->id_tipo_usuario)->first()->descripcion;

        if($tipo){
            $desc=$tipo;
            if($secc){
                $desc=$desc.' ('.$secc->abre_secc_sec.')';
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
