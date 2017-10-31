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
								@foreach ($menus as $key => $menu)
									<tr>
										<td>{{ ++$i }}</td>
										<td>{{ $menu->display_name }}</td>
										<td>{{ $menu->description }}</td>
										<td>
											
											
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-heading">
                        <p class="panel-title" style="color:#777">Drag and drop the menu Items below to re-arrange them.</p>
                    </div>

                    <div class="panel-body" style="padding:30px;">
                        <div class="dd">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
				</div>
			</div>
		</div>
	</div>
@stop