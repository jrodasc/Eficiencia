<div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">REF:</label>
                            <div class="col-sm-10">
                                <input type="number" minlength="2" maxlength="12" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"   id="REF_add" autofocus>
                                <small>Min: 2, Max: 12, Solo Números</small>
                                <p class="errorref text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Nombre:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_add" autofocus>
                                <small>Min: 2, Max: 32, Solo Texto</small>
                                <p class="errornombre text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                       
                        <!--<div class="form-group">
                            <label class="control-label col-sm-2" for="content">Notas:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="notas_add" cols="40" rows="5"></textarea>
                                <small>Min: 2, Max: 128, Solo Téxto</small>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div> -->
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Guardar
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>