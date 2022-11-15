<?php

namespace App\Model\Examen;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    protected $table='admision.adm_audiostmp';
    protected $primaryKey = 'id_audio';
    public $timestamps = false;
    protected $fillable = [
        'id_examen_postulante',
        'archivo',
        'estado',
        'contador'
    ];
}
