<?php

namespace App\Http\Controllers\evaluacion;

use App\Http\Controllers\Controller;
use App\Model\Comentario;
use App\Model\Examen\Examen;
use App\Model\Examen\ProgramacionExamen;
use App\Model\JuradoPostulante;
use App\Model\Nota;
use App\Model\Persona;
use App\Model\Postulante;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $programaciones = $this->programaciones();
        Log::info("El Usuario " . Auth::user()->name . " ingresó a evaluar");
        return view('evaluacion.index', ['programaciones' => $programaciones]);
    }
    public function botoncargar(Request $request)
    {
        $enlace = route('evaluacion.cargar', ['id_programacion_examen' => $request->id_programacion_examen, 'id_examen' => $request->id_examen]);
        $boton = "<form action='$enlace' id='recargar' method='get'></form>
                <button class='btn btn-primary' onclick='formulario(`#recargar`)'>
                <i class='fa fa-repeat' aria-hidden='true'></i> Actualizar</button>";
        return $boton;
    }

    public function programaciones()
    {
        $programaciones = ProgramacionExamen::join('admision.adm_examen as ex', 'ex.id_examen', 'admision.adm_programacion_examen.id_examen')
            ->join('admision.adm_cupos as cu', 'cu.id_cupos', 'admision.adm_programacion_examen.id_cupos')
            ->join('admision.adm_examen_admision as adm', 'adm.id_examen', 'ex.id_examen')
            ->join('admision.adm_aula as au', 'au.id_aula', 'admision.adm_programacion_examen.id_aula')
            ->join('bdsig.vw_sig_seccion_especialidad as esp', 'esp.codi_espe_esp', 'cu.codi_espe_esp')
            ->join('admision.adm_periodo as p', 'p.id_periodo', 'cu.id_periodo')
            ->join('admision.adm_seccion_estudios as asec', 'p.id_seccion', 'asec.id_seccion')
            ->where('admision.adm_programacion_examen.estado', 'A')
            ->where('ex.estado', 'A')
            ->where('cu.estado', 'A')
            ->where('au.estado', 'A')
            ->where('asec.estado', 'A')
            ->where('adm.flag_jura', 'S')
            ->select(
                'admision.adm_programacion_examen.descripcion',
                'admision.adm_programacion_examen.id_programacion_examen',
                'fecha_resol',
                'minutos',
                'modalidad',
                'ex.id_examen',
                'cu.id_cupos',
                'au.id_aula',
                'esp.codi_espe_esp',
                'esp.abre_espe_esp',
                'p.anio',
                'ex.nombre as examen',
                'au.nombre as aula',
                'asec.codi_secc_sec',
                'p.id_seccion'
            )->distinct();
        if (getSeccion()) {
            $programaciones = $programaciones->where('p.id_seccion', getIdSeccion());
        }
        if (getTipoUsuario() == 'Administrador') {
            $programaciones = $programaciones->get();
        } else if (getTipoUsuario() == 'Jurado') {
            $programaciones = $programaciones->join('admision.adm_jurado as jr', 'admision.adm_programacion_examen.id_programacion_examen', 'jr.id_programacion_examen')
                ->join('bdsig.persona as pe', 'pe.codi_pers_per', 'jr.codi_doce_per')
                ->where('jr.estado', 'A')
                ->where('pe.nume_docu_per', Auth::user()->ndocumento)->get();
        }
        return $programaciones;
    }

    public function Evaluar(Request $request)
    {
        $postulante = Postulante::find($request->id_postulante);
        $persona = Persona::where('nume_docu_per', rtrim($postulante->nume_docu_sol))->first();
        $perdoce = Persona::where('nume_docu_per', Auth::user()->ndocumento)->first();
        $mensaje = "El Usuario " . Auth::user()->name . "(" . $perdoce->codi_pers_per . ")" . " evaluó a " . $persona->nomb_comp_per . "(" . $persona->nume_docu_per . ")" . "\n";
        try {
            DB::beginTransaction();
            foreach ($request->idnotas as $idnota) {
                $modelnota = Nota::find($idnota);

                $modelnota->nota = $request->get("nota" . $idnota);
                $modelnota->estado = 'E';
                $modelnota->update();
                if (
                    $request->get("nota" . $idnota) == null ||
                    $request->get("nota" . $idnota) > $request->nota_maxi
                ) {
                    DB::rollBack();
                    //return $this->Cargar($request);
                    return "fallo de parametros";
                }
                $mensaje = $mensaje . $idnota . " : " . $request->get("nota" . $idnota) . "\n";
            }

            $comentario = Comentario::where('id_jurado_postulante', $request->id_jurado_postulante)->first();
            $comentario->comentario = $request->comentario;
            $comentario->update();

            $jurados = JuradoPostulante::where('estado', 'A')->where('id_postulante', $request->id_postulante);
            $Notas = Nota::where('jp.id_postulante', $request->id_postulante)
                ->where('admision.adm_nota_jurado.estado', 'E')
                ->where('sec.estado', 'A')
                ->whereIn('jp.estado', ['A', 'E'])
                ->where('j.estado', 'A')
                ->select('sec.porcentaje', 'admision.adm_nota_jurado.nota')
                ->join('admision.adm_jurado_postulante as jp', 'admision.adm_nota_jurado.id_jurado_postulante', 'jp.id_jurado_postulante')
                ->join('admision.adm_jurado as j', 'j.id_jurado', 'jp.id_jurado')
                ->join('admision.adm_seccion_examen as sec', 'sec.id_seccion_examen', 'admision.adm_nota_jurado.id_seccion_examen')->get();
            $count = $jurados->count();
            $promedio = 0;
            foreach ($Notas as $nota) {
                $promedio = $promedio + (($nota->porcentaje / 100) * $nota->nota);
            }
            if ($promedio > 0) {
                $promedio = $promedio / $count;
            }
            $postulante->nota = $promedio;
            $postulante->estado = 'E';
            $postulante->update();
            DB::commit();
            Log::info($mensaje);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($mensaje . "(Ocurrio un error inesperado) \n" . $e->getMessage());
            return "Ocurrió un error inesperado, Contáctese con soporte" . $this->botoncargar($request);
        }
        return $this->Cargar($request);
    }

    public function Abstener(Request $request)
    {
        $postulante = Postulante::find($request->id_postulante);
        $persona = Persona::where('nume_docu_per', rtrim($postulante->nume_docu_sol))->first();
        $perdoce = Persona::where('nume_docu_per', Auth::user()->ndocumento)->first();
        $mensaje = "El Usuario " . Auth::user()->name . "(" . $perdoce->codi_pers_per . ")" . " se abstuvo al evaluar a " . $persona->nomb_comp_per . "(" . $persona->nume_docu_per . ")";

        try {
            DB::beginTransaction();
            foreach ($request->idnotas as $idnota) {
                $modelnota = Nota::find($idnota);
                $modelnota->estado = 'N';
                $modelnota->nota = 0;
                $modelnota->update();
            }
            /*if ($request->comentario==null) {
                DB::rollBack();
                //return $this->Cargar($request);
                return "Es necesario realizar un comentario para esta opción";
            }*/
            $comentario = Comentario::where('id_jurado_postulante', $request->id_jurado_postulante)->first();
            $comentario->comentario = $request->comentario . " (Comentario de Abstención)";
            $comentario->update();

            $jupos = JuradoPostulante::find($request->id_jurado_postulante);
            $jupos->estado = 'N';
            $jupos->update();
            $jurados = JuradoPostulante::where('estado', 'A')->where('id_postulante', $request->id_postulante);
            $Notas = Nota::where('jp.id_postulante', $request->id_postulante)
                ->where('admision.adm_nota_jurado.estado', 'E')
                ->where('sec.estado', 'A')
                ->whereIn('jp.estado', ['A', 'E'])
                ->where('j.estado', 'A')
                ->select('sec.porcentaje', 'admision.adm_nota_jurado.nota')
                ->join('admision.adm_jurado_postulante as jp', 'admision.adm_nota_jurado.id_jurado_postulante', 'jp.id_jurado_postulante')
                ->join('admision.adm_jurado as j', 'j.id_jurado', 'jp.id_jurado')
                ->join('admision.adm_seccion_examen as sec', 'sec.id_seccion_examen', 'admision.adm_nota_jurado.id_seccion_examen')->get();
            $count = $jurados->count();
            $promedio = 0;
            foreach ($Notas as $nota) {
                $promedio = $promedio + (($nota->porcentaje / 100) * $nota->nota);
            }
            if ($promedio > 0) {
                $promedio = $promedio / $count;
            }
            $postulante->nota = $promedio;
            $postulante->estado = 'E';
            $postulante->update();
            DB::commit();
            Log::info($mensaje);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($mensaje . "(Ocurrio un error inesperado) \n" . $e->getMessage());
            return "Ocurrió un error inesperado, Contáctese con soporte" . $this->botoncargar($request);
        }
        return $this->Cargar($request);
    }

    public function insaistencia(Request $request)
    {
        $postulante = Postulante::find($request->id_postulante);
        $persona = Persona::where('nume_docu_per', rtrim($postulante->nume_docu_sol))->first();
        $perdoce = Persona::where('nume_docu_per', Auth::user()->ndocumento)->first();
        $mensaje = "El Usuario " . Auth::user()->name . "(" . $perdoce->codi_pers_per . ")" . " realizo la inasistencia de " . $persona->nomb_comp_per . "(" . $persona->nume_docu_per . ")";

        try {
            DB::beginTransaction();
            foreach ($request->idnotas as $idnota) {
                $modelnota = Nota::find($idnota);
                $modelnota->estado = 'N';
                $modelnota->nota = 0;
                $modelnota->update();
            }
            /*if ($request->comentario==null) {
                DB::rollBack();
                //return $this->Cargar($request);
                return "Es necesario realizar un comentario para esta opción";
            }*/
            $comentario = Comentario::where('id_jurado_postulante', $request->id_jurado_postulante)->first();
            $comentario->comentario = $request->comentario . " (Comentario de Inasistencia)";
            $comentario->update();

            $jupos = JuradoPostulante::find($request->id_jurado_postulante);
            $jupos->estado = 'I';
            $jupos->update();
            $jurados = JuradoPostulante::where('estado', 'A')->where('id_postulante', $request->id_postulante);
            $Notas = Nota::where('jp.id_postulante', $request->id_postulante)
                ->where('admision.adm_nota_jurado.estado', 'E')
                ->where('sec.estado', 'A')
                ->whereIn('jp.estado', ['A', 'E'])
                ->where('j.estado', 'A')
                ->select('sec.porcentaje', 'admision.adm_nota_jurado.nota')
                ->join('admision.adm_jurado_postulante as jp', 'admision.adm_nota_jurado.id_jurado_postulante', 'jp.id_jurado_postulante')
                ->join('admision.adm_jurado as j', 'j.id_jurado', 'jp.id_jurado')
                ->join('admision.adm_seccion_examen as sec', 'sec.id_seccion_examen', 'admision.adm_nota_jurado.id_seccion_examen')->get();
            $count = $jurados->count();
            $promedio = 0;
            foreach ($Notas as $nota) {
                $promedio = $promedio + (($nota->porcentaje / 100) * $nota->nota);
            }
            if ($promedio > 0) {
                $promedio = $promedio / $count;
            }
            $postulante->nota = $promedio;
            $postulante->estado = 'E';
            $postulante->update();
            DB::commit();
            Log::info($mensaje);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($mensaje . "(Ocurrio un error inesperado) \n" . $e->getMessage());
            return "Ocurrió un error inesperado, Contáctese con soporte" . $this->botoncargar($request);
        }
        return $this->Cargar($request);
    }

    public function Cargar(Request $request)
    {
        $postulantes = DB::table('bdsigunm.ad_postulacion as ad')
            ->join('bdsigunm.ad_proceso as pr', 'pr.codi_proc_adm', 'ad.codi_proc_adm')
            ->join('admision.adm_postulante as adm', 'adm.nume_docu_sol', 'ad.nume_docu_per')
            ->where('esta_post_pos', 'V')
            ->where('adm.id_programacion_examen', $request->id_programacion_examen)
            ->whereNotIn('adm.estado', ['I'])
            ->where('pr.esta_proc_adm', 'V')
            ->select(
                'adm.id_programacion_examen',
                'adm.id_postulante',
                'adm.estado',
                'ad.nume_docu_per',
                'ad.nomb_pers_per',
                'ad.apel_pate_per',
                'ad.apel_mate_per'
            )->distinct()->get();
        $jurado = DB::table('admision.adm_jurado as jr')
            ->join('bdsig.persona as pe', 'pe.codi_pers_per', 'jr.codi_doce_per')
            ->where('pe.nume_docu_per', Auth::user()->ndocumento)
            ->where('jr.id_programacion_examen', $request->id_programacion_examen)
            ->where('jr.estado', 'A')
            ->select('jr.id_jurado')
            ->first();
        $parametros = DB::table('admision.adm_seccion_examen')
            ->where('estado', 'A')
            ->where('id_examen', $request->id_examen)
            ->select(
                'id_seccion_examen',
                'id_examen',
                'descripcion'
            )->get();
        $examen = Examen::find($request->id_examen);
        $contenido = "<div class='container'>
        <div class='row'>
          <div class='col-12'>
            <div class='table-responsive'>
        <table class='table'><thead><tr>
                    <th scope='col'>Alumno</th>";
        foreach ($parametros as $key => $par) {
            $contenido = $contenido . "<th scope='col'>" . $par->descripcion . "</th>";
        }
        $contenido = $contenido . "<th scope='col'>Observación</th>
                               <th scope='col'>Acciones</th>
                               </tr></thead><tbody>";
        foreach ($postulantes as $key => $pos) {
            $estadoeval = '';
            $contenido = $contenido . "<tr><td><form id='$pos->nume_docu_per' class='evaluar' method='GET'>
            <input type='text' name='id_postulante' value='$pos->id_postulante' style='display: none'/>
            <input type='text' name='id_jurado' value='$jurado->id_jurado' style='display: none'/>
            <input type='text' name='id_programacion_examen' value='$request->id_programacion_examen' style='display: none'/>
            <input type='text' name='id_examen' value='$request->id_examen' style='display: none'/>
            <input type='text' name='nota_maxi' value='$examen->nota_maxi' style='display: none'/>
            <input type='text' id='comentario$pos->nume_docu_per' name='comentario' style='display: none'/>
            $pos->nomb_pers_per $pos->apel_pate_per $pos->apel_mate_per";

            foreach ($parametros as $key => $par) {

                $nota = DB::table('admision.adm_nota_jurado as n')
                    ->join('admision.adm_jurado_postulante as jp', 'jp.id_jurado_postulante', 'n.id_jurado_postulante')
                    ->select('n.id_notajurado', 'nota', 'n.estado', 'jp.id_jurado_postulante')
                    ->where('jp.id_jurado', $jurado->id_jurado)
                    ->where('jp.id_postulante', $pos->id_postulante)
                    ->where('id_seccion_examen', $par->id_seccion_examen)->first();
                if ($nota) {
                    $estadoeval = $nota->estado;
                    if ($nota->estado == 'A') {
                        $contenido = $contenido . "<input type='text' name='idnotas[]' value='$nota->id_notajurado' style='display: none'/>
                    <input type='text' id='nota$nota->id_notajurado' name='nota$nota->id_notajurado'  style='display: none'/>
                    <input type='text' name='id_jurado_postulante' value='$nota->id_jurado_postulante' style='display: none'/>";
                    }
                }
            }

            $contenido = $contenido . "</form></td>";

            foreach ($parametros as $key => $par) {

                $nota = DB::table('admision.adm_nota_jurado as n')
                    ->join('admision.adm_jurado_postulante as jp', 'jp.id_jurado_postulante', 'n.id_jurado_postulante')
                    ->select('n.id_notajurado', 'nota', 'n.estado', 'jp.id_jurado_postulante')
                    ->where('jp.id_jurado', $jurado->id_jurado)
                    ->where('jp.id_postulante', $pos->id_postulante)
                    ->where('id_seccion_examen', $par->id_seccion_examen)->first();
                $estadoeval = $nota->estado;
                if ($nota->estado == 'A') {
                    $contenido = $contenido . "<td><input class='form-control' onkeyup='$(" . '"#nota' . $nota->id_notajurado . '"' .
                        ").val($(this).val())' name='' maxlength='2' onKeypress='if (event.keyCode < 45 || event.keyCode > 57 ) event.returnValue = false;' max='$examen->nota_maxi' required type='text'>
                    <input type='text' name='idnotas[]' value='$nota->id_notajurado' style='display: none'/>
                    <input type='text' name='id_jurado_postulante' value='$nota->id_jurado_postulante' style='display: none'/></td>";
                } else {
                    $contenido = $contenido . "<td><input class='form-control' value='$nota->nota' disabled></td>";
                }
            }
            $comentario = DB::table('admision.adm_comentarios as c')
                ->join('admision.adm_jurado_postulante as jp', 'jp.id_jurado_postulante', 'c.id_jurado_postulante')
                ->select('comentario')
                ->where('jp.id_jurado', $jurado->id_jurado)
                ->where('jp.id_postulante', $pos->id_postulante)->first();

            if ($estadoeval == 'A') {
                $contenido = $contenido . "<td><textarea onkeyup='$(" . '"#comentario' . $pos->nume_docu_per . '"' . ").val($(this).val())'>$comentario->comentario</textarea></td>";
            } else {
                $contenido = $contenido . "<td><textarea disabled>$comentario->comentario</textarea></td>";
            }
            $contenido = $contenido . "<td>
                                   ";
            if ($estadoeval == 'A') {
                $contenido = $contenido . "<a href='#' onclick='Evaluar(`#$pos->nume_docu_per`)' class='col btn btn-success'>Grabar</a>
                                       <a href='#' onclick='Abstener(`#$pos->nume_docu_per`)' class='col btn btn-primary'>Abstener</a>";
            } else {
                $contenido = $contenido . "<p>No existen acciones.</p>";
            }
            $contenido = $contenido . "</td></tr>";
        }
        $contenido = $contenido . "</tbody></table></div></div></div></div>";
        return $contenido;
    }
}
