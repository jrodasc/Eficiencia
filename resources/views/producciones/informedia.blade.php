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
    		height: 400px;
		}
        
    </style>
	<div class="row">
		<section class="content-header">
			<h1>Informedía</h1>
		</section>
	</div>
	
	<div class="row m10">
		<div class="panel-heading">
        <ul>
            <a href="/admin/producciones" class=""><li>Regresar</li></a>
           
        </ul>
    </div>
		<div class="col-xs-18 col-sm-18 col-md-12 col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Gráficas</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus" aria-hidden="true"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					
						<canvas id="barrasChart" style="height: 150px; width: 787px;" height="150" width="787"></canvas>
					
				</div>
			</div>
		</div>
		<div class="col-xs-18 col-sm-18 col-md-12 col-lg-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Control de paradas</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse">
							<i class="fa fa-minus" aria-hidden="true"></i>
						</button>
					</div>
				</div>
				<input type="hidden" name="idproduccion" id="idproduccion" value="{{$datos['Produccion']}}" />
					<input type="hidden" name="fecha_bd" id="fecha_bd" value="{{strtotime($datos['fecha_bd'])}}" />
					<input type="hidden" name="id_linea" id="id_linea" value="{{$datos['id_linea']}}" />
					<input type='hidden' name='estatus' id='estatus' value='0' />
				<div class="mygrid-wrapper-div">
					
					<table id="dtContainer" class="display table table-bordered table-hover table-responsive compact" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Fecha Inicio</th>
									<th>Fecha Fin</th>
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
										<td id="fecha_inicio" data-fecha-inicio="{{$parada->fecha_inicio}}">{{$parada->fecha_inicio}}<input type="hidden" name="fecha_inicio" id="fecha_inicio{{$parada->idparada}}" value="{{$parada->fecha_inicio_reloj}}" /></td>
										<td>{{$parada->fecha_fin}}<input type="hidden" name="fecha_fin" id="fecha_fin{{$parada->idparada}}" value="{{strtotime($parada->fecha_fin)}}" /></td>
										<td>
										@if(($parada->segundos !=null))
											{{$parada->minutos}}
										@else
										<div id="clock{{$parada->idparada}}"><label id="minutes">00</label>:<label id="seconds">00</label></div>
										@endif
										</td>
										<td> 
											@if(!empty($parada->maquina))
                                                {{$parada->maquina['nombre']}}
                                            @endif
										</td>
										<td>
											@if(!empty($parada->causas))
                                                {{($parada->causas['nombre'])}}
                                            @endif																						
										</td>
										<td>{{$parada->comentario}} <input type="hidden" name="id" id="id" value="{{$parada->idparada}}" /><input type="hidden" name="id_produccion" id="id_produccion" value="{{$parada->id_produccion}}" />
											<input type="hidden" name="consecutivo{{$parada->idparada}}" id="consecutivo{{$parada->idparada}}" value="{{(count($datos['Paradas']))-($key)}}" />

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
            

            
        </script>

	<script>
	
		var timestamp = null;
	$(document).ready(function()
	{
		
		var app = @json($datos['MaquinasGraficas']);
		console.log(app);
		nombremaquina = CadenaGrafica(app,"nombre");
		minutos = CadenaGrafica(app,"minutos");

		GenerarGráfica(nombremaquina.split(","),minutos.split(","));

	
	});	

	function CadenaGrafica(cadenaJson,tipoAtributo){
		var types = JSON.parse(cadenaJson);
		
		var concatenar = ""; var subCadena = "";
		for(x=0; x<types.length; x++) {
			if(tipoAtributo == "nombre"){
		    	concatenar += '' + types[x].nombre + ',';
			}
		    else if(tipoAtributo == "totalparadas"){
		    	concatenar += '' + types[x].totalparadas + ',';
		    }
		    else if(tipoAtributo == "minutos"){
		    	var minutes = Math.floor( types[x].minutos / 60 );
				var seconds = types[x].minutos % 60;
				 
				//Anteponiendo un 0 a los minutos si son menos de 10 
				minutes = minutes < 10 ? '0' + minutes : minutes;
				seconds = seconds < 10 ? '0' + seconds : seconds;
				 
				var result = minutes + "." + seconds;  // 161:30

		  		concatenar += '' + result + ',';
		    }

		}
		
		subCadena = concatenar.substring(0, concatenar.length-1);
        return(subCadena);


	}
	
	function cargar_push() 
	{  	var fecha_bd = $('input[id=fecha_bd]').val();
		var consecutivo = $(this).find("td:col1").text();
		var idproduccion = $('input[id=idproduccion]').val();
		
		if($('input[id=ultimo]').val()!=null)
		{
			var ultimo = $('input[id=ultimo]').val(); 
			
		}else{
			if($('input[id=estatus]').val()==0)
			{
				var ultimo = {{count($datos['Paradas'])}};	
			}else{
				var ultimo = 0;
			}
		} 
		$.ajax({
		async:	true, 
    	type: "POST",
	    url: "/admin/push",
	    data: {
                '_token': $('input[name=_token]').val(),
               	timestamp: timestamp,
               	fecha_bd: fecha_bd,
                   	ultimo: ultimo,
                   	idproduccion: idproduccion 
                   	
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
			ultimo			   = data.ultimo;
			parada 			   = data.parada;

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
					//$('#fecha_bd').val(data.updated_at);
					$('#Disponibilidad').text(data.Disponibilidad + "%");
					$('#Rendimiento').text(data.Rendimiento + "%");
					$('#oeeCALIDAD').text(data.oeeCALIDAD + "%");
					$('#OEE').text(data.OEE + "%");
					$('#cantidadnominalpiezas').text(data.cantidadnominalpiezas );
					$('#rechazomermas').text(data.rechazomermas );
					$('#totalparada').text(data.totalparada );
					$('#SumaParadas').text(data.SumaParadas );
					$('#ProduccionFechaInicio').text(data.ProduccionFechaInicio );
				
				}else{  
					if(data.estatus=="nuevo")
						{    
							toastr.success('¡Se ha detenido una máquina!', 'Success Alert', {timeOut: 5000});
							ultimoinc = parseInt(data.ultimo)+1 ;
			                $('#dtContainer').prepend("<tr class='item" + data.id + "'><td class='col1'>" + ultimoinc + "</td><td>" + data.fecha_inicio + "</td><td>" + fecha_fin + "</td><td><div id='clock" + id +"'><label id='minutes'>00</label>:<label id='seconds'>00</label></div></td><td><select class='form-control gray-input' id='id_maquina" + id +"' data-idparada='" + id +"' data-id_produccion='1' name='maquina'></select></td><td><select class='form-control gray-input' id='id_causa" + id +"' data-idparada='" + id +"' data-id_produccion='1' name='maquina'></select></td><td><input placeholder='comentarios' class='form-control gray-input' id='comentario' name='comentario' type='text' value=" + comentario + "><input type='hidden' name='fecha_bd' id='fecha_bd' value=" + timestamp +" /><input type='hidden' name='ultimo' id='ultimo' value=" + ultimoinc +" /><input type='hidden' name='consecutivo" + data.id + "' id='consecutivo" + data.id + "' value=" + ultimoinc +" /></td></tr>");

			                $('select[id="id_maquina' + id +'"]').empty(); 
						        $.each(data.maquinas, function(key, value){
						        $('select[id="id_maquina' + id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
						                        });
			                $('select[id="id_causa' + id +'"]').empty(); 
						                        $.each(data.causas, function(key, value){
						                            $('select[id="id_causa' + id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
						                        });
			                var timestamp = null;
			                $('#fecha_bd').val(data.updated_at);
			                
			                if(data.fecha_fin==null)
			                {
			                	
				                var diff = data.fecha_actual - data.fecha_inicio_reloj;
								var minute = Math.floor((diff /60));
								clock(diff,id);	
			                }

			                $('#fecha_bd').val(data.updated_at);
						    $('#estatus').val(0);
							//$('#idproduccion').val(data.produccion);
							$('#Disponibilidad').text(data.Disponibilidad + "%");
							$('#Rendimiento').text(data.Rendimiento + "%");
							$('#oeeCALIDAD').text(data.oeeCALIDAD + "%");
							$('#OEE').text(data.OEE + "%");
							$('#cantidadnominalpiezas').text(data.cantidadnominalpiezas );
							$('#rechazomermas').text(data.rechazomermas );
							$('#totalparada').text(data.totalparada );
							$('#SumaParadas').text(data.SumaParadas );
							$('#ProduccionFechaInicio').text(data.ProduccionFechaInicio );

			                $(document).ready(function() {
						        $('select[id="id_maquina'+ data.id +'"]').on('change',function(e){
						            var maquinaID = $(this).val();
						            var paradaID = $(this).data("idparada");
						            if(maquinaID){ 
						                $.ajax({
						                    url: '/admin/control/maquina/'+maquinaID,
						                    type: 'GET',
						                    data: {
						                    '_token': $('input[name=_token]').val(),
						                   	'idparada': paradaID,
						                   	'id_maquina': maquinaID,
						                   	},
						                    dataType: 'json',
						                    success: function(data){ 
						                        $('select[id="id_causa'+ data.id +'"]').empty(); 
						                        $.each(data, function(key, value){
						                            $('select[id="id_causa'+ data.id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
						                        });

						        
						                    }
						                });

						                
						            }else{
						                $('select[id="id_causa"]').empty();
						            }
						        });
					    	});
						}else{	
							var consecutivo = $('input[id=consecutivo' + data.id + ']').val();
							toastr.success('¡Se ha inicializado una máquina!', 'Success Alert', {timeOut: 5000});
							$('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + consecutivo + "</td><td>" + data.fecha_inicio + "</td><td>" + fecha_fin + "</td><td>"+ data.minutos +"</td><td><select class='form-control gray-input' id='id_maquina" + id +"' data-idparada='" + id +"' data-id_produccion='1' name='maquina'></select></td><td><select class='form-control gray-input' id='id_causa" + id +"' data-idparada='" + id +"' data-id_produccion='1' name='maquina'></select></td><td><input placeholder='comentarios' class='form-control gray-input' id='comentario' name='comentario' type='text' value=" + comentario + "><input type='hidden' name='fecha_bd' id='fecha_bd' value=" + timestamp +" /><input type='hidden' name='ultimo' id='ultimo' value=" + ultimo +" /><input type='hidden' name='consecutivo" + data.id + "' id='consecutivo" + data.id + "' value=" + ultimo +" /></td></tr>");

							$('select[id="id_maquina' + id +'"]').empty(); 
	                        $.each(data.maquinas, function(key, value){
	                            $('select[id="id_maquina' + id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
	                        });
	                		$('select[id="id_causa' + id +'"]').empty(); 
				            $.each(data.causas, function(key, value){
				                $('select[id="id_causa' + id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
				            });

				    		var timestamp = null;
	                		$('#fecha_bd').val(data.updated_at);

	                		$(document).ready(function() {
				        		$('select[id="id_maquina'+ data.id +'"]').on('change',function(e){
				            		var maquinaID = $(this).val();
				            		var paradaID = $(this).data("idparada");
				            		if(maquinaID){ 
						                $.ajax({
						                    url: '/admin/control/maquina/'+maquinaID,
						                    type: 'GET',
						                    data: {
						                    '_token': $('input[name=_token]').val(),
						                   	'idparada': paradaID,
						                   	'id_maquina': maquinaID,
						                   	},
						                    dataType: 'json',
						                    success: function(data){ 
						                        $('select[id="id_causa'+ data.id +'"]').empty(); 
						                        $.each(data, function(key, value){
						                            $('select[id="id_causa'+ data.id +'"]').append('<option value="'+ key +'">'+ value + '</option>');
						                        });
						                    }
						                });
						            }else{
				                		$('select[id="id_causa"]').empty();
				            		}
			        			});
			    			});
						}
					$('#fecha_bd').val(data.updated_at);
					$('#Disponibilidad').text(data.Disponibilidad + "%");
					$('#Rendimiento').text(data.Rendimiento + "%");
					$('#oeeCALIDAD').text(data.oeeCALIDAD + "%");
					$('#OEE').text(data.OEE + "%");
					$('#cantidadnominalpiezas').text(data.cantidadnominalpiezas );
					$('#rechazomermas').text(data.rechazomermas );
					$('#totalparada').text(data.totalparada );
					$('#SumaParadas').text(data.SumaParadas );
					$('#ProduccionFechaInicio').text(data.ProduccionFechaInicio );
			   	}
		
			setTimeout('cargar_push()',5000);
			    	
			    	
	    }
		});		
	}

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

	$(document).ready(function() {
			var sec = 0;

			@foreach ($datos['Paradas'] as $x => $parada)
				var fecha_inicio = $('input[id=fecha_inicio{{$parada->idparada}}]').val();
				var id = {{$parada->idparada}};
				var diff = {{$parada->FechaActual}} - fecha_inicio;
				var minute = Math.floor((diff /60));

				clock(diff,id);

				$(document).ready(function() {
			        $('select[id="id_maquina{{$parada->idparada}}"]').on('change',function(e){
			            var maquinaID = $(this).val();
			            var paradaID = $(this).data("idparada");
			            if(maquinaID){ 
			                $.ajax({
			                    url: '/admin/control/maquina/'+maquinaID,
			                    data: {
			                    '_token': $('input[name=_token]').val(),
			                   	'idparada': paradaID,
			                   	'id_maquina': maquinaID,
			                   	},
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
	    function GenerarGráfica(labels,data1){
		    var barChartCanvas = $("#barrasChart").get(0).getContext("2d");

		    var barChart = new Chart(barChartCanvas);

		    var barChartData = {
		        labels: labels,
		        datasets: [
		            
		            {
		                label: "Total minutos",
		                fillColor: "rgba(60,141,188,0.9)",
		                strokeColor: "rgba(60,141,188,0.8)",
		                pointColor: "#3b8bba",
		                pointStrokeColor: "rgba(60,141,188,1)",
		                pointHighlightFill: "#fff",
		                pointHighlightStroke: "rgba(60,141,188,1)",
		                data: data1
		            }
		        ]
		    };

		    barChartData.datasets[0].fillColor = "#3FB4F1";
		    barChartData.datasets[0].strokeColor = "#3FB4F1";
		    barChartData.datasets[0].pointColor = "#3FB4F1";
		    
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
		}

		
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