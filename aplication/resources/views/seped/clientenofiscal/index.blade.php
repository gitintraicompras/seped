@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="{{url('/seped/clientenofiscal/create')}}">
			<button class="btn-normal" data-toggle="tooltip" style="font-size: 18px; width: 200px;" title="Agregar cliente a la lista">
				Agregar cliente
			</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.clientenofiscal.search')
	</div>
</div>

<div class="row" style="margin-top: 10px;">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width:40px;">#</th>
					<th style="width:70px;">OPCION</th>
					<th style="width:120px;">CODIGO</th>
					<th>NOMBRE</th>
				</thead>
				@foreach ($tabla as $t)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
	
						<a href="" data-target="#modal-delete-{{$t->codcli}}" data-toggle="modal">
							<button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar de la lista">
							</button>
						</a>
		
					</td>
					<td>{{$t->codcli}}</td>
					<td>{{$t->nombre}}</td>
				</tr>
				@include('seped.clientenofiscal.delete')
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