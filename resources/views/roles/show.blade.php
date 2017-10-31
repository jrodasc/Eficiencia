@extends('admin.layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row custom-wrapper">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
						<a class="btn btn-back pull-left" title="Volver atrás" href="{{ route('roles.index') }}">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<h2 class="m0 text-uppercase">Ver los Roles</h2>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 user-details">
						<div class="box box-widget widget-user-2">
							<div class="widget-user-header bg-aqua">
								<h3 class="widget-user-username">{{ $role->display_name }}</h3>
							</div>
							<div class="box-footer no-padding">
								<ul class="nav nav-stacked">
									<li class="bgLightGray">
										<div class="row">
											<div class="col-xs-12 col-md-12 col-md-12 col-lg-12">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
												<label class="diBlock text-uppercase">Descripción: </label>
												<p class="diBlock">{{ $role->description }}</p>
											</div>
										</div>
									</li>
									<li class="bgLightGray">
										<div class="row">
											<div class="col-xs-12 col-md-12 col-md-12 col-lg-12">
												<i class="fa fa-check-square-o" aria-hidden="true"></i>
												<label class="diBlock text-uppercase">Permisos:</label>
												<p class="diBlock">
													@if(!empty($rolePermissions))
														@foreach($rolePermissions as $v)
															{{ $v->display_name }}
														@endforeach
													@endif
												</p>
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

	{{-- <div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $role->display_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Descripcion:</strong>
                {{ $role->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permisos:</strong>
                @if(!empty($rolePermissions))
					@foreach($rolePermissions as $v)
						<label class="label label-success">{{ $v->display_name }}</label>
					@endforeach
				@endif
            </div>
        </div>
	</div> --}}
@stop