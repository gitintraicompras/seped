@extends('layouts.menu')
@section('contenido') 

<section class="content" >
	 <!-- Info boxes -->
	<div class="row" >
	 	<!--- ALCABALA --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-1" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid aqua;">
	      	<a href="{{url('/seped/alcabala')}}">
	        	<span class="info-box-icon info-box-icon-1 bg-aqua" 
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-hand-paper-o"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content" >
	          <span class="info-box-text">Alcabala</span>
	          <span class="info-box-number"	>
	          	{{number_format($contPedido,0, '.', ',')}}
	          	<small>Pedidos por aprobar</small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!--- RECLAMOS RECIBIDOS--->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-2" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid red;">
	      	<a href="{{url('/seped/monitorreclamo')}}">
	        	<span class="info-box-icon info-box-icon-2 bg-red"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-phone-square"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Reclamos</span>
	          <span class="info-box-number">
	          {{number_format(iContadorRecRecibido(),0, '.', ',')}}
	          <small>Reclamos recibidos</small>
	      	  </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>

	    <div class="clearfix visible-sm-block"></div>

	    <!--- PAGOS RECIBIDOS --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-3" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid green;">
	      	<a href="{{url('/seped/monitorpago')}}">
	        	<span class="info-box-icon info-box-icon-3 bg-green"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-money"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Pagos</span>
	          <span class="info-box-number">
	          	{{number_format(iContadorPagRecibido(),0, '.', ',')}}
	          	<small>Pagos recibidos</small>
	          </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>

	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-4" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid yellow;">
	      	<a href="{{URL::action('AdcatalogoController@listado','C')}}">
	        	<span class="info-box-icon info-box-icon-4 bg-yellow"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-cubes"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Catálogo</span>
	          <span class="info-box-number">
	          {{number_format($contCatalogo,0, '.', ',')}}
			  <small>productos</small>
	      	  </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>
	</div>

	<!-- Main row -->
	<div class="row">
		<!-- Left col -->
		<div class="col-md-8" >
			<!-- AREA CHART -->
            <div class="box" 
	            style="background-color: #f7f7f7;
		      	border-radius: 10px 10px 10px 10px;
		      	border: 1px solid #CCCCCC;">
              <div class="box-header">
                <h3 class="box-title">
                	<b>&nbsp;&nbsp;&nbsp;&nbsp;Ventas/Pedidos (Bs.)<b>
                </h3>
              </div>
              <div class="box-body chart-responsive">
                <div class="chart" id="line-chart" 
                	style="height: 240px; width: 100%;">
               	</div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
		</div>

		<div class="col-md-4">
		  	<!-- Info Boxes Style 2 -->
			<div class="info-box info-box-10 bg-yellow"
				style="border-radius: 10px 10px 10px 10px;">
				<a href="{{URL::action('AdestadoctaController@index')}}" 
					style="color: #ffffff;">
			    	<span class="info-box-icon info-box-icon-10"
			    		style="border-radius: 10px 0px 0px 10px;">
			    		<i class="fa fa-cc"></i>
			    	</span>
			    </a>
			    <div class="info-box-content info-box-content-10" >
			      <span class="info-box-text">Cuentas por cobrar</span>
			      <span class="info-box-number">{{number_format($totCxcBs,2, '.', ',')}}</span>
			      <div class="progress">
			        <div class="progress-bar" style="width: 50%"></div>
			      </div>
			      <span class="progress-description">
			      	@if ($cfg->mostrarPrecioOM == 1)
			      		<b>{{number_format($totCxcDs,2, '.', ',')}} {{$cfg->simboloOM}}</b>
			      	@endif
			      </span>
			    </div>
			</div>

			<div class="info-box info-box-20 bg-green"
				style="border-radius: 10px 10px 10px 10px;">
				<a href="{{URL::action('AdreportController@cxps')}}" 
					style="color: #ffffff;">
					<span class="info-box-icon info-box-icon-20"
						style="border-radius: 10px 0px 0px 10px;">
						<i class="fa fa-thumbs-up"></i>
					</span>
				</a>
				<div class="info-box-content info-box-content-20">
				  <span class="info-box-text">Cuentas por pagar</span>
				  <span class="info-box-number">{{number_format($totCxpBs,2, '.', ',')}} </span>
				  <div class="progress">
				    <div class="progress-bar" style="width: 20%"></div>
				  </div>
				  <span class="progress-description">
				  	@if ($cfg->mostrarPrecioOM == 1)
				  		<b>{{number_format($totCxpDs,2, '.', ',')}} {{$cfg->simboloOM}}</b>
				  	@endif
				  </span>
				</div>
			</div>

		    <div class="info-box info-box-30 bg-aqua"
		    	style="border-radius: 10px 10px 10px 10px;">
		    	<a href="{{URL::action('AdreportController@proveedores')}}" 
		    		style="color: #ffffff;">
			    	<span class="info-box-icon info-box-icon-30"
			    		style="border-radius: 10px 0px 0px 10px;">
			    		<i class="fa fa-truck"></i>
			    	</span>
			    </a>
			    <div class="info-box-content info-box-content-30">
			      <span class="info-box-text">Proveedores</span>
			      <span class="info-box-number">
			      	{{number_format($contProveedor,0, '.', ',')}}
			      </span>
			      <div class="progress">
			        <div class="progress-bar" style="width: 40%"></div>
			      </div>
			      <span class="progress-description">
			      	 &nbsp;
			      </span>
			    </div>
		    </div>
		</div>
	</div>

</section>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
setTimeout('document.location.reload()',60000);

$(function () {
Morris.Line({
  element: 'line-chart',
  data: [ <?php echo $chart_data; ?>],
  lineColors: ['#819C79', '#fc8710'],
  xkey: 'periodo',
  ykeys: ['pedidos','ventas'],
  labels: ['PEDIDO', 'VENTA'],
  xLabels: 'day',
  xLabelAngle: 45,
  xLabelFormat: function (d) {
	return ("0" + (d.getDate())).slice(-2) + '-' + ("0" + (d.getMonth() + 1)).slice(-2) + '-' + d.getFullYear(); 
  
  },
  resize: true
});


});


</script>
@endpush
@endsection