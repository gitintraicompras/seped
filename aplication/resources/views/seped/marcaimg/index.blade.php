@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="{{url('/seped/marcaimg/create')}}">
			<button class="btn-normal" data-toggle="tooltip" style="font-size: 18px; width: 200px;" title="Agregar marca">Agregar marca</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.marcaimg.search')
	</div>
</div>

<br>
<div class="col-md-12">
	<div class="nav-tabs-custom" >
	    <ul class="nav nav-tabs" >
	      <li class="active"><a href="#tab_1" data-toggle="tab">IMAGENES</a></li>
	      <li><a href="#tab_2" data-toggle="tab">LISTADO DE MARCAS</a></li>
	      <li class="pull-right">
	      	<a href="{{url('/home')}}" class="text-muted">
	      		<i class="fa fa-window-close-o"></i>
	      	</a>
	      </li>
	    </ul>
	</div>
	<div class="tab-content">
      	<div class="tab-pane active" id="tab_1">
	        <div class="row">
	        	@if ($marcaimg != null)
	        	<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead class="colorTitulo">
							<th style="width: 40px;">#</th>
							<th style="width: 80px;" class="hidden-xs">IMAGEN</th>
							<th style="width: 70px;">OPCION</th>
							<th style="width: 120px;">CODIGO</th>
							<th>DESCRIPCION</th>
							<th style="width: 200px;">NOMBRE IMAGEN</th>
						</thead>
						@foreach ($marcaimg as $m)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td class="hidden-xs">
		                		<div align="center">
		                			<img src="{{asset('/public/storage/'.NombreImagenMarca($m->codmarca))}}" style="width: 120px;" class="img-responsive">
		                		</div>
		                	</td>
							<td>
								<!-- ELIMINAR IMAGENES -->
								<a href="" data-target="#modal-delete-{{$m->codmarca}}" data-toggle="modal">
									<button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar imagen">
									</button>
								</a>
							</td>
							<td>{{$m->codmarca}}</td>
							<td>{{$m->desmarca}}</td>
							<td>{{$m->nomimagen}}</td>
						</tr>
						@include('seped.marcaimg.delete')
						@endforeach
					</table>
				</div>
				@endif
	      	</div>
	    </div>
	    <div class="tab-pane" id="tab_2">
	        <div class="row">
	        	@if ($marca != null)
	        	<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead class="colorTitulo">
							<th style="width: 40px;">#</th>
							<th>DESCRIPCION</th>
						</thead>
						@foreach ($marca as $m)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$m->codmarca}}</td>
						</tr>
						@endforeach
					</table>
				</div>
				@endif
	      	</div>
	    </div>
	</div>
</div>  	

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');

$('.nav-tabs').click(function(event) {
	var x=$(event.target).text();
	var tab = '1';
	if (x == 'IMAGENES') 
		tab = '0';
	var url = "{{url('/seped/marcaimg?tab=X')}}";
	url = url.replace('X', tab);
	window.location.href=url;
})
$('.nav-tabs li:eq( {{$tab}} ) a').tab('show');


</script>
@endpush

@endsection