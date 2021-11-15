<?php

namespace App\Model\Examen;

use Illuminate\Database\Eloquent\Model;

class DetalleExamen extends Model
{
    protected $table='admision.adm_examen_admision';
    protected $primaryKey = 'id_examen_admision';
    public $timestamps = false;
    protected $fillable = [
        'cara_elim',
        'flag_jura',
        'codi_secc_sec',
        'id_examen'
    ];
}
