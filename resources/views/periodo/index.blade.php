@extends('adminlte::page')
@section('title','Periodos')

@section('content_header')
    
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
                <form action="" class='formulario'>
                        <div class="form-group">
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Año</label>
                                    <select class="form-control" name="espec" id="espec">
                                        <option >---- Seleccione -----</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2022">2023</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo de Inscripciones</label>
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'><p>-</p></div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
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
                                            <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'><p>-</p></div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
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
                <form action="" class='formulario'>
                <div class="form-group">
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Año</label>
                                    <select class="form-control" name="espec" id="espec">
                                        <option >---- Seleccione -----</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2022">2023</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="">Periodo de Inscripciones</label>
                                    <div class='row'>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'><p>-</p></div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
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
                                            <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                        </div>
                                        <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'><p>-</p></div>
                                        <div class="col-md-5 col-sm-5 col-xs-5">
                                            <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Editar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->  
    <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Inhabilitar Periodo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea inhabilitar el periodo actual?</p>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------------->
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
                        <th scope="col">Año</th>
                        <!--<th scope="col">Seccion</th>-->
                        <th scope="col">Peri. Inscripciones</th>
                        <th scope="col">Peri. Evaluaciones</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>2019</td>
                       <!-- <td>Superior</td>-->
                        <td>12/01/2019 - 16/01/2019</td>
                        <td>17/01/2019 - 22/01/2019</td>
                        <td>Activo</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-times'></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>2020</td>
                         <!--<td>Escolar</td>-->
                        <td>12/01/2020 - 16/01/2020</td>
                        <td>17/01/2020 - 22/01/2020</td>
                        <td>Activo</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-times'></button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>2022</td>
                         <!--<td>Post. Escolar</td>-->
                        <td>12/01/2022 - 16/01/2022</td>
                        <td>17/01/2022 - 22/01/2022</td>
                        <td>Activo</td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit" class='btn btn-primary fa fa-pencil'></button>
                            <button data-toggle="modal" data-target="#modaldelete" class='btn btn-danger fa fa-times'></button>
                        </td>  
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
   {{--@extends('periodo.partials.agregar')
    @extends('periodo.partials.editar')
    @extends('periodo.partials.eliminar')--}}
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
</script>
@stop