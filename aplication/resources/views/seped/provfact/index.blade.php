@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@include('seped.provfact.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th>#</th>
                    <th style="width: 50px;">OPCION</th>
                    <th>FACTURA</th>
                    <th>CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th style="width: 100px;">FECHA</th>
                    <th>MONTO</th>
                    <th>IVA</th>
                    <th>TOTAL</th>
                    <th>SUCURSAL</th>
	          	</thead>
				@foreach ($fact as $f)
				<tr>
					<td>{{$loop->iteration}}</td>
					<td>
                        <!-- VER FACTURA -->
                        <a href="{{URL::action('AdprovfactController@show',$f->factnum)}}">
                            <button 
                            class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip" title="Consular Factura">
                            </button>
                        </a>
                    </td>
                    <td>{{$f->factnum}}</td>
                    <td>{{$f->codcli}}</td>
			        <td>{{$f->descrip}}</td>
                    <td>{{date('d-m-Y H:i:s', strtotime($f->fecha))}}</td>

                    <?php
                    $monto = 0;
                    $imp = 0;
                    $factren = DB::table('factren')
                    ->select(DB::raw('sum(subtotal) as subtotal'), DB::raw('sum(impuesto) as imp'))
                    ->where('factnum','=',$f->factnum)
                    ->where('marca','LIKE','%'.$codmarca.'%')
                    ->first();
                    if ($factren) {
                        $monto = $factren->subtotal;
                        $imp = $factren->imp;
                    }
                    ?>

                    <td align="right">    
                    	{{number_format($monto, 2, '.', ',')}}
                    </td>
                    <td align="right">    
                        {{number_format($imp, 2, '.', ',')}}
                    </td>
                    <td align="right">    
                        {{number_format($monto + $imp, 2, '.', ',')}}
                    </td>
                    <td>{{sLeercfg($f->codisb, "SedeSucursal")}}</td>
              	</tr>
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