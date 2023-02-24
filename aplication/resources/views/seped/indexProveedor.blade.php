@extends('layouts.menu')
@section('contenido')
 
<section class="content" >
	<div class="row" >
	 	<!--- CATALOGO --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-1" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid aqua;">
	      	<a href="{{url('/seped/provcata')}}">
	        	<span class="info-box-icon info-box-icon-1 bg-aqua"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-cubes"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Catálogo</span>
	          <span class="info-box-number">
	          	{{number_format($contCata,0, '.', ',')}}
	          	<small>Productos</small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!--- FACTURAS --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-2" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid red;">
	      	<a href="{{url('/seped/provfact')}}">
	        	<span class="info-box-icon info-box-icon-2 bg-red"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-building-o"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Facturas</span>
	          <span class="info-box-number">
	          {{number_format($contFact,0, '.', ',')}}
	          <small>Ultimo 7 dias</small>
	      	  </span>
	        </div>
	      </div>
	    </div>

	    <div class="clearfix visible-sm-block"></div>

	    <!--- MAS VENDIDOS --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-3" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid green;">
	      	<a href="{{url('/seped/provvtas')}}">
	        	<span class="info-box-icon info-box-icon-3 bg-green"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-tags"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Ventas</span>
	          <span class="info-box-number">
	          <small>Productos más vendidos</small>
	      	  </span>
	        </div>
	      </div>
	    </div>
 
	    <!--- CONFIGURACION --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-4" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid yellow;">
	      	<a href="{{url('/seped/provconf')}}">
	        	<span class="info-box-icon info-box-icon-4 bg-yellow"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-gear"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Configuración</span>
	          <span class="info-box-number">
	          <small>Información del proveedor</small>
	      	  </span>
	        </div>
	      </div>
	    </div>
	    &nbsp;
	    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	 	
	</div>
</section>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection