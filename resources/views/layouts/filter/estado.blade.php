<div class="col-md col-sm col-xs">
    <label for="estado">Estado</label>
    <select class="buscar form-control" name="estado" id="estadosearch">
        <option value="%">Todos</option>
        <option value="A" @if ($busqueda->estado == 'A') selected @endif>Activo</option>
        <option value="I" @if ($busqueda->estado == 'I') selected @endif>Inactivo</option>
    </select>
</div>
