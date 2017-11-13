@extends('admin.layout')

@section('content')

<style>
        .panel-heading {
            padding: 0;
        }
        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .panel-heading li {
            float: left;
            border-right:1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }
        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }
        .panel-heading li:last-child {
            border-right: none;
        }
        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row custom-wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                        <h2 class="m0 text-uppercase pull-left xs-fix">Articulos</h2>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m20 xs-scroll">
                        <div class="col-md-8 col-md-offset-2">
                            <br />
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <ul>
                                        <li><i class="fa fa-file-text-o"></i> Todos los articulos actuales</li>
                                        <a href="#" class="add-modal"><li>Agregar</li></a>
                                        
                                    </ul>
                                </div>
                                <form class="m20 " role="Buscar" >
                                    <table class="display table table-bordered table-hover table-responsive compact" id="postTable"  cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th valign="middle">#</th>
                                        <th>REF</th>
                                        <th>Articulo</th>
                                        <th>Acciones</th>
                                    </tr>
                                    {{ csrf_field() }}
                                    </thead>
                                    <tbody>
                                      @foreach($articulos as $indexKey => $articulo)
                                      <tr class="item{{$articulo->id}}">
                                              
                                                <td class="col1">{{ $indexKey+1 }}</td>
                                                <td>{{$articulo->ref}}</td>
                                                <td>{{$articulo->nombre}}</td>
                                               
                                                <td>
                                                    @foreach($archivos as $index => $archivo)
                                                        @if($articulo->id==$archivo->articulo_id)
                                                            <a class="btn btn-info" href="/storage/{{$archivo->filename}}">Descargar</a>
                                                        @endif
                                                    @endforeach
                                                    <a class="show-modal btn btn-success" data-id="{{$articulo->id}}" data-ref="{{$articulo->ref}}" data-nombre="{{$articulo->nombre}}" data-categoria="{{$articulo->categoria_id}}" href="{{ route('articulos.notas',$articulo->id) }}">
                                                    <span class="glyphicon glyphicon-eye-open"></span> Notas</a>
                                                    <button class="edit-modal btn btn-info" data-id="{{$articulo->id}}" data-ref="{{$articulo->ref}}" data-nombre="{{$articulo->nombre}}" data-categoria="{{$articulo->categoria_id}}">
                                                    <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                                    <button class="delete-modal btn btn-danger" data-id="{{$articulo->id}}" data-ref="{{$articulo->ref}}" data-nombre="{{$articulo->nombre}}" data-categoria="{{$articulo->categoria_id}}">
                                                    <span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </form>
            
                            </div><!-- /.panel panel-default -->
                        </div><!-- /.col-md-8 -->
                    </div>
                </div>
            </div>
        </div>
        <script src="/js/libs/jquery/jquery-1.9.1.min.js"></script>
        <script src="/js/upload/vendor/jquery.ui.widget.js"></script>
        <script src="/js/upload/jquery.iframe-transport.js"></script>
        <script src="/js/upload/jquery.fileupload.js"></script>
        @include('articulos.agregar')
        @include('articulos.editar')
        @include('articulos.eliminar')
    
        <link rel="stylesheet" href="{{asset('/css/bootstrap3.3.5.min.css') }}">
        <!-- icheck checkboxes -->
        <link rel="stylesheet" href="{{ asset('/icheck/square/yellow.css') }}">
        <!-- toastr notifications -->
        <link rel="stylesheet" href="{{asset('/css/toastr.min.css')}}">
   
        <script>
            $(window).load(function(){
                $('#postTable').removeAttr('style');
            })
        </script>
        <script type="text/javascript">
            $('.add-modal').on('click',function(){
            $('.modal-title').text('Agregar');
            $('#REF_add').val("");
            $('#nombre_add').val("");
            $('#addModal').modal('show');
        });

            $('.add-modal-archivos').on('click',function(){
            $('.modal-title').text('Agregar');
            $('#articulo_add').val("");
            $('#nota_add').val("");
            $('#addModal_archivos').modal('show');
        });
       
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: '/admin/articulos',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'ref': $('#REF_add').val(),
                    'nombre': $('#nombre_add').val(),
                    'archivo_id': $('#archivo_id').val(),
                },
                success: function(data) {
                    $('.errorref').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.ref) {
                            $('.errorref').removeClass('hidden');
                            $('.errorref').text(data.errors.ref);
                        }
                        if (data.errors.nombre) {
                            $('.errornombre').removeClass('hidden');
                            $('.errornombre').text(data.errors.nombre);
                        }
                    } else {
                        toastr.success('¡Articulo Guardado!', 'Success Alert', {timeOut: 5000});
                        $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.ref + "</td><td>" + data.nombre + "</td><td><a class='show-modal btn btn-success' data-id='" + data.id + "' data-ref='" + data.ref +"' data-nombre='" + data.nombre + "'  href='/admin/articulos/notas/" + data.id + "'><span class='glyphicon glyphicon-eye-open'></span> Notas</a> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-edit'></span> Editar</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>");
                        
                         $('.new_published').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                },
            });
        });
        // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#REF_edit').val($(this).data('ref'));
            $('#nombre_edit').val($(this).data('nombre'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: '/admin/articulos/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'ref': $('#REF_edit').val(),
                    'nombre': $('#nombre_edit').val(),
                     'archivo_id': $('#archivo_id_edit').val(),
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                       if (data.errors.ref) {
                            $('.errorref').removeClass('hidden');
                            $('.errorref').text(data.errors.ref);
                        }
                        if (data.errors.nombre) {
                            $('.errornombre').removeClass('hidden');
                            $('.errornombre').text(data.errors.nombre);
                        }
                    } else { 
                        toastr.success('¡El articulo ha sido actualizado!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.ref + "</td><td>" + data.nombre + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                       
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                }
            });
        });
       $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#REF_delete').val($(this).data('ref'));
            $('#nombre_delete').val($(this).data('nombre'));
            $('#categoria_id_delete').val($(this).data('categoria_id'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });

       $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: '/admin/articulos/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('¡El articulo ha sido eliminado!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        });

        $(document).ready(function() { 
            $('select[id="articuloarchivo_add"]').on('change',function(e){ 
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
        </script>
    </div>
@stop