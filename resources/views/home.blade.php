@extends('layouts.app')
@section('title','Principal')

@section('content')
    <div class="flex-center full-height">
        <div class="content">
            <div class="title m-b-md">
                Bienvenido
            </div>
            <div class="text-center">
                <h4>{{ Auth::user()->name }}</h4>
                <br>
               <h5>{{getTipoUsuario()}}</h5>
            </div>
        </div>
    </div>
@stop

