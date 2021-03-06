<div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
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
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Subir 
                            </label>
                            <div class="col-sm-10">
                            
                            {{ csrf_field() }}
                            
                            
                            <input type="file" id="fileupload" name="archivos[]" data-url="/admin/archivos/upload" multiple />
                            
                            <div id="files_list"></div>
                            <p id="loading"></p>
                            <input type="hidden" name="file_ids" id="file_ids" value="" />
                            <input type="hidden" name="archivo_id" id="archivo_id" value="" />
                            
                        </div>
                        </div>
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
     <script>
    $(function () { 
        $('#fileupload').fileupload({ 
            dataType: 'json',
            add: function (e, data) {
                $('#loading').text('Uploading...');
                data.submit();
            },
            done: function (e, data) { 
                $.each(data.result.files, function (index, file) {
                    $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list'));
                    if ($('#file_ids').val() != '') {
                        $('#file_ids').val($('#file_ids').val() + ',');
                    }
                    $('#file_ids').val($('#file_ids').val() + file.fileID);
                });
                $('#loading').text('');
            },
            success: function(data) {
                $('#archivo_id').val(data.archivo_id);
            }
        });
    });
</script>