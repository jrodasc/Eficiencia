@extends('admin.layout')

@section('content')

 <div class="container">
        <div class="row">
            <div class="col-xs-13 col-sm-13 col-md-13 col-lg-13">
                <div class=" custom-wrapper">
                    <h2 class="m0 text-uppercase pull-left xs-fix">Administrador de Producciones</h2>
                       <table id="postTable" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Línea</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Total</th>
                                    <th>Receta</th>
                                    <th>Formt</th>
                                    <th>OEE</th>
                                    <th>Rend.</th>
                                    <th>Dispon.</th>
                                    <th>Calidad</th>
                                    <th>Fin</th>
                                    <th></th>
                                </tr>

                                {{ csrf_field() }}
                            </thead>
                            <tbody>
                                @foreach($datos['Producciones'] as $key => $produccion)
                                    <tr class="item">
                                        <td >{{(count($datos['Producciones']))-($key)}}</td>
                                        <td>{{$produccion->id_linea}}</td>
                                        <td width="40" nowrap >{{$produccion->fecha_inicio}}</td>
                                        <td width="40" nowrap>@if(isset($produccion->fecha_fin))
                                            {{$produccion->fecha_fin}}
                                            @else
                                            -
                                        @endif
                                        </td>
                                        <td>{{$produccion->contador}}</td>
                                        <td>
                                            @if(!empty($produccion->receta))
                                                {{$produccion->receta['nombre']}}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>@if(!empty($produccion->receta['formato']))
                                                    {{$produccion->receta['formato']}}
                                                @else
                                                    -
                                            @endif</td>
                                        <td>
                                            @if(!empty($produccion->calculo['OEE']))
                                                {{$produccion->calculo['OEE']}}
                                            @else
                                                -
                                            @endif
                                            </td>
                                        <td>
                                            @if(!empty($produccion->calculo['rendimiento']))
                                                {{$produccion->calculo['rendimiento']}}
                                            @else
                                                -
                                            @endif
                                            </td>
                                        <td>
                                            @if(!empty($produccion->calculo['oeeDISPONIBILIDAD']))
                                                {{$produccion->calculo['oeeDISPONIBILIDAD']}}
                                            @else
                                                -
                                            @endif
                                        </td> 
                                        <td>
                                            @if(!empty($produccion->calculo['oeeCALIDAD']))
                                                {{$produccion->calculo['oeeCALIDAD']}}
                                                @else
                                                -
                                            @endif
                                        </td>
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
@stop