@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">
	
	  <div class="row">
		  <!-- BUSCAR FACTURAS  -->
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        @include('seped.report.factsearch')
      </div>

  		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
  		</div>

      <!-- MONRO TOTAL CXC -->
  		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
  			<div class="form-group">
  				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
  					<span class="input-group-addon">Total:</span>
  					<input readonly type="text" class="form-control" id="idtot" value="0.00" style="color: #000000; background: #F7F7F7; text-align: right;" placeholder="Monto total">
  				</div>
  			</div>
  		</div>
    </div>   
   
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
                <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                	<thead class="colorTitulo">
	                	<th>#</th>
	                	<th style="width: 40px;">OPCION</th>
		                <th>FACTURA</th>
		                <th>EMISION</th>
                    <th>VENCE</th>
		                <th>CODIGO</th>
		                <th>CLIENTE</th>
		                <th>MONTO</th>
		                <th>IVA</th>
		                <th>TOTAL</th>
                    <th>SUCURSAL</th>
		            </thead>

		            @foreach ($tabla as $t)
		                <tr>
		                	<td>{{$loop->iteration}}</td>
		                	<td>

								        <!-- VER DETALLES -->
                        <a href="{{URL::action('AdreportController@factura',$t->factnum)}}">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" title="Consultar factura">
                        	</button>
                        </a>

                      </td>
		                  <td>{{$t->factnum}}</td>
		                	<td>{{date('d-m-Y', strtotime($t->fecha))}}</td>
                      <td>{{date('d-m-Y', strtotime($t->fechav))}}</td>
		                	<td>{{$t->codcli}}</td>
		                	<td>{{$t->descrip}}</td>
		                	<td align='right'>{{number_format($t->monto, 2, '.', ',')}}</td>	
		                	<td align='right'>{{number_format($t->iva, 2, '.', ',')}}</td>
		                	<td align='right'>{{number_format($t->total, 2, '.', ',')}}</td>
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
    var tot = 0.00;
    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var s1 = cellsOfRow[9].innerHTML;
        var s2 = s1.replace(/,/g, '');
        var inv = parseFloat(s2).toFixed(2);
        tot += parseFloat(inv);
    }
    $("#idtot").val(number_format(tot, 2, '.', ','));
}


</script>
@endpush

@endsection