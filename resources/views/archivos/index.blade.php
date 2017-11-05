@extends('admin.layout')

@section('content')

 <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row custom-wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                        <h2 class="m0 text-uppercase pull-left xs-fix">Administrador de Archivos</h2>
                        
                        <a class="add-modal-archivos btn btn-primary pull-right xs-fix" href="#">
                        <span class="glyphicon glyphicon-plus"></span>
                        Subir Archivo
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
                                    <tr class="item{{$archivo->id}}">
                                        <td class="col1">{{ $indexKey+1 }}</td>
                                    <td>{{$archivo->nombre}}</td>
                                    <td>{{$archivo->created_at}}</td>
                                        <td>
                                            <a class="btn btn-info" href="/storage/{{$archivo->filename}}">Descargar</a>
                                            <button class="edit-modal btn btn-info" data-id="{{$archivo->id}}" data-nombre="{{$archivo->filename}}" data-nota_id="{{$archivo->nota_id}}" >
                                            <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                            <button class="delete-modal btn btn-danger" data-id="{{$archivo->id}}" data-id="{{$archivo->id}}" data-nombre="{{$archivo->filename}}" data-nota_id="{{$archivo->nota_id}}">
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
   
        <script src="/js/libs/jquery/jquery-1.9.1.min.js"></script>

<script src="/js/upload/vendor/jquery.ui.widget.js"></script>
<script src="/js/upload/jquery.iframe-transport.js"></script>
<script src="/js/upload/jquery.fileupload.js"></script>
        @include('archivos.agregar')
        @include('archivos.editar')
        @include('archivos.eliminar')
        
        
        {{-- <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
    
     <link rel="stylesheet" href="{{asset('/css/bootstrap3.3.5.min.css') }}">
    {{-- <link rel="styleeheet" href="asset('bootstrap3.3.5.min.css')"> --}}

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('/icheck/square/yellow.css') }}">
    {{-- <link rel="stylesheet" href="asset('css/yellow.css')"> --}}

    <!-- toastr notifications -->
    {{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
    <link rel="stylesheet" href="{{asset('/css/toastr.min.css')}}">


    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}"> --}}
    
        <script type="text/javascript">
            $('.add-modal-archivos').on('click',function(){
            $('.modal-title').text('Agregar');
            $('#articulo_add').val("");
            $('#nota_add').val("");
            $('#addModal_archivos').modal('show');
        });
           $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            
            $('#id_edit').val($(this).data('id'));
            $('#nota_edit').val($(this).data('nota_id'));
            $('#archivo_edit').val($(this).data('nombre'));
            
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
            

            $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#nota_edit').val($(this).data('nota_id'));
            $('#archivo_edit').val($(this).data('nombre'));
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
                            $('select[id="nota_add"]').append('<option value="'+ key +'">'+ value + '</option>');
                        });
                    }
                });
            }else{
                $('select[id="estado"]').empty();
            }
        });
    });
     $('.modal-footer').on('click', '.add', function() { 
            $.ajax({
                type: 'POST',
                url: '/admin/archivos/',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'articulo': $('#articulo_add').val(),
                    'archivo_id': $('#archivo_id').val(),
                    'nota_id': $('#nota_add').val()
                },
                success: function(data) { 
                    $('.errorarticulo').addClass('hidden');
                    $('.errornota').addClass('hidden');

                   /* if ((data.errors)) { 
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);
alert($('#archivo_id').val());
                        
                        if (data.errors.nota_id) {
                            $('.errornota').removeClass('hidden');
                            $('.errornota').text(data.errors.nota);
                        }
                    } else { */
                        toastr.success('¡Articulo Guardado!', 'Success Alert', {timeOut: 5000});
                        $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.ref + "</td><td>" + data.nombre + "</td><td><a class='show-modal btn btn-success' data-id='" + data.id + "' data-ref='" + data.ref +"'' data-nombre='" + data.nombre + "'' data-categoria='"+ data.categoria +"' href='{{ route('articulos.notas','"+ data.id +"') }}''><span class='glyphicon glyphicon-eye-open'></span> Notas</a> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-edit'></span> Editar</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>");
                        
                         $('.new_published').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                   // }
                },
            });
        });
      $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: '/admin/archivos/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('¡El archivo ha sido eliminado!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        });
            
        </script>
    </div>
@stop