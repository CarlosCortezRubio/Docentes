<?php

namespace App\Model\Examen;

use Illuminate\Database\Eloquent\Model;

class SeccionExamen extends Model
{
    protected $table='admision.adm_seccion_examen';
    protected $primaryKey = 'id_seccion_examen';
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'porcentaje',
        'estado',
        'id_examen',
    ];
}
