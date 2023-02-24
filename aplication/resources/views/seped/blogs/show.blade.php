@extends ('layouts.menu')
@section ('contenido')

<div class="row">

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <center>
                <img class="img-thumbnail img-fluid img-responsive" src="{{ asset( '/public/storage/'.$blog->imagen )}}" alt="" style ="width: 100%;"  >
            </center>
        </div>
    </div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label for="name">ID</label>
            <input readonly type="text" class="form-control" name="name" value="{{$blog->id}}">
	    </div>
    </div>
    <!-- FECHA  -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Fecha</label>
            <input readonly type="text" value="{{date('d-m-Y')}}" name="fecha" class="form-control">
	    </div>
    </div>

	<!-- STATUS -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	    <div class="form-group">
	        <label>Estatus</label>
            <input readonly type="text" class="form-control" name="status" value="{{ $blog->status}}" >
	    </div>
    </div>

   	<!-- PUBLICADO POR  -->
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Publicado por</label>
            <input readonly type="text" class="form-control" name="publicado" value="{{ $blog->publicado}}" >
	    </div>
    </div>

	
</div>

<div class="row">
	<!-- NOMBRE  -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
	        <label>Nombre</label>
            <input readonly type="text" class="form-control" name="nombre" value="{{ $blog->nombre }}" >
	    </div>
    </div>

	<!-- BREVE  -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
	        <label>Breve descripción</label>
            <textarea readonly name="breve" rows="3" style="width: 100%;">{{$blog->breve}}</textarea>
	    </div>
    </div>

    <!-- DESCRIPCION COMPLETA  -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<label>Descripcion completa</label>
    		<textarea readonly name="descrip" rows="10" style="width: 100%;">{{$blog->descrip}}</textarea>
		</div>
    </div>

 	
 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
	</div>

</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection