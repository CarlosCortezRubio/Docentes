<?php

namespace App\Http\Controllers\examen;

use App\Http\Controllers\Controller;
use App\Model\Comentario;
use App\Model\Examen\DetalleExamen;
use App\Model\Examen\Examen;
use App\Model\Examen\ProgramacionExamen;
use App\Model\Examen\SeccionExamen;
use App\Model\Jurado;
use App\Model\JuradoPostulante;
use App\Model\Nota;
use App\Model\Postulante;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $secciones =DB::table('bdsig.vw_sig_seccion as sec')
                    ->join('admision.adm_seccion_estudios as asec','asec.codi_secc_sec','sec.codi_secc_sec')
                    ->select('sec.abre_secc_sec','asec.*')
                    ->where('asec.estado','A')
                    ->get();
        $examenes= Examen::join('admision.adm_examen_admision as exd','exd.id_examen','admision.adm_examen.id_examen')
                         ->join('admision.adm_seccion_estudios as asec','asec.id_seccion','exd.id_seccion')
                         ->join('bdsig.ttablas_det as t','asec.codi_secc_sec','t.codi_tabl_det')
                         ->where('admision.adm_examen.estado','A')
                         ->where('asec.estado','A')
                         ->select('exd.*','nombre','descripcion','nota_apro','nota_maxi','exd.peso','enlace','abre_tabl_det');
       
        if(getSeccion()){
            $examenes= $examenes->where('asec.id_seccion',getIdSeccion())->get();
        }else if(getTipoUsuario()=='Administrador'){
            $examenes= $examenes->get();
        }
        $ids= [];
        foreach ($examenes as $k => $exa) {
            $ids[$k]=$exa->id_examen;
        }
        $secexamen=SeccionExamen::whereIn('id_examen',$ids)
        ->where('estado','A')
        ->get();
        if ($request) {
            return view('examen.index',["secciones"=>$secciones,"examenes"=>$examenes,"secexamen"=>$secexamen,"id_examen"=>$request->id_examen,"cargar"=>true]);
        }else{
            return view('examen.index',["secciones"=>$secciones,"examenes"=>$examenes,"secexamen"=>$secexamen,"cargar"=>false]);
        }
    }

    public function insert(Request $request){
        $examen=new Examen();
        $examendet=new DetalleExamen();
        $tipo=DB::table('admision.adm_tipo_examen')
                ->where('nombre','LIKE','Examen de Admision')
                ->where('estado','A')->first();
        
        try {
            DB::beginTransaction();
            $examen->nombre=$request->nombre;
            $examen->descripcion=$request->descripcion;
            $examen->nota_apro=$request->nota_apro;
            $examen->nota_maxi=$request->nota_maxi;
            
            $examen->estado='A';
            $examen->user_regi=Auth::user()->id;
            $examen->id_tipo_examen=$tipo->id_tipo_examen;
            $examen->enlace=$request->enlace;
            $examen->save();

            if(!$request->cara_elim){
                $examendet->cara_elim='N';
            }else {
                $examendet->cara_elim=$request->cara_elim;
            }
            if(!$request->flag_jura){
                $examendet->flag_jura='N';
            }else{
                $examendet->flag_jura=$request->flag_jura;
            }
            $examendet->id_seccion=$request->id_seccion;
            $examendet->peso=$request->peso;
            $examendet->id_examen=$examen->id_examen;
            $examendet->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
            ->with('no_success', 'Existe un error en los parámetros.');
        }
        return redirect()->back()
        ->with('success', 'Configuración guardada con éxito.');
    }

    public function update(Request $request){
        $examen= Examen::find($request->id_examen);
        $examendet=DetalleExamen::find($request->id_examen_admision);
        try {
            DB::beginTransaction();
            $examen->nombre=$request->nombre;
            $examen->descripcion=$request->descripcion;
            $examen->nota_apro=$request->nota_apro;
            $examen->peso=$request->peso;
            $examen->nota_maxi=$request->nota_maxi;
            $examen->enlace=$request->enlace;
            $examen->user_actu=Auth::user()->id;
            $examen->update();

            if(!$request->cara_elim){
                $examendet->cara_elim='N';
            }else {
                $examendet->cara_elim=$request->cara_elim;
            }
            if(!$request->flag_jura){
                $examendet->flag_jura='N';
            }else{
                $examendet->flag_jura=$request->flag_jura;
            }
            
            $examendet->id_seccion=$request->id_seccion;
            $examendet->update();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
        ->with('no_success', 'Existe un error en los parámetros.');
        }
        return redirect()->back()
        ->with('success', 'Configuración guardada con éxito.');
    }

    public function delete(Request $request){
        $examen=Examen::find($request->id_examen);
        try {
            DB::beginTransaction();
            $examen->estado='E';
            $examen->user_actu=Auth::user()->id;
            $examen->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
        ->with('no_success', 'Existe un error en los parámetros.');
        }
        return redirect()->back()
        ->with('success', 'Configuración guardada con éxito.');
    }

    public function EliminarSeccion(Request $request){
        $sec=SeccionExamen::find($request->id_seccion_examen);
        try {
            DB::beginTransaction();
            $sec->estado='E';
            $sec->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
         //   return redirect()->back()
        //->with('no_success', 'Existe un error en los parámetros.');
        }
        return $sec->id_examen;
    }

    public function EditarSeccion(Request $request){
        $sec=SeccionExamen::find($request->id_seccion_examen);
        try {
            DB::beginTransaction();
            $sec->descripcion=$request->descripcion;
            $sec->porcentaje=$request->porcentaje;
            $sec->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        //    return redirect()->back()
        //->with('no_success', 'Existe un error en los parámetros.');
        }
        return $sec->id_examen;
    }

    public function InsertarSeccion(Request $request){
        $sec=new SeccionExamen;
        try {
            DB::beginTransaction();
            $sec->descripcion=$request->descripcion;
            $sec->porcentaje=$request->porcentaje;
            $sec->estado='A';
            $sec->id_examen=$request->id_examen;
            $sec->save();
            //////////////////////
            $programaciones=ProgramacionExamen::where('id_examen',$request->id_examen)->where('estado','P')->get();
            foreach ($programaciones as $key => $prog) {
                $docentes=Jurado::where('id_programacion_examen',$prog->id_programacion_examen)->where('estado','A')->get();
                $postulantes=Postulante::where('id_programacion_examen',$prog->id_programacion_examen)->where('estado','A')->get();
                foreach ($docentes as $key => $doc) {
                    foreach ($postulantes as $key => $pos) {
                        $jurapost=JuradoPostulante::where('id_postulante',$pos->id_postulante)
                                    ->where('id_jurado',$doc->id_jurado);
                        if ($jurapost->count()==0) {
                            $jurapost=new JuradoPostulante();
                            $jurapost->id_jurado=$doc->id_jurado;
                            $jurapost->id_postulante=$pos->id_postulante;
                            $jurapost->estado='A';
                            $jurapost->save();
                        }else{
                            $jurapost=$jurapost->first();
                        }
                        $coment=Comentario::where('id_jurado_postulante',$jurapost->id_jurado_postulante);
                        if ($coment->count()==0) {
                            $coment=new Comentario();
                            $coment->id_jurado_postulante=$jurapost->id_jurado_postulante;
                            $coment->comentario='';
                            $coment->save();
                        }
                        
                        $nota=new Nota();
                        $nota->id_jurado_postulante=$jurapost->id_jurado_postulante;
                        $nota->id_seccion_examen=$sec->id_seccion_examen;
                        $nota->nota=0;
                        $nota->estado='A';
                        $nota->save();
                    }
                }
            }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        //    return redirect()->back()
        //->with('no_success', 'Existe un error en los parámetros.');
        }
        return $sec->id_examen;
    }

    public function cargar(Request $request){
        $secciones= SeccionExamen::where('id_examen',$request->id_examen)
                                 ->where('estado','A')->get();
        $examen= DetalleExamen::where('id_examen',$request->id_examen)->first();
        $content='';
        foreach ($secciones as $k => $sec) {
            $id='eva'.$sec->id_seccion_examen;
            $plus="";
            if($examen->flag_jura=='N'){
                $plus="<a href='".route('pregunta')."?id_seccion_examen=$sec->id_seccion_examen' class='save'><i class='fa fa-plus-circle'></i></a>";
            }
            
            $content=$content.'<form action="'.route('examen.cargar.delete').'" method="get" id="deletesecc'.$sec->id_seccion_examen.'">'.
                                    "<input type='text' name='id_seccion_examen' value='$sec->id_seccion_examen' style='display:none'>".
                                '</form>'.
                                
                                '<form action="'.route('examen.cargar.update').'" method="get" id="updatesecc'.$sec->id_seccion_examen.'">'.
                                '<div  class="row">'.
                                    "<div id='$id' class='col para-eva'>".
                                        '<div class="row activado centrar-content para-eva-content">'.
                                            "<input type='text' name='id_seccion_examen' value='$sec->id_seccion_examen' style='display:none'>".
                                            '<div class="col input1">'.
                                                "<label>$sec->descripcion</label>".
                                            '</div>'.
                                            '<div class="col-2 input2">'.
                                                "<label>$sec->porcentaje%</label>".
                                            '</div>'.
                                            '<div class="col-2 action centrar-content">'.
                                                "<a href='#' onclick=editar('#$id','#updatesecc".$sec->id_seccion_examen."') class='save'><i class='fa fa-pencil'></i></a>".
                                                $plus.
                                                "<a href='#' onclick=formulario('#deletesecc".$sec->id_seccion_examen."') class='delete'><i class='fa fa-trash'></i></a>".
                                            '</div>'.
                                        '</div>'.
                                    '</div>'.
                                '</div>'.
                            '</form>';
        }
        return  $content;
    }
    
}
