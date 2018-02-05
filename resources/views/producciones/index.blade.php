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
                        <table id="postTable" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" width="100%">
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
                                    <th>Finalizada</th>
                                    <th>Acciones</th>
                                </tr>

                                {{ csrf_field() }}
                            </thead>
                            <tbody>
                                @foreach($datos['Producciones'] as $key => $produccion)
                                    <tr class="item">
                                        <td >{{(count($datos['Producciones']))-($key)}}</td>
                                        <td>{{$produccion->id_linea}}</td>
                                        <td width="100">{{$produccion->fecha_inicio}}</td>
                                        <td width="40">{{$produccion->fecha_fin}}</td>
                                        <td>{{$produccion->contador}}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$produccion->OEE}}</td>
                                        <td>{{$produccion->rendimiento}}</td>
                                        <td>{{$produccion->oeeDISPONIBILIDAD}}</td> 
                                        <td>{{$produccion->oeeCALIDAD}}</td>
                                        <td>{{isset($produccion->finalizado) ? "SI":"NO"}}</td> 
                                        <td>
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