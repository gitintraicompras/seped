<div class="modal fade modal-slide-in-right" 
	 aria-hidden="true" 
	 role="dialog" 
	 tabindex="-1" 
	 id="modal-superoferta-{{$cat->codprod}}">

	@php
	use Illuminate\Support\Facades\Log;
  	$dataprod = MinicpC($cat->barra, $arrayProve);
	if (isset($cliente->DctoPreferencial)) {
		$data = MesActivoPreferencial($cliente->DctoPreferencial);
		$dcto = $data['dcto'];
		$cuota = $data['cuota'];
		$acum = $data['acum'];
	}
 	@endphp 

	<div class="modal-dialog" style="width:700px;">
		<div class="modal-content">
			<div class="modal-header colorTitulo" style="height: 25px;">
				<button style="margin-top: -15px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 style="margin-top: -15px;" class="modal-title"></h4>
			</div>
			<div class="row">
				<span class="pull-left" style="margin-left: 25px; margin-top: 1px;">
					<img src="{{asset('images/logo1.png')}}" 
						alt="seped" 
						height="130" 
						width="520">
				</span>
			</div>
			<div style="float: left; text-align:left; color: black; margin-left: 20px; font-size: 20px;" >
				{{ $cat->desprod }}
			</div>
			<div class="modal-body" style="padding-bottom: 0px;">
				<table id="idtabla"  
					class="table table-striped table-bordered table-condensed table-hover" >
					@if (is_null($dataprod) || empty($dataprod) || !isset($dataprod) ) 
		            	<tr>
		            		<td colspan="8" align='center'>
								INFORMACION NO ACTUALIZADA!!!
							</td>
		            	</tr>
		            @else
			       		<thead>
			       			@for ($i = 0; $i < count($mincpProv); $i++) 
							    <th colspan="2" 
			                        style="background-color: {{ $mincpProv[$i]->backcolor }}; 
			                        color: {{ $mincpProv[$i]->forecolor }}; 
			                        width: 400px; 
			                        word-wrap: 
			                        break-word; ">
			                        <a href="#">
			                            <center>
			                                <button type="button" 
			                                    data-toggle="tooltip" 
			                                    title="{{strtoupper( $mincpProv[$i]->nombre )}} &#10 ({{ date('d-m-Y H:i:s', strtotime( $mincpProv[$i]->fechacata ) ) }})" 
			                                    style="background-color: {{ $mincpProv[$i]->backcolor }}; 
			                                    color: {{ $mincpProv[$i]->forecolor }}; 
			                                    width: 100%;">
			                                  	{{ $mincpProv[$i]->descripcion }}
			                                </button>
			                            </center>
			                        </a>
			                    </th>
			                @endfor
			            </thead>

			            <thead>
			        		@for ($i = 0; $i < count($mincpProv); $i++) 
					            <th style="background-color: {{ $mincpProv[$i]->backcolor }}; 
			                    	color: {{ $mincpProv[$i]->forecolor }}; 
			                    	width: 200px; 
			                    	word-wrap: 
			                    	break-word; ">
			                        PRECIO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                    </th> 
			                    <th style="background-color: {{$mincpProv[$i]->backcolor }}; 
			                    	color: {{ $mincpProv[$i]->forecolor }}; 
			                    	width: 200px; 
			                    	word-wrap: 
			                    	break-word; ">
			                        CANTIDAD
			                    </th>
			                @endfor
			            </thead>

		 	            <tr>
			            	@php 
			            	$noactualizada = 0;
							$arrayRnk = [];
			                $mpc = 100000000000000;
			                $mcodprov = '';
			                $codprove1 = '';
			                $mayorInv = 1;
			            	for ($i = 0; $i < count($mincpProv); $i++) {
			    	   			$codprove = $mincpProv[$i]->codprove;
			    	   		    if ($i == 0)
					                $codprove1 = $codprove; 
					            $campos = $dataprod->$codprove;
			                    $campo = explode("|", $campos);
			                    $precio = $campo[0];
			                    $cantidad = $campo[1];
			                    $dax = $campo[2];
			                    $dcx = 0.00;
			                    $dix = 0.00;
			                    $ppx = 0.00;
								$dpx = 0.00;
								$dvx = 0.00;
								$dvpx = 0.00;
								if ($i==0) {
									$dix = $di;
									$ppx = $pp;
									$dvpx = $dvp;
								}
			                    $neto = CalculaPrecioNeto($precio, $dax, $dix, $dcx, $ppx, $dpx, $dvx, $dvpx);
			                    $liquida = $neto + (($neto * $cat->iva)/100);
			                    if ($liquida > 0) {
			                        $arrayRnk[] = [
			                            'liquida' => $liquida,
			                            'codprove' => $codprove
			                       	];
			                       	if ($liquida < $mpc) {
			                            $mpc = $liquida; 
			                            $mcodprov = $codprove;
			                       	}
			                   	}
			                   	if ($cantidad > 0 && $cantidad > $mayorInv) {
			                        $mayorInv = $cantidad;          
			                   	}
			               	}
			               	$aux = array();
			                foreach ($arrayRnk as $key => $row) {
			                    $aux[$key] = $row['liquida'];
			                }
			                if (count($aux) > 1)
			                    array_multisort($aux, SORT_ASC, $arrayRnk);

			                if ($codprove1 != $mcodprov) {
					        	$noactualizada = 1;
						    }
					      	@endphp
			                @if ($noactualizada == 1)
			                <tr>
			            		<td colspan="8" align='center'>
									INFORMACION NO ACTUALIZADA!!!
								</td>
			            	</tr>
			            	@else
				            	@for ($i = 0; $i < count($mincpProv); $i++) 
							   		@php 
							   		$codprove = mb_strtoupper($mincpProv[$i]->codprove);
							   		$factor = RetornaFactorCambiario($codprove, "USD");
                                    $campos = $dataprod->$codprove;
				                    $campo = explode("|", $campos);
				                    $precio = $campo[0];
				                    $cantidad = $campo[1];
				                    $dax = $campo[2];
				                    $codprod = $campo[3];
				                    $lote = $campo[7];
				                    $fecvence = $campo[8];
				                    $fecvence = str_replace("12:00:00 AM", "", $fecvence);
				                    $dcx = 0.00;
				                    $dix = 0.00;
				                    $ppx = 0.00;
									$dpx = 0.00;
									$dvx = 0.00;
									$dvpx = 0.00;
									if ($i==0) {
										$dix = $di;
										$ppx = $pp;
									}
							        $neto = CalculaPrecioNeto($precio, $dax, $dix, $dcx, $ppx, $dpx, $dvx, $dvpx);
							        $liquida = $neto + (($neto * $cat->iva)/100);
							        if ($i==0) {
										$liquidaVip = $liquida;
										$factorVip = $factor;
									}
				                    $ranking = obtenerRanking($liquida, $arrayRnk);
				            		@endphp

									<td align='right' 
										style="width: 200px; 
										word-wrap: 
										break-word; 
										background-color: {{ $mincpProv[$i]->backcolor }};
				                        color: {{ $mincpProv[$i]->forecolor }}; " 
				                         title = "{{ $mincpProv[$i]->descripcion}} &#10 ======================== &#10 PRECIO: {{number_format($precio, 2, '.', ',')}} &#10 TIPO: {{$tipoprecio}} &#10 TASA: {{number_format($factor, 2, '.', ',')}} &#10 DA: {{number_format($dax, 2, '.', ',')}} &#10 DC: {{number_format($dcx, 2, '.', ',')}} &#10 DI: {{number_format($dix, 2, '.', ',')}} &#10 PP: {{number_format($ppx, 2, '.', ',')}} &#10 IVA: {{number_format($cat->iva, 2, '.', ',')}} &#10 RANKING: {{$ranking}} &#10 LOTE: {{$lote}} &#10 VENCE: {{$fecvence}} &#10 CODIGO: {{$codprod}} &#10 ======================== &#10 LIQUIDA: {{number_format($liquida, 2, '.', ',')}} &#10 ">
				                         @if ($liquida == $mpc)
				                            <i class="fa fa-check"></i>
				                            {{number_format($liquida, 2, '.', ',')}}
				                         @else
				                            {{number_format($liquida, 2, '.', ',')}}
				                         @endif
				                         <br>
				                         {{$cfg->simboloOM}}&nbsp;{{number_format($liquida/$factor, 2, '.', ',')}}
				                         @if ($ranking)
				                            &#10 <div>Rnk:{{$ranking}}</div>
				                         @endif
				                   	</td>

				                	<!--- CANTIDAD DEL PROVEEDOR -->
				                    <td align='right' 
				                    	style="width: 200px; 
				                    	word-wrap: 
				                    	break-word; 
				                    	background-color: {{ $mincpProv[$i]->backcolor}}; 
				                    	color: {{ $mincpProv[$i]->forecolor}};" 
				                        title=" {{ $mincpProv[$i]->descripcion}}">
				                        @if ($mayorInv == $cantidad)
				                            <i class="fa fa-check"></i>
				                            {{number_format($cantidad, 0, '.', ',')}}
				                        @else
				                            {{number_format($cantidad, 0, '.', ',')}}
				                        @endif
				                    </td>
				                @endfor
							 	@if ($dvp > 0)
					                <tr class="colorVip">
					            		<td colspan="1" style="background-color: #ffffff;
					            			border: 1px solid #337AB7;">
											<blink>
					                    	<center>
					                    	<img src="{{asset('images/clientepref.png')}}" 
											alt="seped" 
											style="margin-top: 0px; width: 60px;">
											</center>
											</blink>
								        </td>
					                    <td colspan="1" align='right'>
			                             	<span style="font-size: 20px;">
				                         		<b>
				                         		{{number_format($liquidaVip - ($liquidaVip*$dvp/100) , 2, '.', ',')}}
												</b>
						                    </span>
						                    <span style="font-size: 20px; color: green;">
				                         		<b>
				                         		{{$cfg->simboloOM}}&nbsp;{{number_format(($liquidaVip - ($liquidaVip*$dvp/100))/$factorVip , 2, '.', ',')}} 
				                         		</b>
						                    </span>
						                </td>

					                    <td colspan="2" >
					                   		<div class="inner">
						                    	<span class="info-box-text">
										    		<b style="font-size: 14px;">{{$cfg->msgLitVip}}</b>
										    	</span>
						                     	<span style="margin: 0px; 
										      		padding: 0px;
										      		font-size: 12px; ">
										      		Descuento: <span style="font-size: 14px;">
										      		<b>{{number_format($dcto,2, '.', ',')}}%</b> 
										      		</span><br>
										      		Cuota: <span style="font-size: 14px;">
										      		<b>{{number_format($cuota,0, '.', ',')}}</b> und.
										      		</span><br>
										      		Acumulado: <span style="font-size: 14px;">
										      		<b>{{number_format($acum,0, '.', ',')}}</b> und.
										      	</span>
									      	</div>
					                    </td>

					                </tr>
					            @else
					            	<tr style="background-color: {{ $mincpProv[0]->backcolor }};
					            		color: {{ $mincpProv[0]->forecolor }};">
					                    <td colspan="1" style="background-color: #ffffff;
					                         border: 1px solid #337AB7;">
											<blink>
					                    	<center>
					                    	<img src="{{asset('images/superoferta.png')}}" 
											alt="seped" 
											style="margin-top: 0px; width: 50px;">
											</center>
											</blink>
					                    </td>
					                    <td colspan="1" align='right'>
		                    		     	<span style="font-size: 20px;">
				                         		<b>
				                         		{{number_format($liquidaVip, 2, '.', ',')}}
												</b>
						                    </span>
						                    <span style="font-size: 20px; color: green;">
				                         		<b>
				                         		{{$cfg->simboloOM}}&nbsp;{{number_format($liquidaVip/$factorVip , 2, '.', ',')}} 
				                         		</b>
						                    </span>
		   	                    	    </td>
					                </tr>
				                @endif
				            @endif
			            </tr>
		            @endif
		        </table>
			</div>
			
			@if ($dvp > 0)
				<div class="pull-right" style="margin-right: 40px; margin-top: 0px;">
					<img src="{{asset('images/superoferta.png')}}" 
						alt="seped" 
						style="margin-top: 0px; width: 120%;">
				</div>
			@endif
			<div class="modal-footer" style="margin: 0px;">
				<center>
				<p style="color: red; margin: 0px; font-size: 16px;">
					Mejor precio del mercado proporcionado por 
					@if ($cfg->mostrarCopyRight > 0)
						SUPERPRECIO.ONLINE
					@else
						<a href="http://www.isacom.net">
							<span style="font-size: 18px;">
								<img src="{{asset('images/isacom.ico')}}" 
									alt="ISACOM" 
									style="width:16px; height: 16px;"> 
								ISACOM.NET
							</span>
						</a>
					@endif
				</p>
				</center>
			</div>
		</div>
	</div>
</div>
