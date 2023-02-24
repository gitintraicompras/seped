@extends ('layouts.menu')
@section ('contenido')

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		@include('seped.provcata.search')
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
                    <th @if ( $cfg->mostrarLote > 0 )
                            class="hidden-xs" title="Lote/Vencimiento del producto">
                        @else
                            style="display:none;">
                        @endif
                        LOTE
                    </th>
                    <th @if ( $cfg->mostrarCodigo > 0 )
                            class="hidden-xs" title="Código del producto">
                        @else
                            style="display:none;">
                        @endif
                        CODIGO
                    </th>
                 	<th @if ( $cfg->mostrarBulto > 0 )
                            class="hidden-xs" title="Unidad de manejo del bulto">
                        @else
                            style="display:none;">
                        @endif
                        BULTO
                    </th>
                    <th title="Cantidad dispoible del inventario">EXISTENCIA</th>
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
				@foreach ($producto as $prod)
				<tr>
					<td>{{$loop->iteration}}</td>
					
					@if ( $cfg->mostrarImagen > 0)
                        <td class="hidden-xs">
                            <div align="center">
                                <a href="{{URL::action('AdreportController@producto',$prod->codprod)}}">
                                    <img src="{{asset('/public/storage/'.NombreImagen($prod->codprod)  )}}" width="50" height="25" class="img-responsive">
                                </a>
                            </div>
                        </td>
                    @else
                        <td class="hidden-xs">
                            <!-- VER DETALLES -->
                            <a href="{{URL::action('AdreportController@producto',$prod->codprod)}}">
                                <button class="btn btn-default fa fa-file-o" title="Consultar producto">
                                </button>
                            </a>
                        </td>
                    @endif
                    
                    <td>
                        <b>{{$prod->desprod}}</b>
                    </td>

                    <td @if ( $cfg->mostrarLote > 0 )
                        class="hidden-xs">
                    @else
                        style="display:none;">
                    @endif
                    {{$prod->lote}} {{$prod->fecvence}} 
                    </td>

                    <td @if ( $cfg->mostrarCodigo > 0 )
                        class="hidden-xs">
                    @else
                        style="display:none;">
                    @endif
                    {{$prod->codprod}}
                    </td>

                 	<td @if ( $cfg->mostrarBulto > 0 )
                        class="hidden-xs" align="right">
                    @else
                        style="display:none;">
                    @endif
                    @if ( $prod->original == "") 
                        1 
                    @else
                        {{$prod->original}}
                    @endif
                    </td>

                    <td align="right">    
                    	{{number_format($prod->cantidad, 0, '.', ',')}}
                    </td>

                    <td @if ( $cfg->mostrarBarra > 0 )
                        class="hidden-xs"> 
                    @else
                        style="display:none;">
                    @endif
                    {{$prod->barra}}
                    </td>

                    <td>{{$prod->marcamodelo}}</td>
                    <td>{{sLeercfg($prod->codisb, "SedeSucursal")}}</td>
              
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