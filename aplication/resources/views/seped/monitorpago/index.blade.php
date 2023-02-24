@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		@include('seped.monitorpago.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width: 180px;">OPCION</th>
					<th>ID</th>
					<th>CLIENTE</th>
					<th>CODIGO</th>
					<th>FECHA</th>
					<th>ENVIADO</th>
					<th>PROCESADO</th>
					<th>ESTADO</th>
					<th>ORIGEN</th>
					<th>TOTAL</th>
					<th>SUCURSAL</th>
				</thead>
				@foreach ($pago as $t)
				<tr>
					<td>
                        <?php CalculaTotalesPagos($t->id); ?>
						
						<!-- CONSULTA -->
                        <a href="{{URL::action('AdmonitorpagoController@show',$t->id)}}">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip" title="Consultar pago">
                        	</button>
                        </a>

                        <!-- DESCARGAR PAGO -->
                        <a href="{{URL::action('AdpagoController@descargar',$t->id)}}">
                            <button class="btn btn-default btn-pedido fa fa-download" data-toggle="tooltip" title="Descargar pago en pdf">
                            </button>
                        </a>

                        @if ($t->estado == 'RECIBIDO')
                        <!-- PROCESAR PAGO -->
                        <a href="" data-target="#modal-procesar-{{$t->id}}" data-toggle="modal">
                            <button class="btn btn-default btn-pedido fa fa-check" data-toggle="tooltip" title="Procesar pago"></button>
                        </a>
                        <!-- ELIMINAR RECLAMO -->
                        <a href="" data-target="#modal-delete-{{$t->id}}" data-toggle="modal">
                            <button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar pago"></button>
                        </a>
                        @endif
					</td>
					<td>{{$t->id}}</td>
					<td>{{$t->cliente}}</td>
					<td>{{$t->codcli}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecha))}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecenviado))}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecprocesado))}}</td>
					@if ($t->estado == 'RECIBIDO') 
						<td style="color: red;">{{$t->estado}}</td>
					@else
					    <td>{{$t->estado}}</td>
					@endif
					<td>{{$t->origen}}</td>
					<td align="right">{{number_format(SubtotalPago($t->id), 2, '.', ',')}}</td>
					<td>{{sLeercfg($t->codisb, "SedeSucursal")}}</td>
				</tr>
				@include('seped.monitorpago.procesar')
				@include('seped.monitorpago.delete')
				@endforeach
			</table><br>
	        {{$pago->render()}}
		</div>
	</div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection