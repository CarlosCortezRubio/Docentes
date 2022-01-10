@extends('adminlte::page')
@section('title','Examen')

@section('content_header')
    <form class="row centrar-content">
        <div class="col-md col-sm-3 col-xs-3">
            <label for="">Descripción</label>
            <input type="text" class="form-control" name="" id="">
        </div>
        <div class="col-md col-sm-3 col-xs-3">
            <label for="espec" >Periodo</label>
            <select class="buscar form-control" name="espec" id="espec">
                <option value="">Todos</option>
                <option value="2020">2020(Escolar)</option>
                <option value="2021">2021(Escolar)</option>
                <option value="2022">2022(Escolar)</option>
            </select>
        </div>
        <div class="col-md col-sm col-xs centrar-content btn-search flex-center">
            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Buscar</button>
        </div>
        
    </form>
@stop
@section('content')
    <!_/////////////////////////MODALS/////////////////////////////->
    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Registrar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('examen.insert') }}" method="POST" id='formularioadd'>
                    @csrf   
                    <div class="form-group">
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="">Nombre</label>
                                    <input type="text" required class="form-control" id="nombre"  name="nombre" placeholder="Ingrese Nombre" />
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="">Descripcion</label>
                                    <textarea  class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese Descripción" ></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="enlace">Enlace</label>
                                    <input type="text" required class="form-control" id="enlace"  name="enlace" placeholder="Ingrese Enlace" />
                                </div>
                            </div>
                            <br>
                            <div class='row'  @if (getTipoUsuario()!='Administrador' || getSeccion()!=null) style="display:none " @endif>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Seccion</label>
                                    <select class="form-control" name="id_seccion" required id="id_seccion">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($secciones as $key => $secc)
                                            <option  @if(getIdSeccion()==$secc->id_seccion) selected @endif value="{{ $secc->id_seccion }}">{{ $secc->abre_secc_sec }} 
                                                @if($secc->categoria) -{{ $secc->categoria }}  @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs"> 
                                    <label for="">Nota de Aprobación</label>
                                    <input type="number" required id="nota_apro" min="1" name="nota_apro" class="form-control" placeholder="Ingrese Nota" />    
                                </div>  
                                <div class="col-md col-sm col-xs"> 
                                    <label for="">Nota Maxima</label>
                                    <input type="number" required id="nota_maxi" min="1" name="nota_maxi" class="form-control" placeholder="Ingrese Nota" />    
                                </div>
                            </div>
                            <br>
                           
                                <div class="col-md col-sm col-xs">
                                    <div class="inputGroup">
                                        <input id="cara_elim" name="cara_elim" value="S" type="checkbox"/>
                                        <label for="cara_elim">Carac. Eliminatorio</label><br>
                                    </div>
                                </div>
                                <div class="col-md col-sm col-xs"> 
                                    <div class="inputGroup">
                                        <input id="flag_jura" name="flag_jura" value="S" type="checkbox"/>
                                        <label for="flag_jura">Examen por Jurado</label><br>
                                    </div>
                                </div>
                           
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formularioadd">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Editar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('examen.update') }}" method="POST" id='formularioupd'>
                    @csrf   
                        <input type="text" id="id_examen" name="id_examen" style="display: none">
                        <input type="text" id="id_examen_admision" name="id_examen_admision" style="display: none">
                        <div class="form-group">
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="">Nombre</label>
                                    <input type="text" required class="form-control" id="nombreupd"  name="nombre" placeholder="Ingrese Nombre" />
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="">Descripcion</label>
                                    <textarea  class="form-control" id="descripcionupd" name="descripcion" placeholder="Ingrese Descripción" ></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="enlace">Enlace</label>
                                    <input type="text" required class="form-control" id="enlaceupd"  name="enlace" placeholder="Ingrese Enlace" />
                                </div>
                            </div>
                            <br>
                            <div class='row'  @if (getTipoUsuario()!='Administrador' || getSeccion()!=null) style="display:none " @endif>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Seccion</label>
                                    <select class="form-control" name="id_seccion" required id="codi_secc_secupd">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($secciones as $key => $secc)
                                            <option  @if(getIdSeccion()==$secc->id_seccion) selected @endif value="{{ $secc->id_seccion }}">{{ $secc->abre_secc_sec }}
                                                @if($secc->categoria) -{{ $secc->categoria }}  @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs"> 
                                    <label for="">Nota de Aprobación</label>
                                    <input type="number" required id="nota_aproupd" min="1" name="nota_apro" class="form-control" placeholder="Ingrese Nota" />    
                                </div>  
                                <div class="col-md col-sm col-xs"> 
                                    <label for="">Nota Maxima</label>
                                    <input type="number" required id="nota_maxiupd" min="1" name="nota_maxi" class="form-control" placeholder="Ingrese Nota" />    
                                </div>
                            </div>
                            <br>
                            <div class="col-md col-sm col-xs">
                                <div class="inputGroup">
                                    <input id="cara_elimupd" name="cara_elim" value="S" type="checkbox"/>
                                    <label for="cara_elimupd">Carac. Eliminatorio</label><br>
                                </div>
                            </div>
                            <div class="col-md col-sm col-xs"> 
                                <div class="inputGroup">
                                    <input id="flag_juraupd" name="flag_jura" value="S" type="checkbox"/>
                                    <label for="flag_juraupd">Examen por Jurado</label><br>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formularioupd">Editar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Eliminar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('examen.delete') }}" method="post" id="formdelete">
                        @csrf
                        <input type="text" id="id_examendel" name="id_examen" style="display: none">
                    </form>
                    <p>¿Desea eliminar el Examen?</p>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formdelete">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show" id="modalplus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">Parametros de Evaluación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class='col-1'></div>
                        <div class='col'>
                            <div class="row">
                                <div class="col centrar-content">
                                    <label>Descripcion</label> 
                                </div>
                                <div class="col-2 centrar-content">
                                    <label>Porcentaje</label> 
                                </div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                        <div class='col-1'></div>
                    </div>
                    <div class='row'>
                        <div class='col-1'></div>
                        <div id='categoria' class='col'></div>
                        <div class='col-1'></div>
                    </div>
                    <div class="row centrar-content">
                        <button class='btn btn-succes' id="btnagregar">Agregar</button>
                    </div>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-/////////////////////////////BODY////////////////////////////->
    <div class="card">
        <div class="card-header">
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladd" class='btn btn-success'><i class="fa fa-plus" aria-hidden="true"></i> Nuevo</button>
            </div>
        </div>
        <div class="card-body"> 
            <table class="tablaresponse table tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Nota de Aprobación</th>
                        <th scope="col">Nota Maxima</th>
                        <th scope="col">Caracter Eliminatorio</th>
                        <th scope="col">Examen con Jurado</th>
                        @if (!getSeccion())
                            <th scope="col">Seccion</th>
                        @endif
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($examenes as $k => $exa)
                    <tr>
                        <th scope="row">{{ $k+1 }}</th>
                        <td>{{ $exa->nombre }}</td>
                        <td>{{ $exa->nota_apro }}</td>
                        <td>{{ $exa->nota_maxi }}</td>
                        <td style="color:@if ($exa->cara_elim=='S') green  @elseif ($exa->cara_elim=='N')  red  @endif">@if ($exa->cara_elim=='S') Si  @elseif ($exa->cara_elim=='N')  No  @endif    </td>
                        <td style="color:@if ($exa->flag_jura=='S') green  @elseif ($exa->flag_jura=='N')  red  @endif">@if ($exa->flag_jura=='S') Si  @elseif ($exa->flag_jura=='N')  No  @endif    </td>
                        @if (!getSeccion())
                            <td>{{ $exa->abre_tabl_det }}</td> 
                        @endif
                        <td>
                            <button class='btn btn-primary fa fa-pencil' onclick="editarexamen({{ "'".$exa->id_examen."',".
                                                                                            "'".$exa->id_examen_admision."',".
                                                                                            "'".$exa->nombre."',".
                                                                                            "'".$exa->descripcion."',".
                                                                                            "'".$exa->id_seccion."',".
                                                                                            "'".$exa->nota_apro."',".
                                                                                            "'".$exa->nota_maxi."',".
                                                                                            "'".$exa->cara_elim."',".
                                                                                            "'".$exa->flag_jura."',".
                                                                                            "'".$exa->enlace."'" }})"></button>
                                                                                           @if ($exa->flag_jura=='S')
                            <button class='btn btn-success fa fa-plus-circle' onclick="Cargar({{ $exa->id_examen }})"></button>
                                                                                           @endif
                            <button class='btn btn-danger fa fa-trash' onclick="eliminarexamen({{ $exa->id_examen }})"></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@stop
@section('js')
<script>
    $(document).ready(function() {
         if ({{ $cargar }}==0)
             Cargar({{ $id_examen }});
    });
    function editarexamen(id_examen,id_examen_admision,nombre,descripcion,id_seccion,nota_apro,nota_maxi,cara_elim,flag_jura,enlace) {
        $("#id_examen").val(id_examen);
        $("#id_examen_admision").val(id_examen_admision);
        $("#nombreupd").val(nombre);
        $("#descripcionupd").val(descripcion);
        $("#codi_secc_secupd").val(id_seccion);
        $("#nota_aproupd").val(nota_apro);
        $("#nota_maxiupd").val(nota_maxi);
        $("#enlaceupd").val(enlace);
        if(cara_elim=='S'){
            $("#cara_elimupd").attr('checked',true);
        }else if(cara_elim=='N'){
            $("#cara_elimupd").attr('checked',false);
        }
        if(flag_jura=='S'){
            $("#flag_juraupd").attr('checked',true);
        }else if(flag_jura=='N'){
            $("#flag_juraupd").attr('checked',false);
        }
        $("#modaledit").modal('show');
    }
    
    function eliminarexamen(id_examen){
        $("#id_examendel").val(id_examen);
        $("#modaldelete").modal('show');
    }
    ////////////////////////
    function Agregar(id,id_examen) {
        var content='<div  class="row">'+
                        '<div id="edicion" class="col para-eva">'+
                            '<form action="'+"{{ route('examen.cargar.insert') }}"+'" method="get" id="insersecc">@csrf'+
                            '<div class="row desactivado centrar-content para-eva-content">'+
                                '<div class="col">'+
                                    '<input type="text" name="descripcion" required class="form-control">'+
                                    '<input type="number" name="id_examen" style="display:none" value="'+id_examen+'">'+
                                '</div>'+
                                '<div class="col-2">'+
                                    '<input type="number" min=1 max=100 name="porcentaje" required class="form-control">'+
                                '</div>'+
                                '<div class="col-1 centrar-content">'+
                                    `<a href="#" onclick="formulario('#insersecc')" class='save'><i class="fa fa-check"></i></a>`+
                                    `<a href="#" onclick="eliminar('#edicion')" class='delete'><i class="fa fa-undo"></i></a>`+
                                '</div>'+
                            '</div>'+
                            '</form>'+
                        '</div>'+
                    '</div>';
        $(id).append(content);
    }
    function eliminar(id){
        $(id).remove();
    }
    
    function editar(id,idsec){
        valor1=$(id+" div .input1 label").html();
        valor2=$(id+" div .input2 label").html();
        valor2=valor2.substring(0, valor2.length - 1);
        input1="<input required name='descripcion' type='text' class='form-control' value='"+valor1+"'>";
        input2="<input required type='number' min=1 max=100 name='porcentaje' class='form-control' value='"+valor2+"'>";
        chec="<a href='#' onclick='formulario("+'"'+idsec+'"'+")' class='save'><i class='fa fa-check'></i></a>";
        del="<a href='#' onclick='Cancelar("+'"'+id+'"'+","+'"'+valor1+'"'+","+'"'+valor2+'"'+")' class='delete'><i class='fa fa-undo'></i></a>";
        $(id+" div .input1").html(input1);
        $(id+" div .input2").html(input2);
        $(id+" div .action a").remove();
        $(id+" div .action a").remove();
        $(id+" div .action").append(chec+del);
        $(id+" div").removeClass("activado");
        $(id+" div").addClass("desactivado");
    }
    function Cancelar(id,valor1,valor2){
        label1="<label>"+valor1+"</label>";
        label2="<label>"+valor2+"%</label>";
        plus="<a href='/MOCUNM/PHP/VISTA/Preguntas.php' class='save'><i class='fa fa-plus-circle'></i></a>";
        pen="<a href='#' onclick='editar("+'"'+id+'"'+")' class='save'><i class='fa fa-pencil'></i></a>";
        del="<a href='#' onclick='eliminar("+'"'+id+'"'+")' class='delete'><i class='fa fa-trash'></i></a>";
        $(id+" div .col").html(label1);
        $(id+" div .col-2").html(label2);
        $(id+" div .col-1 .save").remove();
        $(id+" div .col-1 .delete").remove();
        $(id+" div .col-1").append(plus+pen+del);
        $(id+" div").removeClass("desactivado");
        $(id+" div").addClass("activado");
    }

    function Cargar(id){
        $.ajax({
            type: "GET",
            url: '{{ route("examen.cargar") }}',
            data: {'id_examen':id},
            success: function (data) {
                $('#categoria').html(data);
                $("#modalplus").modal('show');
                $("#btnagregar").attr('onclick','Agregar("#categoria",'+id+');');
            }
        });
    }

    function formulario(id) {
        var form = $(id);
        var url = form.attr('action');
        
        $.ajax({
               type: form.attr('method'),
               url: url,
               data: form.serialize(), 
               success: function(data){
                    Cargar(data);
                    $('.multi').multiselect();
               }
             });
    }
    
</script>
@stop