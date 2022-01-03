<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table='admision.adm_nota_jurado';
    protected $primaryKey = 'id_notajurado';
    public $timestamps = false;
    protected $fillable = [
        'id_notajurado',
        'id_jurado_postulante',
        'id_seccion_examen',
        'nota',
    ];
}
