<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table='admision.adm_aula';
    protected $primaryKey = 'id_aula';
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'nombre',
        'estado',
    ];
}
