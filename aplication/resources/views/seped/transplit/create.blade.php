@extends ('layouts.menu')
@section ('contenido')

<div class="row">

	{!! Form::open(array('url'=>'/seped/transplit','method'=>'POST','autocomplete'=>'off')) !!}
	{{ Form::token() }}


	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	        <label>Descripción</label>
            <input type="text" class="form-control" name="literal" value="{{ old('liteal') }}">
	    </div>
    </div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
			<button class="btn-confirmar" type="submit">Crear</button>
			
		</div>
	</div>

	{{ Form::close() }}

</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection