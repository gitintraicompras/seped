
<?php $__env->startSection('contenido'); ?>

<?php echo e(Form::Open(array('action'=>array('AdconfigController@grabarlit')))); ?>

<?php echo e(Form::token()); ?>

<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="#tab_1" data-toggle="tab"><B>EDITAR LITERALES</B></a></li>
	          <li class="pull-right"><a href="<?php echo e(url('/seped/config')); ?>" class="text-muted"><i class="fa fa-gear"></i></a></li>
	        </ul>
	        
	        <div class="tab-content">
	          	<div class="tab-pane active" id="tab_1">
		          	<div class="row">
		          		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
				        	<div class="table-responsive">
				                <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
				             
					                <thead class="colorTitulo">
					                	<th style="width: 150px;">LITERAL ORIGINAL</th>
					                  	<th>DESCRIPCION ORIGINAL</th>
						                <th style="width: 150px;">NUEVO LITERAL</th>
						                <th>NUEVA DESCRIPION</th>
						            </thead>
					                
					                <tr>
					                  	<td>DA</td>
					                	<td>DESCUENTO ADICIONAL</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->LitDa); ?>" name="LitDa" class="form-control" <?php if($cfg->mostrarDa == 0): ?> readonly <?php endif; ?> >
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->msgLitDa); ?>" name="msgLitDa" class="form-control" <?php if($cfg->mostrarDa == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>DP</td>
					                	<td>DESCUENTO DE PRE-EMPAQUE</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->LitDp); ?>" name="LitDp" class="form-control" <?php if($cfg->mostrarDp == 0): ?> readonly <?php endif; ?> >
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->msgLitDp); ?>" name="msgLitDp" class="form-control" <?php if($cfg->mostrarDp == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>DV</td>
					                	<td>DESCUENTO POR VOLUMEN</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->LitDv); ?>" name="LitDv" class="form-control" <?php if($cfg->mostrarDv == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->msgLitDv); ?>" name="msgLitDv" class="form-control" <?php if($cfg->mostrarDv == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>DI</td>
					                	<td>DESCUENTO DE INTERNET</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->LitDi); ?>" name="LitDi" class="form-control" <?php if($cfg->mostrarDi == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->msgLitDi); ?>" name="msgLitDi" class="form-control" <?php if($cfg->mostrarDi == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>DC</td>
					                	<td>DESCUENTO COMERCIAL</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->LitDc); ?>" name="LitDc" class="form-control" <?php if($cfg->mostrarDc == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->msgLitDc); ?>" name="msgLitDc" class="form-control" <?php if($cfg->mostrarDc == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>PP</td>
					                	<td>DESCUENTO DE PRONTO PAGO</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->LitPp); ?>" name="LitPp" class="form-control" <?php if($cfg->mostrarPp == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->msgLitPp); ?>" name="msgLitPp" class="form-control" <?php if($cfg->mostrarPp == 0): ?> readonly <?php endif; ?>>
					                	</td>
					                </tr>
					                <tr>
					                  	<td>PRECIO</td>
					                	<td>PRECIO DE VENTA</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->LitPrecio); ?>" name="LitPrecio" class="form-control">
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->msgLitPrecio); ?>" name="msgLitPrecio" class="form-control">
					                	</td>
					                </tr>
					                <tr>
					                  	<td>VIP</td>
					                	<td>CLIENTE VIP</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->LitVip); ?>" name="LitVip" class="form-control">
					                	</td>
					                	<td>
					                	<input style="color: #000000;" value="<?php echo e($cfg->msgLitVip); ?>" name="msgLitVip" class="form-control">
					                	</td>
					                </tr>
						        </table><br>
				            </div>
						</div>
		          	</div>
	          	</div>
	        </div>
      	</div>
    </div>
</div>

<!-- BOTON GUARDAR/CANCELAR -->
<div class="form-group" style="margin-left: 15px;">
	<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
	<button class="btn-confirmar" type="submit">Guardar</button>
</div>
<?php echo e(Form::close()); ?>


<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/config/literales.blade.php ENDPATH**/ ?>