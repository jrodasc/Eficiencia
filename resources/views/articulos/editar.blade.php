<!-- Modal form to edit a form -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_edit" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">REF:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="REF_edit" autofocus>
                                <small>Min: 2, Max: 32, Solo Números</small>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Nombre:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_edit" autofocus>
                                <small>Min: 2, Max: 32, Solo Texto</small>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Categoria:</label>
                            <div class="col-sm-10">
                                {!! Form::select('categorias_id_edit',array('0' => 'Seleccione Opcion', '1' => 'Hidraulica', '2' => 'Neumatica', '3' => 'Otras Intervenciones' ), 0,[], array('class' => 'form-control gray-input', 'id' => 'categorias_id_edit')) !!}
                                 <select class="form-control gray-input" required=""  id="categorias_id_edit">
                                    <option value="0">Seleccionar opción</option>
                                    <option value="1">Hidraulica</option>
                                    <option value="2">Neumaticos</option>
                                    <option value="3">Otras intervenciones</option></select>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                            <span class='glyphicon glyphicon-check'></span> Edit
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>