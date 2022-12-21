<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    public function index(Request $request){
        return view('Asistencia\index', ['busqueda' => $request]);
    }

    public function CargarDocentes()
    {
        $docentes= DB::table('admision.adm_asistencia as ju')
            ->join('bdsig.persona as pe', 'pe.codi_pers_per', 'ju.codi_pers_per')
            ->whereIn('ju.estado',['S','E'])
            ->where('ju.tipo','DO')
            ->where('ju.fecha_asistencia',date('Y-m-d')." 00:00:00")
            ->select('pe.codi_pers_per','pe.nomb_comp_per','pe.nume_docu_per','ju.entrada','ju.salida')->get();
        $resultado='';
        foreach ($docentes as $dock => $docv) {
            $resultado=$resultado." <tr>
                                        <td>$docv->nomb_comp_per</td>
                                        <td>$docv->nume_docu_per</td>
                                        <td>$docv->entrada</td>
                                        <td>$docv->salida</td>
                                        <td></td>
                                    </tr>";
            //$resultado=$resultado."";
        }
        return $resultado;
    }
}
