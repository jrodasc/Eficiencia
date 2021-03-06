<!-- Modal form to edit a form -->
    <div id="editModal-notas" class="modal fade" role="dialog">
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
                                <input type="text" class="form-control" id="id_edit_categoria" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">REF:</label>
                            <div class="col-sm-10">
                                <input type="text" minlength="2" maxlength="12" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="REF_edit_categoria" autofocus>
                                <small>Min: 2, Max: 32, Solo Números</small>
                                <p class="errorref text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Hora Máquina:</label>
                            <div class="col-sm-10">
                                <input type="text" minlength="2" maxlength="12" class="form-control" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" id="horamaquina_edit_categoria" autofocus>
                                <small>Min: 2, Max: 32, Solo Números</small>
                                <p class="errorhoramaquina text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Notas:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="nombre_edit_categoria" cols="40" rows="5"></textarea>
                                <small>Min: 2, Max: 128, Solo Téxto</small>
                                <p class="errornombre text-center alert alert-danger hidden"></p>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Fecha:</label>
                            <div class="col-sm-10">
                                <div class='input-group date' id='datetimepicker8'>
                                    <input type='text' class="form-control" id="fecha_edit_categoria" name="fecha_add_categoria"  />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div> 
                        </div>
                    </form>
                    <div class="modal-footer-categorias">
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
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    
        <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
            <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript">
    $(function () {
        
        $('#datetimepicker8').datetimepicker({ format: 'YYYY-MM-DD HH:mm'
    });

        
        



        

    });
</script>