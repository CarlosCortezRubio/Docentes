<?php

namespace App\Http\Controllers;

use App\Model\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\Components\Form\Select;

class ReporteController extends Controller
{
    public function notafinal()
    {
        $reporte = DB::table('admision.adm_postulante', 'ap')
            ->join('admision.adm_programacion_examen as pr', 'pr.id_programacion_examen', 'ap.id_programacion_examen')
            ->join('admision.adm_examen as e', 'e.id_examen', 'pr.id_examen')
            ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'e.id_examen')
            ->join('bdsig.persona as p', 'p.nume_docu_per', 'ap.nume_docu_sol')
            ->join('bdsigunm.ad_postulacion as po', 'po.nume_docu_per', 'ap.nume_docu_sol')
            ->join('bdsig.ttablas_det as tt', 'tt.codi_tabl_det', 'po.codi_espe_esp')
            ->join('bdsigunm.ad_proceso as pro', 'po.codi_proc_adm', 'pro.codi_proc_adm')
            ->whereIn('ap.estado', ['E', 'P'])
            ->where('pro.esta_proc_adm', 'V')
            ->where('po.esta_post_pos', 'V');

        $especialidad = $reporte->select('tt.abre_tabl_det as  especialidad', DB::raw('count(tt.abre_tabl_det)'))
            ->groupBy('tt.abre_tabl_det')
            ->get();
        $postulantes = $reporte->select(
            'p.nomb_comp_per as nombre',
            DB::raw('count(p.nomb_comp_per)'),
            DB::raw('ROUND(sum(ap.nota*(ea.peso/100)),2) as final')
        )
            ->groupBy('p.nomb_comp_per')
            ->get();
        $reporte = $reporte->select(
            'tt.abre_tabl_det as  especialidad',
            'p.nomb_comp_per as nombre',
            'pr.descripcion as examen',
            'ap.nota as nota',
            'ea.peso'
        )
            ->orderByDesc('tt.abre_tabl_det', 'p.nomb_comp_per', 'pr.descripcion', 'ap.nota')
            ->groupBy("pr.descripcion", 'ap.nota', 'ea.peso')->get();

        return view('Reportes.Notas.notafinal', ["reporte" => $reporte, "especialidad" => $especialidad, "postulantes" => $postulantes]);
    }
    public function notarubrica()
    {
        $reporte = Nota::all();
        return view('Reportes.Notas.notarubrica', ["reporte" => $reporte]);
    }
    public function notaconocimiento()
    {
        $reporte = Nota::all();
        return view('Reportes.Notas.notaconocimiento', ["reporte" => $reporte]);
    }
    public function DetalleJurado(Request $request)
    {
        return view('Reportes.DetalleJurado', ['busqueda' => $request]);
    }
    public function CargarNotas(Request $request)
    {
        $examenes = DB::table('admision.adm_examen', 'ex')
            ->select(
                'ex.id_examen',
                'ex.nombre',
                'pr.id_programacion_examen'
            )
            ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
            ->join('admision.adm_programacion_examen as pr', 'pr.id_examen', 'ex.id_examen')
            ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
            ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
            ->where('ea.flag_jura', 'S')
            ->where('ex.estado', 'A')
            ->where('pr.estado', 'A')
            ->where('cu.estado', 'A')
            ->where('per.id_seccion','like' ,$request->seccion)
            ->where('per.anio', $request->anio)
            ->where('ex.id_examen','like', $request->examen)
            ->orderBy('ex.nombre')->get();

        $resultado = "";
        foreach ($examenes as $kexamen => $vexamen) {

            $indexju = DB::table('admision.adm_examen', 'ex')
                ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
                ->join('admision.adm_programacion_examen as pr', 'pr.id_examen', 'ex.id_examen')
                ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
                ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
                ->join('admision.adm_jurado as ju', 'ju.id_programacion_examen', 'pr.id_programacion_examen')
                ->join('bdsig.persona as pe', 'pe.codi_pers_per', 'ju.codi_doce_per')
                ->where('ju.estado', 'A')
                ->where('ea.flag_jura', 'S')
                ->where('ex.estado', 'A')
                ->where('pr.estado', 'A')
                ->where('cu.estado', 'A')
                ->where('per.id_seccion','like', $request->seccion)
                ->where('per.anio', $request->anio)
                ->where('pr.id_programacion_examen', $vexamen->id_programacion_examen)
                ->orderBy('pe.nomb_comp_per')
                ->select(
                    'pe.nomb_comp_per',
                    'ju.id_programacion_examen',
                    'ju.id_jurado'
                )->get();
            $indexpar = DB::table('admision.adm_examen', 'ex')
                ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
                ->join('admision.adm_seccion_examen as par', 'ea.id_examen', 'par.id_examen')
                ->select(
                    'par.id_examen',
                    'par.descripcion',
                    'par.porcentaje',
                    'par.id_seccion_examen'
                )
                ->where('ea.flag_jura', 'S')
                ->where('ex.estado', 'A')
                ->where('par.estado', 'A')
                ->where('par.id_examen','like', $vexamen->id_examen)
                ->orderBy('par.descripcion')->get();
            $indexal = DB::table('admision.adm_examen', 'ex')
                ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
                ->join('admision.adm_programacion_examen as pr', 'pr.id_examen', 'ex.id_examen')
                ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
                ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
                ->join('admision.adm_postulante as pos', 'pos.id_programacion_examen', 'pr.id_programacion_examen')
                ->join('bdsig.persona as pe', 'pe.nume_docu_per', 'pos.nume_docu_sol')
                ->whereIn('pos.estado', ['E', 'P'])
                ->where('ea.flag_jura', 'S')
                ->where('ex.estado', 'A')
                ->where('pr.estado', 'A')
                ->where('cu.estado', 'A')
                ->where('per.anio', $request->anio)
                ->where('per.id_seccion','like', $request->seccion)
                ->where('pr.id_programacion_examen', $vexamen->id_programacion_examen)
                ->select(
                    'pe.nomb_comp_per',
                    'pr.id_programacion_examen',
                    'pos.id_postulante'
                )->get();
            $resultado = $resultado . "<thead class='thead'><tr><th scope='col' rowspan='3'></th>
                                       <th scope='col' colspan='" . (count($indexpar) * count($indexju) + count($indexju)) . "'>$vexamen->nombre</th></tr><tr>";
            foreach ($indexju as $kjurado => $vjurado) {
                $resultado = $resultado . "<th scope='col' colspan='" . count($indexpar) . "'>$vjurado->nomb_comp_per</th>
                                               <th scope='col' rowspan='2'>Promedio</th>";
            }
            $resultado = $resultado . "</tr><tr>";
            foreach ($indexju as $kjurado => $vjurado) {
                foreach ($indexpar as $kparametro => $vparametro) {
                    $resultado = $resultado . "<th scope='col'>$vparametro->descripcion ($vparametro->porcentaje%)</th>";
                }
            }
            $resultado = $resultado . "</tr></thead><tbody style='font-size:15px'>";
            foreach ($indexal as $kalumno => $valumno) {
                $resultado = $resultado . "<tr><td>$valumno->nomb_comp_per</td>";
                foreach ($indexju as $kjurado => $vjurado) {
                    $promedio = 0;
                    foreach ($indexpar as $kparametro => $vparametro) {
                        $notas = DB::table('admision.adm_examen', 'ex')
                            ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
                            ->join('admision.adm_seccion_examen as par', 'par.id_examen', 'ex.id_examen')
                            ->join('admision.adm_nota_jurado as no', 'no.id_seccion_examen', 'par.id_seccion_examen')
                            ->join('admision.adm_jurado_postulante as jp', 'no.id_jurado_postulante', 'jp.id_jurado_postulante')
                            //->whereIn('no.estado', ['E', 'A'])
                            //->where('jp.estado', 'A')
                            //->where('ea.flag_jura', 'S')
                            //->where('ex.estado', 'A')
                            ->where('ea.id_seccion', 'like',$request->seccion)
                            ->where('par.id_seccion_examen', $vparametro->id_seccion_examen)
                            ->where('jp.id_jurado', $vjurado->id_jurado)
                            ->where('jp.id_postulante', $valumno->id_postulante)
                            ->where('ex.id_examen', $vexamen->id_examen)
                            ->select(
                                'no.id_seccion_examen',
                                'jp.id_jurado',
                                'jp.id_postulante',
                                'nota'
                            )->get();
                        foreach ($notas as $knota => $vnota) {
                            $resultado = $resultado . "<td>$vnota->nota</td>";
                            $promedio += $vnota->nota * 0.01 * $vparametro->porcentaje;
                        }
                    }
                    $resultado = $resultado . "<td>$promedio</td>";
                }
                $resultado = $resultado . "</tr>";
            }
            $resultado = $resultado . "</tbody>";
        }
        if ($resultado=="") {
            $resultado="<center>Datos no encontrados</center>";
        }
        return $resultado;
    }
}
