@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">

	<div class="row">
	    <!-- BUSCAR CLIENTES  -->
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			@include('seped.clientes.search')
		</div>
	</div>   
   
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                   <thead class="colorTitulo">
	                	<th>#</th>
	                	<th style="width: 100px;">OPCION</th>
	                	<th>DESCRIPCION</th>
		                <th>CODIGO</th>
		                <th>RIF</th>
		                <th>TELEFONO</th>
		                <th>CONTACTO</th>
		                <th>ESTADO</th>
		                <th>SUCURSAL</th>
		            </thead>

		            @foreach ($tabla as $t)
		                <tr>
		                	<td>{{$loop->iteration}}</td>
		                	<td>

								<!-- VER DETALLES -->
                                <a href="{{URL::action('AdclientesController@show',$t->codcli)}}">
                                	<button class="btn btn-default  btn-pedido fa fa-file-o" title="Consultar cliente">
                                	</button>
                                </a>


								<a href="{{URL::action('AdclientesController@edit',$t->codcli)}}">
									<button class="btn btn-default btn-pedido fa fa-pencil" title="Modificar estado del cliente">
									</button>
								</a>


                        	</td>
                        	<td>{{$t->nombre}}</td>
		                    <td>{{$t->codcli}}</td>
		                	<td>{{$t->rif}}</td>
		                	<td>{{$t->telefono}}</td>
		                	<td>{{$t->contacto}}</td>
		                	<td>{{$t->estado}}</td>
		                	<td>{{sLeercfg($t->codisb, 'SedeSucursal')}}</td>
		                </tr>
		            @endforeach
	            </table><br>
	            <div align='right'>
					{{$tabla->render()}}
				</div><br>
            </div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
		</div>
	</div>

</div>


@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection