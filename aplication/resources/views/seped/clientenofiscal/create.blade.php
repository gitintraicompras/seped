@extends ('layouts.menu')
@section ('contenido')


{!! Form::open(array('url'=>'/seped/clientenofiscal','method'=>'POST','autocomplete'=>'off')) !!}
{{ Form::token() }}

<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
		<div class="form-group">
			<label>Clientes:</label>
	    	<select name="codcli" class="form-control selectpicker " data-live-search="true">
	    		@foreach($tabla as $t)
	   				<option value="{{$t->codcli}}">{{$t->codcli}} - {{$t->nombre}}</option>
	    		@endforeach
	    	</select>
		</div>
	</div>
</div>

<div class="row" style="margin-top: 40px;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
		<div class="form-group">
			<a href="{{URL::action('AdclientenofiscalController@index')}}">
			    <button type="button" class="btn-normal" data-toggle="tooltip" title="Regresar">Regresar</button>
			</a>
			<button class="btn-confirmar" type="submit" data-toggle="tooltip" title="Agregar producto a la lista">Agregar</button>
		</div>
	
	</div>
</div>

{{ Form::close() }}


@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection