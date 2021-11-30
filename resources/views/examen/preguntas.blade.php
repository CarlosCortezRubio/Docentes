@extends('adminlte::page')
@section('title', 'Preguntas')

@section('content_header')
    <div id='title'>
        <hr width="100%" size="5" noshade>
        <h2>Registro de preguntas</h2>
        <hr width="100%" size="5" noshade>
    </div>
@stop
@section('content')
        <form>
            <div class='row' id='agregar'>
                <div class='col-2 '></div>
                <div class="input-group regiresp col ">
                    <div class="input-group-prepend">
                        <button class="btn btn-success"onclick='AgregarPregunta($("#tipo").val(),"#examen","#inputpregunta");' type="button">+</button>
                    </div>
                    <input type="text" id='inputpregunta' class="form-control" placeholder="Ingrese una Pregunta"
                        aria-label="" aria-describedby="basic-addon1">
                    <select name="tipo" id="tipo">
                        <option value="1">Una sola respuesta</option>
                        <option value="2">Una o mas respuestas</option>
                        <option value="3">Una sola respuesta con audio</option>
                        <option value="4">Texto de respuesta</option>
                        <option value="5">Verdadero y falso</option>
                    </select>
                </div>
                <div class='col-2'></div>
            </div>
            <div id='examen'>

            </div>
            <br>
            <br>
            <br>
            <div class='row'>
                <a type="submit" class="btn btn-success col-2" href="/MOCUNM/PHP/VISTA/RegistrarCategoria.php">Grabar Respuestas</a>
                <div class='col-1'></div>
                <a type="submit" class="btn btn-danger col-2" href="/MOCUNM/PHP/VISTA/RegistrarCategoria.php">Cancelar</a>
            </div>
        </form>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/Examen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preguntas.css') }}">
@stop
@section('js')
    <script src="{{ asset('js/Pregunta.js') }}"></script>
@stop
