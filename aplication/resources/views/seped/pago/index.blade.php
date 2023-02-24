@extends ('layouts.menu')
@section ('contenido') 

<div class="row">
	
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <a href="{{url('/seped/pago/create')}}">
            <button class="btn-normal" data-toggle="tooltip" style="font-size: 18px; width: 200px;" title="Crear pago nuevo">
                Pago nuevo
            </button>
        </a>
    </div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.pago.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead class="colorTitulo">
                    <th>#</th>
                	<th style="width:190px;">OPCION</th>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>ENVIADO</th>
                    <th>PROCESADO</th>
                    <th>ESTADO</th>
                    <th>ORIGEN</th>
                    <th>TOTAL</th>
                    <th>SUCURSAL</th>
                </thead>

	            @foreach ($tabla as $t)
                <tr>
                    <td>{{$loop->iteration}}</td>
                  	<td>

                        <?php CalculaTotalesPagos($t->id); ?>
                		<!-- VER RECLAMO -->
                        <a href="{{URL::action('AdpagoController@show',$t->id)}}">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" 
                                data-toggle="tooltip" 
                                title="Consular Pago">
                        	</button>
                        </a>

                        <!-- DESCARGAR PAGO -->
                        <a href="{{URL::action('AdpagoController@descargar',$t->id)}}">
                            <button class="btn btn-default btn-pedido fa fa-download" 
                                data-toggle="tooltip" 
                                title="Descargar pago en pdf">
                            </button>
                        </a>

                        @if ($t->estado == 'NUEVO') 
                            <!-- MODIFICAR PEDIDO -->
                            <a href="{{URL::action('AdpagoController@edit',$t->id)}}">
                                <button class="btn btn-default btn-pedido fa fa-pencil" 
                                    data-toggle="tooltip" 
                                    title="Modificar Pago">
                                </button>
                            </a>

                            <!-- ELIMINAR RECLAMO -->
                            <a href="" 
                                data-target="#modal-delete-{{$t->id}}" 
                                data-toggle="modal">
                                <button class="btn btn-default btn-pedido fa fa-trash-o" 
                                    data-toggle="tooltip" 
                                    title="Eliminar Pago">
                                </button>
                            </a>
                        @endif
               
                	</td>
                    <td>{{$t->id}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($t->fecha))}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($t->fecenviado))}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($t->fecprocesado))}}</td>
                    @if ($t->estado == 'ENVIADO')
                        <td style="color: red;">{{$t->estado}}</td>
                    @else
                        <td>{{$t->estado}}</td>
                    @endif
                    <td>{{$t->origen}}</td>
                    <td align="right">{{number_format(SubtotalPago($t->id), 2, '.', ',')}}</td>
                    <td>{{sLeercfg($t->codisb, "SedeSucursal")}}</td>
                </tr>
                @include('seped.pago.delete')
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