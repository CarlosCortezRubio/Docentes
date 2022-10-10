@php
    $anioexist = getAnios();
@endphp
<div class="col-md col-sm col-xs">
    <label for="anio">Año <a style="color: red">*</a></label>
    <select class="buscar browser-default custom-select" required name="anio" id="aniodosearch">
        @foreach ($anioexist as $k => $anio)
            <option value="{{ $anio->anio }}"@if ($busqueda->anio == $anio->anio) selected @endif>{{ $anio->anio }}</option>
        @endforeach
    </select>
</div>
