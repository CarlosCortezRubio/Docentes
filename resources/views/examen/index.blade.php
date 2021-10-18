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
    @extends('examen.partials.agregar')
    @extends('examen.partials.editar')
    @extends('examen.partials.eliminar')
    @extends('examen.partials.plus')
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
                        <th scope="col">Descripción</th>
                        <!--<th scope="col">Periodo</th>-->
                        <th scope="col">Nota de Aprobación</th>
                        <th scope="col">Caracter Eliminatorio</th>
                        <th scope="col">Examen por Jurado</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
    
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Examen de Conocimientos Generales</td>
                         <!--<td>2020(Escolar)</td>-->
                        <td>13</td>
                        <td>No</td>
                        <td>No</td>
                        <td>Activo</td> 
                        <td>
                            <button class='btn btn-primary fa fa-pencil' data-toggle="modal" data-target="#modaledit"></button>
                            <button class='btn btn-success fa fa-plus-circle' data-toggle="modal" data-target="#modalplus"></button>
                            <button class='btn btn-danger fa fa-trash' data-toggle="modal" data-target="#modaldelete"></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Examen de Teoria Musical</td>
                         <!--<td>2020(Escolar)</td>-->
                        <td>13</td>
                        <td>No</td>
                        <td>No</td>
                        <td>Activo</td> 
                        <td>
                            <button class='btn btn-primary fa fa-pencil' data-toggle="modal" data-target="#modaledit"></button>
                            <button class='btn btn-success fa fa-plus-circle' data-toggle="modal" data-target="#modalplus"></button>
                            <button class='btn btn-danger fa fa-trash' data-toggle="modal" data-target="#modaldelete"></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Examen de Especialidad</td>
                         <!--<td>2020(Escolar)</td>-->
                        <td>15</td>
                        <td>Si</td>
                        <td>Si</td>
                        <td>Activo</td> 
                        <td>
                            <button class='btn btn-primary fa fa-pencil' data-toggle="modal" data-target="#modaledit"></button>
                            <button class='btn btn-success fa fa-plus-circle' data-toggle="modal" data-target="#modalplus"></button>
                            <button class='btn btn-danger fa fa-trash' data-toggle="modal" data-target="#modaldelete"></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
@stop
@section('css')
<style>
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
        padding-top: 25px
    }
</style>
@stop
@section('js')
<script>
    $(document).ready(function() {
        $('.buscar').select2();
        $('.tablaresponse').DataTable({
            "language": {
               "url": "{{ asset('js/datatables.spanish.json') }}"
            },
            "order": [[ 1, "asc" ]],
            "info": false,
            "stateSave": true,
            "columnDefs": [
               { "orderable": false, "targets": 0 }
            ],
            "pageLength": 100
         });
    });

    numberid=0;
    function Agregar(id) {
        var content='<div  class="row">'+
                        '<div id="eva'+numberid+'" class="col para-eva">'+
                            '<div class="row desactivado centrar-content para-eva-content">'+
                                '<div class="col">'+
                                    '<input type="text" required class="form-control">'+
                                '</div>'+
                                '<div class="col-2">'+
                                    '<input type="number" required class="form-control">'+
                                '</div>'+
                                '<div class="col-1 centrar-content">'+
                                    `<a href="#" onclick="GuardarEva('#eva`+numberid+`')" class='save'><i class="fa fa-check"></i></a>`+
                                    `<a href="#" onclick="eliminar('#eva`+numberid+`')" class='delete'><i class="fa fa-undo"></i></a>`+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
        $(id).append(content);
        numberid++;
    }
    function eliminar(id){
        $(id).remove();
    }
    function GuardarEva(id){
        label1="<label>"+$(id+" div .col input").val()+"</label>";
        label2="<label>"+$(id+" div .col-2 input").val()+"%</label>";
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

    function editar(id){
        valor1=$(id+" div .col label").html();
        valor2=$(id+" div .col-2 label").html();
        valor2=valor2.substring(0, valor2.length - 1);
        input1="<input required type='text' class='form-control' value='"+valor1+"'>";
        input2="<input required type='number' class='form-control' value='"+valor2+"'>";
        chec="<a href='#' onclick='GuardarEva("+'"'+id+'"'+")' class='save'><i class='fa fa-check'></i></a>";
        del="<a href='#' onclick='Cancelar("+'"'+id+'"'+","+'"'+valor1+'"'+","+'"'+valor2+'"'+")' class='delete'><i class='fa fa-undo'></i></a>";
        $(id+" div .col").html(input1);
        $(id+" div .col-2").html(input2);
        $(id+" div .col-1 .save").remove();
        $(id+" div .col-1 .delete").remove();
        $(id+" div .col-1").append(chec+del);
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
</script>
@stop