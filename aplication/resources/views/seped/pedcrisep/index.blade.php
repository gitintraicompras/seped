@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="pedcrisep/create">
			<button class="btn-normal" style="font-size: 18px; width: 200px;" title="Crear criterio nuevo">
				Criterio Nuevo 
			</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.pedcrisep.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width: 50px;">ID</th>
					<th style="width: 150px;">OPCION</th>
					<th>DESCRIPCION</th>
					<th>ESTADO</th>
				</thead>
				@foreach ($tabla as $t)
				<tr>
					<td>{{$t->id}}</td>
					<td>
						<a href="{{URL::action('AdpedcrisepController@show',$t->id)}}"><button class="btn btn-default btn-pedido fa fa-file-o" title="Consultar criterio"></button></a>

						<a href="{{URL::action('AdpedcrisepController@edit',$t->id)}}"><button class="btn btn-default btn-pedido fa fa-pencil" title="Modificar criterio"></button></a>

						<a href="" data-target="#modal-delete-{{$t->id}}" data-toggle="modal"><button class="btn btn-default btn-pedido fa fa-trash-o" title="Eliminar criterio"></button></a>

					</td>
					<td>{{$t->descrip}}</td>
					<td>{{$t->estado}}</td>
				</tr>
				@include('seped.pedcrisep.delete')
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