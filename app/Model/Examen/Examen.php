<?php

namespace App\Model\Examen;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table='admision.adm_examen';
    protected $primaryKey = 'id_examen';
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'descripcion',
        'nota_apro',
        'nota_maxi',
        'estado',
        'user_regi',
        'user_actu',
        'id_tipo_examen'
    ];
    protected $dates=[
        'created_at',
        'updated_at'
    ];
}
