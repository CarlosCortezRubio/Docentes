@extends('adminlte::page')
@section('title', 'Programacion')
@section('content_header')
    @php
        $aulas = getAulas();
        $examenes = getExamenes();
    @endphp
    <form action="{{ route('programacion') }}" method="get">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="row">
                        @include('layouts.filter.descripcionExamen')
                        @include('layouts.filter.seccion')
                        @include('layouts.filter.modalidad')
                    </div>
                    <div class="row">
                        @include('layouts.filter.anio')
                        @include('layouts.filter.ProgramaEstudio')
                        @include('layouts.filter.exajura')
                    </div>
                </div>
                <div class="col-2 centrar-content flex-center btn-search">
                    <button type="submit" class="btn btn-info"><i class="fas fa-search "></i> Buscar</button>
                </div>
            </div>
        </div>
    </form>
@stop
@section('content')
    <div class="modal fade" id="modaladdteorico" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Registrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('programacion.insertTeorico') }}" method="POST" id='formularioaddteorico'>
                        @csrf
                        <div class="form-group">
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="fecha_resol">Fecha de Resoluciòn</label>
                                    <input type="datetime-local" required class="form-control" id="fecha_resol"
                                        name="fecha_resol" placeholder="Ingrese Fecha" />
                                </div>

                                <div class="col-md col-sm col-xs">
                                    <label for="">Aula</label>
                                    <select class="form-control" required name="id_aula" id="id_aula">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($aulas as $k => $aul)
                                            <option value="{{ $aul->id_aula }}">{{ $aul->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md col-sm col-xs">
                                    <label class="row" for="">Modalidad</label>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col">
                                            <input class="col-1" type="radio" id="modalidadV" value="V" required
                                                name="modalidad" />
                                            <label class="col-3 control control--radio" for="modalidadV">Virtual</label>
                                        </div>
                                        <div class="col">
                                            <input class="col-1" type="radio" id="modalidadP" value="P" required
                                                name="modalidad" />
                                            <label class="col-3 control control--radio" for="modalidadP">Presencial</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md col-sm col-xs">
                                    <label class="row" for="">Programa de Estudio</label>
                                    <select class="row buscar form-control" multiple="multiple" required name="id_cupos[]" id="id_cupos">
                                        @foreach ($cupos as $k => $cu)
                                            <option value="{{ $cu->id_cupos }}">
                                                {{ $cu->abre_espe_esp }}@if (is_admin())
                                                    ({{ $cu->abre_secc_sec }}
                                                    @if ($cu->categoria)
                                                        - {{ $cu->categoria }}
                                                    @endif )
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <table class="table table-light">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th>Examen</th>
                                            <th>Minutos</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaexamenadd">
                                        <tr id="r1">
                                            <td>1</td>
                                            <td>
                                                <input type="text" required class="form-control" name="descripcion[]"
                                                    placeholder="Ingrese descripcion" />
                                            </td>
                                            <td>
                                                <select class="form-control" required name="id_examen[]">
                                                    <option value="">---- Seleccione -----</option>
                                                    @foreach ($examenesteoricos as $k => $exa)
                                                        <option value="{{ $exa->id_examen }}">{{ $exa->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" required class="form-control" name="minutos[]"
                                                    placeholder="Ingrese Minutos de Resoluciòn" />
                                            </td>
                                            <td style="text-align: center"><a class="btn btn-danger"
                                                    onclick="eliminarelemento('#r1')" type="button"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: center"><a class="btn btn-success"
                                                    onclick="agregarexamen('#tablaexamenadd')">+</a></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            {{-- <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="minutos">Minutos</label>
                                    <input type="number" required class="form-control" id="minutos" name="minutos"
                                        placeholder="Ingrese Minutos de Resoluciòn" />
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Examen</label>
                                    <select class="form-control" required name="id_examen" id="id_examen">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($examenes as $k => $exa)
                                            <option value="{{ $exa->id_examen }}">{{ $exa->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formularioaddteorico">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Registrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('programacion.insert') }}" method="POST" id='formularioadd'>
                        @csrf
                        <div class="form-group">
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" required class="form-control" id="descripcion"
                                        name="descripcion" placeholder="Ingrese descripcion" />
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="fecha_resol">Fecha de Resoluciòn</label>
                                    <input type="datetime-local" required class="form-control" id="fecha_resol"
                                        name="fecha_resol" placeholder="Ingrese Fecha" />
                                </div>
                            </div>
                            <br>
                            <div class="row d-none">
                                <div class="col-md col-sm col-xs">
                                    <label for="minutos">Minutos</label>
                                    <input type="number" required class="form-control" value='0' id="minutos" name="minutos"
                                        placeholder="Ingrese Minutos de Resoluciòn" />
                                </div>
                            </div>
                            <div class='row'>
                                @include('layouts.filter.examenjurado')
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Aula</label>
                                    <select class="form-control" required name="id_aula" id="id_aula">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($aulas as $k => $aul)
                                            <option value="{{ $aul->id_aula }}">{{ $aul->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Programa de Estudio</label>
                                    <select class="form-control" required name="id_cupos" id="id_cupos">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($cupos as $k => $cu)
                                            <option value="{{ $cu->id_cupos }}">
                                                {{ $cu->abre_espe_esp }}@if (is_admin())
                                                    ({{ $cu->abre_secc_sec }}
                                                    @if ($cu->categoria)
                                                        - {{ $cu->categoria }}
                                                    @endif )
                                                @endif
                                            </option>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="row" for="">Jurados</label>
                                    <select class="row buscar form-control" multiple="multiple" name="codi_doce_per[]"
                                        id="codi_doce_per">
                                        @foreach ($docentes as $k => $doc)
                                            <option value="{{ $doc->codi_pers_per }}">{{ $doc->nomb_comp_per }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="control-group">
                                <label>Modalidad</label>
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col">
                                        <input class="col-1" type="radio" id="modalidadV" value="V" required
                                            name="modalidad" />
                                        <label class="col-3 control control--radio" for="modalidadV">Virtual</label>
                                    </div>
                                    <div class="col">
                                        <input class="col-1" type="radio" id="modalidadP" value="P" required
                                            name="modalidad" />
                                        <label class="col-3 control control--radio" for="modalidadP">Presencial</label>
                                    </div>
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
    <!---------------------------------------------------------------------------------------------------->
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
                    <form action="{{ route('programacion.update') }}" method="POST" id='formularioupd'>
                        @csrf
                        <input type="text" id="id_programacion_examen" name="id_programacion_examen"
                            style="display: none">
                        <div class="form-group">
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" required class="form-control" id="descripcionupd"
                                        name="descripcion" placeholder="Ingrese descripcion" />
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="fecha_resol">Fecha de Resoluciòn</label>
                                    <input type="datetime-local" required class="form-control" id="fecha_resolupd"
                                        name="fecha_resol" placeholder="Ingrese Fecha" />
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="minutos">Minutos</label>
                                    <input type="number" required class="form-control" id="minutosupd" name="minutos"
                                        placeholder="Ingrese Minutos de Resoluciòn" />
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Examen</label>
                                    <select class="form-control" required name="id_examen" id="id_examenupd">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($examenes as $k => $exa)
                                            <option value="{{ $exa->id_examen }}">{{ $exa->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Examen de Requerimiento</label>
                                    <select class="form-control" name="id_prog_requ" id="id_prog_requupd">
                                        <option value="">Ninguno</option>
                                        @foreach ($programaciones as $k => $prog)
                                            <option value="{{ $prog->id_programacion_examen }}">
                                                {{ $prog->examen . ' - ' . $prog->abre_espe_esp . '(' . $prog->abre_secc_sec . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Aula</label>
                                    <select class="form-control" required name="id_aula" id="id_aulaupd">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($aulas as $k => $aul)
                                            <option value="{{ $aul->id_aula }}">{{ $aul->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Programa de Estudio</label>
                                    <select class="form-control" required name="id_cupos" id="id_cuposupd">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($cupos as $k => $cu)
                                            <option value="{{ $cu->id_cupos }}">
                                                {{ $cu->abre_espe_esp }}@if (is_admin())
                                                    ({{ $cu->abre_secc_sec }}
                                                    @if ($cu->categoria)
                                                        - {{ $cu->categoria }}
                                                    @endif )
                                                @endif
                                            </option>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label class="row" for="">Jurados</label>
                                    <select class="row buscar form-control" multiple="multiple" name="codi_doce_per[]"
                                        id="codi_doce_perupd">
                                        @foreach ($docentes as $k => $doc)
                                            <option value="{{ $doc->codi_pers_per }}">{{ $doc->nomb_comp_per }}
                                            </option>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="control-group">
                                <label>Modalidad</label>
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col">
                                        <input class="col-1" type="radio" id="modalidadVupd" value="V"
                                            name="modalidad" />
                                        <label class="col-3 control control--radio" for="modalidadV">Virtual</label>
                                    </div>
                                    <div class="col">
                                        <input class="col-1" type="radio" id="modalidadPupd" value="P"
                                            name="modalidad" />
                                        <label class="col-3 control control--radio" for="modalidadP">Presencial</label>
                                    </div>
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
    <!---------------------------------------------------------------------------------------------------->
    <div class="modal fade show" id="modalplus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">Programar Postulantes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-5 flex-center">
                            <h5>Postulantes Por Programar</h5>
                        </div>
                        <div class="col">

                        </div>
                        <div class="col-5 flex-center">
                            <h5>Postulantes Programados</h5>
                        </div>
                    </div>
                    <div id="cargar" class="row"></div>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('programacion.delete') }}" method="post" id="formdelete">
                        @csrf
                        <input type="text" id="id_programacion_examendel" name="id_programacion_examen"
                            style="display: none">
                    </form>
                    <p>¿Desea eliminar esta Programaciòn?</p>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="submit" class="btn btn-success" form="formdelete">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!---------------------------------------------------------------------------------------------------->
    <div class="card">
        <div class="card-header">
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladd" class='btn btn-success'><i class="fa fa-plus"
                        aria-hidden="true"></i> Nuevo jurado</button>
            </div>
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladdteorico" class='btn btn-success'><i class="fa fa-plus"
                        aria-hidden="true"></i> Nuevo Teorico</button>
            </div>
        </div>
        <div class="card-body">
            <table class="tablaresponse table tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Programa de Estudio</th>
                        <th scope="col">Examen</th>
                        <th scope="col">Seccion</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Aula</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody style='font-size:15px'>

                    @foreach ($programaciones as $k => $prog)
                        @php
                            $fecha = str_replace(' ', 'T', $prog->fecha_resol);
                        @endphp
                        <tr>
                            <th scope="row">{{ $k + 1 }}</th>
                            <td>{{ $prog->descripcion }}</td>
                            <td>{{ $prog->abre_espe_esp . '(' . $prog->anio . ')' }}</td>
                            <td>{{ $prog->examen }}</td>
                            <td>{{ $prog->abre_secc_sec }}</td>
                            <td>{{ $prog->fecha_resol }}</td>
                            <td>{{ $prog->minutos }} min</td>
                            <td>
                                @if ($prog->modalidad == 'V')
                                    Virtual
                                @elseif ($prog->modalidad == 'P')
                                    Presencial
                                @endif
                            </td>
                            <td>{{ $prog->aula }}</td>

                            <td>
                                <form action="{{ route('programacion.alumnos.cargar') }}"
                                    id="formcargaralumno{{ $prog->id_programacion_examen }}" method="get"> @csrf<input
                                        type="number" style="display: none" name="id_programacion_examen"
                                        value="{{ $prog->id_programacion_examen }}"></form>
                                <button class='btn btn-primary fa fa-pencil'
                                    onclick="editar({{ "'" .
                                        $prog->id_programacion_examen .
                                        "'," .
                                        "'" .
                                        $prog->descripcion .
                                        "'," .
                                        "'" .
                                        $fecha .
                                        "'," .
                                        "'" .
                                        $prog->minutos .
                                        "'," .
                                        "'" .
                                        $prog->modalidad .
                                        "'," .
                                        "'" .
                                        $prog->id_examen .
                                        "'," .
                                        "'" .
                                        $prog->id_cupos .
                                        "'," .
                                        "'" .
                                        $prog->id_aula .
                                        "'," .
                                        "'" .
                                        $prog->id_prog_requ .
                                        "'," .
                                        "['" .
                                        implode("','", $arraydoc[$prog->id_programacion_examen]) .
                                        "']" }});"
                                    aria-hidden="true"></button>
                                <button class='btn btn-danger fa fa-trash'
                                    onclick="eliminar({{ $prog->id_programacion_examen }});" aria-hidden="true"></button>
                                <button class='btn btn-success fa fa-plus-circle'
                                    onclick="formulario('#formcargaralumno{{ $prog->id_programacion_examen }}');"
                                    aria-hidden="true"></button>
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
        count = 1;

        function editar(id, descripcion, fecha_resol, minutos, modalidad, id_examen, id_cupos, id_aula, id_prog_requ,
            docentes) {
            $("#id_programacion_examen").val(id);
            $("#descripcionupd").val(descripcion);
            $("#fecha_resolupd").val(fecha_resol);
            $("#minutosupd").val(minutos);
            $("#id_examenupd").val(id_examen);
            $("#id_cuposupd").val(id_cupos);
            $("#id_aulaupd").val(id_aula);
            $("#codi_doce_perupd").val(docentes).trigger('change');
            $("#id_prog_requupd").val(id_prog_requ);
            if (modalidad == 'V') {
                $("#modalidadVupd").attr('checked', true);
                $("#modalidadPupd").attr('checked', false);

            } else if (modalidad == 'P') {
                $("#modalidadPupd").attr('checked', true);
                $("#modalidadVupd").attr('checked', false);
            }
            $("#modaledit").modal('show');
        }

        function AgregarAlumnos(id, data) {
            $("#id_programacion_examenA").val(id);
            $("#nume_docu_sol").multiSelect('select', data);
            $("#modalplus").modal('show');
        }

        function eliminar(id_programacion_examen) {
            $("#id_programacion_examendel").val(id_programacion_examen);
            $("#modaldelete").modal('show');
        }

        function agregarexamen(id) {
            count++;
            htmlexa = "<tr id='r" + count + "'><td>" + count +
                "</td><td><input type='text' required class='form-control' name='descripcion[]' placeholder='Ingrese descripcion' /></td><td><select class='form-control' required name='id_examen[]' ><option value=''>---- Seleccione -----</option>";
            @foreach ($examenesteoricos as $k => $exa)
                htmlexa = htmlexa + "<option value='{{ $exa->id_examen }}'>{{ $exa->nombre }}</option>";
            @endforeach
            htmlexa = htmlexa +
                "</select></td><td><input type='number' required class='form-control' name='minutos[]' placeholder='Ingrese Minutos de Resoluciòn' /></td><td style='text-align: center'><a class='btn btn-danger' onclick='eliminarelemento(" +
                '"#r' + count + '"' + ")' type='button'><i class='fa fa-trash' aria-hidden='true'></i></a></td></tr>";
            $(id).append(htmlexa)
        }

        function eliminarelemento(id) {
            $(id).remove();
        }

        function formulario(id) {
            var form = $(id);
            var url = form.attr('action');

            $.ajax({
                type: form.attr('method'),
                url: url,
                data: form.serialize(),
                success: function(data) {
                    //alert(data);
                    $('#cargar').html(data);
                    $("#modalplus").modal('show');
                }
            });
        }
    </script>
@stop
