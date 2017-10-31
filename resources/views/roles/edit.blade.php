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
						<h2 class="m0 text-uppercase">Editar Rol</h2>
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
					{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m20 hidden-xs hidden-sm"></div>
						<div class="form-section">
							<h3 class="bgWhite m0">Datos del rol</h3>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                      <p>Nombre:</p>
                      {!! Form::text('display_name', null, array('placeholder' => 'Name','class' => 'form-control gray-input', 'required')) !!}
                  </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="form-group">
                      <p>Descripción:</p>
                      {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control gray-input', 'style'=>'height:100px', 'required')) !!}
                  </div>
              </div>
              
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-group">
								<p>Menus:</p> 
								@foreach($menu as $value)
                                <ul>
                                    <label class="mr15">{{  Form::checkbox('menu[]', $value->id, in_array($value->id, $roleMenus) ? true : false, array('class' => 'name')) }}
                                    {{ $value->name }}</label><br>
	                                    @foreach($submenu as $valuesub)
	                                 		<ul>
	                                 			
	                                 			@if ($valuesub->menu_id == $value->id)
			                                        <label class="mr15">{{  Form::checkbox('menu[]', $valuesub->id, in_array($valuesub->id, $roleMenus) ? true : false, array('class' => 'name')) }}
				                                    {{ $valuesub->name }}</label><br>
		                                    	@endif
		                                    </ul>
		                                @endforeach
                                </ul>
                                @endforeach
									
								</div>
              </div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 text-right">
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop