<div class="col-md col-sm col-xs">
    <label for="anio">Año</label>
    <select class="buscar browser-default custom-select" required name="anio" id="aniodosearch">
        <option value="%">Todos</option>
        @foreach ($anioexist as $k => $anio)
            <option value="{{ $anio->anio }}"@if ($busqueda->anio == $anio->anio) selected @endif>{{ $anio->anio }}</option>
        @endforeach
    </select>
</div>
