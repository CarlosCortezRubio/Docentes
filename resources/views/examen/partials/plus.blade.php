<div class="modal fade show" id="modalplus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title">Parametros de Evaluación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-1'></div>
                    <div class='col'>
                        <div class="row">
                            <div class="col centrar-content">
                                <label>Descripcion</label> 
                            </div>
                            <div class="col-2 centrar-content">
                                <label>Porcentaje</label> 
                            </div>
                        </div>
                    </div>
                    <div class='col-1'></div>
                </div>
                <div class='row'>
                    <div class='col-1'></div>
                    <div id='categoria' class='col'></div>
                    <div class='col-1'></div>
                </div>
                <div class="row centrar-content">
                    <button class='btn btn-succes' onclick='Agregar("#categoria");'>Agregar</button>
                </div>
            </div>
            <div class="modal-footer centrar-content">
                <button type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>