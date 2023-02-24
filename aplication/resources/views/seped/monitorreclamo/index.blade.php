@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		@include('seped.monitorreclamo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width: 180px;">OPCION</th>
					<th>ID</th>
					<th>CODIGO</th>
					<th>CLIENTE</th>
					<th>FECHA</th>
					<th>PROCESADO</th>
					<th>ESTADO</th>
					<th>FACTURA</th>
					<th>ORIGEN</th>
					<th>TOTAL</th>
					<th>SUCURSAL</th>
				</thead>
				@foreach ($tabla as $t)
				<tr>
					<td>
						<!-- CONSULTA DEL RECLAMO -->
                        <a href="{{URL::action('AdmonitorreclamoController@show',$t->id)}}">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip" title="Consultar reclamo">
                        	</button>
                        </a>

                        <!-- DESCARGAR RECLAMO-->
                        <a href="{{URL::action('AdreclamoController@descargar',$t->id)}}">
                            <button class="btn btn-default btn-pedido fa fa-download" data-toggle="tooltip" title="Descargar reclamo en pdf">
                            </button>
                        </a>

                        @if ($t->estado == 'RECIBIDO')
                        <!-- PROCESAR RECLAMO -->
                        <a href="" data-target="#modal-procesar-{{$t->id}}" data-toggle="modal">
                            <button class="btn btn-default btn-pedido fa fa-check" data-toggle="tooltip" title="Procesar reclamo"></button>
                        </a>
                        <!-- ELIMINAR RECLAMO -->
                        <a href="" data-target="#modal-delete-{{$t->id}}" data-toggle="modal">
                            <button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar reclamo"></button>
                        </a>
						@endif
					</td>
					<td>{{$t->id}}</td>
					<td>{{$t->codcli}}</td>
					<td>{{$t->cliente}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecha))}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecprocesado))}}</td>
					@if ($t->estado == 'RECIBIDO')
						<td style="color: red;">{{$t->estado}}</td>
					@else
						<td>{{$t->estado}}</td>
					@endif
					<td>{{$t->factnum}}</td>
					<td>{{$t->origen}}</td>
					<td align="right">{{number_format(SubtotalReclamo($t->id), 2, '.', ',')}}</td>
					<td>{{sLeercfg($t->codisb, "SedeSucursal")}}</td>
				</tr>
				@include('seped.monitorreclamo.procesar')
				@include('seped.monitorreclamo.delete')
				@endforeach
			</table><br>
	        {{$tabla->render()}}
		</div>
	</div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection