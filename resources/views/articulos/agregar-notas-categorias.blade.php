<div id="addModal-notas-categorias" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title-categorias"></h4>
                    <input id="articulo_id" type="hidden" value="{{ $articulos->id}}">
                    <input type="hidden" class="form-control" id="categoria_id_notas" autofocus>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">REF:</label>
                            <div class="col-sm-10">
                                <input type="text" minlength="2" maxlength="12" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="REF_add_categoria" autofocus>
                                <small>Min: 2, Max: 32, Solo Números</small>
                                <p class="errorref text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Hora Máquina:</label>
                            <div class="col-sm-10">
                                <input type="text" minlength="2" maxlength="12" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="horamaquina_add_categoria" autofocus>
                                <small>Min: 2, Max: 32, Solo Números</small>
                                <p class="errorhoramaquina text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Notas:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="notas_add_categoria" cols="40" rows="5"></textarea>
                                <small>Min: 2, Max: 128, Solo Téxto</small>
                                <p class="errornombre text-center alert alert-danger hidden"></p>
                            </div>
                        </div> 
                        <div class="form-group">

                            <label class="control-label col-sm-2" for="content">Subir Archivo:</label>
                            <div class="col-sm-10">
                                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Delete</span>
</button><div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
</div>

                                <input type="file" class="form-control" name="file" >
                                <small>Min: 2, Max: 128, Solo Téxto</small>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div> 

                    </form>
                    <div class="modal-footer-categoria">
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