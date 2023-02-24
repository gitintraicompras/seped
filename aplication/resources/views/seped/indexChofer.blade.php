@extends('layouts.menu')
@section('contenido')
 
<section class="content" >
	<div class="row" >
	 	<!--- CESTAS POR ENTREGAR --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-1" style="background-color: #f7f7f7;">
	      	<a href="{{url('/seped/cestasentregar')}}">
	        	<span class="info-box-icon info-box-icon-1 bg-aqua">
	        		<i class="fa fa-shopping-basket"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Cestas</span>
	          <span class="info-box-number">
	          	{{$cestasxEntregar}}
	          	<small>Por entregar</small>
	          </span>
	        </div>
	      </div>
	    </div>
	    &nbsp;
	    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
</section>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection