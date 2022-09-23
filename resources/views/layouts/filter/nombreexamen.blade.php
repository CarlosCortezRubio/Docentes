<div class=" col-md col-sm col-xs">
    <label for="nombre">Nombre de Examen</label>
    <input name="nombre" @if ($busqueda->nombre) value='{{$busqueda->nombre}}' @endif placeholder="Ingrese Nombre" id="nombresearch"  class="form-control"/>
</div>
