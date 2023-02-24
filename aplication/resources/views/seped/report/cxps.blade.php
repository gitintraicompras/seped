@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">
	
	<div class="row">
		<!-- BUSCAR FACTURAS  -->
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	        @include('seped.report.cxpsearch')
	    </div>
	    @if ( $cfg->mostrarPedidoOM > 0 )
	    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
     		<div class="form-group">
  				<div class="input-group input-group-sm">
					<span class="input-group-addon" >Total({{ $cfg->simboloOM }}):</span>
					<input readonly type="text" class="form-control" id="idtotDs" value="0.00" style="color: #000000; text-align: right; background: #F7F7F7;" placeholder="Monto total">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
     		<div class="form-group">
  				<div class="input-group input-group-sm">
					<span class="input-group-addon" >Total({{ $cfg->simboloMoneda }}):</span>
					<input readonly type="text" class="form-control" id="idtotBs" value="0.00" style="color: #000000; text-align: right; background: #F7F7F7;" placeholder="Monto total">
				</div>
			</div>
		</div>
		@else
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     		<div class="form-group">
  				<div class="input-group input-group-sm">
					<span class="input-group-addon" >Total({{ $cfg->simboloMoneda }}):</span>
					<input readonly type="text" class="form-control" id="idtotBs" value="0.00" style="color: #000000; text-align: right; background: #F7F7F7;" placeholder="Monto total">
				</div>
			</div>
		</div>
		@endif
	</div>   
   
  	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
                <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
             
	                <thead class="colorTitulo">
						<th>#</th>
						<th style="width: 40px;">OPCION</th>
						<th style="width: 100px;">DOCUMENTO</th>
						<th>TIPO</th>
						<th>DETALLE</th>
	                    <th style="width: 80px;">EMISION</th>
		                <th style="width: 80px;">VENCE</th>
		                <th>DIAS</th>
						@if ( $cfg->mostrarPedidoOM > 0 )
		                	<th >SALDO({{$cfg->simboloOM}})</th>
		                @else
		                	<th style="display:none;"></th>
		                @endif
		                <th>SALDO</th>
		                @if ( $cfg->mostrarPedidoOM > 0 )
		                	<th>TASA</th>
		                @else
	                		<th style="display:none;">TASA</th>
	                	@endif
	                	@if ( $cfg->mostrarPedidoOM > 0 )
		                	<th>MONEDA</th>
		                @else
	                		<th style="display:none;">MONEDA</th>
	                	@endif
	                	<th>DESCRIPCION</th>
	                	<th>SUCURSAL</th>
		            </thead>

		            @foreach ($tabla as $t)
		            <tr>
						<td>{{$loop->iteration}}</td>
						<td>
							<!-- VER DETALLES -->
							<a href="{{URL::action('AdreportController@cxp',$t->tipocxp.'-'.$t->numerod)}}">
								<button class="btn btn-default btn-pedido fa fa-file-o" title="Consultar cxp"></button>
							</a>
						</td>
						<td>{{$t->numerod}}</td>
						<td>{{$t->tipocxp}}</td>
						<td>{{ substr($t->notas1, 0,30) }}</td>
	                	<td>{{date('d-m-Y', strtotime($t->fecha))}}</td>
	                	<td>{{date('d-m-Y', strtotime($t->fechai))}}</td>
	                	<td style="text-align: right;">{{DiferenciaDias($t->fechai)}}</td>
										@if ( $cfg->mostrarPedidoOM > 0 )
	                		<td align='right' @if ($t->saldoDs <0) style="color: red;" @else style="color: blue;" @endif>
	                			{{number_format($t->saldoDs, 2, '.', ',')}}
	                		</td>
	                	@else
	                		<td style="display:none;"></td>
	                	@endif
	    
	                	<td align='right' 
	                		@if ($t->saldo <0) style="color: red;" @else style="color: blue;" @endif>
	                		{{number_format($t->saldo, 2, '.', ',')}}
	                	</td>
	                	@if ( $cfg->mostrarPedidoOM > 0 )
	                		<td align='right'>{{number_format($t->factorcambiario, 2, '.', ',')}}</td>
	                	@else
	                		<td style="display:none;">0.00</td>
	                	@endif
	                	@if ( $cfg->mostrarPedidoOM > 0 )
	                		<td align='right'>{{$t->codmoneda}}</td>
	                	@else
	                		<td style="display:none;">{{$t->codmoneda}}</td>
	                	@endif
                	    <td>{{$t->descrip}}</td>
                	    <td>{{sLeercfg($t->codisb, "SedeSucursal")}}</td>

		         	</tr>
		            @endforeach
	            </table><br>
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

window.onload = function(){

    var tableReg = document.getElementById('idtabla');
    var totBs = 0.00;
    var totDs = 0.00;
    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var s1 = cellsOfRow[8].innerHTML;
        var s2 = s1.replace(/,/g, '');
        var inv = parseFloat(s2).toFixed(2);
        totBs += parseFloat(inv);

        s1 = cellsOfRow[7].innerHTML;
        s2 = s1.replace(/,/g, '');
        inv = parseFloat(s2).toFixed(2);
        totDs += parseFloat(inv);

    }
    $("#idtotBs").val(number_format(totBs, 2, '.', ','));
    $("#idtotDs").val(number_format(totDs, 2, '.', ','));
      

}

</script>
@endpush

@endsection