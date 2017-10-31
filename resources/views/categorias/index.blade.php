@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row custom-wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                        <h2 class="m0 text-uppercase pull-left xs-fix">Administrador de Categorias</h2>
                        
                        <a class="btn btn-primary pull-right xs-fix" href="#">
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
                                
                                    <tr>
                                        <td>01</td>
                                         <td>Neumaticos</td>
                                        <td>27/10/2017</td>
                                                                               
                                        <td>
                                            <a class="btn btn-info" href="#">Detalles</a>
                                            <a class="btn btn-primary" href="#">Editar</a>
                                            <a class="btn btn-danger" href="#">Borrar</a>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>Otra Categoria</td>
                                        <td>15/10/2017</td>
                                        
                                        
                                        <td>
                                            <a class="btn btn-info" href="#">Detalles</a>
                                            <a class="btn btn-primary" href="#">Editar</a>
                                            <a class="btn btn-danger" href="#">Borrar</a>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>03</td>
                                        <td>Hidraulica</td>
                                        <td>27/10/2017</td>
                                        
                                        
                                        <td>
                                            <a class="btn btn-info" href="#">Detalles</a>
                                            <a class="btn btn-primary" href="#">Editar</a>
                                            <a class="btn btn-danger" href="#">Borrar</a>
                                            
                                        </td>
                                    </tr>
                                    
                                
                            </tbody>
                        </table>
                        {{-- {!! $data->render() !!} --}}
                    </div>
                </div>
            </div>
        </div>
        
         <script type="text/javascript">
            
            $('button[id=btnExportar]').on('click',function () {
               $.ajax({
              type: 'GET',
              url: '/admin/conferencias/exportar',
              
                success:function(data){
                   
                  
                    }
                });
            });
            $('.btn-show').on('click',function(){
                    $('#id_show').val($(this).data('id'));
                    $('#uuid').val($(this).data('uuid'));
                    $('#myModal').modal('show');
                });

            
        </script>
    </div>
@stop