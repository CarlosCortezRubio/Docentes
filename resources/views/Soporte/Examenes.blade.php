@extends('adminlte::page')
@section('title', 'Soporte Examenes')
@section('content_header')
    <form action="{{ route('examensoporte') }}" method="get">
        @csrf
        <div class="container">
            <div class="row">
                @include('layouts.filter.index', ['filtro' => 'seccion', 'tipo' => 1])
                @include('layouts.filter.index', ['filtro' => 'ProgramaEstudio', 'tipo' => 1])
                <div class="col-md col-sm col-xs centrar-content flex-center btn-search">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search "></i> Buscar</button>
                </div>
            </div>
        </div>
    </form>
@stop
@section('content')
    <!-----------------------------MODALS--------------------------->
    <div class="modal fade show" id="modalplus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog mw-100 w-75 modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">Examenes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="cargar" style="overflow: scroll;height: 65vh;" class="row"></div>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------------->

    <!------------------------------BODY---------------------------->
    <div class="card-header row">
    </div>
    <div class="card">
        <div class="card-body" style="overflow: scroll;">
            <table class="tablaresponse table tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Postulante</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $key => $alu)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $alu->nomb_comp_per }}</td>
                            <td>{{ $alu->desc_tabl_det }}</td>
                            <td>
                                {{-- @if ($per->estado == 'A')
                                    <button onclick="desactivado('{{ $per->id_periodo }}');"
                                        class='btn btn-danger fa fa-times'></button>
                                @else
                                    <button onclick="mensaje('{{ $per->id_periodo }}');"
                                        class='btn btn-success fa fa-check'></button>
                                @endif --}}
                                <div class="row">
                                    <div class="col">
                                        <form id="form{{ $alu->nume_docu_per }}"
                                            action="{{ route('examensoporte.cargarJurados') }}" method="GET">
                                            <input type='text' name='nume_docu_per' value='{{ $alu->nume_docu_per }}'
                                                style='display: none' />
                                        </form>
                                        <button onclick="formulario('#form{{ $alu->nume_docu_per }}');"
                                            class='btn btn-primary fa fa-list'></button>
                                    </div>
                                    <div class="col">
                                        <form id="formescrito{{ $alu->nume_docu_per }}"
                                            action="{{ route('examensoporte.cargarTeoria') }}" method="GET">
                                            <input type='text' name='nume_docu_per' value='{{ $alu->nume_docu_per }}'
                                                style='display: none' />
                                        </form>
                                        <button onclick="formulario('#formescrito{{ $alu->nume_docu_per }}');"
                                            class='btn btn-primary fa fa-book'></button>
                                    </div>
                                    <div class="col">
                                        <form id="formaudio{{ $alu->nume_docu_per }}"
                                            action="{{ route('examensoporte.cargarAudio') }}" method="GET">
                                            <input type='text' name='nume_docu_per' value='{{ $alu->nume_docu_per }}'
                                                style='display: none' />
                                        </form>
                                        <button onclick="formulario('#formaudio{{ $alu->nume_docu_per }}');"
                                            class='btn btn-primary fa fa-volume'></button>
                                    </div>
                                </div>


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
        function formulario(id) {
            var form = $(id);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                beforeSend: function() {
                    $('#cargar').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#cargar').html(data);
                    $("#modalplus").modal('show');
                },
                error: function(data) {
                    alert("ha  ocurrido un error");
                }
            });
        }

        function examenes(nume_docu_per) {

            $.ajax({
                type: 'GET',
                url: '{{ route('examensoporte.cargarJurados') }}',
                data: {
                    'nume_docu_per': nume_docu_per
                },
                beforeSend: function() {
                    $('#cargar').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#cargar').html(data);
                    $("#modalplus").modal('show');
                },
                error: function(data) {
                    alert("ha  ocurrido un error");
                }
            });
        }

        function evaluar(nume_docu_per) {

            $.ajax({
                type: 'GET',
                url: '{{ route('examensoporte.cargarJurados') }}',
                data: {
                    'nume_docu_per': nume_docu_per
                },
                beforeSend: function() {
                    $('#cargar').html("<center>Cargando...</center>");
                },
                success: function(data) {
                    $('#cargar').html(data);
                    $("#modalplus").modal('show');
                },
                error: function(data) {
                    alert("ha  ocurrido un error");
                }
            });
        }
    </script>
@stop
