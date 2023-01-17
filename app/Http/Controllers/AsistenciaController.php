<?php

namespace App\Http\Controllers;

use App\Model\Asistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        return view('Asistencia\index', ['busqueda' => $request]);
    }

    public function CargarDocentes(Request $request)
    {

        $docentes = DB::table('admision.adm_asistencia as ju')
            ->join('bdsig.persona as pe', 'pe.codi_pers_per', 'ju.codi_pers_per')
            ->whereIn('ju.estado', ['S', 'E'])
            ->where('ju.tipo', 'DC')
            ->where('ju.fecha_asistencia', date('Y-m-d') . " 00:00:00")
            ->where('ju.tipo_asistencia',getTipoUsuario() )
            ->select('ju.estado', 'ju.id_asistencia', 'pe.codi_pers_per', 'pe.nomb_comp_per', 'pe.nume_docu_per', 'ju.entrada', 'ju.salida')
            ->orderBy('id_asistencia')->get();
        $resultado = '<table id="tablasasistencia" class="table table-light">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Numero de Documento</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tdata">';
        foreach ($docentes as $dock => $docv) {
            $resultado = $resultado . " <tr>

                                        <td>$docv->nomb_comp_per</td>
                                        <td>$docv->nume_docu_per</td>
                                        <td>$docv->entrada</td>
                                        <td>$docv->salida</td>
                                        <td>";
            switch ($docv->estado) {
                case 'E':
                    $resultado = $resultado . "<form id='formsalida$docv->id_asistencia' action='" . route('addsalida') . "' method='get'>
                                                <input type='text' name='id_asistencia' class='d-none' value='$docv->id_asistencia'>
                                                <input type='text' name='tipo' class='d-none' value='DC'>
                                                <input type='text' name='token' class='d-none' value='" . csrf_token() . "'>
                                            </form>
                                            <button class='btn btn-primary' onclick='formulario(" . '"#formsalida' . $docv->id_asistencia . '"' . ")' type='button'>Marcar Salida</button>";
                    break;
                case 'S':
                    $resultado = $resultado . "No hay acciones a realizar";
                    break;
            }

            $resultado = $resultado . "</td>
                                    </tr>";
        }
        $resultado = $resultado . "</tbody>
                                </table>";
        return $resultado;
    }

    public function CargarPostulantes(Request $request)
    {

        $docentes = DB::table('admision.adm_asistencia as ju')
            ->join('bdsig.persona as pe', 'pe.codi_pers_per', 'ju.codi_pers_per')
            ->whereIn('ju.estado', ['S', 'E'])
            ->where('ju.tipo', 'PO')
            ->where('ju.fecha_asistencia', date('Y-m-d') . " 00:00:00")
            ->where('ju.tipo_asistencia',getTipoUsuario() )
            ->select('ju.estado', 'ju.id_asistencia', 'pe.codi_pers_per', 'pe.nomb_comp_per', 'pe.nume_docu_per', 'ju.entrada', 'ju.salida')
            ->orderByDesc('entrada')->get();
        $resultado = '<table id="tablasasistenciapo" class="table table-light">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Numero de Documento</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tdata">';
        foreach ($docentes as $dock => $docv) {
            $resultado = $resultado . " <tr>

                                        <td>$docv->nomb_comp_per</td>
                                        <td>$docv->nume_docu_per</td>
                                        <td>$docv->entrada</td>
                                        <td>$docv->salida</td>
                                        <td>";
            switch ($docv->estado) {
                case 'E':
                    $resultado = $resultado . "<form id='formsalida$docv->id_asistencia' action='" . route('addsalida') . "' method='get'>
                                                <input type='text' name='id_asistencia' class='d-none' value='$docv->id_asistencia'>
                                                <input type='text' name='tipo' class='d-none' value='PO'>
                                                <input type='text' name='token' class='d-none' value='" . csrf_token() . "'>
                                            </form>
                                            <button class='btn btn-primary' onclick='formulariopo(" . '"#formsalida' . $docv->id_asistencia . '"' . ")' type='button'>Marcar Salida</button>";
                    break;
                case 'S':
                    $resultado = $resultado . "No hay acciones a realizar";
                    break;
            }

            $resultado = $resultado . "</td>
                                    </tr>";
        }
        $resultado = $resultado . "</tbody>
                                </table>";
        return $resultado;
    }

    public function addasistencia(Request $request)
    {
        $asistencia = new Asistencia;
        $asistencia->codi_pers_per = $request->codi_pers_per;
        $asistencia->tipo = $request->tipo;
        $asistencia->entrada = date('Y-m-d H:i:s');
        $asistencia->fecha_asistencia = date('Y-m-d') . ' 00:00:00';
        $asistencia->estado = 'E';
        $asistencia->user_regi = Auth::user()->id;
        $asistencia->tipo_asistencia= getTipoUsuario();
        $asistencia->save();
        DB::commit();

        switch ($request->tipo) {
            case 'DC':
                return $this->CargarDocentes($request);
                break;

            case 'PO':
                return $this->CargarPostulantes($request);
                break;
            default:
                return 'Error, contáctese con soporte técnico';
                break;
        }
    }

    public function addsalida(Request $request)
    {
        $asistencia = Asistencia::find($request->id_asistencia);
        $asistencia->salida = date('Y-m-d H:i:s');
        $asistencia->estado = 'S';
        $asistencia->user_actu = Auth::user()->id;
        $asistencia->update();
        DB::commit();

        switch ($request->tipo) {
            case 'DC':
                return $this->CargarDocentes($request);
                break;

            case 'PO':
                return $this->CargarPostulantes($request);
                break;
            default:
                return 'Error, contáctese con soporte técnico';
                break;
        }
    }
}
