<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cupos extends Model
{
    protected $table='admision.adm_cupos';
    protected $primaryKey = 'id_cupos';
    public $timestamps = true;
    protected $fillable = [
        'cant_cupo',
        'observacion',
        'created_at',
        'updated_at',
        'estado',
        'id_periodo',
        'user_regi',
        'user_actu',
    ];
    protected $dates=[
        'created_at',
        'updated_at'
    ];
}
