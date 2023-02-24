@extends ('layouts.menu')
@section ('contenido')
  
<div class="row">
	<div class="col-xs-4">
		@include('seped.pedido.search')
	</div>
</div>

<div class="row" style="margin-top: 10px;">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width:190px;">OPCION</th>
					<th>PEDIDO</th>
					<th>FECHA</th>
					<th>ENVIADO</th>
					<th>PROCESADO</th>
					<th>ESTADO</th>
					<th>ORIGEN</th>
					<th>TIPO</th>
					<th>TOTAL</th>
					@if ( $cfg->mostrarPedidoOM > 0 )
						<th>FACTOR</th>
					@endif
			        <th>SUCURSAL</th>
           		</thead>
				@foreach ($tabla as $t)
				<tr>
					<td>
						<!-- CONSULTA DE PEDIDO -->
                        <a href="{{URL::action('AdpedidoController@show',$t->id)}}">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" 
                        		data-toggle="tooltip" 
                        		title="Consultar pedido">
                        	</button> 
                        </a>

                        <!-- DESCARGAR PEDIDO -->
                        <a href="{{URL::action('AdpedidoController@descargar',$t->id)}}">
                        	<button class="btn btn-default btn-pedido fa fa-download" 
                        		data-toggle="tooltip" 
                        		title="Descargar pedido en pdf">
                        	</button>
                        </a>

						@if ($t->estado == 'NUEVO') 
							<!-- ELIMINAR PEDIDO -->
							<a href="" 
								data-target="#modal-delete-{{$t->id}}" 
								data-toggle="modal">
								<button class="btn btn-default btn-pedido fa fa-trash-o" 
									data-toggle="tooltip" 
									title="Eliminar pedido">
								</button>
							</a>
						@endif

					</td>
					<td>{{$t->id}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecha))}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecenviado))}}</td>
					<td>{{date('d-m-Y H:i:s', strtotime($t->fecprocesado))}}</td>
					@if ($t->estado == 'APROBADO')
						<td style="color: red;">{{$t->estado}}</td>
					@else
						<td>{{$t->estado}}</td>
					@endif
					<td>{{$t->origen}}</td>
					<td align="center">{{$t->tipedido}}</td>

					<td align="right">
						<span title= "{{$cfg->simboloMoneda}}">
                        	{{number_format($t->total, 2, '.', ',')}}
                        </span>
						@if ( $cfg->mostrarPrecioOM > 0 )
                            <br>
                            <span style="color: green;" 
                                title= "{{$cfg->simboloOM}}">
                                <b>{{number_format($t->total/$t->factorcambiario, 2, '.', ',')}}</b>
                            </span>
                        @endif
					</td>

					@if ( $cfg->mostrarPedidoOM > 0 )
						<td align="right">{{number_format($t->factorcambiario, 2, '.', ',')}}</td>
					@endif
					<td>{{sLeercfg($t->codisb, "SedeSucursal")}}</td>
				</tr>
				@include('seped.pedido.delete')
				@endforeach
			</table><br>
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