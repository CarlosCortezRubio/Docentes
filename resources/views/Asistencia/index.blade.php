@extends('adminlte::page')
@php
    $docentes = getDocentes();
@endphp
@section('title', 'Asistencia')
@section('content_header')
    <form action="{{ route('cupo') }}" method="get">
        @csrf
        <div class="container">
            <div class="row">
                {{-- <div class="col-12">
                    <div class="row">
                        @include('layouts.filter.index', ['filtro' => 'ProgramaEstudio', 'tipo' => 1])
                        @include('layouts.filter.index', ['filtro' => 'anio', 'tipo' => 1])
                        @include('layouts.filter.index', ['filtro' => 'seccion', 'tipo' => 1])
                    </div>
                </div>
                <div class="col-12 centrar-content flex-center btn-search">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search "></i> Buscar</button>
                </div> --}}
            </div>
        </div>
    </form>
@stop
@section('content')
    <!--------------------------MODALS------------------------------------>
    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Registrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th>Docente</th>
                                <th>Numero de Documento</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tdata">

                        </tbody>
                        <tfoot>
                            <tr>
                                <form action="">
                                    <td colspan="4">
                                        <select class="buscar form-control" required name="codi_pers_per" id="codi_pers_per">
                                            @foreach ($docentes as $k => $doc)
                                                <option value="{{ $doc->codi_pers_per }}">
                                                    {{ $doc->nomb_comp_per . ' - ' . $doc->nume_docu_per }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><button type="submit" class="btn btn-success">Marcar</button></td>
                                </form>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formadd">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------------------------------------->
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
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formedit">Editar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!--------------------------BODY--------------------------------------->
    <div class="card">
        <div class="card-header">
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladd" class='btn btn-success'><i class="fa fa-plus"
                        aria-hidden="true"></i> Nuevo</button>
            </div>
        </div>
        <div class="card-body" style="overflow: scroll;">
            <table class="table tablaresponse tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo de asistencia</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Docente</td>
                        <td><button class="btn btn-primary" onclick="docentes()" type="button">Asistencia</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Postulante</td>
                        <td><button class="btn btn-primary" onclick="postulantes()" type="button">Asistencia</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--------------------------------------------------------------------->
@stop
@section('js')
    <script>
        function docentes() {
            var url = "{{ route('CargarDocentes') }}";
            $.ajax({
                type: 'get',
                data: {
                    token: '{{ csrf_token() }}'
                },
                url: url,
                beforeSend: function() {
                    $('#tdata').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#tdata').html(data);
                },
                error: function(data) {
                    alert("ha  ocurrido un error");
                }
            });
            $("#modaladd").modal('show');
        }

        function postulantes() {
            $("#modaladd").modal('show');
        }
    </script>
@stop
