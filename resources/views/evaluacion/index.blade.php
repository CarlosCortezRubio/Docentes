@extends('layouts.app')
@section('title','Evaluacion')
@section('content_header')
{{-- <form class="table row ">
    <div class=" col-md col-sm col-xs">
        <label for="">Programa de Estudio</label>
        <select class="buscar browser-default custom-select">
            <option>Todos</option>
            <option value="">Guitarra-Escolar(2019)</option>
            <option value="">Violín-Escolar(2019)</option>
            <option value="">Violonchelo-Escolar(2019)</option>
        </select>
    </div>
    <div class="col-md col-sm col-xs">
        <label for="espec">Modalidad</label>
        <select class="buscar form-control" name="espec" id="espec">
            <option value="">Todos</option>
            <option value="2020">Virtual</option>
            <option value="2021">Presencial</option>
        </select>
    </div>
    <div class="col-md col-sm col-xs">
        <label for="espec">Aula</label>
        <select class="buscar form-control" name="espec" id="espec">
            <option value="">Todos</option>
            <option value="2020">AULA 12-A</option>
            <option value="2021">AULA 12-B</option>
            <option value="2021">AULA 13-A</option>
            <option value="2021">AULA 13-B</option>
            <option value="2021">AULA 14-A</option>
            <option value="2021">AULA 14-B</option>
            <option value="2021">AULA 15-A</option>
        </select>
    </div>
    <div class="col-md col-sm col-xs centrar-content flex-center btn-search">
        <button type="submit" class="btn btn-info"><i class="fas fa-search "></i> Buscar</button>
    </div>
</form>--}}
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="tablaresponse table tprincipal table-striped">
                            <thead class="thead">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Examen</th>
                                    <th scope="col">Programa de Estudio</th>
                                    <th scope="col">Horario</th>
                                    <th scope="col">Tiempo</th>
                                    <th scope="col">Modalidad</th>
                                    <th scope="col">Aula</th>
                                    <th scope="col">Acciones</th>

                                </tr>
                            </thead>
                            <tbody style='font-size:15px'>
                                @foreach ($programaciones as $k => $prog)
                                <tr>
                                    <th scope="row">{{ $k+1 }}</th>
                                    <td>{{ $prog->examen }}</td>
                                    <td>{{ $prog->abre_espe_esp . '(' . $prog->anio . ')' }}</td>
                                    <td>{{ $prog->fecha_resol }}</td>
                                    <td>{{ $prog->minutos }} min</td>
                                    <td>@if ($prog->modalidad == 'V') Virtual @elseif ($prog->modalidad=='P') Presencial
                                        @endif</td>
                                    <td>{{ $prog->aula }}</td>
                                    <td>
                                        <form
                                            action="{{ route('evaluacion.cargar', ['id_programacion_examen'=>$prog->id_programacion_examen,'id_examen'=>$prog->id_examen]) }}"
                                            id="form{{ $prog->id_programacion_examen }}" method="get"></form>
                                        <button class='btn btn-primary'
                                            onclick="formulario('#form{{ $prog->id_programacion_examen }}')"><i
                                                class="fa fa-pencil" aria-hidden="true"></i> Evaluar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade show" id="modalplus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title">Parametros de Evaluación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="cargar" class="modal-body">

            </div>
            <div class="modal-footer centrar-content">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    function formulario(id) {
        var form = $(id);
        
        $.ajax({
               type: form.attr('method'),
               url: form.attr('action'),
               data: form.serialize(), 
               success: function(data){
                   //alert(data);
                    $('#cargar').html(data);
                    $("#modalplus").modal('show');
                }
             });
    }
    function Evaluar(id) {
        var form = $(id);
        var opcion = confirm("¿Está seguro de grabar las notas?");
        if (opcion == true) {
            $.ajax({
                type: form.attr('method'),
                url: "{{ route('evaluacion.evaluar') }}",
                data: form.serialize(), 
                success: function(data){
                    if(data=="fallo de parametros"){
                        alert("Falto completar o corregir un parametro");
                    }else{
                        $('#cargar').html(data);
                        alert("Las notas fueron grabadas satisfactoriamente");
                    }
                 }
              });
        }
        
    }
    function Abstener(id) {
        var form = $(id);
        var opcion = confirm("¿Está seguro que desea Abstenerse?");
        if (opcion == true) {
        $.ajax({
               type: form.attr('method'),
               url: "{{ route('evaluacion.abstener') }}",
               data: form.serialize(), 
               success: function(data){
                   //alert(data);
                   if(data=="fallo de parametros"){
                        alert("Falto completar o corregir un parametro");
                   }else if(data=="Es necesario realizar un comentario para esta opción"){
                        alert(data);
                   }else{
                        $('#cargar').html(data);
                        alert("Usted se abstuvo satisfactoriamente");
                   }
                }
             });
        }
    }
</script>
@stop