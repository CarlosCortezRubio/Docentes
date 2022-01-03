<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamenPostulante extends Model
{
    protected $table = 'admision.adm_Examen_Postulante';
    protected $primaryKey = 'id_examen_postulante';

    public $timestamps = false;

    protected $fillable = [
        'id_postulante',
        'minutos',
        'segundos',
        'estado',
    ];
}
