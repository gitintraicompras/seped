
<?php $__env->startSection('contenido'); ?>
 
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
										<?php echo e($cliente->codcli); ?>

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
										<?php echo e($cliente->rif); ?>   
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
										<?php echo e($cliente->telefono); ?> - <?php echo e($cliente->contacto); ?> 
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
										<?php echo e(CampoVendedor($cliente->zona, "nombre")); ?>  
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
										<?php if( $cfg->mostrarAlcabalaOM > 0 ): ?>
											<?php echo e($cfg->simboloOM); ?> <?php echo e(number_format($cliente->limiteDs,2, '.', ',')); ?> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <?php echo e(number_format($cliente->limite,2, '.', ',')); ?> 
										<?php else: ?>
											<?php echo e(number_format($cliente->limite,2, '.', ',')); ?>

										<?php endif; ?>
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
										<?php if( $cfg->mostrarAlcabalaOM > 0 ): ?>
											<?php echo e($cfg->simboloOM); ?> <?php echo e(number_format($cliente->saldoDs,2, '.', ',')); ?> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;  <?php echo e(number_format($cliente->saldo,2, '.', ',')); ?> 
										<?php else: ?>
											<?php echo e(number_format($cliente->saldo,2, '.', ',')); ?>

										<?php endif; ?>
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
										<?php if( $cfg->mostrarAlcabalaOM > 0 ): ?>		
											<?php echo e($cfg->simboloOM); ?> 
											<?php echo e(number_format($cliente->limiteDs - $cliente->saldoDs,2, '.', ',')); ?> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;  <?php echo e(number_format($cliente->limite - $cliente->saldo,2, '.', ',')); ?>

										<?php else: ?>
											<?php echo e(number_format($cliente->limite - $cliente->saldo,2, '.', ',')); ?>

										<?php endif; ?>
										</span>
									</td>
				                </tr>
				                <tr>
				                	<td>
			                			<?php if($cliente->dcomercial > 0): ?>
				                			<span style="color: #000000; font-size: 14px;">
				                			Descuento Comercial: <?php echo e(number_format($cliente->dcomercial,2, '.', ',')); ?>% 
				                			</span>
			                			<?php endif; ?>
			                			<p>
			                				<?php if($cliente->ppago > 0): ?>
			                					Pronto pago: <?php echo e(number_format($cliente->ppago,2, '.', ',')); ?>% &nbsp;&nbsp;
			                				<?php endif; ?>
			                				<?php if($cliente->dinternet > 0): ?>
			                					
			                					Descuento Internet: 
			                					<?php echo e(number_format($cliente->dinternet,2, '.', ',')); ?>%
			                				<?php endif; ?>
			                			</p>
			                    	</td>
									<td align='right'>
										<span style="color: #000000; font-size: 14px;">
										<?php echo e($cliente->dcredito); ?> días de Crédito
										</span>
										<?php if($cliente->estado == "INACTIVO"): ?>
			                				<p style="color: red;"> <?php echo e($cliente->estado); ?> </p>
			                			<?php else: ?>
			                				<p style="color: green;"> <?php echo e($cliente->estado); ?> </p>
			                			<?php endif; ?>
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
				      <h3><?php echo e(number_format($contCatalogo,0, '.', ',')); ?></h3>
				      <p>Catálogo</p>
				    </div>
				    <div class="icon">
				      <i class="fa fa-cubes"></i>
				    </div>
				    <a href="<?php echo e(URL::action('AdcatalogoController@listado','D')); ?>" 
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
			      <h3><?php echo e(number_format($contPedido,0, '.', ',')); ?>

			      	<sup style="font-size: 20px"></sup>
			      </h3>
			      <p>Pedidos</p>
			    </div>
			    <div class="icon">
			      <i class="fa fa-shopping-cart"></i>
			    </div>
			    <a href="<?php echo e(URL::action('AdpedidoController@index')); ?>" 
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
			      <h3><?php echo e(number_format($contReclamo,0, '.', ',')); ?></h3>
			      <p>Reclamos</p>
			    </div>
			    <div class="icon">
			      <i class="fa fa-phone-square"></i>
			    </div>
			    <a href="<?php echo e(URL::action('AdreclamoController@index')); ?>" 
			    	class="small-box-footer">
			    	Más información 
			    	<i class="fa fa-arrow-circle-right"></i>
			    </a>
			  </div>
			</div>

			<?php if(!empty($cliente->DctoPreferencial)): ?>
				<?php
					$data = MesActivoPreferencial($cliente->DctoPreferencial);
			        $dcto = $data['dcto'];
			        $cuota = $data['cuota'];
			        $acum = $data['acum'];
			        $chart_data = MesesActivoPreferencial();
				?>
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
					    		<b style="font-size: 14px;"><?php echo e($cfg->msgLitVip); ?></b>
					    	</span>
					    	<span style="margin: 0px; 
					      		padding: 0px;
					      		font-size: 12px; ">
					      		Descuento: <span style="font-size: 14px;">
					      		<b><?php echo e(number_format($dcto,2, '.', ',')); ?>%</b> 
					      		</span><br>
					      		Cuota: <span style="font-size: 14px;">
					      		<b><?php echo e(number_format($cuota,0, '.', ',')); ?></b> und.
					      		</span><br>
					      		Acumulado: <span style="font-size: 14px;">
					      		<b><?php echo e(number_format($acum,0, '.', ',')); ?></b> und.
					      	</span>
					    </div>
					    <div class="icon">
					    	<img src="<?php echo e(asset('images/clientepref.png')); ?>" 
					    		alt="seped" 
					    		style="width: 100px;">
					    </div>
					    <span class="small-box-footer"> &nbsp;</span>
					  </div>
					</a>
					<?php echo $__env->make('seped.catalogo.vip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			<?php else: ?>
				<div class="col-lg-3 col-xs-6">
				  <!-- small box -->
				  <div class="small-box small-box-4 bg-yellow"
				  	style="border-radius: 10px 10px 10px 10px;">
				    <div class="inner">
				      <h3><?php echo e(number_format($contPago,0, '.', ',')); ?></h3>
				      <p>Pagos</p>
				    </div>
				    <div class="icon">
				      <i class="fa fa-money"></i>
				    </div>
				    <a href="<?php echo e(URL::action('AdpagoController@index')); ?>" 
				    	class="small-box-footer">
				    	Más información 
				    	<i class="fa fa-arrow-circle-right"></i>
				    </a>
				  </div>
				</div>
			<?php endif; ?>
		</div>
		
	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
setTimeout('document.location.reload()',60000);
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/indexCliente.blade.php ENDPATH**/ ?>