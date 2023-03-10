<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table='admision.adm_periodo';
    protected $primaryKey = 'id_periodo';
    public $timestamps = true;
    protected $fillable = [
        'anio',
        'peri_insc_inic',
        'peri_insc_fin',
        'peri_eval_inic',
        'peri_eval_fin',
        'created_at',
        'updated_at',
        'user_regi',
        'user_actu',
        'id_seccion',

    ];
    protected $dates=[
        'peri_insc_inic',
        'peri_insc_fin',
        'peri_eval_inic',
        'peri_eval_fin',
        'created_at',
        'updated_at',
        'peri_show_inic',
        'peri_show_fin'
    ];


}
