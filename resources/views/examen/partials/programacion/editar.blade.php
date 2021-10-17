<div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-4">
            <div class="modal-header border-0 mb-2">
                <h2>Modificar Examen</h2>
            </div>
            <div class="modal-body">
                <form action="" class='formulario'>
                    <div class="form-group">
                        <div class="row ">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="">Especialidad</label>
                                <select class="browser-default custom-select">
                                    <option >---- Seleccione -----</option>
                                    <option selected value="">Guitarra</option>
                                    <option value="">Violín</option>
                                    <option value="">Violonchelo</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="">Descripción</label>
                                <input type="text" value='Examen de Admision' class="form-control" placeholder="Ingrese Nota" />
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="">Inicio</label>
                                <input type="text" value='2021-02-23 12:30:00' class="form-control datetime" placeholder="Ingrese Fecha" />
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="">Fin</label>
                                <input type="text" value='2021-02-23 12:30:00' class="form-control datetime" placeholder="Ingrese Fecha"  />
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col'></div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="">Tiempo</label>
                                <input type="time" value='2021-02-23 12:30:00' class="form-control" placeholder="Ingrese tiempo de respuesta" />
                            </div>
                            <div class='col'></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class='row'>
            <div class="modal-footer border-0 col"> <button id='btnmodal' type="button" class="btn signup col-12 btn-success" data-dismiss="modal">Modificar</button> </div>
            <!--<div class="modal-footer border-0 col"> <button id='btnmodal' type="button" class="btn signup col-12 btn-primary" data-dismiss="modal">Preguntas</button> </div>-->
            <div class="modal-footer border-0 col"> <button id='btnmodal' type="button" class="btn signup col-12 btn-danger" data-dismiss="modal">Cancelar</button> </div>
            </div>
        </div>
    </div>
</div>