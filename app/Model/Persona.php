<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='bdsig.persona';

	protected $primaryKey='codi_pers_per';
	protected $keyType='string';
	public $incrementing=true;

	public $timestamps=false;

	protected $fillable=[
		'codi_matr_per',
		'apel_pate_per',
		'apel_mate_per',
		'nomb_pers_per',
		'nomb_comp_per',
		'tipo_docu_per',
		'nume_docu_per',
		'nruc_pers_per',
		'flag_alum_per',
		'flag_acti_per',
		'ubig_domi_per',
		'dire_domi_per',
		'telf_domi_per',
		'telf_emer_per',
		'mail_pers_per',
		'ubig_naci_per',
		'tipo_pers_per',
		'zona_domi_per',
		'gene_pers_per',
		'codi_ocup_per',
		'repr_apod_per',
		'ndni_reap_per',
		'foto_pers_per'
	];

	protected $dates=[
		'fech_naci_per'
	];
}
