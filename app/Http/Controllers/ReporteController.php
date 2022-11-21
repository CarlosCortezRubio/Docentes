<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function NotasGenerales(Request $request)
    {
        return view('Reportes.NotasGenerales', ['busqueda' => $request]);
    }
    public function CargarNotasGenerales(Request $request)
    {
        $nivelmaximo = DB::table('admision.adm_nivelevaluacion', 'nv')
            ->where('nv.id_seccion', $request->seccion)
            ->select(DB::raw('max(nv.nivel)'))->get();
        $resultado = '';
        $eval = [];
        if (count($nivelmaximo) > 0) {
            $maxnivel = $nivelmaximo[0]->max;
            for ($index = 1; $index <= $maxnivel; $index++) {
                $niveles = DB::table('admision.adm_nivelevaluacion', 'nv')->where('nv.nivel', $index)
                    ->where('nv.id_seccion', $request->seccion)
                    ->orderBy('nv.id_up_nivel')
                    ->orderBy('nv.id_nivel')->get();
                if ($index == 1) {
                    $resultado = "<thead class='thead'><tr>
                      <th scope='col' rowspan='$maxnivel'>Nº</th>
                      <th scope='col' rowspan='$maxnivel'>APELLIDOS Y NOMBRES</th>
                      <th scope='col' rowspan='$maxnivel'>ESPECIALIDAD</th>";
                }
                foreach ($niveles as $nivelk => $nivelv) {
                    $subnivel = DB::table('admision.adm_nivelevaluacion', 'nv')->where('nv.id_up_nivel', $nivelv->id_nivel)->get();
                    if (count($subnivel) > 0) {
                        $resultado = $resultado . "<th scope='col' colspan='" . count($subnivel) . "'>$nivelv->descripcion $nivelv->porcentaje%</th>
                                             <th scope='col' rowspan='" . ($maxnivel - ($index - 1)) . "'>Promedio $nivelv->descripcion</th>";
                    } else {
                        $resultado = $resultado . "<th scope='col' rowspan='" . ($maxnivel - ($index - 1)) . "'>$nivelv->descripcion $nivelv->porcentaje%</th>";
                        $eval[] = $nivelv;
                        if (isset($niveles[$nivelk + 1])) {
                            if ($nivelv->id_up_nivel != $niveles[$nivelk + 1]->id_up_nivel) {
                                $evalindex = DB::table('admision.adm_nivelevaluacion', 'nv')->where('nv.id_nivel', $nivelv->id_up_nivel)->get();
                                foreach ($evalindex as $evalindexk => $evalindexv) {
                                    $eval[] = $evalindexv;
                                }
                            }
                        } else {
                            $evalindex = DB::table('admision.adm_nivelevaluacion', 'nv')->where('nv.id_nivel', $nivelv->id_up_nivel)->get();
                            foreach ($evalindex as $evalindexk => $evalindexv) {
                                $eval[] = $evalindexv;
                            }
                        }
                    }
                }
                if ($index == 1) {
                    $resultado = $resultado . "<th scope='col' rowspan='$maxnivel'>Promedio 100%</th></tr>";
                } else {
                    $resultado = $resultado . "</tr>";
                }
            }
            $resultado = $resultado . "</thead><tbody>";

            $alumnos = DB::table('admision.adm_programacion_examen', 'pr')
                ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
                ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
                ->join('admision.adm_postulante as pos', 'pos.id_programacion_examen', 'pr.id_programacion_examen')
                ->join('bdsig.persona as pe', 'pe.nume_docu_per', 'pos.nume_docu_sol')
                ->join('bdsig.ttablas_det as t', 'cu.codi_espe_esp', 't.codi_tabl_det')
                ->whereIn('pos.estado', ['E', 'P', 'I'])
                ->where('pr.estado', 'A')
                ->where('cu.estado', 'A')
                ->where('per.anio', $request->anio)
                ->where('per.id_seccion', 'like', $request->seccion)
                ->select(
                    'pe.nomb_comp_per',
                    't.abre_tabl_det',
                    'pos.nume_docu_sol'
                )->distinct()->orderBy('t.abre_tabl_det')->get();
            foreach ($alumnos as $alumnok => $alumnov) {
                $resultado = $resultado . " <tr>
                                                <td>" . ($alumnok + 1) . "</td>
                                                <td>$alumnov->nomb_comp_per</td>
                                                <td>$alumnov->abre_tabl_det</td>";
                $promedio=0;
                $subpromedio = 0;
                foreach ($eval as $evalk => $evalv) {
                    $nota = DB::table('admision.adm_examen_admision', 'ea')
                        ->join('admision.adm_programacion_examen as pr', 'pr.id_examen', 'ea.id_examen')
                        ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
                        ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
                        ->join('admision.adm_postulante as po', 'po.id_programacion_examen', 'pr.id_programacion_examen')
                        ->whereIn('po.estado', ['E', 'P'])
                        ->where('pr.estado', 'A')
                        ->where('cu.estado', 'A')
                        ->where('po.nume_docu_sol', $alumnov->nume_docu_sol)
                        ->where('ea.id_nivel', $evalv->id_nivel)
                        ->where('per.anio', $request->anio)
                        ->where('per.id_seccion', 'like', $request->seccion)
                        ->select('po.nota')
                        ->first();
                    if (isset($nota)) {
                        $resultado = $resultado . "<td>$nota->nota</td>";
                        $subpromedio = $subpromedio + ($nota->nota * ($evalv->porcentaje * 0.01));
                        $promedio = $promedio + ($nota->nota * ($evalv->porcentaje * 0.01));
                    } else {
                        $subnivel = DB::table('admision.adm_nivelevaluacion', 'nv')->where('nv.id_up_nivel', $evalv->id_nivel)->get();
                        if (count($subnivel) > 0) {
                            $resultado = $resultado . "<td>" . number_format($subpromedio, 2) . "</td>";
                            $subpromedio = 0;
                        } else {
                            $resultado = $resultado . "<td></td>";
                            $subpromedio = $subpromedio + (0 * ($evalv->porcentaje * 0.01));
                        }
                    }
                }
                $resultado = $resultado . "<td>" . number_format($promedio, 2) . "</td>";
                $resultado = $resultado . "</tr>";
            }
            $resultado = $resultado . "</tbody>";
        }
        return $resultado;
    }
    public function DetalleJurado(Request $request)
    {
        return view('Reportes.DetalleJurado', ['busqueda' => $request]);
    }
    public function CargarNotasJurado(Request $request)
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
            ->where('per.id_seccion', 'like', $request->seccion)
            ->where('per.anio', $request->anio)
            ->where('ex.id_examen', 'like', $request->examen)
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
                ->where('per.id_seccion', 'like', $request->seccion)
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
                ->where('par.id_examen', 'like', $vexamen->id_examen)
                ->orderBy('par.descripcion')->get();
            $indexal = DB::table('admision.adm_examen', 'ex')
                ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
                ->join('admision.adm_programacion_examen as pr', 'pr.id_examen', 'ex.id_examen')
                ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
                ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
                ->join('admision.adm_postulante as pos', 'pos.id_programacion_examen', 'pr.id_programacion_examen')
                ->join('bdsig.persona as pe', 'pe.nume_docu_per', 'pos.nume_docu_sol')
                ->whereIn('pos.estado', ['E', 'P', 'I'])
                ->where('ea.flag_jura', 'S')
                ->where('ex.estado', 'A')
                ->where('pr.estado', 'A')
                ->where('cu.estado', 'A')
                ->where('per.anio', $request->anio)
                ->where('per.id_seccion', 'like', $request->seccion)
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
                            ->whereIn('jp.estado', ['N', 'A'])
                            //->where('ea.flag_jura', 'S')
                            //->where('ex.estado', 'A')
                            ->where('ea.id_seccion', 'like', $request->seccion)
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
        if ($resultado == "") {
            $resultado = "<center>Datos no encontrados</center>";
        }
        return $resultado;
    }
}
