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
                        <h2 class="m0 text-uppercase">Detalles del Usuario</h2>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offsrt-3 user-details">
                        <div class="box box-widget widget-user-2">
                            <div class="widget-user-header bg-aqua">
                                <h3 class="widget-user-username">{{ $user->name }}</h3>
                            </div>
                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li class="bgLightGray">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-md-12 col-lg-12">
                                                <i class="fa fa fa-user" aria-hidden="true"></i>
                                                <label class="diBlock text-uppercase">Nombre de usuario: </label>
                                                <p class="diBlock">{{ $user->usuario }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="bgLightGray">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-md-12 col-lg-12">
                                                <i class="fa fa-id-badge" aria-hidden="true"></i>
                                                <label class="diBlock text-uppercase">Perfil:</label>
                                                <p class="diBlock">
                                                    @if(!empty($user->roles))
                                                        @foreach($user->roles as $v)
                                                            {{ $v->display_name }}
                                                        @endforeach
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="bgLightGray">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-md-12 col-lg-12">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                <label class="diBlock text-uppercase">Correo electrónico: </label>
                                                <p class="diBlock">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
@stop