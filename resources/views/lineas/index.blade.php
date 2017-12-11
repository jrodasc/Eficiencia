@extends('admin.layout')

@section('content')

 <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row custom-wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                        <h2 class="m0 text-uppercase pull-left xs-fix">Administrador de Líneas</h2>
                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m20 xs-scroll">
                        <table id="postTable" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lineas as $indexKey => $linea)
                                    <tr class="item{{$linea->idlinea}}">
                                        <td class="col1">{{ $indexKey+1 }}</td>
                                    <td>{{$linea->nombre}}</td>
                                    <td></td>
                                        <td>
                                            <a class="show-modal btn btn-success" data-id="{{$linea->id}}" href="/admin/control/{{$linea->idlinea}}">
                                                    <span class="glyphicon glyphicon-eye-open"></span> Paradas Máquinas</a>
                                            <button class="edit-modal btn btn-info" data-id="{{$linea->idlinea}}" >
                                            <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                            <button class="delete-modal btn btn-danger" data-id="{{$linea->idlinea}}" data-id="{{$linea->idlinea}}" >
                                            <span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                            
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