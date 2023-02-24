@extends('layouts.menu')
@section('contenido')

<div id="page-wrapper">

	<div class="row">
    	<!-- BUSCAR CLIENTES  -->
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			@include('seped.report.vendsearch')
		</div>
	</div>   
   
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
             
	                <thead class="colorTitulo">
	                	<th>#</th>
	                	<th>DESCRIPCION</th>
	                    <th>CODIGO</th>
		                <th>TIPO</th>
		                <th>SUPERVISOR</th>
		                <th>SUCURSAL</th>
		            </thead>

		            @foreach ($tabla as $t)
		                <tr>
		                	<td>{{$loop->iteration}}</td>
		                	<td>{{$t->nombre}}</td>
		                    <td>{{$t->codigo}}</td>
		                	<td>{{$t->tipo}}</td>
		                	<td>{{$t->supervisor}}</td>
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