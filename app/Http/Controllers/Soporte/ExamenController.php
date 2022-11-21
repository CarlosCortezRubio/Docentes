<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use App\Model\Examen\Audio;
use App\Model\ExamenPostulante;
use App\Model\Nota;
use App\Model\Postulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function index(Request $request)
    {
        $alumnos = DB::table('admision.adm_postulante', 'pos')
            ->join('admision.adm_programacion_examen as pr', 'pr.id_programacion_examen', 'pos.id_programacion_examen')
            ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
            ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
            ->join('bdsig.persona as pe', 'pe.nume_docu_per', 'pos.nume_docu_sol')
            ->join('bdsig.ttablas_det as esp', 'esp.codi_tabl_det', 'cu.codi_espe_esp')
            ->where('pr.estado', 'A')
            ->where('cu.estado', 'A')
            ->where('per.estado', 'A')
            ->whereIn('pos.estado', ['E', 'P'])
            ->select('pe.nomb_comp_per', 'pe.nume_docu_per', 'esp.desc_tabl_det')
            ->distinct();

        if ($request->seccion) {
            $alumnos = $alumnos->where('per.id_seccion', 'like', $request->seccion);
        }
        if ($request->codi_espe_esp) {
            $alumnos = $alumnos->where('esp.codi_tabl_det', 'like', $request->codi_espe_esp);
        }
        $alumnos = $alumnos->get();
        return view('Soporte\Examenes', ['alumnos' => $alumnos, 'busqueda' => $request]);
    }

    public function cargarExamenJurado(Request $request)
    {
        $examenes = DB::table('admision.adm_postulante', 'pos')
            ->join('admision.adm_programacion_examen as pr', 'pr.id_programacion_examen', 'pos.id_programacion_examen')
            ->join('admision.adm_examen as ex', 'ex.id_examen', 'pr.id_examen')
            ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
            ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
            ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
            ->where('ea.flag_jura', 'S')
            ->where('pr.estado', 'A')
            ->where('cu.estado', 'A')
            ->where('ex.estado', 'A')
            ->where('per.estado', 'A')
            ->whereIn('pos.estado', ['E', 'P'])
            ->where('pos.nume_docu_sol', $request->nume_docu_per)
            ->select('pr.id_programacion_examen', 'ex.id_examen', 'ex.nombre')
            ->get();
        $resultado = '<table class="table table-bordered" style="text-align:center;">';
        foreach ($examenes as $key => $examen) {
            $jurados = DB::table('admision.adm_jurado', 'ju')
                ->join('bdsig.persona as pe', 'pe.codi_pers_per', 'ju.codi_doce_per')
                ->join('admision.adm_programacion_examen as pr', 'pr.id_programacion_examen', 'ju.id_programacion_examen')
                ->join('admision.adm_postulante as pos', 'pr.id_programacion_examen', 'pos.id_programacion_examen')
                ->join('admision.adm_jurado_postulante as jp', function ($query) {
                    $query->on('jp.id_jurado', 'ju.id_jurado')
                        ->on('jp.id_postulante', 'pos.id_postulante');
                })
                ->join('admision.adm_nota_jurado as nj', 'jp.id_jurado_postulante', 'nj.id_jurado_postulante')
                ->where('ju.id_programacion_examen', $examen->id_programacion_examen)
                ->where('ju.estado', 'A')
                ->where('pr.estado', 'A')
                ->where('pr.id_programacion_examen', $examen->id_programacion_examen)
                ->where('pos.nume_docu_sol', $request->nume_docu_per)
                ->whereIn('jp.estado', ['N', 'A'])
                ->whereIn('pos.estado', ['E', 'P'])
                ->whereIn('nj.estado', ['E', 'A', 'N'])
                ->distinct()
                ->select('pe.nomb_comp_per', 'ju.id_jurado')->get();
            $resultado = $resultado . "<colgroup  span='4'><thead class='thead'>
                                        <tr>
                                            <th scope='col' colspan='4'>$examen->nombre</th>
                                        </tr>
                                        <tr>
                                            <th scope='col'>Jurados</th>
                                            <th scope='col'>Parametros</th>
                                            <th scope='col'>Notas</th>
                                            <th scope='col'>Acciones</th>
                                        </tr>
                                    </thead><tbody>";
            foreach ($jurados as $key => $jurado) {
                $parametros = DB::table('admision.adm_seccion_examen', 'sec')
                    ->join('admision.adm_programacion_examen as pr', 'pr.id_examen', 'sec.id_examen')
                    ->join('admision.adm_postulante as pos', 'pr.id_programacion_examen', 'pos.id_programacion_examen')
                    ->join('admision.adm_jurado as ju', 'pr.id_programacion_examen', 'ju.id_programacion_examen')
                    ->join('admision.adm_jurado_postulante as jp', function ($query) {
                        $query->on('jp.id_jurado', 'ju.id_jurado')
                            ->on('jp.id_postulante', 'pos.id_postulante');
                    })
                    ->join('admision.adm_nota_jurado as nj', function ($query) {
                        $query->on('jp.id_jurado_postulante', 'nj.id_jurado_postulante')
                            ->on('nj.id_seccion_examen', 'sec.id_seccion_examen');
                    })

                    ->where('sec.id_examen', $examen->id_examen)
                    ->where('pr.id_programacion_examen', $examen->id_programacion_examen)
                    ->where('jp.id_jurado', $jurado->id_jurado)
                    ->where('pos.nume_docu_sol', $request->nume_docu_per)
                    ->where('pr.estado', 'A')
                    ->where('ju.estado', 'A')
                    ->whereIn('jp.estado', ['N', 'A'])
                    ->where('sec.estado', 'A')
                    ->whereIn('pos.estado', ['E', 'P'])
                    ->whereIn('nj.estado', ['E', 'A', 'N'])
                    ->distinct()
                    ->select('sec.descripcion', 'nj.nota', 'nj.id_jurado_postulante')->get();
                $resultado = $resultado . "<tr ><td style='vertical-align:middle;border-top: 2px solid;' rowspan='" . count($parametros) . "'>$jurado->nomb_comp_per</td>";
                foreach ($parametros as $key => $parametro) {
                    if ($key == 0) {
                        $resultado = $resultado . "<td style='border-top: 2px solid;' >";
                    } else {
                        $resultado = $resultado . "<tr><td>";
                    }
                    $resultado = $resultado . "$parametro->descripcion</td><td ";
                    if ($key == 0) {
                        $resultado = $resultado . "style='border-top: 2px solid;'";
                    }
                    $resultado = $resultado . "><input disabled type='number' value='$parametro->nota'></td>";
                    if ($key == 0) {
                        $resultado = $resultado . "  <td  style='vertical-align:middle;border-top: 2px solid;' rowspan='" . count($parametros) . "'>
                                                        <form id='nota$parametro->id_jurado_postulante' action='" . route('reiniciar.notas') . "' method='GET'>
                                                            <input type='text' name='nume_docu_per' value='$request->nume_docu_per' style='display: none'/>
                                                            <input type='text' name='id_jurado_postulante' value='$parametro->id_jurado_postulante' style='display: none'/>
                                                        </form>
                                                        <button onclick='formulario(" . '"#nota' . $parametro->id_jurado_postulante . '"' . ")'class='btn btn-primary fa fa-repeat'> Reiniciar</button>
                                                    </td>
                                                </tr>";
                    } else {
                        $resultado = $resultado . "</tr>";
                    }
                }
            }
            $resultado = $resultado . '</tbody></colgroup>';
        }
        $resultado = $resultado . '</table>';

        return $resultado;
    }

    public function ReiniciarNotas(Request $request)
    {
        $notas = Nota::where('id_jurado_postulante', $request->id_jurado_postulante)->get();
        foreach ($notas as $notak => $nota) {
            $nota->nota = 0;
            $nota->estado = 'A';
            $nota->update();
        }
        return $this->cargarExamenJurado($request);
    }

    public function ReiniciarExamen(Request $request)
    {
        DB::table('admision.adm_respuestas', 'res')
            ->where('res.id_postulante', $request->id_postulante)->delete();
        $postulante = Postulante::find($request->id_postulante);
        $examen = ExamenPostulante::where('id_postulante', $request->id_postulante)->get();
        if (count($examen) == 1) {
            DB::table('admision.adm_audiostmp', 'res')
                ->where('res.id_examen_postulante', $examen[0]->id_examen_postulante)->delete();
            $examen[0]->segundos = $request->segundos;
            $examen[0]->minutos = $request->minutos;
            $examen[0]->update();
        }
        if (isset($postulante)) {
            $postulante->estado = 'P';
            $postulante->update();
        }
        return $this->cargarExamenTeorico($request);
    }

    public function ReiniciarAudio(Request $request)
    {
        $audio = Audio::find($request->id_audio);
        if(asset($audio)){
            $audio->estado='A';
            $audio->update();
        }
        return $this->cargarExamenAudio($request);
    }

    public function cargarExamenTeorico(Request $request)
    {
        $examenes = DB::table('admision.adm_postulante', 'pos')
            ->join('admision.adm_programacion_examen as pr', 'pr.id_programacion_examen', 'pos.id_programacion_examen')
            ->join('admision.adm_examen as ex', 'ex.id_examen', 'pr.id_examen')
            ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
            ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
            ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
            ->join('admision.adm_examen_postulante as ep', 'ep.id_postulante', 'pos.id_postulante')
            ->where('ea.flag_jura', 'N')
            ->where('pr.estado', 'A')
            ->where('cu.estado', 'A')
            ->where('ex.estado', 'A')
            ->where('per.estado', 'A')
            ->whereIn('pos.estado', ['E', 'P'])
            ->whereIn('ep.estado', ['E', 'A'])
            ->where('pos.nume_docu_sol', $request->nume_docu_per)
            ->select('pos.id_postulante', 'ex.id_examen', 'ex.nombre', 'ep.minutos', 'ep.segundos')
            ->get();

        $resultado = "<table class='table table-bordered' style='text-align:center;'>
        <thead class='thead'>
            <tr>
                <th scope='col'>Examen</th>
                <th scope='col'>Respuestas</th>
                <th scope='col'>Tiempo restante</th>
                <th scope='col'>Acciones</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($examenes as $key => $examen) {
            $resp = DB::table('admision.adm_respuestas', 're')
                ->where('re.id_postulante', $examen->id_postulante)
                ->get();
            $resultado = $resultado . " <tr>
                                            <td style='vertical-align:middle;'>$examen->nombre</td>
                                            <td style='vertical-align:middle;'>";
            foreach ($resp as $key => $value) {
                $resultado = $resultado . "$value->key : $value->respuesta";
                if ($key !== count($resp) - 1) {
                    $resultado = $resultado . " - ";
                }
            }
            $resultado = $resultado . " </td>
                                        <td style='vertical-align:middle;'>
                                            <div class='row'>
                                                <input class='col' type='text' value= '" . substr(str_repeat(0, 2) . $examen->minutos, -2) . "'
                                                    maxlength='2' minlength='2'
                                                    onKeypress='if (event.keyCode < 45 || event.keyCode > 57 ) event.returnValue = false;'
                                                    onkeyup='$(" . '"#min' . $examen->id_postulante . '"' .").val($(this).val())'>
                                                <div class='col'>:</div>
                                                <input class='col' type='text' value= '" . substr(str_repeat(0, 2) . $examen->segundos, -2) . "'
                                                    maxlength='2' minlength='2'
                                                    onKeypress='if (event.keyCode < 45 || event.keyCode > 57 ) event.returnValue = false;'
                                                    onkeyup='$(" . '"#seg' . $examen->id_postulante . '"' .").val($(this).val())'>
                                            </div>
                                        </td>
                                        <td>
                                            <form id='nota$examen->id_postulante' action='" . route('reiniciar.examen') . "' method='GET'>
                                                <input type='text' name='nume_docu_per' value='$request->nume_docu_per' style='display: none'/>
                                                <input type='text' name='id_postulante' value='$examen->id_postulante' style='display: none'/>
                                                <input type='text' id='min$examen->id_postulante' value='$examen->minutos' name='minutos' style='display: none'/>
                                                <input type='text' id='seg$examen->id_postulante' value='$examen->segundos' name='segundos' style='display: none'/>
                                            </form>
                                            <button onclick='formulario(" . '"#nota' . $examen->id_postulante . '"' . ")'class='btn btn-primary fa fa-repeat'> Reiniciar</button>
                                        </td></tr>";
        }
        $resultado = $resultado . '</tbody></table>';

        return $resultado;
    }

    public function cargarExamenAudio(Request $request)
    {
        $examenes = DB::table('admision.adm_postulante', 'pos')
            ->join('admision.adm_programacion_examen as pr', 'pr.id_programacion_examen', 'pos.id_programacion_examen')
            ->join('admision.adm_examen as ex', 'ex.id_examen', 'pr.id_examen')
            ->join('admision.adm_examen_admision as ea', 'ea.id_examen', 'ex.id_examen')
            ->join('admision.adm_cupos as cu', 'pr.id_cupos', 'cu.id_cupos')
            ->join('admision.adm_periodo as per', 'per.id_periodo', 'cu.id_periodo')
            ->join('admision.adm_examen_postulante as ep', 'ep.id_postulante', 'pos.id_postulante')
            ->join('admision.adm_audiostmp as au', 'ep.id_examen_postulante', 'au.id_examen_postulante')
            ->where('ea.flag_jura', 'N')
            ->where('pr.estado', 'A')
            ->where('cu.estado', 'A')
            ->where('ex.estado', 'A')
            ->where('per.estado', 'A')
            ->whereIn('pos.estado', ['E', 'P'])
            ->whereIn('ep.estado', ['E', 'A'])
            ->where('pos.nume_docu_sol', $request->nume_docu_per)
            ->distinct()
            ->select('ep.id_examen_postulante', 'ex.id_examen', 'ex.nombre')
            ->get();

        $resultado = "<table class='table table-bordered' style='text-align:center;'>
            <thead class='thead'>
                <tr>
                    <th scope='col'>Examen</th>
                    <th scope='col'>Audios</th>
                    <th scope='col'>estado</th>
                    <th scope='col'>Acciones</th>
                </tr>
            </thead>
            <tbody>";
        foreach ($examenes as $key => $examen) {
            $audios = DB::table('admision.adm_audiostmp', 'au')
                ->where('au.id_examen_postulante', $examen->id_examen_postulante)
                ->orderBy('id_audio')
                ->get();

            $resultado = $resultado . " <tr>
                                            <td rowspan='" . count($audios) . "' style='vertical-align:middle;'>$examen->nombre</td>
                                            ";
            foreach ($audios as $key => $audio) {
                $nombre = explode('/', $audio->archivo);
                $resultado = $resultado . "<td>" . end($nombre) . "</td>";
                if ($audio->estado == 'U') {
                    $resultado = $resultado . "<td><p class='btn btn-danger'><i class='fa fa-volume-slash' aria-hidden='true'></i></p></td>";
                } else {
                    $resultado = $resultado . "<td><p class='btn btn-success'><i class='fa fa-volume' aria-hidden='true'></i></p></td>";
                }
                $resultado = $resultado . "<td>
                                            <form id='nota$audio->id_audio' action='" . route('reiniciar.audio') . "' method='GET'>
                                                <input type='text' name='nume_docu_per' value='$request->nume_docu_per' style='display: none'/>
                                                <input type='text' name='id_audio' value='$audio->id_audio' style='display: none'/>
                                            </form>
                                            <button onclick='formulario(" . '"#nota' . $audio->id_audio . '"' . ")'class='btn btn-primary fa fa-repeat'> Reiniciar</button>
                                        </td>
                                    </tr>";
            }
        }
        $resultado = $resultado . '</tbody></table>';

        return $resultado;
    }
}
