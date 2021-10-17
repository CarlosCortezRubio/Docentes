@extends('adminlte::page')
@section('title','Evaluacion')

@section('content_header')
    <form class="table row ">
        <div class=" col-md col-sm col-xs">
            <label for="">Programa de Estudio</label>
            <select class="buscar browser-default custom-select">
                <option >Todos</option>
                <option value="">Guitarra-Escolar(2019)</option>
                <option value="">Violín-Escolar(2019)</option>
                <option value="">Violonchelo-Escolar(2019)</option>
            </select>
        </div>
        <div class="col-md col-sm col-xs">
            <label for="espec" >Modalidad</label>
            <select class="buscar form-control" name="espec" id="espec">
                <option value="">Todos</option>
                <option value="2020">Virtual</option>
                <option value="2021">Presencial</option>
            </select>
        </div>
        <div class="col-md col-sm col-xs">
            <label for="espec" >Aula</label>
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
    </form>
@stop
@section('content')
    <div class="card">
        <div class="card-body"> 
            <table class="tablaresponse table tprincipal table-striped">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Programa de Estudio</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Aula</th>
                        <th scope="col">Acciones</th>
    
                    </tr>
                </thead>
                <tbody style='font-size:15px'>
                    <tr>
                        <th scope="row">1</th>
                        <td>Guitarra-Escolar(2021)</td>
                        <td>2021-02-23 12:30:00 - 13:30:00</td>
                        <td>150 min</td>
                        <td>Presencial</td>
                        <td>AULA 12-A</td>
                        <td>
                            <button class='btn btn-primary'data-toggle="modal" data-target="#modalplus"><i class="fa fa-pencil" aria-hidden="true"></i> Evaluar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Violín-Escolar(2021)</td>
                        <td>2021-02-23 12:30:00 - 13:30:00</td>
                        <td>150 min</td>
                        <td>Presencial</td>
                        <td>AULA 12-A</td>
                        <td>
                            <button class='btn btn-primary'data-toggle="modal" data-target="#modalplus"><i class="fa fa-pencil" aria-hidden="true"></i> Evaluar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Violonchelo-Escolar(2021)</td>
                        <td>2021-02-23 12:30:00 - 13:30:00</td>
                        <td>150 min</td>
                        <td>Presencial</td>
                        <td>AULA 12-A</td>
                        <td>
                            <button class='btn btn-primary'data-toggle="modal" data-target="#modalplus"><i class="fa fa-pencil" aria-hidden="true"></i> Evaluar</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Violonchelo-Escolar(2021)</td>
                        <td>2021-02-23 12:30:00 - 13:30:00</td>
                        <td>150 min</td>
                        <td>Presencial</td>
                        <td>AULA 12-A</td>
                        <td>
                            <button class='btn btn-primary'data-toggle="modal" data-target="#modalplus"><i class="fa fa-pencil" aria-hidden="true"></i> Evaluar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @extends('evaluacion.partials.evaluar')
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