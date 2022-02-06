<?php

namespace App\Http\Controllers;

use App\Model\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function notafinal(){
        $reporte=DB::table('admision.adm_postulante','ap')
        ->join('admision.adm_programacion_examen as pr','pr.id_programacion_examen','ap.id_programacion_examen')
        ->join('admision.adm_examen as e','e.id_examen','pr.id_examen')
        ->join('admision.adm_examen_admision as ea','ea.id_examen','e.id_examen')
        ->join('bdsig.persona as p','p.nume_docu_per','ap.nume_docu_sol')
        ->join('bdsigunm.ad_postulacion as po','po.nume_docu_per','ap.nume_docu_sol')
        ->join('bdsig.ttablas_det as tt','tt.codi_tabl_det','po.codi_espe_esp')
        ->join('bdsigunm.ad_proceso as pro','po.codi_proc_adm','pro.codi_proc_adm')
        ->whereIn('ap.estado',['E','P'])
        ->where('pro.esta_proc_adm','V')
        ->where('po.esta_post_pos','V');
        
        $especialidad=$reporte->select('tt.abre_tabl_det as  especialidad', DB::raw('count(tt.abre_tabl_det)'))
                              ->groupBy('tt.abre_tabl_det')
                              ->get();
        $postulantes=$reporte->select('p.nomb_comp_per as nombre', 
                                      DB::raw('count(p.nomb_comp_per)'),
                                      DB::raw('ROUND(sum(ap.nota*(ea.peso/100)),2) as final'))
                             ->groupBy('p.nomb_comp_per')
                             ->get();
        $reporte=$reporte->select('tt.abre_tabl_det as  especialidad',
                                    'p.nomb_comp_per as nombre', 
                                    'pr.descripcion as examen',
                                    'ap.nota as nota',
                                    'ea.peso')
                            ->orderByDesc('tt.abre_tabl_det','p.nomb_comp_per','pr.descripcion','ap.nota')
                            ->groupBy("pr.descripcion",'ap.nota','ea.peso')->get();
        
        return view('Reportes.Notas.notafinal',["reporte"=>$reporte,"especialidad"=>$especialidad,"postulantes"=>$postulantes]);
    }
    public function notarubrica(){
        $reporte=Nota::all();
        return view('Reportes.Notas.notarubrica',["reporte"=>$reporte]);
    }
    public function notaconocimiento(){
        $reporte=Nota::all();
        return view('Reportes.Notas.notaconocimiento',["reporte"=>$reporte]);
    }
}
