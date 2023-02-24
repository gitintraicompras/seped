@extends('layouts.menu')
@section('contenido')
 
<div class="col-md-12">
	<div class="row">

		<div class="row">
            <div class="col-md-6">
              	<!-- Danger box -->
             	<div class="box box-solid box-primary" 
             		style="height: 240px; border-radius: 10px 10px 10px 10px;">
             		<div class="box-header colorTitulo" style="height: 40px;"> 
						<i class="fa fa-user" >
							<span style="font-size: 20px; margin-top: 0px;">
								&nbsp;Datos del Cliente
							</span>
						</i>
					</div>
	                <div class="box-body">
	                  	<div class="table-responsive" style="padding: 1px;">
			                <table class="table table-striped table-bordered" >
			                    <tr>
				                	<td>
			                			<span style="color: #000000; font-size: 14px;">
			                			Código
			                			</span>
				                	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										{{$cliente->codcli}}
										</span>
									</td>
				                </tr>
				                <tr>
				                	<td>
			                			<span style="color: #000000; font-size: 14px;">
			                			Rif:
			                			</span>
				                	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										{{$cliente->rif}}   
										</span>
									</td>
				                </tr>
				                <tr> 
				                	<td>
			                			<span style="color: #000000; font-size: 14px;">
			                			Contacto:
			                			</span>
				                	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										{{$cliente->telefono}} - {{$cliente->contacto}} 
										</span>
									</td>
				                </tr>
				                <tr> 
				                	<td>
			                			<span style="color: #000000; font-size: 14px;">
			                			Vendedor:
			                			</span>
				                	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										{{ CampoVendedor($cliente->zona, "nombre") }}  
										</span>
									</td>
				                </tr>
				            </table>
				        </div>
	                </div><!-- /.box-body -->
              	</div><!-- /.box -->
            </div>

            <div class="col-md-6">
              <!-- Success box -->
	             <div class="box box-solid box-primary" 
	             	style="height: 240px; border-radius: 10px 10px 10px 10px;">
	                <div class="box-header colorTitulo" style="height: 40px;"> 
						<i class="fa fa-th-list" >
							<span style="font-size: 20px; margin-top: 0px;">
								&nbsp;Condiciones comerciales
							</span>
						</i>
					</div>
	                <div class="box-body">
	                	<div class="table-responsive" style="padding: 1px;">
			                <table class="table table-striped table-bordered" >
			                    <tr>
				                	<td>
			                			<span style="color: #000000; font-size: 14px;">
			                			Limite de Crédito
			                			</span>
				                	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										@if ( $cfg->mostrarAlcabalaOM > 0 )
											{{ $cfg->simboloOM }} {{number_format($cliente->limiteDs,2, '.', ',')}} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; {{number_format($cliente->limite,2, '.', ',')}} 
										@else
											{{number_format($cliente->limite,2, '.', ',')}}
										@endif
										</span>
									</td>
				                </tr>
				                <tr> 
				                	<td>
			                			<span style="color: #000000; font-size: 14px;">
			                			Saldo Actual:
			                			</span>
				                	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										@if ( $cfg->mostrarAlcabalaOM > 0 )
											{{ $cfg->simboloOM }} {{number_format($cliente->saldoDs,2, '.', ',')}} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;  {{number_format($cliente->saldo,2, '.', ',')}} 
										@else
											{{number_format($cliente->saldo,2, '.', ',')}}
										@endif
										</span>
									</td>
				                </tr>
				                <tr>
				                	<td>
			                			<span style="color: #000000; font-size: 14px;">
			                			Crédito Disponible:
			                			</span>
				                	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										@if ( $cfg->mostrarAlcabalaOM > 0 )		
											{{$cfg->simboloOM}} 
											{{number_format($cliente->limiteDs - $cliente->saldoDs,2, '.', ',')}} &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;  {{number_format($cliente->limite - $cliente->saldo,2, '.', ',')}}
										@else
											{{number_format($cliente->limite - $cliente->saldo,2, '.', ',')}}
										@endif
										</span>
									</td>
				                </tr>
				                <tr>
				                	<td>
			                			@if ($cliente->dcomercial > 0)
				                			<span style="color: #000000; font-size: 14px;">
				                			Descuento Comercial: {{ number_format($cliente->dcomercial,2, '.', ',') }}% 
				                			</span>
			                			@endif
			                			<p>
			                				@if ($cliente->ppago > 0)
			                					Pronto pago: {{ number_format($cliente->ppago,2, '.', ',') }}% &nbsp;&nbsp;
			                				@endif
			                				@if ($cliente->dinternet > 0)
			                					
			                					Descuento Internet: 
			                					{{ number_format($cliente->dinternet,2, '.', ',') }}%
			                				@endif
			                			</p>
			                    	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										{{ $cliente->dcredito }} días de Crédito
										</span>
										@if ($cliente->estado == "INACTIVO")
			                				<p style="color: red;"> {{ $cliente->estado }} </p>
			                			@else
			                				<p style="color: green;"> {{ $cliente->estado }} </p>
			                			@endif
									</td>
				                </tr>
				            </table>
				        </div>	
	                </div><!-- /.box-body -->
	            </div><!-- /.box -->
            </div>
        </div>
		<br>

		<!-- Small boxes (Stat box) -->
		<div class="row">

			<div class="col-lg-3 col-xs-6">
		  		<!-- small box -->
			 	<div class="small-box small-box-1 bg-aqua "
			 		style="border-radius: 10px 10px 10px 10px;">
				    <div class="inner">
				      <h3>{{number_format($contCatalogo,0, '.', ',')}}</h3>
				      <p>Catálogo</p>
				    </div>
				    <div class="icon">
				      <i class="fa fa-cubes"></i>
				    </div>
				    <a href="{{URL::action('AdcatalogoController@listado','D')}}" 
				    	class="small-box-footer">
				    		Más información 
				    		<i class="fa fa-arrow-circle-right"></i>
				    </a>
			  	</div>
			</div>

			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box small-box-2 bg-green"
			  	style="border-radius: 10px 10px 10px 10px;">
			    <div class="inner">
			      <h3>{{number_format($contPedido,0, '.', ',')}}
			      	<sup style="font-size: 20px"></sup>
			      </h3>
			      <p>Pedidos</p>
			    </div>
			    <div class="icon">
			      <i class="fa fa-shopping-cart"></i>
			    </div>
			    <a href="{{URL::action('AdpedidoController@index')}}" 
			    	class="small-box-footer">
			    		Más información 
			    		<i class="fa fa-arrow-circle-right"></i>
			    </a>
			  </div>
			</div>
	
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box small-box-3 bg-red"
			  	style="border-radius: 10px 10px 10px 10px;">
			    <div class="inner">
			      <h3>{{number_format($contReclamo,0, '.', ',')}}</h3>
			      <p>Reclamos</p>
			    </div>
			    <div class="icon">
			      <i class="fa fa-phone-square"></i>
			    </div>
			    <a href="{{URL::action('AdreclamoController@index')}}" 
			    	class="small-box-footer">
			    	Más información 
			    	<i class="fa fa-arrow-circle-right"></i>
			    </a>
			  </div>
			</div>

			@if (!empty($cliente->DctoPreferencial))
				@php
					$data = MesActivoPreferencial($cliente->DctoPreferencial);
			        $dcto = $data['dcto'];
			        $cuota = $data['cuota'];
			        $acum = $data['acum'];
			        $chart_data = MesesActivoPreferencial();
				@endphp
				<!--- CLIENTE PREFERENCIAL --->
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <a href="" 
	                  data-target="#modal-vip" 
	                  data-toggle="modal"
	                  style="color: #000000;"
	                  title="VER GRAFICAS">
					  <div class="small-box colorVip"
					  	style="border-radius: 10px 10px 10px 10px;">
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
					    <div class="icon">
					    	<img src="{{asset('images/clientepref.png')}}" 
					    		alt="seped" 
					    		style="width: 100px;">
					    </div>
					    <span class="small-box-footer"> &nbsp;</span>
					  </div>
					</a>
					@include('seped.catalogo.vip')
				</div>
			@else
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box small-box-4 bg-yellow"
				  	style="border-radius: 10px 10px 10px 10px;">
				    <div class="inner">
				      <h3>{{number_format($contPago,0, '.', ',')}}</h3>
				      <p>Pagos</p>
				    </div>
				    <div class="icon">
				      <i class="fa fa-money"></i>
				    </div>
				    <a href="{{URL::action('AdpagoController@index')}}" 
				    	class="small-box-footer">
				    	Más información 
				    	<i class="fa fa-arrow-circle-right"></i>
				    </a>
				  </div>
				</div>
			@endif
		</div>
		
	</div>
</div>

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
setTimeout('document.location.reload()',60000);
</script>
@endpush
@endsection