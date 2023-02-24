@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">
	
	<div class="row">
		<!-- BUSCAR FACTURAS  -->
	    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	        @include('seped.report.ctabancosearch')
	    </div>
    </div>   
   
  	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
                <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
             
	                <thead class="colorTitulo">
	                	<th>#</th>
	                  	<th>CUENTA</th>
		                <th>BANCO</th>
		                <th>NUMERO</th>
		                <th>SUCURSAL</th>
		            </thead>

		            @foreach ($tabla as $t)
		                <tr>
		                	<td>{{$loop->iteration}}</td>
		                  	<td>{{$t->co_cta}}</td>
		                	<td>{{$t->co_banco}}</td>
		                  	<td>{{$t->num_cuenta}}</td>
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