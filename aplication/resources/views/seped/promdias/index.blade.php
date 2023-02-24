@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="promdias/create">
			<button class="btn-normal" 
				style="font-size: 18px; width: 200px;" 
				title="Crear una nueva promoción">
				Nueva promoción
			</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.promdias.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width: 50px;">#</th>
					<th style="width: 100px;">OPCION</th>
					<th style="width: 50px;">ID</th>
					<th>DESCRIPCION</th>
					<th>DIAS</th>
					<th>DESDE</th>
					<th>HASTA</th>
					<th>ESTADO</th>
					<th>SUCURSAL</th>
				</thead>
				@foreach ($promdias as $pd)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
			
						<a href="{{URL::action('AdpromdiasController@edit',$pd->id)}}">
							<button class="btn btn-default btn-pedido fa fa-pencil" 
								title="Modificar promoción">
							</button>
						</a>

						<a href="" 
							data-target="#modal-delete-{{$pd->id}}" 
							data-toggle="modal">
							<button class="btn btn-default btn-pedido fa fa-trash-o" 
								title="Eliminar promoción">
							</button>
						</a>

					</td>
					<td>{{$pd->id}}</td>
					<td>{{$pd->descrip}}</td>
					<td align="right">{{$pd->dias}}</td>
					<td>{{date('d-m-Y', strtotime($pd->desde))}}</td>
					<td>{{date('d-m-Y', strtotime($pd->hasta))}}</td>
					<td>{{$pd->estado}}</td>
					<td>{{sLeercfg($pd->codisb, "SedeSucursal")}}</td>
				</tr>
				@include('seped.promdias.delete')
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