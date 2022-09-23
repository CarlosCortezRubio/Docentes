<div class="col-md col-sm col-xs">
    <label for="jura">Examen por Jurado</label>
    <select class="buscar form-control" name="jura" id="jurasearch">
        <option value="%">Todos</option>
        <option value="S" @if ($busqueda->jura == 'S') selected @endif>Si</option>
        <option value="N" @if ($busqueda->jura == 'N') selected @endif>No</option>
    </select>
</div>
