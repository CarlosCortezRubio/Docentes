<div class=" col-md col-sm col-xs">
    <label for="desc">Descripción</label>
    <input name="desc" @if ($busqueda->desc) value='{{$busqueda->desc}}' @endif placeholder="Ingrese Descripcion" id="descsearch"  class="form-control"/>
</div>
