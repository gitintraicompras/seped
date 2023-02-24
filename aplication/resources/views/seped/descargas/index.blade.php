@extends('layouts.menu')
@section('contenido')

<section class="content" >
	 <!-- Info boxes -->
	<div class="row">
		@foreach ($carga as $c)
	    <div class="col-md-6 col-sm-12 col-xs-12" >
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="{{URL::action('AddescargaController@show',$c->id)}}">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px !important;">
	        		<i class="fa fa-download"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">
	          	{{$c->ruta}}
	          </span>
	          <span class="info-box-number">
	          	{{ $c->descrip }} 
	          	<br>
	          	<small>
	          		({{  number_format($c->contdescarga, 0, '.', ',') }}) descargas
	          	</small>
	          </span>
	        </div>
	      </div>
	    </div>
	    @endforeach
	</div>
</section>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection