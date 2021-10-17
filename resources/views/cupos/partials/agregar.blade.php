<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Registrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            <form action="" class='formulario'>
                    <div class="form-group">
                        <div class="row ">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="">Programa de Estudio</label>
                                <select class="browser-default custom-select">
                                    <option >---- Seleccione -----</option>
                                    <option value="">Guitarra</option>
                                    <option value="">Violín</option>
                                    <option value="">Violonchelo</option>
                                </select>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="">Periodo</label>
                                <select class="form-control" name="espec" id="espec">
                                    <option >---- Seleccione -----</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="">Secciòn</label>
                                <select class="browser-default custom-select">
                                    <option >---- Seleccione -----</option>
                                    <option value="">Superior</option>
                                    <option value="">Escolar</option>
                                    <option value="">Post. Escolar</option>
                                </select>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="">Cantidad Cupos</label>
                                <input type="number" class="form-control" placeholder="Ingrese Cupos" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer centrar-content">
                <button type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>