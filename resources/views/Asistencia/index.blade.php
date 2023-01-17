@extends('adminlte::page')
@php
    $docentes = getDocentes();
    $estudiantes = getEstudiantes();
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
    <div class="modal fade" id="modaladd-do" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Asistencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formdoc" action="{{ route('addasistencia') }}" method="get">
                        <div class="row">
                            <div class="col-9">
                                <select class="buscar row browser-default custom-select" required name="codi_pers_per"
                                    id="codi_pers_per">
                                    <option value=""> -- Seleccione Docente -- </option>
                                    @foreach ($docentes as $k => $doc)
                                        <option value="{{ $doc->codi_pers_per }}">{{ $doc->nomb_comp_per }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="tipo" class="d-none" value="DC">
                            </div>
                            <div class="col-3">
                                <a onclick="formulario('#formdoc')" class="btn btn-success">Marcar Entrada</a>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div id="asistencias">

                    </div>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------------------------------------->
    <div class="modal fade" id="modaladd-po" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Asistencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formes" action="{{ route('addasistencia') }}" method="get">
                        <div class="row">
                            <div class="col-9">
                                <select class="buscar row browser-default custom-select" required name="codi_pers_per"
                                    id="codi_pers_per">
                                    <option value=""> -- Seleccione Postulante -- </option>
                                    @foreach ($estudiantes as $k => $doc)
                                        <option value="{{ $doc->codi_pers_per }}">{{ $doc->nomb_comp_per }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="tipo" class="d-none" value="PO">
                            </div>
                            <div class="col-3">
                                <a onclick="formulariopo('#formes')" class="btn btn-success">Marcar Entrada</a>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div id="asistenciases">

                    </div>
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
                    tipo: 'DC',
                    token: '{{ csrf_token() }}'
                },
                url: url,
                beforeSend: function() {
                    $('#tdata').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#asistencias').html(data);
                    $("#modaladd-do").modal('show');
                    cargar();
                },

                error: function(data) {
                    alert("ha  ocurrido un error");
                }
            });
        }

        function postulantes() {
            var url = "{{ route('CargarPostulantes') }}";
            $.ajax({
                type: 'get',
                data: {
                    tipo: 'PO',
                    token: '{{ csrf_token() }}'
                },
                url: url,
                beforeSend: function() {
                    $('#tdata').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#asistenciases').html(data);
                    $("#modaladd-po").modal('show');
                    cargarpo();
                },

                error: function(data) {
                    alert("ha  ocurrido un error");
                }
            });
        }


        function cargar() {
            $(".buscar").select2({
                dropdownParent: $('#modaladd-do')
            });
            $('#tablasasistencia').DataTable({
                "language": {
                    "url": "{{ asset('js/datatables.spanish.json') }}"
                },
                "order": [
                    [4, "asc"]
                ],
                "info": false,
                "stateSave": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }],
                "pageLength": 10
            });
        }

        function cargarpo() {
            $(".buscar").select2({
                dropdownParent: $('#modaladd-po')
            });
            $('#tablasasistenciapo').DataTable({
                "language": {
                    "url": "{{ asset('js/datatables.spanish.json') }}"
                },
                "order": [
                    [4, "asc"]
                ],
                "info": false,
                "stateSave": true,
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }],
                "pageLength": 10
            });
        }

        function formulario(id) {
            var form = $(id);
            var url = form.attr('action');

            $.ajax({
                type: form.attr('method'),
                url: url,
                data: form.serialize(),

                beforeSend: function() {
                    $('#tdata').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#asistencias').html(data);
                    cargar();
                },
                error: function(data) {
                    alert("ha  ocurrido un error, verifique los parámetros");
                }
            });
        }

        function formulariopo(id) {
            var form = $(id);
            var url = form.attr('action');

            $.ajax({
                type: form.attr('method'),
                url: url,
                data: form.serialize(),

                beforeSend: function() {
                    $('#tdata').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#asistenciases').html(data);
                    cargarpo();
                },
                error: function(data) {
                    alert("ha  ocurrido un error, verifique los parámetros");
                }
            });
        }
    </script>
@stop
