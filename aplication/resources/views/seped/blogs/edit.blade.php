@extends ('layouts.menu')
@section ('contenido')

{!!Form::model($blog,['method'=>'PATCH','route'=>['blogs.update',$blog->id], 'enctype'=>'multipart/form-data'])!!}
{{Form::token()}}


<div class="row">

	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
	        <label for="name">ID</label>
            <input readonly type="text" class="form-control" value="{{$blog->id}}">
	    </div>
    </div>

    <!-- FECHA SINCONIZACION -->
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
	        <label>Fecha</label>
            <input type="date" value="{{date('Y-m-d')}}" name="fecha" class="form-control" value="{{$blog->fecha}}">
	    </div>
    </div>

    <!-- TIPO DE USUARIO -->
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	    <div class="form-group">
	    	<label>Estatus</label>
	    	<select name="status" class="form-control">
				<option value="ACTIVO" selected>ACTIVO</option>
				<option value="INACTIVO">INACTIVO</option>
	    	</select>
	    </div>
    </div>
   
    <!-- PUBLICADO POR  -->
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
		<div class="form-group">
	        <label>Publicado por</label>
            <input type="text" class="form-control" name="publicado" value="{{$blog->publicado}}">
	    </div>
    </div>

	<!-- NOMBRE  -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
	        <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" value="{{$blog->nombre}}" >
	    </div>
    </div>

  	<!-- BREVE  -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
	        <label>Breve descripción</label>
            <textarea name="breve" rows="3" style="width: 100%;">{{$blog->breve}}</textarea>
	    </div>
    </div>

	<!-- DESCRIPCION COMPLETA  -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<label>Descripción completa</label>
    		<textarea name="descrip" rows="10" style="width: 100%;">{{$blog->descrip}}</textarea>
		</div>
    </div>

	<!-- IMAGEN -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Imagen</label>
			<input type="text" class="form-control" readonly name="nimagen" value="{{$blog->imagen}}">
			<input type="file" name="imagen">
		</div>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
        	<img class="img-thumbnail img-fluid" src="{{ asset( '/aplication/public/storage/'.$blog->imagen)}}" alt="" style ="width: 50%;" >
        </div>
    </div>

</div>

<!-- BOTON GUARDAR/CANCELAR -->
<div class="form-group">
	<div class="form-group" style="margin-top: 20px;">
	    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
		<button class="btn-confirmar" type="submit">Guardar</button>
	</div>
</div>


{{Form::close()}}

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection