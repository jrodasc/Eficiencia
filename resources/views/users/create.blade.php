@extends('admin.layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row custom-wrapper">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
                        <a class="btn btn-back pull-left" title="Volver atrás" href="{{ route('users.index') }}">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <h2 class="m0 text-uppercase">Crear un nuevo usuario</h2>
                    </div>

                    @if (count($errors) > 0)
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> ¡Lo sentimos!</h4>
                                <p>Algunos datos son incorrectos.</p>
                                 <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m20 hidden-xs hidden-sm"></div>
                        <div class="form-section">
                            <h3 class="bgWhite m0">Datos del usuario</h3>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <p>Nombre Completo:</p>
                                    {!! Form::text('name', null, array('placeholder' => 'Nombre Completo','class' => 'form-control gray-input', 'required')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <p>Nombre de Usuario:</p>
                                    {!! Form::text('usuario', null, array('placeholder' => 'Usuario','class' => 'form-control gray-input', 'required')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <p>Correo Electrónico:</p>
                                    {!! Form::text('email', null, array('placeholder' => 'Ej.user@mail.com','class' => 'form-control gray-input', 'required', 'pattern' => '^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <p>Contraseña:</p>
                                    {!! Form::password('password', array('placeholder' => 'Contraseña','class' => 'form-control gray-input', 'required', 'pattern' => '^.{6,}$')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <p>Confirmar Contraseña:</p>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirmar Contraseña','class' => 'form-control gray-input', 'required', 'pattern' => '^.{6,}$')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    
                                    <p>Role:</p>
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control gray-input', 'required')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right m15">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop