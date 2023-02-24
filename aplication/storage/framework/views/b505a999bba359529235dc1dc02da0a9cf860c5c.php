
<?php $__env->startSection('contenido'); ?>

<div class="col-md-12"> 
	<div class="row">
		<section class="content">
      
			<?php echo Form::open(array('url'=>'/home','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

			<div class="row">
				<div class="col-md-12" style="margin-bottom: 0px; height: 45px;" >
					<div class="form-group">
						<div class="input-group input-group-sm">
					    	<select name="codcli" class="form-control selectpicker " data-live-search="true">
					    		<?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					    			<?php if($users->codcliactivo == $cli->codcli): ?>
										<option selected value="<?php echo e($cli->codcli); ?>"><?php echo e($cli->codcli); ?>-<?php echo e($cli->nombre); ?></option>
						    		<?php else: ?>
					    				<option value="<?php echo e($cli->codcli); ?>"><?php echo e($cli->codcli); ?>-<?php echo e($cli->nombre); ?></option>
					    			<?php endif; ?>
					    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    	</select>
				  		    <span style="padding: 0;" 
				  		    	class="input-group-addon input-group">
								<button type="submit" 
									class="btn-normal" 
									style="height: 32px; border-radius: 0px 10px 10px 0px !important">
									Cambiar
								</button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<?php echo e(Form::close()); ?>


			<div class="row">
	            <div class="col-md-6">
	              	<!-- Danger box -->
	             	<div class="box box-solid box-primary" 
	             		style="height: 240px; 
	             		border-radius: 10px 10px 10px 10px;">
	             		<div class="box-header colorTitulo" 
	             			style="height: 40px;
	             			border-radius: 10px 10px 0px 0px;"> 
							<i class="fa fa-user" >
								<span style="font-size: 20px;
									 margin-top: 0px;">
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
	            </div><!-- /.col -->

	            <div class="col-md-6">
	              <!-- Success box -->
		             <div class="box box-solid box-primary" 
		             	style="height: 240px;
		             	border-radius: 10px 10px 10px 10px;">
		                <div class="box-header colorTitulo" 
		                	style="height: 40px; 
		                	border-radius: 10px 10px 0px 0px;"> 
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
												 <?php echo e($cfg->simboloOM); ?> <?php echo e(number_format($cliente->limiteDs,2, '.', ',')); ?> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;  <?php echo e(number_format($cliente->limite,2, '.', ',')); ?>

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
											    <?php echo e($cfg->simboloOM); ?> <?php echo e(number_format($cliente->limiteDs - $cliente->saldoDs,2, '.', ',')); ?>  &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <?php echo e(number_format($cliente->limite - $cliente->saldo,2, '.', ',')); ?>

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
	            </div><!-- /.col -->
	        </div>
		
			<div class="row">
				<!--- CATALOGO --->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box info-box-1" 
				  	style="background-color: #f7f7f7;
				  	border-radius: 10px 10px 10px 10px;
				  	border: 1px solid aqua;">
				  	<a href="<?php echo e(URL::action('AdcatalogoController@listado','C')); ?>">
				    	<span class="info-box-icon info-box-icon-1 bg-aqua"
				    		style="border-radius: 10px 0px 0px 10px;">
				    		<i class="fa fa-cubes"></i>
				    	</span>
					</a>
				    <div class="info-box-content">
				      <span class="info-box-text">Catálogo</span>
				      <span class="info-box-number">
				      	<?php echo e(number_format($contCatalogo,0, '.', ',')); ?>

				      	<small>productos</small>
				      </span>
				    </div>
				  </div>
				</div>

				<!--- PEDIDOS ENVIADOS --->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box info-box-2" 
				  	style="background-color: #f7f7f7;
				  	border-radius: 10px 10px 10px 10px;
				  	border: 1px solid red;">
				  	<a href="<?php echo e(URL::action('AdpedidoController@index')); ?>">
				    	<span class="info-box-icon info-box-icon-2 bg-red"
				    		style="border-radius: 10px 0px 0px 10px;">
				    		<i class="fa fa-shopping-cart"></i>
				    	</span>
					</a>
				    <div class="info-box-content">
				      <span class="info-box-text">Pedidos</span>
				      <span class="info-box-number">
				      <?php echo e(number_format($contPedido,0, '.', ',')); ?>

				      <small>enviados</small>
				  	  </span>
				    </div>
				  </div>
				</div>

				<!-- fix for small devices only -->
				<div class="clearfix visible-sm-block"></div>

				<!--- RECLAMOS ENVIADOS --->
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <div class="info-box info-box-3" 
				  	style="background-color: #f7f7f7;
				  	border-radius: 10px 10px 10px 10px;
				  	border: 1px solid green;">
				  	<a href="<?php echo e(URL::action('AdreclamoController@index')); ?>">
				    	<span class="info-box-icon info-box-icon-3 bg-green"
				    		style="border-radius: 10px 0px 0px 10px;">
				    		<i class="fa fa-phone-square"></i>
				    	</span>
					</a>
				    <div class="info-box-content">
				      <span class="info-box-text">Reclamos</span>
				      <span class="info-box-number">
				      <?php echo e(number_format($contReclamo,0, '.', ',')); ?>

				      <small>enviados</small>
				  	  </span>
				    </div>
				  </div>
				</div>

				<?php if(!empty(trim($cliente->DctoPreferencial))): ?>
					<?php
						$data = MesActivoPreferencial($cliente->DctoPreferencial);
				        $dcto = $data['dcto'];
				        $cuota = $data['cuota'];
				        $acum = $data['acum'];
				        $chart_data = MesesActivoPreferencial();
				  	?>
					<!--- CLIENTE PREFERENCIAL --->
					<div class="col-md-3 col-sm-6 col-xs-12">
						<a href="" 
			                data-target="#modal-vip" 
			                data-toggle="modal"
			                style="color: #000000;"
			                title="VER GRAFICAS">
							<div class="info-box colorVip" 
								style="border-radius: 10px 10px 10px 10px;
				  				border: 1px solid green;">
								<span class="info-box-icon" 
									style="background-color: #4FA5E2;
									border-radius: 10px 0px 0px 10px;">
									<img src="<?php echo e(asset('images/clientepref.png')); ?>" alt="seped" style="width: 80px;">
								</span>
								<div class="info-box-content">
								  <span class="info-box-text">
								  	<b style="font-size: 12px;"><?php echo e($cfg->msgLitVip); ?></b>
								  </span>
								  <span class="info-box-number" 
								  	style="margin: 0px; 
								  		padding: 0px;
								  		font-size: 10px; ">
								  		Descuento: <span style="font-size: 14px;">
								  		<b><?php echo e(number_format($dcto,2, '.', ',')); ?>%</b> 
								  		</span><br>
								  		Cuota: <span style="font-size: 14px;">
								  		<b><?php echo e(number_format($cuota,0, '.', ',')); ?></b> und.
								  		</span><br>
								  		Acumulado: <span style="font-size: 14px;">
								  		<b><?php echo e(number_format($acum,0, '.', ',')); ?></b> und.
								  		</span>
								  </span>
								</div>
							</div>
						</a>
						<?php echo $__env->make('seped.catalogo.vip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				<?php else: ?>
					<!--- PAGOS ENVIADOS --->
					<div class="col-md-3 col-sm-6 col-xs-12">
					  <div class="info-box info-box-4"  
					  	style="background-color: #f7f7f7;
					  	border-radius: 10px 10px 10px 10px;
				  		border: 1px solid yellow;">
					  	<a href="<?php echo e(URL::action('AdpagoController@index')); ?>">
					    	<span class="info-box-icon info-box-icon-4 bg-yellow"
					    		style="border-radius: 10px 0px 0px 10px;">
					    		<i class="fa fa-money"></i>
					    	</span>
						</a>
					    <div class="info-box-content">
					      <span class="info-box-text">Pagos</span>
					      <span class="info-box-number">
					      	<?php echo e(number_format($contPago,0, '.', ',')); ?>

					      	<small>enviados</small>
					      </span>
					    </div>
					  </div>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
setTimeout('document.location.reload()',60000);
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/indexVendedor.blade.php ENDPATH**/ ?>