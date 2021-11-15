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
    <div class="modal fade show" id="modalplus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">Parametros de Evaluación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <table>
                        <thead>
                            <tr>
                                <td>Alumno</td>
                                <td>Llego a entonar a un DO mayor</td>    
                                <td>Llego a entonar a un DO menor</td>
                                <td>Llego a entonar a un RE mayor</td>   
                                <td>Llego a entonar a un RE menor</td>    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postulantes as $k => $pos)
                            <form action="{{ route('evaluar') }}" id="{{ $pos->codi_post_pos }}" class="evaluar" method="GET">
                                @csrf   
                                <tr>                 
                                    <input type="text" name="codi_pers_per" value="{{  $pos->codi_post_pos }}" style="display: none"/>
                                    <td>{{ $pos->nomb_pers_per." ".$pos->apel_pate_per." ".$pos->apel_mate_per }}</td>
                                    <td><input class="form-control des{{ $pos->codi_post_pos }}" name="nota1" min="0" required type="number" ></td>
                                    <td><input class="form-control des{{ $pos->codi_post_pos }}" name="nota2" min="0" required type="number" > </td>
                                    <td><input class="form-control des{{ $pos->codi_post_pos }}"  name="nota3" min="0" required type="number" ></td>
                                    <td><input class="form-control des{{ $pos->codi_post_pos }}" name="nota4" min="0" required type="number" ></td>
                                    <td><button type="submit" class="btn btn-success des{{ $pos->codi_post_pos }}"> <i class="fas fa-check"></i> </button></td>
                                </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer centrar-content">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
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
    $(".evaluar").submit(function(e) {

        e.preventDefault(); 
    
        var form = $(this);
        var url = form.attr('action');
        
        $.ajax({
               type: "GET",
               url: url,
               data: form.serialize(), 
               success: function(data){
                    //$("tbody tr td").css('background-color', 'black');
                    $(".des"+form.attr('id')).attr('disabled', true);
                    $(".des"+form.attr('id')).attr('disabled', true);
               }
             });
    
        
    });
</script>
@stop