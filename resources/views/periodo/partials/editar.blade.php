<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            <form action="" class='formulario'>
            <div class="form-group">
                        <div class='row'>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="">Año</label>
                                <select class="form-control" name="espec" id="espec">
                                    <option >---- Seleccione -----</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2022">2023</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="">Periodo de Inscripciones</label>
                                <div class='row'>
                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                        <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                    </div>
                                    <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'><p>-</p></div>
                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                        <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label for="">Periodo de Evaluaciones</label>
                                <div class='row'>
                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                        <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                    </div>
                                    <div class='col-md-2 col-sm-2 col-xs-2 centrar-content'><p>-</p></div>
                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                        <input  type="date" class="form-control" placeholder="Ingrese Cupos" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer centrar-content">
                <button type="button" class="btn btn-success" data-dismiss="modal">Editar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>