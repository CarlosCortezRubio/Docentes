<?php

namespace App\Http\Controllers\periodo;

use App\Exports\PeridoTodosExport;
use App\Exports\PeriodoExport;
use App\Exports\PeriodoTodosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Model\Periodo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeriodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $anios = collect([]);
        for ($i = 0; $i < 10; $i++) {
            $anios->push(date('Y') + $i);
        }
        $periodos = Periodo::join('admision.adm_seccion_estudios as asec', 'asec.id_seccion', 'admision.adm_periodo.id_seccion')
            ->join('bdsig.vw_sig_seccion as sec', 'sec.codi_secc_sec', 'asec.codi_secc_sec')
            ->where('admision.adm_periodo.estado', '<>', 'E')
            ->select('admision.adm_periodo.*', 'sec.abre_secc_sec', 'asec.categoria');
        if ($request->anio) {
            $periodos = $periodos->where('admision.adm_periodo.anio', 'like', $request->anio);
        }
        if ($request->estado) {
            $periodos = $periodos->where('admision.adm_periodo.estado', 'like', $request->estado);
        }
        if (getSeccion()) {
            $periodos = $periodos->where('asec.id_seccion', getIdSeccion())->get();
        } else if (getTipoUsuario() == 'Administrador') {
            if ($request->seccion) {
                $periodos = $periodos->where('asec.id_seccion', 'like', $request->seccion);
            }
            $periodos = $periodos->get();
        }
        return view('periodo.index', [
            'periodos' => $periodos,
            'anios' => $anios,
            'busqueda' => $request
        ]);
    }

    public function insert(Request $request)
    {
        $periodo = new Periodo;
        try {
            DB::beginTransaction();
            $peri_insc_fin = substr($request->peri_insc_fin, 0, strpos($request->peri_insc_fin, ' ')).' 23:59:59';
            $peri_eval_fin = substr($request->peri_eval_fin, 0, strpos($request->peri_eval_fin, ' ')).' 23:59:59';
            $peri_show_fin = substr($request->peri_show_fin, 0, strpos($request->peri_show_fin, ' ')).' 23:59:59';
            $periodo->anio = $request->anio;
            $periodo->peri_insc_inic = $request->peri_insc_inic;
            $periodo->peri_insc_fin = $peri_insc_fin;
            $periodo->peri_eval_inic = $request->peri_eval_inic;
            $periodo->peri_eval_fin = $peri_eval_fin;
            $periodo->peri_show_inic = $request->peri_show_inic;
            $periodo->peri_show_fin = $peri_show_fin;
            $periodo->estado = 'I';
            $periodo->user_regi = Auth::user()->id;
            $periodo->id_seccion = $request->id_seccion;
            $periodo->save();
            DB::commit();
        } catch (Exception $e) {
            Log::error("(Ocurrio un error inesperado) \n" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()
                ->with('no_success', 'Existe un error en los parámetros.');
        }
        return redirect()->back()
            ->with('success', 'Configuración guardada con éxito.');
    }

    public function update(Request $request)
    {
        $periodo = Periodo::find($request->id_periodo);
        try {
            DB::beginTransaction();
            $peri_insc_fin = $request->peri_insc_fin.' 23:59:59';
            $peri_eval_fin = $request->peri_eval_fin.' 23:59:59';
            $peri_show_fin = $request->peri_show_fin.' 23:59:59';
            $periodo->anio = $request->anio;
            $periodo->peri_insc_inic = $request->peri_insc_inic;
            $periodo->peri_insc_fin = $peri_insc_fin;
            $periodo->peri_eval_inic = $request->peri_eval_inic;
            $periodo->peri_eval_fin = $peri_eval_fin;
            $periodo->peri_show_inic = $request->peri_show_inic;
            $periodo->peri_show_fin = $peri_show_fin;
            $periodo->user_actu = Auth::user()->id;
            $periodo->id_seccion = $request->id_seccion;
            $periodo->update();
            DB::commit();
        } catch (Exception $e) {
            Log::error("(Ocurrio un error inesperado) \n" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()
                ->with('no_success', 'Existe un error en los parámetros.');
        }
        return redirect()->back()
            ->with('success', 'Configuración guardada con éxito.');
    }
    public function updateEstado(Request $request)
    {
        $periodo = Periodo::find($request->id_periodo);
        $periodos = Periodo::where('id_seccion', $periodo->id_seccion)->where('estado', '<>', 'E')->get();
        try {
            DB::beginTransaction();
            foreach ($periodos as $per) {
                if ($per->estado == 'A') {
                    $per->estado = 'I';
                    $per->user_actu = Auth::user()->id;
                    $per->update();
                }
            }
            if ($periodo->estado == 'A') {
                $periodo->estado = 'I';
                $per->user_actu = Auth::user()->id;
            } else if ($periodo->estado == 'I') {
                $periodo->estado = 'A';
                $per->user_actu = Auth::user()->id;
            }

            $periodo->update();
            DB::commit();
        } catch (Exception $e) {
            Log::error("(Ocurrio un error inesperado) \n" . $e->getMessage());
            DB::rollBack();
            return redirect()->back()
                ->with('no_success', 'Existe un error en los parámetros.');
        }
        return redirect()->back()
            ->with('success', 'Configuración guardada con éxito.');
    }

    public function MensajeEstado(Request $request)
    {
        $periodo = Periodo::find($request->idperiodo);
        $periodos = Periodo::where('id_seccion', $periodo->id_seccion)->where('estado', '<>', 'E')->get();
        foreach ($periodos as $per) {
            if ($per->estado == 'A') {
                return "Existe un periodo activo.<br>¿Desea Activar el periodo?";
            }
        }
        return "¿Desea Activar el periodo?";
    }

    public function export(Request $request)
    {
        $seccion = null;
        if (getSeccion()) {
            $seccion = getIdSeccion();
        } else if (isset($request->seccion)) {
            $seccion = $request->seccion;
        }
        if (isset($request->anio) && $seccion && isset($request->estado)) {
            return Excel::download(new PeriodoExport($request->anio, $request->seccion, $request->estado), 'Periodos' . date('Ymmdd') . '.' . $request->tipo);
        } else {
            return Excel::download(new PeridoTodosExport, 'Periodos' . date('Ymmdd') . '.' . $request->tipo);
        }
    }
}
