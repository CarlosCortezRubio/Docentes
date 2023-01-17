@extends('layouts.app')
@section('title','Principal')

@section('content')
    <div class="flex-center full-height">
        <div class="content">
            <div class="title m-b-md">
                Bienvenido
            </div>
            <div class="text-center">
                {{ Auth::user()->name }}
                <br>
                {{getTipoUsuario()}}
            </div>
        </div>
    </div>
@stop

