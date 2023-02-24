@extends ('layouts.menu')
@section ('contenido')
    
<div id="page-wrapper"> 

	<!-- ENCABEZADO -->
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		@if ($cfg->modoVisual=="1")
		<div class="form-group">
			<div class="row" >
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		
			 		<span class="input-group-addon">Pedido:</span>
            		<input readonly type="text" class="form-control" value="{{$tabla->id}}-{{$tabla->tipedido}}" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Estado:</span>
            		<input readonly type="text" class="form-control" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
			      	<span class="input-group-addon hidden-xs">Fecha:</span>
            		<input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecha))}}" style="color: #000000; background: #F7F7F7;">

					<span class="input-group-addon hidden-xs" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Enviado:</span>
					<input readonly type="text" class="form-control hidden-xs" value="{{date('d-m-Y H:i', strtotime($tabla->fecenviado))}}" style="color:#000000; background: #F7F7F7;" >		

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Unidades:</span>
					<b>
						<input readonly 
						type="text" 
						class="form-control" 
						value="{{$tabla->numund}}" 
						style="color:#000000; background: #F7F7F7; text-align: right;" >
					</b>	        

			    </div>
			</div>
			<div class="row" style="margin-top: 4px;">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		
			 		<span class="input-group-addon">Procesado:</span>
            		<input readonly type="text" class="form-control" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))}}" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Origen:</span>
            		<input readonly type="text" class="form-control" value="{{$tabla->origen}}" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Usuario:</span>
            		<input readonly type="text" class="form-control" value="{{$tabla->usuario}}" style="color: #000000; background: #F7F7F7;">

			    </div>
			</div>
			<div class="row" style="margin-top: 4px;">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		<span class="input-group-addon hidden-xs">Descuento:</span>
            		<input readonly type="text" class="form-control hidden-xs" value="{{number_format($tabla->descuento, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="iddescuento">

            		<span class="input-group-addon hidden-xs" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Subtotal:</span>
            		<input readonly type="text" class="form-control" value="{{number_format($tabla->subtotal, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idsubtotal">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Monto IVA:</span>
            		<input readonly type="text" class="form-control" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

            		@if ( $cfg->mostrarPedidoOM > 0 )
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')}} {{ $cfg->simboloOM }}" style="color: green; background: #F7F7F7; text-align: right;" id="idtotalOM"></b>
                    @endif

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon">Total:</span>
					<b><input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>		        
			    </div>
			</div>
		</div>
		@endif
		@if ($cfg->modoVisual=="2")
		<div class="form-group">
			<div class="row">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		
			 		<span class="input-group-addon">Pedido:</span>
            		<input readonly type="text" class="form-control" value="{{$tabla->id}}-{{$tabla->tipedido}}" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Estado:</span>
            		<input readonly type="text" class="form-control" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
			      	<span class="input-group-addon hidden-xs">Fecha:</span>
            		<input readonly type="text" class="form-control" value="{{date('d-m-Y H:i', strtotime($tabla->fecha))}}" style="color: #000000; background: #F7F7F7;">

					<span class="input-group-addon hidden-xs" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Enviado:</span>
					<input readonly type="text" class="form-control hidden-xs" value="{{date('d-m-Y H:i', strtotime($tabla->fecenviado))}}" style="color:#000000; background: #F7F7F7;" >		

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Unidades:</span>
					<b>
						<input readonly 
						type="text" 
						class="form-control" 
						value="{{$tabla->numund}}" 
						style="color:#000000; background: #F7F7F7; text-align: right;" >
					</b>	        

			    </div>
			</div>
			<div class="row" style="margin-top: 4px;">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
            		<span class="input-group-addon hidden-xs">Descuento:</span>
            		<input readonly type="text" class="form-control hidden-xs" value="{{number_format($tabla->descuento, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="iddescuento">

            		<span class="input-group-addon hidden-xs" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Subtotal:</span>
            		<input readonly type="text" class="form-control" value="{{number_format($tabla->subtotal, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idsubtotal">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Monto IVA:</span>
            		<input readonly type="text" class="form-control" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

            		@if ( $cfg->mostrarPedidoOM > 0 )
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')}} {{ $cfg->simboloOM }}" style="color: green; background: #F7F7F7; text-align: right;" id="idtotalOM"></b>
                    @endif

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon">Total:</span>
					<b><input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>		        

			    </div>
			</div>
		</div>
		@endif
		@if ($cfg->modoVisual=="3")
		<div class="form-group">
			<div class="row">
			    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
			 		
			 		<span class="input-group-addon">Pedido:</span>
            		<input readonly type="text" class="form-control" value="{{$tabla->id}}-{{ $tabla->tipedido}}" style="color: #000000; background: #F7F7F7;">

			      	<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Monto IVA:</span>
            		<input readonly type="text" class="form-control" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

            		@if ( $cfg->mostrarPedidoOM > 0 )
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon hidden-xs">Total:</span>
                        <b><input readonly type="text" class="form-control" value="{{number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')}} {{ $cfg->simboloOM }}" style="color: green; background: #F7F7F7; text-align: right;" id="idtotalOM"></b>
                    @endif

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Total:</span>
					<b><input readonly type="text" class="form-control" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>

					<span class="input-group-addon" style="border:0px; "></span>
					<span class="input-group-addon hidden-xs">Unidades:</span>
					<b>
						<input readonly 
						type="text" 
						class="form-control" 
						value="{{$tabla->numund}}" 
						style="color:#000000; background: #F7F7F7; text-align: right;" >
					</b>

			    </div>
			</div>
		</div>
		@endif
	</div>

	@if ($tabla->estado != "POR-APROBAR") 
		<!-- BOTONES PRINCIPALES -->
		<div class="btn-toolbar" role="toolbar" style="margin-bottom: 3px;">
		    <div class="btn-group" role="group" style="width: 100%;">

		        <!-- BUSCAR PRODUCTOS EN EL CATALOGO -->
		        @include('seped.catalogo.catasearch')

		        <!-- VER CATALOGO -->
		   	    <a href="{{URL::action('AdcatalogoController@listado','C')}}">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos " 
		            class="btn-catalogo">
		            Catálogo
		            </button>
		        </a>
		        @if ($cfg->activarEntradasProducto=="1")
		        <!-- VER ENTRADAS -->
		        <a href="{{URL::action('AdcatalogoController@listado','E')}}">
		            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver catálogo de productos con entradas recientes" 
		            class="btn-catalogo">
		            últ.Entradas
		            </button>
		        </a>
		        @endif
		        @if ($cfg->activarOfertasProducto=="1")
		        <!-- VER OFERTAS -->
		        <a href="{{URL::action('AdcatalogoController@listado','O')}}">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de ofertas de productos" 
		            class="btn-catalogo">
		            Ofertas
		            </button>
		        </a>
		        @endif
		        @if ($cfg->activarDestacadoProducto=="1")
		        <!-- VER OFERTAS -->
		        <a href="{{URL::action('AdcatalogoController@listado','D')}}">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos destacados" 
		            class="btn-catalogo">
		            Destacados
		            </button>
		        </a>
		        @endif

		        @if ($cfg->activarCateProducto=="1")
		        <a href="{{URL::action('AdcatalogoController@listado','G')}}">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos por categorias" 
		            class="btn-catalogo">
		            Categorias
		            </button>
		        </a>
		        @endif

		        @if ($cfg->activarMarcaProducto=="1")
		        <a href="{{URL::action('AdcatalogoController@listado','M')}}">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catálogo de productos por marcas" 
		            class="btn-catalogo">
		            Marcas
		            </button>
		        </a>
		        @endif

		        @if ($cfg->activarBotonDias=="1")
		        <a href="{{URL::action('AdcatalogoController@listado','I')}}">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" 
		            title="Ver catálogo de productos por Dias de Credito" 
		            class="btn-catalogo">
		            Dias
		            </button>
		        </a>
		        @endif

		        <!-- PSICOTROPICOS -->
		        @if (Auth::user()->tipo == "C" || Auth::user()->tipo == "G")
            		@if ($cfg->activarBotonPsicoCliente=="1")
			        <a href="{{URL::action('AdcatalogoController@listado','P')}}">
			            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver catálogo de productos psicotropicos" 
			            class="btn-catalogo">
			            Psicotropicos
			            </button>
			        </a>
			        @endif
			    @endif
			    @if (Auth::user()->tipo == "V")
            		@if ($cfg->activarBotonPsico=="1")
            		<a href="{{URL::action('AdcatalogoController@listado','P')}}">
			            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver catálogo de productos psicotropicos" 
			            class="btn-catalogo">
			            Psicotropicos
			            </button>
			        </a>
					@endif
			    @endif
		        <!-- ENVIA PEDIDO -->
		        <a href="" data-target="#modal-enviar-{{$tabla->id}}" data-toggle="modal">
		            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Enviar pedido" class="btn-confirmar">
		                Enviar
		            </button>
		        </a>
		        @include('seped.catalogo.enviar')  

		    </div>   
		</div>
	@endif

	<!-- TABLA -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table id="idtabla" 
					class="table table-striped table-bordered table-condensed table-hover">
					<thead class="colorTitulo">
						<!-- O NUMERO -->
						<th>#</th>

						<!-- 1 IMAGEN -->
						@if ( $cfg->mostrarImagenPedido > 0 )
                        	<th title="Imagen del producto" style="width: 120px;">
                        		<center>IMAGEN</center>
                        	</th>
                        @else
                        	<th style="display:none;">IMAGEN</th>
                 		@endif

                 		<!-- 2 PEDIR -->
						<th style="width: 110px;" title="Cantidad pedir">PEDIR</th>

						<!-- 3 OPCION -->
						<th style="width: 40px;"></th>

						<!-- 4 DESPROD -->
						<th title="Descripción de producto">
                            PRODUCTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
					    
						<!-- 5 CODPROD -->
					    <th title="Código del producto" @if ($cfg->mostrarCodigo > 0)>
                        @else
                            style="display:none;">
                        @endif
                        CODIGO
                        </td>

        				<!-- 6 PRECIO -->
						<th title="{{$cfg->msgLitPrecio}}">
							{{$cfg->LitPrecio}}
			            </td>
 
 						<!-- 7 IVA -->
						<th title="Porcentaje del Iva">IVA</th>

						<!-- 8 DV -->
						<th @if ( $cfg->mostrarDv > 0 )
							<th title="{{ $cfg->msgLitDv }}">
							{{ $cfg->LitDv }}
							</th>
						@else
							<th style="display:none;">DV</th>
						@endif

						<!-- 9 DA -->
						<th @if ( $cfg->mostrarDa > 0 )
							<th title="{{ $cfg->msgLitDa }}">
							{{ $cfg->LitDa }}
							</th>
						@else
							<th style="display:none;">DA</th>
						@endif

						<!-- 10 DP -->
						<th @if ( $cfg->mostrarDp > 0 )
							<th title="{{ $cfg->msgLitDp }}">
							{{ $cfg->LitDp }}
							</th>
						@else
							<th style="display:none;">DP</th>
						@endif

						<!-- 11 DI -->
						@if ( $cfg->mostrarDi > 0 )
							<th title="{{ $cfg->msgLitDi }}">
							{{ $cfg->LitDi }}
							</th>
						@else
							<th style="display:none;">DI</th>
                 		@endif
                 		
                 		<!-- 12 DC -->
                 		@if ( $cfg->mostrarDc > 0 )
							<th title="{{ $cfg->msgLitDc }}">
							{{ $cfg->LitDc }}
							</th>
						@else
							<th style="display:none;">DC</th>
                 		@endif
                 		
                 		<!-- 13 PP -->
                 		@if ( $cfg->mostrarPp > 0 )
							<th title="{{ $cfg->msgLitPp }}">
							{{ $cfg->LitPp }}
							</th>
						@else
							<th style="display:none;">PP</th>
                 		@endif

                   		<!-- 14 NETO  -->
						<th title="MONTO NETO">NETO</th>

	               		<!-- 15 SUBTOTAL -->
                        <th title="MONTO SUBTOTAL">SUBTOTAL</th>


                        @if (!empty($cliente->DctoPreferencial))
							@php
								$data = MesActivoPreferencial($cliente->DctoPreferencial);
						        $dcto = $data['dcto'];
							@endphp
	                   		<!-- 16 NETO VIP -->
							<th title="MONTO NETO {{$cfg->msgLitVip}}">NETO {{$cfg->LitVip}}</th>
		               		<!-- 17 SUBTOTAL VIP -->
	                        <th title="MONTO SUBTOTAL {{$cfg->msgLitVip}}">SUBTOTAL {{$cfg->LitVip}}</th>
                        @else
	                        <!-- 16 NETO VIP -->
							<th style="display:none;">NET.VIP</th>
		               		<!-- 17 SUBTOTAL VIP -->
	                        <th style="display:none;">SUB.VIP</th>
                        @endif

                   		<!-- 18 ITEM -->
						<th style="display:none;">ITEM</th>
					</thead>
					@foreach ($tabla2 as $t)
					@php 
						$tooltip = sVerificarCaractExt($t->codprod); 
				      	if (!empty($cliente->DctoPreferencial)) {
				      		$netoSinDvp = $t->neto + ($t->neto*$dcto/100);
				      		$subtotalSinDvp = $t->subtotal + ($t->subtotal*$dcto/100);
				      		$neto = $t->neto;
				      		$subtotal = $t->subtotal;
				      	} else {
				      		$netoSinDvp = $t->neto;
				      		$subtotalSinDvp = $t->subtotal;
				      		$neto = $t->neto;
				      		$subtotal = $t->subtotal;
				      	}
				 	@endphp
					<tr>
					    <!-- O NUMERO -->
						<td>{{$loop->iteration}}</td>

					    <!-- 1 IMAGEN -->
						@if ( $cfg->mostrarImagenPedido > 0 )
                        <td >
        					<div align="center" 
        						style="width: 110px;">
                                <a href="{{URL::action('AdreportController@producto',$t->codprod)}}">
                                    <img src="{{asset('/public/storage/'.NombreImagen($t->codprod))}}" 
                                    width="100%"
                                    style="border: 2px solid #D2D6DE;"  
                                    class="img-responsive">
                                </a>
                            </div>
                        </td>
                        @else
                        <td style="display:none;"></td>
                 		@endif

				    	<!-- 2 MODIFICAR CANTIDAD DEL CARRO DE COMPRA -->
						<td>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group" id="idModificar_{{$t->item}}_{{$t->codprod}}" >
                                <input style="text-align: center; color: #000000; width: 60px;" 
                                	id="idpedir_{{$t->item}}" 
                                	value="{{number_format($t->cantidad, 0, '.', ',')}}" 
                                	class="form-control" >

                                <span class="input-group-btn BtnModificar" >
                                    <button type="button" 
                                    	class="btn btn-default btn-pedido" 
                                    	id="idModificar_{{$t->item}}_{{$t->codprod}}" 
                                    	data-toggle="tooltip" title="Modificar cantidad">
                                    	<span class="fa fa-check" 
                                    		id="idModificar_{{$t->item}}_{{$t->codprod}}" 
                                    		aria-hidden="true">
                                    	</span>
                                    </button>
                                </span>
                            </div>
                        </td>

                		<!-- 3 DELETE RENGLON -->
						<td>
							<a href="" data-target="#modal-delete-{{$t->item}}" data-toggle="modal">
								<button style="height: 35px;" class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar producto"></button>
							</a>
						</td>
	
						<!-- 4 DESPROD -->        
						<td title="{{$tooltip}}">
							@if ($tooltip != '')
                                <span style="color: red; font-size: 20px;"> <b>!</b> </span>
                            @endif
							<b>{{$t->desprod}}</b>
							@if ($t->dcredito > 0)
                                <div class="colorPromDias"
                                    style="margin-top: 5px;
                                    border-radius: 5px; 
                                    font-size: 14px;
                                    text-align: center;
                                    padding: 1px; 
                                    color: white;
                                    width: 70px;
                                    background-color: black;"
                                    title="DIAS DE CREDITO: {{$t->dcredito}}">
                                    DIAS: {{$t->dcredito}} 
                                </div>
                            @endif
						</td>

						<!-- 5 CODIGO -->        
						<td @if ( $cfg->mostrarCodigo > 0 ) >
                        @else
                            style="display:none;">
                        @endif
                        {{$t->codprod}}
                        </td>

                    	<!-- 6 PRECIO  -->                             
						<td align="right">
							<span title= "{{$cfg->simboloMoneda}}">
								<b>{{number_format($t->precio, 2, '.', ',')}}</b>
							</span>
							@if ( $cfg->mostrarPedidoOM > 0 )
								<br>
								<span style="color: green;" 
                                    title= "{{$cfg->simboloOM}}">
                                    <b>{{number_format($t->precio/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                             	</span>
							@endif
						</td>

                        <!-- 7 IVA -->        
						<td align="right">{{number_format($t->iva, 2, '.', ',')}}</td>

                        <!-- 8 DESCUENTO POR VOLUMEN -->        
						@if ( $cfg->mostrarDv > 0 ) 
							@php
								$dvDetalle = "";
								$reg = DB::table('producto')
									->where('codprod','=',$t->codprod)
									->first();
								if ($reg) 
									$dvDetalle = $reg->dvDetalle;
							@endphp
							<td id="iddv1_{{$t->item}}"
								@php
                                $toltips = "\n";
                                $separador = ";";
                                if (substr($dvDetalle, -1) != $separador)
                                    $dvDetalle = $dvDetalle.$separador;

                                $listaDcto = explode($separador, $dvDetalle);
                                for ($i = 0; $i < count($listaDcto); $i++) {
                                    $s1 = explode("-", $listaDcto[$i]);
                                    if (count($s1) > 1) {
                                        $desde = $s1[0];
                                        $hasta = $s1[1];
                                        $dcto = $s1[2];
                                        if ($i == count($listaDcto)-2)
                                            $hasta = "INFINITO";
                                        $toltips .= $desde.' - '.$hasta." => ".$dcto."% \n";
                                    }
                                }
                                @endphp
                                title = "{{strtoupper($cfg->msgLitDv)}} &#10======================== {{$toltips}}"
								align="right" 
								@if (($t->dv > 0) && !is_null($dvDetalle))
									style="color: red;"
								@endif
								>			
								{{number_format($t->dv, 2, '.', ',')}}
							</td>
						@else
							<td style="display:none;">{{number_format($t->dv, 2, '.', ',')}}</td>
						@endif

						<!-- 9 DESCUENTO ADICIONAL -->
						@if ( $cfg->mostrarDa > 0 )
							@if ($t->da > 0)
								<td title = "{{strtoupper($cfg->msgLitDa)}}" align="right" style="color: red;">{{number_format($t->da, 2, '.', ',')}}
								</td>
							@else
								<td align="right">{{number_format($t->da, 2, '.', ',')}}</td>
							@endif
						@else
							<td style="display:none;">{{number_format($t->da, 2, '.', ',')}}</td>
						@endif

						<!-- 10 DESCUENTO DE PRE-EMPAQUE -->
						@if ( $cfg->mostrarDp > 0 )
							@if ($t->dp > 0)
								@php
									$up = 0;
									$reg = DB::table('producto')
								    ->where('codprod','=',$t->codprod)
								    ->first();
								    if ($reg) 
								    	$up = $reg->upre;
								@endphp
								<td id="iddp1_{{$t->item}}" align="right" style="color: red;" title = "{{strtoupper($cfg->msgLitDp)}} &#10======================== &#10Multiplos de pre-emapque: {{$up}}">
									{{number_format($t->dp, 2, '.', ',')}}
								</td>
							@else
								<td id="iddp2_{{$t->item}}" align="right">
									{{number_format($t->dp, 2, '.', ',')}}
								</td>
							@endif
						@else
							<td style="display:none;">
								{{number_format($t->dp, 2, '.', ',')}}
							</td>
						@endif

						<!-- 11 DESCUENTO INTERNET -->
						@if ( $cfg->mostrarDi > 0 )
							@if ($t->di > 0)
								<td title = "{{strtoupper($cfg->msgLitDi)}}" align="right" style="color: red;">{{number_format($t->di, 2, '.', ',')}}
								</td>
							@else
								<td align="right">{{number_format($t->di, 2, '.', ',')}}</td>
							@endif
						@else
							<td style="display:none;">{{number_format($t->di, 2, '.', ',')}}</td>
                 		@endif

                 		<!-- 12 DESCUENTO COMERCIAL -->
                 		@if ( $cfg->mostrarDc > 0 )
							@if ($t->dc > 0)
								<td title = "{{strtoupper($cfg->msgLitDc)}}" align="right" style="color: red;">{{number_format($t->dc, 2, '.', ',')}}
								</td>
							@else
								<td align="right">{{number_format($t->dc, 2, '.', ',')}}</td>
							@endif
						@else
							<td style="display:none;">{{number_format($t->dc, 2, '.', ',')}}</td>
                 		@endif

                 		<!-- 13 DESCUENTO DE PRONTO PAGO -->
                 		@if ( $cfg->mostrarPp > 0 )
							@if ($t->pp > 0)
								<td title = "{{strtoupper($cfg->msgLitPp)}}" align="right" style="color: red;">{{number_format($t->pp, 2, '.', ',')}}
								</td>
							@else
								<td align="right">{{number_format($t->pp, 2, '.', ',')}}</td>
							@endif
						@else
							<td style="display:none;">{{number_format($t->pp, 2, '.', ',')}}</td>
                 		@endif

                 		<!-- 14 NETO  -->
						<td align="right">
							<span title= "{{$cfg->simboloMoneda}}">
								{{number_format($netoSinDvp, 2, '.', ',')}}
							</span>
							@if ( $cfg->mostrarPedidoOM > 0 )
								<br>
								<span style="color: green;" 
                                    title= "{{$cfg->simboloOM}}">
                                    {{number_format($netoSinDvp/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}
                             	</span>
							@endif
						</td>
    		
                   		<!-- 15 SUBTOTAL  -->
                        <td align="right">
                        	<span title= "{{$cfg->simboloMoneda}}">
								<b>{{number_format($subtotalSinDvp, 2, '.', ',')}}</b>
							</span>
                        	@if ( $cfg->mostrarPedidoOM > 0 )
								<br>
								<span style="color: green;" 
                                    title= "{{$cfg->simboloOM}}">
                                    <b>{{number_format($subtotalSinDvp/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                             	</span>
							@endif
                        </td>
						
						@if (!empty($cliente->DctoPreferencial))
							<!-- 16 NETO VIP -->
							<td align="right">
								<span title= "{{$cfg->simboloMoneda}}">
									<b>{{number_format($t->neto, 2, '.', ',')}}</b>
								</span>
								@if ( $cfg->mostrarPedidoOM > 0 )
									<br>
									<span style="color: green;" 
	                                    title= "{{$cfg->simboloOM}}">
	                                    <b>{{number_format($t->neto/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
	                             	</span>
								@endif
							</td>
		               		<!-- 17 SUBTOTAL VIP -->
	                        <td align="right">
	                        	<span title= "{{$cfg->simboloMoneda}}">
									<b>{{number_format($t->subtotal, 2, '.', ',')}}</b>
								</span>
	                        	@if ( $cfg->mostrarPedidoOM > 0 )
									<br>
									<span style="color: green;" 
	                                    title= "{{$cfg->simboloOM}}">
	                                    <b>{{number_format($t->subtotal/(($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
	                             	</span>
								@endif
	                        </td>
                        @else
                        	<!-- 16 NETO VIP -->
							<td style="display:none;">0.00</td>
		               		<!-- 17 SUBTOTAL VIP -->
	                        <td style="display:none;">0.00</td>
                        @endif

                   		<!-- 18 ITEM -->
                   		<td style="display:none;">{{$t->item}}</td>
					</tr>
					@include('seped.catalogo.deleprod')
					@endforeach
				</table>
			</div>
		</div>
	</div>

	@if ($contItem == 0)
	    <div class="row">
	        <center><h2>Carro de compra vacio</h2></center>
	        <br><br><br><br><br><br><br>
	    </div>
	@endif
	@if ($contItem > 20)
	<div class="btn-toolbar" role="toolbar" style="margin-top: 8px;">
	    <div class="btn-group" role="group" style="width: 100%;">

	        <!-- BUSCAR PRODUCTOS EN EL CATALOGO -->
	        @include('seped.catalogo.catasearch')
	 
	        <!-- VER CATALOGO -->
	   	    <a href="{{URL::action('AdcatalogoController@listado','C')}}">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catalogo de productos" 
	            class="btn-catalogo">
	            Catálogo
	            </button>
	        </a>
	        @if ($cfg->activarEntradasProducto=="1")
	        <!-- VER ENTRADAS -->
	        <a href="{{URL::action('AdcatalogoController@listado','E')}}">
	            <button style="margin-right: 3px; " type="button" data-toggle="tooltip" title="Ver entradas recientes de productos" 
	            class="btn-catalogo">
	            Entradas
	            </button>
	        </a>
	        @endif
	        @if ($cfg->activarOfertasProducto=="1")
	        <!-- VER OFERTAS -->
	        <a href="{{URL::action('AdcatalogoController@listado','O')}}">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver ofertas de productos" 
	            class="btn-catalogo">
	            Ofertas
	            </button>
	        </a>
	        @endif
	        @if ($cfg->activarDestacadoProducto=="1")
	        <!-- VER OFERTAS -->
	        <a href="{{URL::action('AdcatalogoController@listado','D')}}">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver productos destacados" 
	            class="btn-catalogo">
	            Destacados
	            </button>
	        </a>
	        @endif
	 		@if ($cfg->activarCateProducto=="1")
	        <a href="{{URL::action('AdcatalogoController@listado','G')}}">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Ver catalogo por categorias" 
	            class="btn-catalogo">
	            Categorias
	            </button>
	        </a>
	        @endif
	 
	        <!-- ENVIA PEDIDO -->
	        <a href="" data-target="#modal-enviar-{{$tabla->id}}" data-toggle="modal">
	            <button style="margin-right: 3px;" type="button" data-toggle="tooltip" title="Enviar pedido" class="btn-confirmar">
	                Enviar
	            </button>
	        </a>
	        @include('seped.catalogo.enviar')  

	    </div>   
	</div>
    @endif
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
window.onload = function() {
	$('.BtnModificar').on('click',function(e){
        var id = e.target.id.split('_');
        var item = id[1];
        var codprod = id[2];
        var pedir = $('#idpedir_'+item).val();
        var idpedido = '{{$tabla->id}}';
        var tasacambiaria = '{{$cfg->tasacambiaria}}';
        var simboloOM = '{{$cfg->simboloOM}}';
        $.ajax({
            type:'POST',
            url:'../modificar',
            dataType: 'json', 
            encode  : true,
            data: {item : item, pedir : pedir, idpedido : idpedido, codprod : codprod },
            success:function(data){
            	if (data.msg != "") {
                    alert(data.msg);
                } 
                location.reload(true);
            }
        });
    });
    refrescar();
}
function refrescar() {
	var tableReg = document.getElementById('idtabla');
	var s1 = "";
	var s2 = "";
	var valor = 0;
    for (var i = 1; i < tableReg.rows.length; i++) {
		var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

		// DESCUENTO POR VOLUMEN
		s1 = cellsOfRow[8].innerHTML;  
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[8].style.color = "red";
		else 
			cellsOfRow[8].style.color = "black";
		
		// DESCUENTO ADICIONAL
		s1 = cellsOfRow[9].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[9].style.color = "red";
		else 
			cellsOfRow[9].style.color = "black";
		
		// DESCUENTO PRE-EMPAQUE
		s1 = cellsOfRow[10].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[10].style.color = "red";
		else 
			cellsOfRow[10].style.color = "black";

		// DESCUENTO INTERNET
		s1 = cellsOfRow[11].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[11].style.color = "red";
		else 
			cellsOfRow[11].style.color = "black";

		// DESCUENTO COMERCIAL
		s1 = cellsOfRow[12].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[12].style.color = "red";
		else 
			cellsOfRow[12].style.color = "black";

		// DESCUENTO PRONTO PAGO
		s1 = cellsOfRow[13].innerHTML; 
		s2 = s1.replace(/,/g, '');
		valor = parseFloat(s2).toFixed(2);
		if (valor > 0) 
			cellsOfRow[13].style.color = "red";
		else 
			cellsOfRow[13].style.color = "black";
	}
}
</script>
@endpush
@endsection