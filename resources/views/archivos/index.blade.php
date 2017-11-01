@extends('admin.layout')

@section('content')
 <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row custom-wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                        <h2 class="m0 text-uppercase pull-left xs-fix">Administrador de Archivos</h2>
                        
                        <a class="add-modal btn btn-primary pull-right xs-fix" href="#">
                        <span class="glyphicon glyphicon-plus"></span>
                        Agregar Categoria
                        </a>
                    </div>
                    {{-- @if ($message = Session::get('success'))
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> ¡Genial!</h4>
                                <p>{{ $message }}</p>
                            </div>
                        </div>
                    @endif --}}
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m20 xs-scroll">
                        <table id="dtTalleres" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($archivos as $indexKey => $archivo)
                                    <tr>
                                        <td class="col1">{{ $indexKey+1 }}</td>
                                    <td>{{$archivo->nombre}}</td>
                                    <td>{{$archivo->created_at}}</td>
                                        <td>
                                            <a class="btn btn-info" href="#">Descargar</a>
                                            <button class="edit-modal btn btn-info" data-id="{{$archivo->id}}" data-nombre="{{$archivo->filename}}" data-fecha="{{$archivo->created_at}}" >
                                            <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                            <button class="delete-modal btn btn-danger" data-id="{{$archivo->id}}" data-id="{{$archivo->id}}" data-nombre="{{$archivo->filename}}" data-fecha="{{$archivo->created_at}}">
                                            <span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                            
                                        </td>
                                    </tr>
                                   @endforeach
                            </tbody>
                        </table>
                        {{-- {!! $data->render() !!} --}}
                    </div>
                </div>
            </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="/js/upload/vendor/jquery.ui.widget.js"></script>
<script src="/js/upload/jquery.iframe-transport.js"></script>
<script src="/js/upload/jquery.fileupload.js"></script>
        @include('archivos.agregar')
        @include('archivos.editar')
        @include('archivos.eliminar')
        <script type="text/javascript">
            $('.add-modal').on('click',function(){
            $('.modal-title').text('Agregar');
            $('#nombre_add').val("");
            $('#fecha_add').val("");
            $('#addModal').modal('show');
        });
            $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            
            $('#id_edit').val($(this).data('id'));
            $('#nombre_edit').val($(this).data('nombre'));
            $('#fecha_edit').val($(this).data('fecha'));
            
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
            

            $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#nombre_archivo_delete').val($(this).data('nombre'));
            $('#fecha_archivo_delete').val($(this).data('fecha'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $(document).ready(function() {
        $('select[id="articulo_add"]').on('change',function(e){
            var articuloID = $(this).val();

            if(articuloID){ 
                $.ajax({
                    url: '/admin/archivos-notas/'+articuloID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){ 
                        $('select[id="nota"]').empty(); 
                        $.each(data, function(key, value){
                            $('select[id="nota"]').append('<option value="'+ key +'">'+ value + '</option>');
                        });
                    }
                });
            }else{
                $('select[id="estado"]').empty();
            }
        });
    });

            
        </script>
    </div>
@stop