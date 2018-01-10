@extends('admin.layout')

@section('content')

 <div class="container">
        <div class="row">
            <div class="col-xs-13 col-sm-13 col-md-13 col-lg-13">
                <div class="row custom-wrapper">
                    <div class="col-xs-13 col-sm-13 col-md-13 col-lg-10 no-padding">
                        <h2 class="m0 text-uppercase pull-left xs-fix">Administrador de Producciones</h2>
                        
                    </div>
                    <div class="col-xs-13 col-sm-13 col-md-13 col-lg-10 m18 xs-scroll">
                        <table id="postTable" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Línea</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Total</th>
                                    <th>Receta</th>
                                    <th>Formato</th>
                                    <th>OEE</th>
                                    <th>Rendimiento</th>
                                    <th>Dispon.</th>
                                    <th>Calidad</th>
                                    <th>Finalizada
                                    Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($producciones as $indexKey => $produccion)
                                    <tr class="item{{$produccion->idproduccion}}">
                                        <td class="col1">{{ $indexKey+1 }}</td>
                                    <td>{{$produccion->id_linea}}</td>
                                    <td>{{$produccion->fecha_inicio}}</td>
                                    <td>{{$produccion->fecha_fin}}</td>
                                    <td>{{$produccion->contador}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td> <td></td> 
                                    

                                        <td>{{$produccion->finalizado}}
                                            <a class="show-modal btn btn-success" data-id="{{$produccion->idproduccion}}" href="/admin/informe-dia/{{$produccion->idproduccion}}">
                                                    <span class="glyphicon glyphicon-eye-open"></span> Ver</a>
                                                                                        
                                        </td>
                                    </tr>
                                   @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
   
    </div>
@stop