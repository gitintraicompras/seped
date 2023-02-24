
<?php $__env->startSection('contenido'); ?>
  
<div class="row">
	<div class="col-xs-4">
		<?php echo $__env->make('seped.pedido.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>

<div class="row" style="margin-top: 10px;">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width:190px;">OPCION</th>
					<th>PEDIDO</th>
					<th>FECHA</th>
					<th>ENVIADO</th>
					<th>PROCESADO</th>
					<th>ESTADO</th>
					<th>ORIGEN</th>
					<th>TIPO</th>
					<th>TOTAL</th>
					<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
						<th>FACTOR</th>
					<?php endif; ?>
			        <th>SUCURSAL</th>
           		</thead>
				<?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<!-- CONSULTA DE PEDIDO -->
                        <a href="<?php echo e(URL::action('AdpedidoController@show',$t->id)); ?>">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" 
                        		data-toggle="tooltip" 
                        		title="Consultar pedido">
                        	</button> 
                        </a>

                        <!-- DESCARGAR PEDIDO -->
                        <a href="<?php echo e(URL::action('AdpedidoController@descargar',$t->id)); ?>">
                        	<button class="btn btn-default btn-pedido fa fa-download" 
                        		data-toggle="tooltip" 
                        		title="Descargar pedido en pdf">
                        	</button>
                        </a>

						<?php if($t->estado == 'NUEVO'): ?> 
							<!-- ELIMINAR PEDIDO -->
							<a href="" 
								data-target="#modal-delete-<?php echo e($t->id); ?>" 
								data-toggle="modal">
								<button class="btn btn-default btn-pedido fa fa-trash-o" 
									data-toggle="tooltip" 
									title="Eliminar pedido">
								</button>
							</a>
						<?php endif; ?>

					</td>
					<td><?php echo e($t->id); ?></td>
					<td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecha))); ?></td>
					<td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecenviado))); ?></td>
					<td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecprocesado))); ?></td>
					<?php if($t->estado == 'APROBADO'): ?>
						<td style="color: red;"><?php echo e($t->estado); ?></td>
					<?php else: ?>
						<td><?php echo e($t->estado); ?></td>
					<?php endif; ?>
					<td><?php echo e($t->origen); ?></td>
					<td align="center"><?php echo e($t->tipedido); ?></td>

					<td align="right">
						<span title= "<?php echo e($cfg->simboloMoneda); ?>">
                        	<?php echo e(number_format($t->total, 2, '.', ',')); ?>

                        </span>
						<?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                            <br>
                            <span style="color: green;" 
                                title= "<?php echo e($cfg->simboloOM); ?>">
                                <b><?php echo e(number_format($t->total/$t->factorcambiario, 2, '.', ',')); ?></b>
                            </span>
                        <?php endif; ?>
					</td>

					<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
						<td align="right"><?php echo e(number_format($t->factorcambiario, 2, '.', ',')); ?></td>
					<?php endif; ?>
					<td><?php echo e(sLeercfg($t->codisb, "SedeSucursal")); ?></td>
				</tr>
				<?php echo $__env->make('seped.pedido.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table><br>
			<div align='right'>
				<?php echo e($tabla->render()); ?>

			</div><br>
		</div>
	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pedido/index.blade.php ENDPATH**/ ?>