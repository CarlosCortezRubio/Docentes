<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table='admision.adm_asistencia';
    protected $primaryKey = 'id_asistencia';
    public $timestamps = true;
    protected $fillable = [
        'codi_pers_per',
        'tipo',
        'entrada',
        'salida',
        'fecha_asistencia',
        'created_at',
        'updated_at',
        'estado',
    ];
    protected $date =[
        'entrada',
        'salida',
        'fecha_asistencia',
        'created_at',
        'updated_at',
    ];
}
