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
                            <label class="control-label col-sm-2" for="title">Subir 
                            </label>
                            <div class="col-sm-10">
                            {{ csrf_field() }}
                            <input type="file" id="fileupload_edit" name="archivos[]" data-url="/admin/archivos/upload" multiple />
                            <div id="files_list_edit"></div>
                            <p id="loading"></p>
                            <input type="hidden" name="file_ids_edit" id="file_ids_edit" value="" />
                            <input type="text" name="archivo_id_edit" id="archivo_id_edit" value="" />
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
    <script>
    $(function () { 
        $('#fileupload_edit').fileupload({ 
            dataType: 'json',
            add: function (e, data) {
                $('#loading').text('Uploading...');
                data.submit();
            },
            done: function (e, data) { 
                $.each(data.result.files, function (index, file) {
                    $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list_edit'));
                    if ($('#file_ids_edit').val() != '') {
                        $('#file_ids_edit').val($('#file_ids_edit').val() + ',');
                    }
                    $('#file_ids_edit').val($('#file_ids_edit').val() + file.fileID);
                });
                $('#loading').text('');
            },
            success: function(data) {
                $('#archivo_id_edit').val(data.archivo_id);
            }
        });
    });
     
</script>