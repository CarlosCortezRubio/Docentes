@extends('adminlte::page')
@section('title', 'Periodos')
@php
    $secciones = getSecciones();
@endphp
@section('content_header')
    <form action="{{ route('periodo') }}" method="get">
        @csrf
        <div class="container">
            <div class="col">
                <div class="row">
                    @include('layouts.filter.index', ['filtro' => 'anio', 'tipo' => 1])
                    @include('layouts.filter.index', ['filtro' => 'seccion', 'tipo' => 1])
                    @include('layouts.filter.index', ['filtro' => 'estado', 'tipo' => 1])
                </div>

                <div class="row centrar-content flex-center btn-search">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search "></i> Buscar</button>
                </div>
            </div>
        </div>
    </form>
@stop
@section('content')
    <!-----------------------------MODALS--------------------------->
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
                    <form action="{{ route('periodo.insert') }}" id="addform" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Año</label>
                                    <select class="buscarform-control" name="anio" required id="anio_add">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($anios as $key => $an)
                                            <option>{{ $an }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row' @if (getTipoUsuario() != 'Administrador' || getSeccion() != null) style="display:none " @endif>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Seccion</label>
                                    <select class="form-control" name="id_seccion" required id="id_seccion">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($secciones as $key => $secc)
                                            <option @if (getIdSeccion() == $secc->id_seccion) selected @endif
                                                value="{{ $secc->id_seccion }}">{{ $secc->abre_secc_sec }}
                                                @if ($secc->categoria)
                                                    -{{ $secc->categoria }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo de Inscripciones</label>
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class=" form-control dateadd" required
                                                name="peri_insc_inic" id="peri_insc_inic" placeholder="Ingrese Cupos" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'>
                                            <p></p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class="form-control dateadd" required name="peri_insc_fin"
                                                id="peri_insc_fin" placeholder="Ingrese Cupos" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo de Evaluaciones</label>
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class=" form-control dateadd" required
                                                name="peri_eval_inic" id="peri_eval_inic" placeholder="Ingrese Cupos" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'>
                                            <p></p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class="form-control dateadd" required name="peri_eval_fin"
                                                id="peri_eval_fin" placeholder="Ingrese Cupos" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo de Publicacion de notas</label>
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class=" form-control dateadd" required
                                                name="peri_show_inic" id="peri_show_inic" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'>
                                            <p></p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class="form-control dateadd" required name="peri_show_fin"
                                                id="peri_show_fin" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" form="addform" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('periodo.update') }}" method="POST" id="formedit" class='formulario'>
                        @csrf
                        <input type="text" style="display:none" name="id_periodo" id="id_periodo">
                        <div class="form-group">
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Año</label>
                                    <select class="form-control" name="anio" required id="anio_edit">
                                        <option>---- Seleccione -----</option>
                                        @foreach ($anios as $key => $an)
                                            <option>{{ $an }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row' @if (getTipoUsuario() != 'Administrador' || getSeccion() != null) style="display:none " @endif>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Seccion</label>
                                    <select class="form-control" name="id_seccion" required id="codi_secc_sec_edit">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($secciones as $key => $secc)
                                            <option value="{{ $secc->id_seccion }}">{{ $secc->abre_secc_sec }}
                                                @if ($secc->categoria)
                                                    -{{ $secc->categoria }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo de Inscripciones</label>
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class="form-control dateedit" required
                                                name="peri_insc_inic" id="peri_insc_inic_edit"
                                                placeholder="Ingrese Cupos" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'>
                                            <p></p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class="form-control dateedit" required
                                                name="peri_insc_fin" id="peri_insc_fin_edit"
                                                placeholder="Ingrese Cupos" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo de Evaluaciones</label>
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class="form-control dateedit" required
                                                name="peri_eval_inic" id="peri_eval_inic_edit" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'>
                                            <p></p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class="form-control dateedit" required
                                                name="peri_eval_fin" id="peri_eval_fin_edit" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo de Publicacion de notas</label>
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class=" form-control dateedit" required
                                                name="peri_show_inic" id="peri_show_inic_edit" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'>
                                            <p></p>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input type="date" class="form-control dateedit" required
                                                name="peri_show_fin" id="peri_show_fin_edit" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formedit">Editar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="modal fade" id="modalDesactivado" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Inhabilitar Periodo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea inhabilitar el periodo?</p>
                    <form action="{{ route('periodo.update.estado') }}" method="post" id="formdesa">
                        @csrf
                        <input type="text" style="display:none" id="id_periodo_des" name="id_periodo">
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" form="formdesa" class="btn btn-success">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
    <div class="modal fade" id="modalActivado" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Inhabilitar Periodo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="mensajeCambio"></p>
                    <form action="{{ route('periodo.update.estado') }}" method="post" id="formact">
                        @csrf
                        <input type="text" style="display:none" id="id_periodo_act" name="id_periodo">
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" form="formact" class="btn btn-success">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------BODY---------------------------->
    <div class="card">
        <div class="card-header">
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladd" class='btn btn-success'><i class="fa fa-plus"
                        aria-hidden="true"></i> Nuevo</button>
            </div>
        </div>
        <div class="card-body" style="overflow: scroll;">
            <table class="tablaresponse table tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Año</th>
                        @if (is_admin())
                            <th scope="col">Seccion</th>
                        @endif
                        <th scope="col">Peri. Inscripciones</th>
                        <th scope="col">Peri. Evaluaciones</th>
                        <th scope="col">Peri. Publicación</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periodos as $key => $per)
                        @php
                            $peri_insc_inic = substr($per->peri_insc_inic, 0, strpos($per->peri_insc_inic, ' '));
                            $peri_insc_fin = substr($per->peri_insc_fin, 0, strpos($per->peri_insc_fin, ' '));
                            $peri_eval_inic = substr($per->peri_eval_inic, 0, strpos($per->peri_eval_inic, ' '));
                            $peri_eval_fin = substr($per->peri_eval_fin, 0, strpos($per->peri_eval_fin, ' '));
                            $peri_show_inic = substr($per->peri_show_inic, 0, strpos($per->peri_show_inic, ' '));
                            $peri_show_fin = substr($per->peri_show_fin, 0, strpos($per->peri_show_fin, ' '));
                        @endphp
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $per->anio }}</td>
                            @if (is_admin())
                                <td>{{ $per->abre_secc_sec }} @if ($per->categoria)
                                        - {{ $per->categoria }}
                                    @endif
                                </td>
                            @endif
                            <td>{{ $peri_insc_inic . '    ||    ' . $peri_insc_fin }}</td>
                            <td>{{ $peri_eval_inic . '    ||    ' . $peri_eval_fin }}</td>
                            <td>
                                @if ($peri_show_inic)
                                    {{ $peri_show_inic . '    ||    ' . $peri_show_fin }}
                                @endif
                            </td>
                            <td
                                style="color: @if ($per->estado == 'I') red @elseif ($per->estado == 'A') green @endif">
                                @if ($per->estado == 'A')
                                    Activo
                                @elseif ($per->estado == 'I')
                                    Inactivo
                                @endif
                            </td>
                            <td>
                                @if ($per->estado == 'A')
                                    <button onclick="desactivado('{{ $per->id_periodo }}');"
                                        class='btn btn-danger fa fa-times'></button>
                                @else
                                    <button onclick="mensaje('{{ $per->id_periodo }}');"
                                        class='btn btn-success fa fa-check'></button>
                                @endif
                                <button
                                    onclick=editar({{ "'" .
                                        $per->id_periodo .
                                        "','" .
                                        $per->anio .
                                        "','" .
                                        $per->id_seccion .
                                        "','" .
                                        $peri_show_inic .
                                        "','" .
                                        $peri_show_fin .
                                        "','" .
                                        $peri_insc_inic .
                                        "','" .
                                        $peri_insc_fin .
                                        "','" .
                                        $peri_eval_inic .
                                        "','" .
                                        $peri_eval_fin .
                                        "'" }});
                                    class='btn btn-primary fa fa-pencil'></button>
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

            $('#anio_edit').change(function(e) {
                $('.dateedit').attr('max', $('#anio_edit').val() + '-12-31');
                $('.dateedit').attr('min', $('#anio_edit').val() + '-01-01');
            });
            $('#anio_add').change(function(e) {
                $('.dateadd').attr('max', $('#anio_add').val() + '-12-31');
                $('.dateadd').attr('min', $('#anio_add').val() + '-01-01');
            });


        });

        function editar(id_periodo, anio, id_seccion, peri_show_inic, peri_show_fin, peri_insc_inic, peri_insc_fin, peri_eval_inic, peri_eval_fin) {
            $("#id_periodo").val(id_periodo);
            $("#anio_edit").val(anio);
            $("#codi_secc_sec_edit").val(id_seccion);
            $("#peri_insc_inic_edit").val(peri_insc_inic);
            $("#peri_insc_fin_edit").val(peri_insc_fin);
            $("#peri_eval_inic_edit").val(peri_eval_inic);
            $("#peri_eval_fin_edit").val(peri_eval_fin);
            $("#peri_show_inic_edit").val(peri_show_inic);
            $("#peri_show_fin_edit").val(peri_show_fin);
            $("#modaledit").modal('show');
            $('.dateedit').attr('max', anio + '-12-31');
            $('.dateedit').attr('min', anio + '-01-01');
        }

        function desactivado(id_periodo) {
            $("#id_periodo_des").val(id_periodo);
            $("#modalDesactivado").modal('show');
        }

        function mensaje(id_periodo) {
            $.ajax({
                type: "GET",
                url: '{{ route('periodo.mensaje') }}',
                data: {
                    'idperiodo': id_periodo
                },
                success: function(data) {
                    $('#mensajeCambio').html(data);
                    $("#modalActivado").modal('show');
                    $("#id_periodo_act").val(id_periodo);
                }
            });
        }

        function exportar(tipo) {
            $.ajax({
                type: "POST",
                url: '{{ route('periodo.export') }}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'anio': "{{ $busqueda->anio }}",
                    'seccion': "{{ $busqueda->seccion }}",
                    'estado': "{{ $busqueda->estado }}",
                    'tipo': tipo

                },
                success: function(data) {
                    return data;
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
            });
        }
    </script>
@stop
