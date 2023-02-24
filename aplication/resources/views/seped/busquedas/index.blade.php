@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		@include('seped.busquedas.search')
	</div>
</div>

<div class="row" style="margin-top: 10px;">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width:70px;">OPCION</th>
					<th style="width:40px;">ID</th>
					<th>BUSQUEDA</th>
					<th>EXITOSA</th>
					<th>CONTADOR</th>
					<th>FECHA</th>
				</thead>
				@foreach ($tabla as $t)
				<tr>
					<td>
						<a href="" data-target="#modal-delete-{{$t->id}}" data-toggle="modal">
							<button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar la busqueda"></button>
						</a>
		
					</td>
					<td>{{$t->id}}</td>
					<td>{{$t->texto}}</td>
					<td>{{$t->exitosa == 1 ? 'SI' : 'NO'}}</td>
					<td>{{number_format($t->contador, 0, '.', ',')}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecha))}}</td>
				</tr>
				@include('seped.busquedas.delete')
				@endforeach
			</table>
			<div align='right'>
				{{$tabla->render()}}
			</div><br>
		</div>
	</div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection