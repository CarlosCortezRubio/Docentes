<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jurado extends Model
{
    protected $table='admision.adm_jurado';
    protected $primaryKey = 'id_jurado';
    public $timestamps = false;
    protected $fillable = [
        'id_programacion_examen',
        'codi_doce_per',
        'estado',
    ];
}
