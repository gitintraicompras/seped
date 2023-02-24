@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
	{!! Form::open(array('url'=>'/seped/blogs','method'=>'POST','autocomplete'=>'off', 'enctype'=>'multipart/form-data')) !!}
	{{ Form::token() }}

	<!-- NOMBRE  -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" >
	    </div>
    </div>

    <!-- FECHA SINCONIZACION -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Fecha</label>
            <input type="date" value="{{date('Y-m-d')}}" name="fecha" class="form-control">
	    </div>
    </div>

    <!-- TIPO DE USUARIO -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	    <div class="form-group">
	    	<label>Estatus</label>
	    	<select name="status" class="form-control">
				<option value="ACTIVO" selected>ACTIVO</option>
				<option value="INACTIVO">INACTIVO</option>
	    	</select>
	    </div>
    </div>
   
	<!-- BREVE  -->
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="form-group">
	        <label>Breve descripción</label>
            <input type="text" class="form-control" name="breve" >
	    </div>
    </div>

    <!-- PUBLICADO POR  -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Publicado por</label>
            <input type="text" class="form-control" name="publicado" >
	    </div>
    </div>

	<!-- DESCRIPCION COMPLETA  -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
	        <label>Descripción completa</label>
            <input type="text" class="form-control" name="descrip" >
	    </div>
    </div>

 	<!-- IMAGEN -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Imagen</label>
			<input type="text" class="form-control" readonly name="nimagen">
			<input type="file" name="imagen">
		</div>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group" style="margin-top: 20px;">
		    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
			<button class="btn-confirmar" type="submit">Guardar</button>
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