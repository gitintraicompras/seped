@extends ('layouts.menu')
@section ('contenido')

{!! Form::open(array('url'=>'/seped/prodimg','method'=>'POST','autocomplete'=>'off', 'enctype'=>'multipart/form-data')) !!}
{{ Form::token() }}

<div class="container">
    <p>&nbsp;</p>
    <div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3">
			<center>
			<i class="fa fa-upload color3 lcolor5" style="font-size: 120px;"></i>
			</center>
    	</div>
		<div class="col-lg-9 col-md-9 col-sm-9" style="width: 60%;">
			<div class="row">
				<div>
					<img src="{{asset('images/linea.png')}}" class="img-responsive">
				</div>
				<p><strong>SUBIR ARCHIVO</strong></p>
		  		<p align="justify">Seleccione el nombre del archivo que desea subir al portal web</p> 
			</div>   
			<div class="row">
				<div class="form-group">
					<input type="file" name="linkarchivo">
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<div class="col-xs-12 input-group input-group-sm">
				    	<select name="codprod" class="form-control selectpicker " data-live-search="true">
				    		@foreach($producto as $p)
				    			<option value="{{$p->codprod}}">{{$p->codprod}}-{{$p->desprod}}-{{$p->barra}}</option>
				    		@endforeach
				    	</select>
					</div>
				</div>
			</div>
		</div>
	</div>

	
</div>

<br><br>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="form-group">
		<div class="form-group">
		    <button type="button" class="btn-normal" onclick="history.back(-1)" data-toggle="tooltip" title="Regresar">
		    Regresar
			</button>
			<button class="btn-confirmar" type="submit" data-toggle="tooltip" title="Subir imagen">
			Subir
			</button>
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