@extends('adminlte::page')

@section('title', 'Programacion')
@section('content_header')
    <form class="table row centrar-content">
        <div class="col-md col-sm col-xs">
            <label for="">Programa de Estudio</label>
            <select class="buscar browser-default custom-select">
                <option>Todos</option>
                <option value="">Guitarra-Escolar(2019)</option>
                <option value="">Violín-Escolar(2019)</option>
                <option value="">Violonchelo-Escolar(2019)</option>
            </select>
        </div>
        <div class="col-md col-sm col-xs">
            <label for="">Descripción</label>
            <input type="text" class='form-control' name="" id="">
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
            <button type="submit" class="btn btn-info">Buscar</button>
        </div>
    </form>
@stop
@section('content')
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
                    <form action="{{ route('programacion.insert') }}" method="POST" id='formularioadd'>
                        @csrf
                        <div class="form-group">
                            <div class='row'  @if (getTipoUsuario()!='Administrador' || getSeccion()!=null) style="display:none " @endif>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Seccion</label>
                                    <select class="form-control" name="codi_secc_sec" required id="codi_secc_sec">
                                        <option value="">---- Seleccione -----</option>
                                        @foreach ($secciones as $key => $secc)
                                            <option  @if(getCodSeccion()==$secc->codi_secc_sec) selected @endif value="{{ $secc->codi_secc_sec }}">{{ $secc->abre_secc_sec }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="col-md col-sm col-xs">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text" required class="form-control" id="descripcion" name="descripcion"
                                        placeholder="Ingrese descripcion" />
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
                            <div class="row ">
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
                            <div class="control-group">
                                <label>Modalidad</label>
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col">
                                        <input class="col-1" type="radio" id="modalidadV" value="V" name="modalidad"/>
                                        <label class="col-3 control control--radio" for="modalidadV">Virtual</label>
                                    </div>
                                    <div class="col">
                                        <input class="col-1" type="radio" id="modalidadP" value="P" name="modalidad"/>
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
    <div class="card">
        <div class="card-header">
            <div class='col'>
                <button data-toggle="modal" data-target="#modaladd" class='btn btn-success'><i class="fa fa-plus"
                        aria-hidden="true"></i> Nuevo</button>
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
                        <th scope="col">Horario</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Aula</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>

                    </tr>
                </thead>
                <tbody style='font-size:15px'>
                    <tr>
                        <th scope="row">1</th>
                        <td>Examen de Conocimiento</td>
                        <td>Guitarra-Escolar(2021)</td>
                        <td>Examen A</td>
                        <td>2021-02-23 12:30:00 - 13:30:00</td>
                        <!--<td>2021-02-24 12:30:00</td>-->
                        <td>150 min</td>
                        <td>Presencial</td>
                        <td>AULA 12-A</td>
                        <td>Activo</td>
                        <td>
                            <button class='btn btn-primary fa fa-pencil' aria-hidden="true"></button>
                            <button class='btn btn-danger fa fa-trash' aria-hidden="true"></button>
                            <button class='btn btn-success fa fa-plus-circle' aria-hidden="true"></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Examen de Conocimiento</td>
                        <td>Violín-Escolar(2021)</td>
                        <td>Examen A</td>
                        <td>2021-02-23 12:30:00 - 13:30:00</td>
                        <!--<td>2021-02-24 12:30:00</td>-->
                        <td>150 min</td>
                        <td>Presencial</td>
                        <td>AULA 12-A</td>
                        <td>Activo</td>
                        <td>
                            <button class='btn btn-primary fa fa-pencil' aria-hidden="true"></button>
                            <button class='btn btn-danger fa fa-trash' aria-hidden="true"></button>
                            <button class='btn btn-success fa fa-plus-circle' aria-hidden="true"></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Examen de Conocimiento</td>
                        <td>Violonchelo-Escolar(2021)</td>
                        <td>Examen B</td>
                        <td>2021-02-23 12:30:00 - 13:30:00</td>
                        <!--<td>2021-02-24 12:30:00</td>-->
                        <td>150 min</td>
                        <td>Presencial</td>
                        <td>AULA 12-A</td>
                        <td>Activo</td>
                        <td>
                            <button class='btn btn-primary fa fa-pencil' aria-hidden="true"></button>
                            <button class='btn btn-danger fa fa-trash' aria-hidden="true"></button>
                            <button class='btn btn-success fa fa-plus-circle' aria-hidden="true"></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Examen de Conocimiento</td>
                        <td>Violonchelo-Escolar(2021)</td>
                        <td>Examen C</td>
                        <td>2021-02-23 12:30:00 - 13:30:00</td>
                        <!--<td>2021-02-24 12:30:00</td>-->
                        <td>150 min</td>
                        <td>Presencial</td>
                        <td>AULA 12-A</td>
                        <td>Activo</td>
                        <td>
                            <button class='btn btn-primary fa fa-pencil' aria-hidden="true"></button>
                            <button class='btn btn-danger fa fa-trash' aria-hidden="true"></button>
                            <button class='btn btn-success fa fa-plus-circle' aria-hidden="true"></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop

