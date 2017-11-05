@extends('admin.layout')

@section('content')
  <!-- icheck checkboxes -->
    
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
<div class="panel panel-default">
    <div class="panel-heading">
        <ul>
            <a href="/admin/articulos" class=""><li>Regresar</li></a>
            <a href="#" class="add-modal-notas "><li>Agregar</li></a>
        </ul>
    </div>
    <div class="panel-body">
        <div   role="dialog">
            <div class="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="m0 text-uppercase">Agregar Notas a</h4>
                        <h2 class="m0 text-uppercase">{{ $articulos->nombre}}</h2>
                    </div>
                    <div class="modal-body">
                        <table class="display table table-bordered table-hover table-responsive compact" id="postTable"  cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th valign="middle">#</th>
                                    <th>REF</th>
                                    <th>Notas</th>
                                    <th>Acciones</th>
                                </tr>
                                {{ csrf_field() }}
                            </thead>
                            <tbody>
                            @foreach($notas as $indexKey => $nota)
                                <tr class="item{{$nota->id}}">
                                    <td class="col1">{{ $indexKey+1 }}</td>
                                    <td>{{$nota->ref}}</td>
                                    <td>{{$nota->nombre}}</td>
                                    <td>
                                        <button class="edit-modal btn btn-info" data-id="{{$nota->id}}" data-ref="{{$nota->ref}}" data-nombre="{{$nota->nombre}}" >
                                        <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                        <button class="delete-modal btn btn-danger"  data-id="{{$nota->id}}" data-ref="{{$nota->ref}}" data-nombre="{{$nota->nombre}}">
                                        <span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-heading">
                        <ul>
                            <a href="#" class="add-modal-notas-categoria1 btn btn-success pull-left ">Agregar</a>        
                        </ul>
                    </div>
                    <br>
                    <h2 class="m0 text-uppercase">Neumática</h2>
                    <table class="display table table-bordered table-hover table-responsive compact" id="postTable-categoria1"  cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th valign="middle">#</th>
                                <th>Fecha</th>
                                <th>Horas Máquina</th>
                                <th>Revisión</th>
                                <th>Notas</th>
                                <th>Acciones</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                              @foreach($notas_neumaticas as $indexCategoriaKey => $notacategoria)
                          <tr class="item-cat1{{$notacategoria->id}}">
                                  
                                    <td class="col-neu1">{{ $indexCategoriaKey+1 }}</td>
                                    <td>{{$notacategoria->created_at}}</td>
                                    <td>{{$notacategoria->horamaquina}}</td>
                                    
                                    <td class="text-center"><input type="checkbox" class="revision" id="" data-id="{{$notacategoria->id}}" @if ($notacategoria->revision) checked @endif></td>
                                    
                                        
                                    <td>{{$notacategoria->nombre}}</td>
                                   
                                    <td>
                                      
                                        <button class="edit-Modal-notas btn btn-info" data-id="{{$notacategoria->id}}" data-ref="{{$notacategoria->ref}}" data-nombre="{{$notacategoria->nombre}}" data-horamaquina="{{$notacategoria->horamaquina}}" >
                                        <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                        <button class="delete-modal-notas btn btn-danger"  data-id="{{$notacategoria->id}}" data-ref="{{$notacategoria->ref}}" data-nombre="{{$notacategoria->nombre}}" data-horamaquina="{{$notacategoria->horamaquina}}">
                                        <span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="panel-heading">
                        <ul>
                        <a href="#" class="add-modal-notas-categoria2 btn btn-success pull-left">Agregar</a>
                        </ul>
                    </div><br>
                <h2 class="m0 text-uppercase">Hidraúlica</h2>
                <table class="display table table-bordered table-hover table-responsive compact" id="postTable-categoria2"  cellspacing="0" width="100%">
                     
                        <thead>
                            <tr>
                                <th valign="middle">#</th>
                                <th>Fecha</th>
                                <th>Horas Máquina</th>
                                <th>Revisión</th>
                                <th>Notas</th>
                                <th>Acciones</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                              @foreach($notas_hidraulicas as $indexCategoriahidraKey => $notacategoriahidra)
                          <tr class="item-cat2{{$notacategoriahidra->id}}">
                                    <td class="col-neu1">{{ $indexCategoriahidraKey+1 }}</td>
                                    <td>{{$notacategoriahidra->created_at}}</td>
                                    <td>{{$notacategoriahidra->horamaquina}}</td>
                                    <td class="text-center"><input type="checkbox" class="revision" id="" data-id="{{$notacategoriahidra->id}}" @if ($notacategoriahidra->revision) checked @endif></td>
                                    <td>{{$notacategoriahidra->nombre}}</td>
                                    <td>
                                        <button class="edit-Modal-notas btn btn-info" data-id="{{$notacategoriahidra->id}}" data-ref="{{$notacategoriahidra->ref}}" data-nombre="{{$notacategoriahidra->nombre}}" data-horamaquina="{{$notacategoriahidra->horamaquina}}" >
                                        <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                        <button class="delete-modal-notas btn btn-danger"  data-id="{{$notacategoriahidra->id}}" data-ref="{{$notacategoriahidra->ref}}" data-nombre="{{$notacategoriahidra->nombre}}" data-horamaquina="{{$notacategoriahidra->horamaquina}}">
                                        <span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="panel-heading">
                        <ul>
                            <a href="#" class="add-modal-notas-categoria3 btn btn-success pull-left">Agregar</a>
                        </ul>
                    </div>
                    <h2 class="m0 text-uppercase">Otras intervenciones</h2>
                <table class="display table table-bordered table-hover table-responsive compact" id="postTable-categoria3"  cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th valign="middle">#</th>
                                <th>Fecha</th>
                                <th>Horas Máquina</th>
                                <th>Revisión</th>
                                <th>Notas</th>
                                <th>Acciones</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                              @foreach($notas_otras as $indexCategoriaotraKey => $notacategoriaotra)
                          <tr class="item-cat3{{$notacategoriaotra->id}}">
                                  
                                    <td class="col-neu1">{{ $indexCategoriaotraKey+1 }}</td>
                                    <td>{{$notacategoriaotra->created_at}}</td>
                                    <td>{{$notacategoriaotra->horamaquina}}</td>
                                    
                                    <td class="text-center"><input type="checkbox" class="revision" id="" data-id="{{$notacategoriaotra->id}}" @if ($notacategoriaotra->revision) checked @endif></td>
                                    <td>{{$notacategoriaotra->nombre}}</td>
                                    <td>
                                        <button class="edit-Modal-notas btn btn-info" data-id="{{$notacategoriaotra->id}}" data-ref="{{$notacategoriaotra->ref}}" data-fecha="{{$notacategoriaotra->fecha}}" data-revision="{{$notacategoriaotra->revision}}" data-nombre="{{$notacategoriaotra->nombre}}" data-horamaquina="{{$notacategoriaotra->horamaquina}}">
                                        <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                        <button class="delete-modal-notas btn btn-danger"  data-id="{{$notacategoriaotra->id}}" data-ref="{{$notacategoriaotra->ref}}" data-nombre="{{$notacategoriaotra->nombre}}" data-horamaquina="{{$notacategoriaotra->horamaquina}}">
                                        <span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
            </div><!-- /.panel-body -->
        </div>
          {{-- <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
    
     <link rel="stylesheet" href="{{asset('/css/bootstrap3.3.5.min.css') }}">
    {{-- <link rel="styleeheet" href="asset('bootstrap3.3.5.min.css')"> --}}

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('/icheck/square/yellow.css') }}">
    {{-- <link rel="stylesheet" href="asset('css/yellow.css')"> --}}

    <!-- toastr notifications -->
    {{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
    <link rel="stylesheet" href="{{asset('/css/toastr.min.css')}}">
@include('articulos.agregar-notas')
@include('articulos.agregar-notas-categorias')
@include('articulos.editar-notas')
@include('articulos.editar-notas-categorias')
@include('articulos.eliminar-notas')
@include('articulos.eliminar-notas-categorias')
<script>
$(window).load(function(){
        $('#postTable').removeAttr('style');
    })
</script>
<script>
        $(document).ready(function(){
            $('.revision').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '20%'
            });
            $('.revision').on('ifClicked', function(event){
                id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/admin/articulos/changeStatus/' + id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        // empty
                    },
                });
            });
            $('.revision').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
        });
        
        
    </script>
<script type="text/javascript">
    $('.add-modal-notas').on('click',function(){
        $('.modal-title').text('Agregar');
        $('#REF_add').val("");
        $('#notas_add').val("");
        $('#addModal-notas').modal('show');
    });

    $('.add-modal-notas-categoria1').on('click',function(){ 
        $('.modal-title-categorias').text('Agregar-Neumaticas');
        $('#categoria_id_notas').val("1");
        $('#REF_add_categoria').val("");
        $('#horamaquina_add_categoria').val("");
        $('#notas_add_categoria').val("");
        
        $('#addModal-notas-categorias').modal('show');
    });
    $('.add-modal-notas-categoria2').on('click',function(){
        $('.modal-title-categorias').text('Agregar-Hidraulica');
        $('#categoria_id_notas').val("2");
        $('#REF_add_categoria').val("");
        $('#horamaquina_add_categoria').val("");
        $('#notas_add_categoria').val("");
        $('#addModal-notas-categorias').modal('show');
    });
    $('.add-modal-notas-categoria3').on('click',function(){
        $('.modal-title-categorias').text('Agregar-Otras Intervenciones');
        $('#categoria_id_notas').val("3");
        $('#REF_add_categoria').val("");
        $('#horamaquina_add_categoria').val("");
        $('#notas_add_categoria').val("");
        $('#addModal-notas-categorias').modal('show');
    });
     $('.modal-footer').on('click', '.add', function() {
           
            $.ajax({
                type: 'POST',
                url: '/admin/articulos/notas/add',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'ref': $('#REF_add').val(),
                    'nombre': $('#nombre_add').val(),
                    'articulo_id': $('#articulo_id').val(),
                    'categoria_id': "4",
                    'horamaquina': "0",
                    'revision': "0",
                    
                    
                },
                success: function(data) {
                    $('.errorref').addClass('hidden');
                    $('.errornombre').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal-notas').modal('show');
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
                        toastr.success('¡Nota Guardada Guardado!', 'Success Alert', {timeOut: 5000});
                        $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>"+ data.ref +"</td><td>" + data.nombre + "</td><td> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-edit'></span> Editar</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>");
                        
                         
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                },
            });
        });
     $('.modal-footer-categoria').on('click', '.add', function() {
            
            $.ajax({
                type: 'POST',
                url: '/admin/articulos/notas/add',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'ref': $('#REF_add_categoria').val(),
                    'nombre': $('#notas_add_categoria').val(),
                    'articulo_id': $('#articulo_id').val(),
                    'categoria_id': $('#categoria_id_notas').val(),
                    'horamaquina': $('#horamaquina_add_categoria').val(),
                    'revision': "0"
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');
                    
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal-notas-categorias').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.ref) {
                            $('.errorref').removeClass('hidden');
                            $('.errorref').text(data.errors.ref);
                        }
                        if (data.errors.horamaquina) {
                            $('.errorhoramaquina').removeClass('hidden');
                            $('.errorhoramaquina').text(data.errors.horamaquina);
                        }
                        if (data.errors.nombre) {
                            $('.errornombre').removeClass('hidden');
                            $('.errornombre').text(data.errors.nombre);
                        }
                    } else {
                        toastr.success('¡Nota Guardada Guardado!', 'Success Alert', {timeOut: 5000});
                        
                        $('#postTable-categoria'+ data.categoria_id).prepend("<tr class='item-cat"+ data.categoria_id + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.created_at + "</td><td>" + data.horamaquina + "</td><td class='text-center'><input type='checkbox' class='revision'  data-id=" + data.id + " ></td><td>" + data.nombre + "</td><td> <button class='edit-Modal-notas btn btn-info' data-id='" + data.id + "' data-ref='" + data.ref + "' data-horamaquina='" + data.horamaquina + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-edit'></span> Editar</button> <button class='delete-modal-notas btn btn-danger' data-id='" + data.id + "' data-ref='" + data.ref + "' data-horamaquina='" + data.horamaquina + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>");
                        
                        $('.revision').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.revision').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'POST',
                                url: '/admin/articulos/changeStatus/' + id,
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    // empty
                                },
                            });
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
        $(document).on('click', '.edit-Modal-notas', function() {
            $('.modal-title').text('Edit');
            
            $('#id_edit_categoria').val($(this).data('id'));
            $('#REF_edit_categoria').val($(this).data('ref'));
            $('#horamaquina_edit_categoria').val($(this).data('horamaquina'));
            $('#nombre_edit_categoria').val($(this).data('nombre'));
            id = $('#id_edit_categoria').val();
            $('#editModal-notas').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            
            $.ajax({
                type: 'POST',
                url: '/admin/articulos/notas/edit/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'ref': $('#REF_edit').val(),
                    'nombre': $('#nombre_edit').val(),
                    
                },
                success: function(data) {
                    $('.errorref').addClass('hidden');
                    $('.errornombre').addClass('hidden');

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
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.ref + "</td><td>" + data.nombre + "</td><td> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-edit'></span> Editar</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>");
                        
                         if (data.revision) {
                            $('.revision').prop('checked', true);
                            $('.revision').closest('tr').addClass('warning');
                        }
                        $('.revision').iCheck({
                            checkboxClass: 'icheckbox_square-yellow',
                            radioClass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.revision').on('ifToggled', function(event) {
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.revision').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'GET',
                                url: '/admin/articulos/changeStatus/' + id,
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    // empty
                                },
                            });
                        });
                       
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                }
            });
        });

        $('.modal-footer-categorias').on('click', '.edit', function() {
            $.ajax({
                type: 'POST',
                url: '/admin/articulos/notas/edit/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit_categoria").val(),
                    'ref': $('#REF_edit_categoria').val(),
                    'horamaquina': $('#horamaquina_edit_categoria').val(),
                    'nombre': $('#nombre_edit_categoria').val(),
                    },
                success: function(data) {
                    $('.errorref').addClass('hidden');
                    $('.errorhoramaquina').addClass('hidden');
                    $('.errornombre').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal-notas').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.ref) {
                            $('.errorref').removeClass('hidden');
                            $('.errorref').text(data.errors.ref);
                            
                        }
                        if (data.errors.horamaquina) {
                            $('.errorhoramaquina').removeClass('hidden');
                            $('.errorhoramaquina').text(data.errors.horamaquina);
                        }
                        if (data.errors.nombre) {
                            $('.errornombre').removeClass('hidden');
                            $('.errornombre').text(data.errors.nombre);
                        }
                    } else { 
                            toastr.success('¡El articulo ha sido actualizado!', 'Success Alert', {timeOut: 5000});
                            $('.item-cat'+ data.categoria_id + data.id).replaceWith("<tr class='item-cat"+ data.categoria_id + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.created_at + "</td><td>" + data.horamaquina + "</td><td class='text-center'><input type='checkbox' class='edit_revision' data-id='" + data.id + "'></td><td>" + data.nombre + "</td><td> <button class='edit-Modal-notas btn btn-info' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "' data-horamaquina='" + data.horamaquina + "'><span class='glyphicon glyphicon-edit'></span> Editar</button> <button class='delete-modal-notas btn btn-danger' data-id='" + data.id + "' data-ref='" + data.ref + "' data-nombre='" + data.nombre + "' data-horamaquina='" + data.horamaquina + "'><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>");
                        
                            if (data.revision) {
                                $('.edit_revision').prop('checked', true);
                                $('.edit_revision').closest('tr').addClass('warning');
                            }
                            $('.edit_revision').iCheck({
                                checkboxClass: 'icheckbox_square-yellow',
                                radioClass: 'iradio_square-yellow',
                                increaseArea: '20%'
                            });
                        $('.edit_revision').on('ifToggled', function(event) {
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.edit_revision').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'GET',
                                url: '/admin/articulos/changeStatus/' + id,
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    // empty
                                },
                            });
                        });
                       
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                }
            });
        });

        // delete a post
         $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#REF_delete').val($(this).data('ref'));
            $('#nombre_delete').val($(this).data('nombre'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $(document).on('click', '.delete-modal-notas', function() {
            $('.modal-title').text('Delete');
            
            $('#id_delete_categoria').val($(this).data('id'));
            $('#REF_delete_categoria').val($(this).data('ref'));
            $('#nombre_delete_categoria').val($(this).data('nombre'));
            $('#horamaquina_delete_categoria').val($(this).data('horamaquina'));
            $('#deleteModal-categorias').modal('show');
            id = $('#id_delete_categoria').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'POST',
                url: '/admin/articulos/notas/eliminar/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_delete").val()
                    
                },
                success: function(data) {
                    toastr.success('¡Se ha eliminado correctamente el registro!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        });
        $('.modal-footer-categoria').on('click', '.delete', function() {
            
            $.ajax({
                type: 'POST',
                url: '/admin/articulos/notas/eliminar/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_delete_categoria").val()
                    
                },
                success: function(data) {
                    toastr.success('¡Se ha eliminado correctamente el registro!', 'Success Alert', {timeOut: 5000});
                    $('.item-cat'+ data.categoria_id + data['id']).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        });

</script>



    @stop