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
                            <label class="control-label col-sm-2" for="title">Articulos:</label>
                            <div class="col-sm-10">
                                {!! Form::select('articulo', $articulos, null, ['placeholder' => '', 'class' => 'form-control gray-input','id' => 'articulo_add']); !!}
                               
                                <small>Min: 2, Max: 12, Solo Números</small>
                                <p class="errorref text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Notas:</label>
                            <div class="col-sm-10">
                                 {!! Form::select('nota', array('0' => 'Seleccionar nota'), null, ['placeholder' => '', 'class' => 'form-control gray-input','id' => 'nota']); !!}
                                
                                <small>Min: 2, Max: 12, Solo Números</small>
                                <p class="errorref text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Subir <form action="/admin/archivos/nota" method="post">
    {{ csrf_field() }}
    Product name:
    <br />
    <input type="text" name="name" />
    <br /><br />
    Product photos (can add more than one):
    <br />
    <input type="file" id="fileupload" name="archivos[]" data-url="/admin/archivos/upload" multiple />
    <br />
    <div id="files_list"></div>
    <p id="loading"></p>
    <input type="hidden" name="file_ids" id="file_ids" value="" />
    <input type="submit" value="Upload" />
</form>
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
    
    <script>
    $(function () { alert("dffgh");
        $('#fileupload').fileupload({ 
            dataType: 'json',
            add: function (e, data) {
                $('#loading').text('Uploading...');
                data.submit();
            },
            done: function (e, data) { alert("hola");
                $.each(data.result.files, function (index, file) {
                    $('<p/>').html(file.name + ' (' + file.size + ' KB)').appendTo($('#files_list'));
                    if ($('#file_ids').val() != '') {
                        $('#file_ids').val($('#file_ids').val() + ',');
                    }
                    $('#file_ids').val($('#file_ids').val() + file.fileID);
                });
                $('#loading').text('');
            }
        });
    });
</script>