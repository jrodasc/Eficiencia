@extends('admin.layout')


@section('content')
<style>
        .panel-heading {
            padding: 0;
        }
        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .panel-heading li {
            float: left;
            border-right:1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }
        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }
        .panel-heading li:last-child {
            border-right: none;
        }
        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
		.mygrid-wrapper-div {
    	    overflow: scroll;
    		height: 270px;
		}
        
    </style>
	<div class="row">
		<section class="content-header">
			<h1>Estadísticas</h1>
		</section>
	</div>
	<div class="row m10">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="info-box">
            <div class="info-box-content">
              <span class="info-box-text">Disponibilidad</span>
              <h2 class="m0 text-uppercase pull-left">{{$datos['Graficas']->produccion}}%</h2>
				<br>
				<br>
              <span class="info-box-text">Rendimiento</span>
              <h2 class="m0 text-uppercase pull-left">{{$datos['Graficas']->rendimiento}}%</h2>
				<br>
				<br>
              <span class="info-box-text">Calidad</span>
              <h2 class="m0 text-uppercase pull-left">{{$datos['Graficas']->conformescalidad}}%</h2>
				<br>
				<br>
              <span class="info-box-text">OEE</span>
              <h2 class="m0 text-uppercase pull-left">{{$datos['Graficas']->OEE}}%</h2>
				<br>
				<br>
               {!! Form::select('receta', $datos['Recetas'], [], ['class' => 'form-control gray-input', 'id' => 'receta', 'data-id_produccion' => $datos['Paradas'][0]->id_produccion, 'data-id_linea' => 3]) !!}
				<br>
				<br>
			  <span class="info-box-text">Unds:</span>
    		  <h2 class="m0 text-uppercase pull-left">900000</h2>          
			  <br><br>
    		  <span class="info-box-text">Merma:</span>
    		  <h2 class="m0 text-uppercase pull-left">2888</h2>          
    		  <br>
			  <br>
    		  <span class="info-box-text">T. Paradas:</span>
    		  <h2 class="m0 text-uppercase pull-left">2888</h2>     
    		    <br>
				<br>
    		  <span class="info-box-text">T. mins paradas:</span>
    		  <h2 class="m0 text-uppercase pull-left">2888</h2>     
				<br>
				<br>
    		  <span class="info-box-text">Inicio produc:</span>
    		  <h2 class="m0 text-uppercase pull-left">17:05:00</h2>     
				<br>
				<br>
            </div>
            <!-- /.info-box-content -->
          </div>
		</div>
		<div class="col-xs-18 col-sm-18 col-md-8 col-lg-8">
			<div class="box box-primary">
				<div class="box-header with-border">
					<!--<h3 class="box-title">Afluencia de asistentes por evento</h3>-->
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus" aria-hidden="true"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					<div class="chart">
						<canvas id="barrasChart" style="height: 250px; width: 787px;" height="250" width="787"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-18 col-sm-18 col-md-8 col-lg-8">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Control de paradas</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus" aria-hidden="true"></i>
						</button>
					</div>
				</div>
				<div class="mygrid-wrapper-div">
					<table id="dtContainer" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Inicio</th>
									<th>Fin</th>
									<th>Total Min</th>
									<th>Maquina</th>
									<th>Causa</th>
									<th>Comentarios</th>
								</tr>
								{{ csrf_field() }}
							</thead>
							<tbody>
								@foreach ($datos['Paradas'] as $key => $parada)
									<tr class="item{{$parada->idparada}}">
										<td class="col1">{{(count($datos['Paradas']))-($key)}}</td>
										<td id="fecha_inicio" data-fecha-inicio="{{$parada->fecha_inicio}}">{{$parada->fecha_inicio}}<input type="hidden" name="fecha_inicio" id="fecha_inicio{{$parada->idparada}}" value="{{strtotime($parada->fecha_inicio)}}" /></td>
										<td>{{$parada->fecha_fin}}<input type="hidden" name="fecha_fin" id="fecha_fin{{$parada->idparada}}" value="{{strtotime($parada->fecha_fin)}}" /></td>
										<td>
										@if(($parada->minutos >0) or ($parada->segundos>0))
											{{$parada->minutos}}:{{substr($parada->segundos, 0,2)}}
										@else
										<div id="clock{{$parada->idparada}}"><label id="minutes">00</label>:<label id="seconds">00</label></div>
										@endif
										</td>
										<td>
											 {!! Form::select('maquina', $datos['Maquinas'], $parada->id_maquina, ['class' => 'form-control gray-input', 'id' => "id_maquina".$parada->idparada, 'data-idparada' => $parada->idparada,  'data-id_produccion' => $parada->id_produccion]); !!}
										</td>
										<td>
											 {!! Form::select('causas', $datos['Causas'], $parada->id_causa, ['class' => 'form-control gray-input', 'id' => "id_causa".$parada->idparada,'data-idparada' => $parada->idparada, 'data-id_produccion' => $parada->id_produccion]); !!}
										</td>
										<td> {!! Form::text('comentario', $parada->comentario, array('placeholder' => 'comentarios','class' => 'form-control gray-input', 'id' => 'comentario'.$parada->idparada, 'data-idparada' => $parada->idparada)) !!}<input type="hidden" name="id" id="id" value="{{$parada->idparada}}" /><input type="hidden" name="fecha_bd" id="fecha_bd" value="{{strtotime($datos['fecha_bd'])}}" /><input type="hidden" name="id_produccion" id="id_produccion" value="{{$parada->id_produccion}}" />
											<input type="hidden" name="id_linea" id="id_linea" value="{{$parada->id_linea}}" />

										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>

    <link rel="stylesheet" href="{{asset('/css/bootstrap3.3.5.min.css') }}">
        <!-- icheck checkboxes -->
        <link rel="stylesheet" href="{{ asset('/icheck/square/yellow.css') }}">
        <!-- toastr notifications -->
        <link rel="stylesheet" href="{{asset('/css/toastr.min.css')}}">
     
        
        <script src="/js/countTimer/jquery.countdownTimer.js"></script>

		<script>
            $(window).load(function(){
                $('#dtContainer').removeAttr('style');
            });

            
        </script>
	<script>
	
		var timestamp = null;
	$(document).ready(function()
	{
		cargar_push();
		cargar_push_produccion();

	
	});	
	function cargar_push_produccion() 
	{  var fecha_bd = $('input[id=fecha_bd]').val();
	var id_produccion = $('input[id=id_produccion]').val();
	var id_linea = $('input[id=id_linea]').val();
	
		
		$.ajax({
		async:	true, 
    	type: "POST",
	    url: "/admin/push/produccion",
	    data: {
                    '_token': $('input[name=_token]').val(),
                   	timestamp: timestamp,
                   	fecha_bd: fecha_bd,
                   	id_produccion: id_produccion,
                   	id_linea: id_linea
              },
		success: function(data)
		{	
			timestamp 		   = data.updated_at;
			fecha_inicio       = data.fecha_inicio;
			fecha_fin          = data.fecha_fin;
			id_maquina         = data.id_maquina;
			id_causa           = data.id_causa;
			id        		   = data.id;
			comentario     	   = data.comentario;
			produccion    	   = data.produccion;
			

			if (fecha_fin == null)
			{
				fecha_fin ="";
			}
			if (comentario == null)
			{
				comentario ="";
			}
		
		if(produccion == null)
			{
			
			}else{
				alert(data.produccion);
				toastr.success('¡Se ha iniciado una nueva produccion!', 'Success Alert', {timeOut: 5000});
                /*$('#dtContainer').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.fecha_inicio + "</td><td>" + fecha_fin + "</td><td><div id='clock" + id +"'><label id='minutes'>00</label>:<label id='seconds'>00</label></div></td><td><select class='form-control gray-input' id='id_maquina" + id +"' data-idparada='" + id +"' data-id_produccion='1' name='maquina'></select></td><td><select class='form-control gray-input' id='id_causa" + id +"' data-idparada='" + id +"' data-id_produccion='1' name='maquina'></select></td><td><input placeholder='comentarios' class='form-control gray-input' id='comentario' name='comentario' type='text' value=" + comentario + "></td></tr>");

                $('select[id="id_maquina' + id +'"]').empty(); 
			                        $.each(data.maquinas, function(key, value){
			                            $('select[id="id_maquina' + id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
			                        });
                 $('select[id="id_causa' + id +'"]').empty(); 
			                        $.each(data.causas, function(key, value){
			                            $('select[id="id_causa' + id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
			                        });
            
                $('.col1').each(function (index) {
                    $(this).html(index+1);
                });
                 var timestamp = null;
                $('#fecha_bd').val(data.updated_at);

				
				var diff = data.fecha_actual - data.fecha_inicio_reloj;
				var minute = Math.floor((diff /60));

				clock(diff,id);

				function clock($fecha_inicio,$id){

				      //  var $fecha_inicio = diff;
				      	var totalSeconds = $fecha_inicio;
				        setInterval(setTime, 1000);
				        function setTime()
				        { 
				            ++totalSeconds;
				            $('#clock'+ $id +' > #seconds').html(pad(totalSeconds%60));
				            $('#clock'+ $id +' > #minutes').html(pad(parseInt(totalSeconds/60)));
				            //$('#clock'+ $id +' > #hrs').html(pad(parseInt(totalSeconds/3600)));

				          //  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);

				        }
				        function pad(val)
				        {
				            var valString = val + "";
				            if(valString.length < 2)
				            {
				                return "0" + valString;
				            }
				            else
				            {
				                return valString;
				            }
				        }
				}
             */  
			}
		
		setTimeout('cargar_push_produccion()',5000);
			    	
			    	
	    }
		});		
	}
	function cargar_push() 
	{  var fecha_bd = $('input[id=fecha_bd]').val();
		
		$.ajax({
		async:	true, 
    	type: "POST",
	    url: "/admin/push",
	    data: {
                    '_token': $('input[name=_token]').val(),
                   	timestamp: timestamp,
                   	fecha_bd: fecha_bd,
              },
		success: function(data)
		{	
			timestamp 		   = data.updated_at;
			fecha_inicio       = data.fecha_inicio;
			fecha_fin          = data.fecha_fin;
			id_maquina         = data.id_maquina;
			id_causa           = data.id_causa;
			id        		   = data.id;
			comentario     	   = data.comentario;

			if (fecha_fin == null)
			{
				fecha_fin ="";
			}
			if (comentario == null)
			{
				comentario ="";
			}
		
		if(timestamp == null)
			{
			
			}else{
				toastr.success('¡Se ha detenido una máquina!', 'Success Alert', {timeOut: 5000});
                $('#dtContainer').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.fecha_inicio + "</td><td>" + fecha_fin + "</td><td><div id='clock" + id +"'><label id='minutes'>00</label>:<label id='seconds'>00</label></div></td><td><select class='form-control gray-input' id='id_maquina" + id +"' data-idparada='" + id +"' data-id_produccion='1' name='maquina'></select></td><td><select class='form-control gray-input' id='id_causa" + id +"' data-idparada='" + id +"' data-id_produccion='1' name='maquina'></select></td><td><input placeholder='comentarios' class='form-control gray-input' id='comentario' name='comentario' type='text' value=" + comentario + "></td></tr>");

                $('select[id="id_maquina' + id +'"]').empty(); 
			                        $.each(data.maquinas, function(key, value){
			                            $('select[id="id_maquina' + id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
			                        });
                 $('select[id="id_causa' + id +'"]').empty(); 
			                        $.each(data.causas, function(key, value){
			                            $('select[id="id_causa' + id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
			                        });
              /*  $('.new_published').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });*/

                $('.col1').each(function (index) {
                    $(this).html(index+1);
                });
                 var timestamp = null;
                $('#fecha_bd').val(data.updated_at);

				
				var diff = data.fecha_actual - data.fecha_inicio_reloj;
				var minute = Math.floor((diff /60));

				clock(diff,id);

				function clock($fecha_inicio,$id){

				      //  var $fecha_inicio = diff;
				      	var totalSeconds = $fecha_inicio;
				        setInterval(setTime, 1000);
				        function setTime()
				        { 
				            ++totalSeconds;
				            $('#clock'+ $id +' > #seconds').html(pad(totalSeconds%60));
				            $('#clock'+ $id +' > #minutes').html(pad(parseInt(totalSeconds/60)));
				            //$('#clock'+ $id +' > #hrs').html(pad(parseInt(totalSeconds/3600)));

				          //  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);

				        }
				        function pad(val)
				        {
				            var valString = val + "";
				            if(valString.length < 2)
				            {
				                return "0" + valString;
				            }
				            else
				            {
				                return valString;
				            }
				        }
				}


             

                
			}
		
		setTimeout('cargar_push()',5000);
			    	
			    	
	    }
		});		
	}

	$(document).ready(function()
		{
			var sec = 0;

    function clock($fecha_inicio,$id){

      //  var $fecha_inicio = diff;
      	var totalSeconds = $fecha_inicio;
        setInterval(setTime, 1000);
        function setTime()
        { 
            ++totalSeconds;
            $('#clock'+ $id +' > #seconds').html(pad(totalSeconds%60));
            $('#clock'+ $id +' > #minutes').html(pad(parseInt(totalSeconds/60)));
            //$('#clock'+ $id +' > #hrs').html(pad(parseInt(totalSeconds/3600)));

          //  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);

        }
        function pad(val)
        {
            var valString = val + "";
            if(valString.length < 2)
            {
                return "0" + valString;
            }
            else
            {
                return valString;
            }
        }
}

			@foreach ($datos['Paradas'] as $x => $parada)
				var fecha_inicio = $('input[id=fecha_inicio{{$parada->idparada}}]').val();
				var id = {{$parada->idparada}};
				var diff = {{$parada->FechaActual}} - fecha_inicio;
				var minute = Math.floor((diff /60));

				clock(diff,id);

				$(document).ready(function() {
			        $('select[id="id_maquina{{$parada->idparada}}"]').on('change',function(e){
			            var maquinaID = $(this).val();
			            
			            if(maquinaID){ 
			                $.ajax({
			                    url: '/admin/control/maquina/'+maquinaID,
			                    type: 'GET',
			                    dataType: 'json',
			                    success: function(data){ 
			                        $('select[id="id_causa{{$parada->idparada}}"]').empty(); 
			                        $.each(data, function(key, value){
			                            $('select[id="id_causa{{$parada->idparada}}"]').append('<option value="'+ key +'">'+ value + '</option>');
			                        });
			                    }
			                });
			            }else{
			                $('select[id="id_causa"]').empty();
			            }
			        });
			    });

					$('select[id=id_causa{{$parada->idparada}}]').on('change',function () {
					//$('#id').val($(this).data('id'));
					var id_produccion = $(this).data('id_produccion');
			    	id = $(this).data("idparada");
			    	
		    	
					$.ajax({
		                type: 'PUT',
		                url: '/admin/control/' + id,
		                data: {
		                    '_token': $('input[name=_token]').val(),
		                   	'id': id,
		                   	'comentario': document.getElementById("comentario{{$parada->idparada}}").value,
		                   	'id_maquina': document.getElementById("id_maquina{{$parada->idparada}}").value,
		                   	'id_causa': document.getElementById("id_causa{{$parada->idparada}}").value,
		                   	'id_produccion': id_produccion,

		                    
		                },
		                success: function(data) {
		                }
		                });
				});
				$('input[id=comentario{{$parada->idparada}}]').on('change',function () {
					id = $(this).data("idparada");
					
					var id_produccion = $(this).data('id_produccion');
					$.ajax({
		                type: 'PUT',
		                url: '/admin/control/' + id,
		                data: {
		                    '_token': $('input[name=_token]').val(),
		                   	'id': id,
		                   	'comentario': document.getElementById("comentario{{$parada->idparada}}").value,
		                   	'id_maquina': document.getElementById("id_maquina{{$parada->idparada}}").value,
		                   	'id_causa': document.getElementById("id_causa{{$parada->idparada}}").value,
		                   	'id_produccion': id_produccion,
		                },
		                success: function(data) {
		                }
		                });
				});



				
			@endforeach	
		});		

	function restarFechas(date1,date2)
		{
  			start_actual_time = new Date(date1);
    		end_actual_time = new Date(date2);

    		var diff = end_actual_time - start_actual_time;
    		var diffSeconds = diff/1000;
		    var HH = Math.floor(diffSeconds/3600);
    		var MM = Math.floor(diffSeconds%3600)/60;

    		var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM)
    		return formatted;
 		}

			

	

	    /*----------------------------------------*/
	    /*            Grafica de Barras           */
	    /*----------------------------------------*/
	    var barChartCanvas = $("#barrasChart").get(0).getContext("2d");

	    var barChart = new Chart(barChartCanvas);

	    var barChartData = {
	        labels: [@foreach ($datos['Paradas'] as $x => $parada)
	        {{ $parada->id_maquina.= "," }}
	        @endforeach
	        ],
	        datasets: [
	            {
	                label: "Total minutos",
	                fillColor: "rgba(90, 186, 102, 1)",
	                strokeColor: "rgba(90, 186, 102, 1)",
	                pointColor: "rgba(90, 186, 102, 1)",
	                pointStrokeColor: "#5ABA66",
	                pointHighlightFill: "#fff",
	                pointHighlightStroke: "rgba(220,220,220,1)",
	                data: [65, 59, 80, 81, 56, 55, 40]
	            },
	            {
	                label: "Total paradas",
	                fillColor: "rgba(60,141,188,0.9)",
	                strokeColor: "rgba(60,141,188,0.8)",
	                pointColor: "#3b8bba",
	                pointStrokeColor: "rgba(60,141,188,1)",
	                pointHighlightFill: "#fff",
	                pointHighlightStroke: "rgba(60,141,188,1)",
	                data: [28, 48, 40, 19, 86, 27, 90]
	            }
	        ]
	    };

	    barChartData.datasets[1].fillColor = "#3FB4F1";
	    barChartData.datasets[1].strokeColor = "#3FB4F1";
	    barChartData.datasets[1].pointColor = "#3FB4F1";
	    
	    var barChartOptions = {
	        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
	        scaleBeginAtZero: true,
	        //Boolean - Whether grid lines are shown across the chart
	        scaleShowGridLines: true,
	        //String - Colour of the grid lines
	        scaleGridLineColor: "rgba(0,0,0,.05)",
	        //Number - Width of the grid lines
	        scaleGridLineWidth: 1,
	        //Boolean - Whether to show horizontal lines (except X axis)
	        scaleShowHorizontalLines: true,
	        //Boolean - Whether to show vertical lines (except Y axis)
	        scaleShowVerticalLines: true,
	        //Boolean - If there is a stroke on each bar
	        barShowStroke: true,
	        //Number - Pixel width of the bar stroke
	        barStrokeWidth: 2,
	        //Number - Spacing between each of the X value sets
	        barValueSpacing: 5,
	        //Number - Spacing between data sets within X values
	        barDatasetSpacing: 1,
	        //String - A legend template
	        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
	        //Boolean - whether to make the chart responsive
	        responsive: true,
	        maintainAspectRatio: true
	    };

	    barChartOptions.datasetFill = false;
	    barChart.Bar(barChartData, barChartOptions);

		
		$('select[id=receta]').on('change',function () {
 			
	    	
	    	var id_produccion = $(this).data('id_produccion');
	    	var id_linea = $(this).data('id_linea');
	    	id = $(this).val();
		
			$.ajax({
                type: 'GET',
                url: '/admin/control/receta/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                   	id: $('#id').val(),
                   	'id_produccion': id_produccion,
                   	'id_linea': id_linea,
                },
                success: function(data) {
                }
                });
		});
		
	
		$(document).on('click', '.actualizar', function() { 
	    	$('#id').val($(this).data('id'));
	    	id = $('#id').val();

	    	
            $.ajax({
                type: 'PUT',
                url: '/admin/control/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                   	id: $('#id').val(),
                   	comentario: $('#comentario').val(),
                    
                },
                success: function(data) {
                  

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                       if (data.errors.ref) {
                            $('.errorref').removeClass('hidden');
                            $('.errorref').text(data.errors.ref);
                        }
                        if (data.errors.nombre) {
                            $('.errornombre').removeClass('hidden');
                            $('.errornombre').text(data.errors.nombre);
                        }
                    } else { 
                        toastr.success('¡El estado ha sido actualizado!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.fecha_inicio + "</td><td>" + data.fecha_fin + "</td><td>0</td><td>-</td><td>-</td><td><input placeholder='comentarios' class='form-control gray-input' id='comentario' name='comentario' type='text' value=" + data.comentario + "></td><td><a class='actualizar btn btn-info'  data-id=" + data.id + "' >Actualizar</a></td></tr>");
     

                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                }
            });
        });

	   

	</script>

@stop