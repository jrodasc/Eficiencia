<div id="addModal_archivos" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form action="#" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="articulos">Articulos:</label>
                            <div class="col-sm-10">
                                {!! Form::select('articuloarchivo_add', $listaarticulos, null, ['placeholder' => '', 'class' => 'form-control gray-input','id' => 'articuloarchivo_add']); !!}
                                <small>Min: 2, Max: 12, Solo Números</small>
                                <p class="errorarticulo text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="notas">Notas:</label>
                            <div class="col-sm-10">
                                 {!! Form::select('nota_add', array('0' => 'Seleccionar nota'), null, ['placeholder' => '', 'class' => 'form-control gray-input','id' => 'nota_add']); !!}
                                
                                <small>Min: 2, Max: 12, Solo Números</small>
                                <p class="errornota text-center alert alert-danger hidden"></p>
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