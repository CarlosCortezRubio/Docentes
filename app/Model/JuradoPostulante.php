<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JuradoPostulante extends Model
{
    protected $table='admision.adm_jurado_postulante';
    protected $primaryKey = 'id_jurado_postulante';
    public $timestamps = false;
    protected $fillable = [
        'id_jurado_postulante',
        'id_jurado',
        'id_postulante',
        'estado',
    ];
}
