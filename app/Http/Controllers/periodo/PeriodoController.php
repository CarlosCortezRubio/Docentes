<?php

namespace App\Http\Controllers\periodo;

use App\Exports\PeriodoExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Model\Periodo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $anioexist = DB::table('admision.adm_periodo as pe')->distinct('anio')->get();
        $secciones = DB::table('bdsig.vw_sig_seccion as sec')
            ->join('admision.adm_seccion_estudios as asec', 'asec.codi_secc_sec', 'sec.codi_secc_sec')
            ->where('asec.estado', 'A')
            ->select('sec.abre_secc_sec', 'asec.*')
            ->get();
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
            'secciones' => $secciones,
            'anios' => $anios,
            'anioexist' => $anioexist,
            'busqueda' => $request
        ]);
    }

    public function insert(Request $request)
    {
        $periodo = new Periodo;
        try {
            DB::beginTransaction();
            $periodo->anio = $request->anio;
            $periodo->peri_insc_inic = $request->peri_insc_inic;
            $periodo->peri_insc_fin = $request->peri_insc_fin;
            $periodo->peri_eval_inic = $request->peri_eval_inic;
            $periodo->peri_eval_fin = $request->peri_eval_fin;
            $periodo->estado = 'I';
            $periodo->user_regi = Auth::user()->id;
            $periodo->id_seccion = $request->id_seccion;
            $periodo->save();
            DB::commit();
        } catch (Exception $e) {
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
            $periodo->anio = $request->anio;
            $periodo->peri_insc_inic = $request->peri_insc_inic;
            $periodo->peri_insc_fin = $request->peri_insc_fin;
            $periodo->peri_eval_inic = $request->peri_eval_inic;
            $periodo->peri_eval_fin = $request->peri_eval_fin;
            $periodo->user_actu = Auth::user()->id;
            $periodo->id_seccion = $request->id_seccion;
            $periodo->update();
            DB::commit();
        } catch (Exception $e) {
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
        //$type = $request->type;
        //return 'Periodos'.date('Ymmdd').'.xlsx';
        return Excel::download(new PeriodoExport($request), 'Periodos'.date('Ymmdd').'.csv');
    }

}
