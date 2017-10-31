@extends('admin.layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row custom-wrapper">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
						<h2 class="m0 text-uppercase pull-left xs-fix">Administrador de Roles</h2>
						<a class="btn btn-success pull-right xs-fix" href="{{ route('roles.create') }}">
			            	<span class="glyphicon glyphicon-plus"></span>
			            	Crear nuevo rol
			            </a>
					</div>
					@if ($message = Session::get('success'))
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-check"></i> ¡Genial!</h4>
								<p>{{ $message }}</p>
							</div>
						</div>
					@endif
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m20 xs-scroll">
						<table id="dtRoles" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nombre</th>
									<th>Descripcion</th>
									<th width="280px">Acciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($roles as $key => $role)
									<tr>
										<td>{{ ++$i }}</td>
										<td>{{ $role->display_name }}</td>
										<td>{{ $role->description }}</td>
										<td>
											<a href="{{ route('roles.edit',$role->id) }}" class="btn btn-success ">
                                                 Editar
                                            </a>
											<a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Detalles</a>
											{{-- <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a> --}}
											{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
											{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
											{!! Form::close() !!} 
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