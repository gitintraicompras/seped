@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">
	
	<div class="row">
		<!-- BUSCAR FACTURAS  -->
	    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	        @include('seped.report.monedasearch')
	    </div>
    </div>   
   
  	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
                <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
             
	                <thead class="colorTitulo">
	                	<th>CODIGO</th>
	                  	<th>DESCRIPCION</th>
		                <th>FACTOR</th>
		                <th>PREFERENCIA</th>
		                <th>SIMBOLO</th>
		                <th>SUCURSAL</th>
		            </thead>

		            @foreach ($tabla as $t)
		                <tr>
		                  	<td>{{$t->codigo}}</td>
		                	<td>{{$t->descrip}}</td>
		                  	<td align="right">{{number_format($t->factor, 2, '.', ',')}}</td>
		                  	<td>{{$t->pref}}</td>
		                  	<td>{{$t->simbolo}}</td>
		                  	<td>{{sLeercfg($t->codisb, "SedeSucursal")}}</td>
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