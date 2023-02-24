@extends ('layouts.menu')
@section ('contenido')
@php
$contCesta = 0;
@endphp
 
<div id="page-wrapper">

	<!-- TABLA DE CESTAS POR ENTREGAR -->
	<div class="row" >
		<div class="col-xs-12" >
			<div class="table-responsive" >
				<table id="idtabla" 
					   class="table table-striped table-bordered table-condensed table-hover">
					<thead class="colorTitulo">
						<th style="width:140px;">CESTA</th>
						<th>PEDIDO</th>
		 	            <th style="width: 100px;">FECHA</th>
         				<th>CLIENTE</th>
         				<th>SUCURSAL</th>
					</thead>
					@foreach ($cestas as $c)
					<tr >
                        <td>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group" >
                                <input readonly 
                                	style="width: 130px;" 
                                	value="{{$c->cesta_co}}" 
                                	class="form-control" >
                            </div>
                        </td>

						<td>{{$c->pedido_num}}</td>
						<td>{{date('d-m-Y', strtotime($c->fecha_rec))}}</td>
						<td>{{NombreCliente($c->co_cli)}}</td>
						<td>{{sLeercfg($c->codisb, "SedeSucursal")}}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	
    <div class="form-group" style="margin-left: 0px;">
        <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
    </div>

</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
</script>
@endpush

@endsection