@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
		
		{!! Form::open(array('url'=>'/seped/reclamo','method'=>'POST','autocomplete'=>'off')) !!}
		{{ Form::token() }}

		<label>Factura:</label>
		<div class="form-group">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 input-group input-group-sm">
		    	<select name="factnum" class="form-control selectpicker " data-live-search="true">
		    		@foreach($tabla as $t)
		   				<option value="{{$t->factnum}}">{{$t->factnum}}  -  {{date('d-m-Y', strtotime($t->fecha))}}</option>
		    		@endforeach
		    	</select>
			</div>
		</div>

		<div class="form-group">
			<a href="{{URL::action('AdreclamoController@index')}}">
			    <button type="button" class="btn-normal" data-toggle="tooltip" title="Regresar">Regresar</button>
			</a>
			<button class="btn-confirmar" type="submit" data-toggle="tooltip" title="Crear reclamo">Crear</button>
		</div>
	
		{{ Form::close() }}
	</div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush
@endsection