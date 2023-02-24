@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="grupo/create">
			<button class="btn-normal" style="font-size: 18px; width: 200px;" title="Crear grupo nuevo">
				Nuevo grupo
			</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.grupo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width: 50px;">#</th>
					<th style="width: 150px;">OPCION</th>
					<th style="width: 50px;">ID</th>
					<th>DESCRIPCION</th>
					<th>SUCURSAL</th>
				</thead>
				@foreach ($grupo as $gp)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
						<a href="{{URL::action('AdgrupoController@show',$gp->id)}}"><button class="btn btn-default btn-pedido fa fa-file-o" title="Consultar Grupo"></button></a>

						<a href="{{URL::action('AdgrupoController@edit',$gp->id)}}"><button class="btn btn-default btn-pedido fa fa-pencil" title="Modificar Grupo"></button></a>

						<a href="" data-target="#modal-delete-{{$gp->id}}" data-toggle="modal"><button class="btn btn-default btn-pedido fa fa-trash-o" title="Eliminar Grupo"></button></a>

					</td>
					<td>{{$gp->id}}</td>
					<td>{{$gp->nomgrupo}}</td>
					<td>{{sLeercfg($gp->codisb, "SedeSucursal")}}</td>
				</tr>
				@include('seped.grupo.delete')
				@endforeach
			</table>
		</div>
	</div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection