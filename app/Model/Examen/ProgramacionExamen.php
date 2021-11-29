<?php

namespace App\Model\Examen;

use Illuminate\Database\Eloquent\Model;

class ProgramacionExamen extends Model
{
    protected $table='admision.adm_programacion_examen';
    protected $primaryKey = 'id_programacion_examen';
    public $timestamps = true;
    protected $fillable = [
        'descripcion',
        'fecha_resol',
        'minutos',
        'modalidad',
        'estado',
        'user_regi',
        'user_actu',
        'id_aula',
        'id_examen',
        'codi_doce_per'
    ];
    protected $dates=[
        'created_at',
        'updated_at'
    ];
}
