<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DetalleUsuario extends Model
{
    protected $table='admision.detalle_usuarios';
    protected $primaryKey = 'idusuario_det';
    public $timestamps = true;
    protected $fillable = [
        'created_at',
        'updated_at',
        'ultimo_inicio',
        'estado',
        'id_seccion',
        'id_usuario',
        'imagen'
    ];
    protected $dates=[
        'created_at',
        'updated_at',
        'ultimo_inicio',
     ];

}
