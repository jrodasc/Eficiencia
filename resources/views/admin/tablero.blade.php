@extends('admin.layout')


@section('content')
	<div class="row">
		<section class="content-header">
			<h1>BIENVENIDO</h1>
		</section>
	</div>

	<div class="row m20">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			
			<div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Usuarios Registrados</span>
              <span class="info-box-number">{{ $usuarios}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Archivos</span>
              <span class="info-box-number">{{ $archivos}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			
                <div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                            DOCUMENTOS
                        </h4>
                        <div class="media">
                            <div class="media-left">
                                <a href="https://www.creative-tim.com/product/material-dashboard-pro-angular2?affiliate_id=97705" class="ad-click-event">
                                    <img src="/uploads/images/free_templates/creative-tim-material-angular.png" alt="Material Dashboard Pro" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                                </a>
                            </div>
                            <div class="media-body">
                                <div class="clearfix">
                                    <p class="pull-right">
                                        <a href="https://www.creative-tim.com/product/material-dashboard-pro-angular2?affiliate_id=97705" class="btn btn-success btn-sm ad-click-event">
                                            Descargar
                                        </a>
                                    </p>

                                    <h4 style="margin-top: 0">Manual de usuario</h4>

                                    <p>Puede descargar el manual de usuario con la finalidad de proporcionar la guía de uso.</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
		</div>
		
		
		
		
	
	</div>



@stop