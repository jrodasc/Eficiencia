@extends('admin.layout')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row custom-wrapper">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
						<h2 class="m0 text-uppercase pull-left xs-fix">Administrador de Usuarios</h2>
						<a class="btn btn-success pull-right xs-fix" href="{{ route('users.create') }}">
	            	<span class="glyphicon glyphicon-plus"></span>
	            	Crear nuevo usuario
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
						<table id="dtUsuarios" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Nombre</th>
									<th>Correo Electrónico</th>
									<th>Perfiles</th>
									<th width="280px">Acción</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $key => $user)
									<tr>
										<td>{{ ++$i }}</td>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>
											@if(!empty($user->roles))
												@foreach($user->roles as $v)
													<label class="label label-success">{{ $v->display_name }}</label>
												@endforeach
											@endif
										</td>
										<td>
											<a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Detalles</a>
											<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a> 
											{{-- {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
											{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
											{!! Form::close() !!} --}}
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