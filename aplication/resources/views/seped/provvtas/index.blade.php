@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.provvtas.search')
	</div>
</div> 

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th>#</th>
					@if ( $cfg->mostrarImagen > 0 )
                        <th class="hidden-xs">IMAGEN</th>
                    @else
                        <th class="hidden-xs">OPCION</th>
                    @endif
                    <th title="Descripción de producto">PRODUCTO</th>
                    <th title="Unidades vendidas">CANTIDAD</th>
                    <th @if ( $cfg->mostrarCodigo > 0 )
                            class="hidden-xs" title="Código del producto">
                        @else
                            style="display:none;">
                        @endif
                        CODIGO
                    </th>
                    <th @if ( $cfg->mostrarBarra > 0 )
                            class="hidden-xs" title="Código de referencia del producto">
                        @else
                            style="display:none;">
                        @endif
                        BARRA
                    </th>
                    <th>MARCA</th>
                    <th>SUCURSAL</th>
  				</thead>
				@foreach ($factren as $fr)
				<tr>
					<td>{{$loop->iteration}}</td>
					@if ( $cfg->mostrarImagen > 0)
                        <td class="hidden-xs">
                            <div align="center">
                                <a href="{{URL::action('AdreportController@producto',$fr->codprod)}}">
                                    <img src="{{asset('/public/storage/'.NombreImagen($fr->codprod)  )}}" width="50" height="25" class="img-responsive">
                                </a>
                            </div>
                        </td>
                    @else
                        <td class="hidden-xs">
                            <!-- VER DETALLES -->
                            <a href="{{URL::action('AdreportController@producto',$fr->codprod)}}">
                                <button class="btn btn-default fa fa-file-o" title="Consultar producto">
                                </button>
                            </a>
                        </td>
                    @endif
                    
                    <td>
                        <b>{{$fr->desprod}}</b>
                    </td>
                    <td align="right">    
                        {{number_format($fr->cantidad, 0, '.', ',')}}
                    </td>
                    <td @if ( $cfg->mostrarCodigo > 0 )
                        class="hidden-xs">
                    @else
                        style="display:none;">
                    @endif
                    {{$fr->codprod}}
                    </td>
                    <td @if ( $cfg->mostrarBarra > 0 )
                        class="hidden-xs"> 
                    @else
                        style="display:none;">
                    @endif
                    {{$fr->referencia}}
                    </td>
                    <td>{{$fr->marca}}</td>
                    <td>{{sLeercfg($fr->codisb, "SedeSucursal")}}</td>
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