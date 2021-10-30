<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table='admision.tipo_usuarios';
    protected $primaryKey = 'id_tipo_usuario';
    public $timestamps = true;
    protected $fillable = [
        'descripcion',
        'estado', 
        'created_at', 
        'updated_at',
    ];
    protected $dates=[
        'created_at',
        'updated_at',
     ];
}
