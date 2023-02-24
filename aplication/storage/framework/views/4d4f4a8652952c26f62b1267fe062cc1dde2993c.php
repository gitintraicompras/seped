
<?php $__env->startSection('contenido'); ?>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<?php echo $__env->make('seped.monitorreclamo.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width: 180px;">OPCION</th>
					<th>ID</th>
					<th>CODIGO</th>
					<th>CLIENTE</th>
					<th>FECHA</th>
					<th>PROCESADO</th>
					<th>ESTADO</th>
					<th>FACTURA</th>
					<th>ORIGEN</th>
					<th>TOTAL</th>
					<th>SUCURSAL</th>
				</thead>
				<?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<!-- CONSULTA DEL RECLAMO -->
                        <a href="<?php echo e(URL::action('AdmonitorreclamoController@show',$t->id)); ?>">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip" title="Consultar reclamo">
                        	</button>
                        </a>

                        <!-- DESCARGAR RECLAMO-->
                        <a href="<?php echo e(URL::action('AdreclamoController@descargar',$t->id)); ?>">
                            <button class="btn btn-default btn-pedido fa fa-download" data-toggle="tooltip" title="Descargar reclamo en pdf">
                            </button>
                        </a>

                        <?php if($t->estado == 'RECIBIDO'): ?>
                        <!-- PROCESAR RECLAMO -->
                        <a href="" data-target="#modal-procesar-<?php echo e($t->id); ?>" data-toggle="modal">
                            <button class="btn btn-default btn-pedido fa fa-check" data-toggle="tooltip" title="Procesar reclamo"></button>
                        </a>
                        <!-- ELIMINAR RECLAMO -->
                        <a href="" data-target="#modal-delete-<?php echo e($t->id); ?>" data-toggle="modal">
                            <button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar reclamo"></button>
                        </a>
						<?php endif; ?>
					</td>
					<td><?php echo e($t->id); ?></td>
					<td><?php echo e($t->codcli); ?></td>
					<td><?php echo e($t->cliente); ?></td>
					<td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecha))); ?></td>
					<td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecprocesado))); ?></td>
					<?php if($t->estado == 'RECIBIDO'): ?>
						<td style="color: red;"><?php echo e($t->estado); ?></td>
					<?php else: ?>
						<td><?php echo e($t->estado); ?></td>
					<?php endif; ?>
					<td><?php echo e($t->factnum); ?></td>
					<td><?php echo e($t->origen); ?></td>
					<td align="right"><?php echo e(number_format(SubtotalReclamo($t->id), 2, '.', ',')); ?></td>
					<td><?php echo e(sLeercfg($t->codisb, "SedeSucursal")); ?></td>
				</tr>
				<?php echo $__env->make('seped.monitorreclamo.procesar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('seped.monitorreclamo.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table><br>
	        <?php echo e($tabla->render()); ?>

		</div>
	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/monitorreclamo/index.blade.php ENDPATH**/ ?>