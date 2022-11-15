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
use PDF;
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
                'ad.apel_mate_per',
                'ad.codi_post_pos'
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
                    <th scope='col'>Alumno</th>
                    <th scope='col'>Ficha</th>";
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

            $contenido = $contenido . "</form></td>
            <td>
                <form id='ficha$pos->codi_post_pos' action='" . route('evaluacion.generatePDF') . "' method='POST' target='_blank' style='display: none;'>
                    <input type='hidden' name='_token' value='".csrf_token()."'>
                    <input type='hidden' name='codi_post_pos' value='$pos->codi_post_pos'>
                </form>
                <button class='btn btn-outline-primary' type='button' onclick='event.preventDefault();
                    document.getElementById(".'"ficha'.$pos->codi_post_pos.'"'.").submit();'>
                    <i class='fas fa-file-pdf'></i>
                    <span class='d-none d-sm-inline-block pl-1'>Ver ficha</span>
                </button>
            </td>";

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

    public function getUbigeo($ubigeo)
    {
        if (!(empty($ubigeo) || is_null($ubigeo))) {
            $data = DB::table('bdsig.ubigeo as di')
                      ->join('bdsig.ubigeo as dp', 'dp.codi_ubic_ubg', '=', DB::raw('substr(di.codi_ubic_ubg,1,2)'))
                      ->join('bdsig.ubigeo as pr', 'pr.codi_ubic_ubg', '=', DB::raw('substr(di.codi_ubic_ubg,1,4)'))
                      ->select('di.codi_ubic_ubg as codi_ubic_ubg','dp.abre_ubic_ubg as nomb_depa_ubg','pr.abre_ubic_ubg as nomb_prov_ubg','di.abre_ubic_ubg as nomb_dist_ubg')
                      ->where('di.codi_ubic_ubg','LIKE',$ubigeo ? $ubigeo : '')
                      ->where(DB::raw('length(di.codi_ubic_ubg)'),'=','6')
                      ->orderBy('di.codi_ubic_ubg','asc')
                      ->get();

            if ($ubigeo!='%') {
                $data = $data->first();
            }

            return ($data);

        } else {
            return ('');
        }
    }

    public function generatePDF(Request $request)
    {
        if ($request) {
            $id = $request->get('codi_post_pos');

            $ficha = DB::table('bdsigunm.ad_postulacion AS a')
                ->join('bdsig.ttablas_det AS b', 'b.codi_tabl_det', 'a.codi_espe_esp')
                ->join('bdsig.ttablas_det AS c', 'c.codi_tabl_det', 'a.codi_secc_sec')
                ->join('bdsig.ttablas_det AS d', 'd.codi_tabl_det', 'a.codi_pais_per')
                ->join('bdsig.ttablas_det AS t', 't.codi_tabl_det', 'a.tipo_docu_per')
                ->join('bdsigunm.ad_proceso AS e', 'e.codi_proc_adm', 'a.codi_proc_adm')
                ->join('bdsig.sg_usuario_externo AS u', function ($join) {
                    $join->on('u.tdocumento', '=', 'a.tipo_docu_per')
                        ->on('u.ndocumento', '=', 'a.nume_docu_per');
                })
                ->where('a.codi_post_pos', '=', $id)
                ->where('b.codi_tabl_tab', '=', '04')
                ->where('c.codi_tabl_tab', '=', '05')
                ->where('d.codi_tabl_tab', '=', '15')
                ->where('t.codi_tabl_tab', '=', '01')
                ->select(
                    'a.*',
                    'b.desc_tabl_det AS especialidad',
                    'c.desc_tabl_det AS seccion',
                    'd.desc_tabl_det AS pais',
                    'e.nume_proc_adm AS proceso',
                    't.abre_tabl_det AS abre_tipo_doc',
                    'u.email',
                    DB::raw("TO_CHAR(a.fech_naci_per, 'dd/mm/yyyy') AS fech_naci_pos"),
                    DB::raw("DECODE(a.codi_secc_sec, '05001', 'S', '05002', 'P', 'E')||substr(e.nume_proc_adm, 3)||trim(to_char(a.nume_expe_pos, '0000')) AS nume_expe_exp")
                )
                ->first();
            $profesor = '';
            $especialidad_estudio = '';
            if ($ficha->tipo_prep_pos == 'C') {
                $especialidad_estudio = DB::table('bdsig.ttablas_det')->where('codi_tabl_det', $ficha->codi_espe_adm)->first()->desc_tabl_det;
                $profesor = DB::table('bdsig.persona')->where('codi_pers_per', $ficha->codi_doce_adm)->first()->nomb_comp_per;
            }

            $repertorio = DB::table('bdsigunm.ad_repertorio')
                ->where('codi_post_pos', '=', $id)
                ->get();

            $trabajos = DB::table('bdsigunm.ad_trabajo')
                ->where('codi_post_pos', '=', $id)
                ->get();

            $ubigeoDom = $this->getUbigeo($ficha->ubig_domi_per);

            $pdf = PDF::loadView(
                'evaluacion.Ficha.ficha',
                [
                    'especialidad_estudio' => $especialidad_estudio,
                    'profesor' => $profesor,
                    "ficha"      => $ficha,
                    "repertorio" => $repertorio,
                    "trabajos"   => $trabajos,
                    "ubigeoDom"  => $ubigeoDom
                ]
            );

            $filename = 'fichainscripcion_' . $ficha->nume_expe_exp . '.pdf';
            $pdf->setPaper('a4', 'portrait');

            return $pdf->stream($filename);
        }
    }
}
