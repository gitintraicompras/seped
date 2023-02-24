@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <a href="{{url('/seped/reclamo/create')}}">
            <button class="btn-normal" data-toggle="tooltip" style="font-size: 18px; width: 200px;" title="Crear reclamo nuevo">
                Reclamo nuevo
            </button>
        </a>
    </div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.reclamo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead class="colorTitulo">
                	<th style="width:190px;">OPCION</th>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>ENVIADO</th>
                    <th>PROCESADO</th>
                    <th>FACTURA</th>
                    <th>ESTADO</th>
                    <th>ORIGEN</th>
                    <th>TOTAL</th>
                    <th>SUCURSAL</th>
	            </thead>

	            @foreach ($tabla as $t)
                <tr>
                  	<td>

                		<!-- VER RECLAMO -->
                        <a href="{{URL::action('AdreclamoController@show',$t->id)}}">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" 
                                data-toggle="tooltip" 
                                title="Consular Reclamo">
                        	</button>
                        </a>

                        <!-- DESCARGAR RECLAMO-->
                        <a href="{{URL::action('AdreclamoController@descargar',$t->id)}}">
                            <button class="btn btn-default btn-pedido fa fa-download" 
                                data-toggle="tooltip" 
                                title="Descargar reclamo en pdf">
                            </button>
                        </a>

                        @if ($t->estado == 'NUEVO') 
                            <!-- MODIFICAR PEDIDO -->
                            <a href="{{URL::action('AdreclamoController@edit',$t->id)}}">
                                <button class="btn btn-default btn-pedido fa fa-pencil" 
                                    data-toggle="tooltip" 
                                    title="Modificar Reclamo">
                                </button>
                            </a>

                            <!-- ELIMINAR RECLAMO -->
                            <a href="" 
                                data-target="#modal-delete-{{$t->id}}" 
                                data-toggle="modal">
                                <button class="btn btn-default btn-pedido fa fa-trash-o" d
                                    ata-toggle="tooltip" 
                                    title="Eliminar Reclamo">
                                </button>
                            </a>
                        @endif 
               
                	</td>
                    <td>{{$t->id}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($t->fecha))}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($t->fecenviado))}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($t->fecprocesado))}}</td>
                    <td>{{$t->factnum}}</td>
                    @if ($t->estado == 'ENVIADO')
                        <td style="color: red;">{{$t->estado}}</td>
                    @else
                        <td>{{$t->estado}}</td>
                    @endif
                    <td>{{$t->origen}}</td>
                    <td align="right">{{number_format(SubtotalReclamo($t->id), 2, '.', ',')}}</td>
                    <td>{{sLeercfg($t->codisb, "SedeSucursal")}}</td>
                </tr>
                @include('seped.reclamo.delete')
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