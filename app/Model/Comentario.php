<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table='admision.adm_comentarios';
    protected $primaryKey = 'id_comentario';
    public $timestamps = false;
    protected $fillable = [
        'id_comentario',
        'id_jurado_postulante',
        'comentario',
    ];
}
