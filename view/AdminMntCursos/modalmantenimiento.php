<div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalmantenimiento">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Nuevo Registro</h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="cursos_form">
                <div class="modal-body">
                    <input type="hidden" name="cur_id" id="cur_id">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Categoria: <span class="tx-danger">*</span> </label>
                            <select class="form-control select2" style="width: 100%" data-placeholder="Seleccione" name="cat_id" id="cat_id">
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombre: <span class="tx-danger">*</span> </label>
                            <input class="form-control tx-uppercase" id="cur_nom" type="text" name="cur_nom" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Descripcion: <span class="tx-danger">*</span> </label>
                            <input class="form-control tx-uppercase" id="cur_descrip" type="text" name="cur_descrip" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Inicio: <span class="tx-danger">*</span> </label>
                            <input class="form-control tx-uppercase" id="cur_fech_ini" type="date" name="cur_fech_ini" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Fin: <span class="tx-danger">*</span> </label>
                            <input class="form-control tx-uppercase" id="cur_fech_fin" type="date" name="cur_fech_fin" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Instructor: <span class="tx-danger">*</span> </label>
                            <select class="form-control select2" style="width: 100%" data-placeholder="Seleccione" name="inst_id" id="inst_id">
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="add" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i>Guardar</button>
                    <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i>Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>