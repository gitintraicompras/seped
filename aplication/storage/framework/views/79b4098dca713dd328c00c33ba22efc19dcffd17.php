
<?php $__env->startSection('contenido'); ?>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<?php echo $__env->make('seped.busquedas.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>

<div class="row" style="margin-top: 10px;">

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width:70px;">OPCION</th>
					<th style="width:40px;">ID</th>
					<th>BUSQUEDA</th>
					<th>EXITOSA</th>
					<th>CONTADOR</th>
					<th>FECHA</th>
				</thead>
				<?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<a href="" data-target="#modal-delete-<?php echo e($t->id); ?>" data-toggle="modal">
							<button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar la busqueda"></button>
						</a>
		
					</td>
					<td><?php echo e($t->id); ?></td>
					<td><?php echo e($t->texto); ?></td>
					<td><?php echo e($t->exitosa == 1 ? 'SI' : 'NO'); ?></td>
					<td><?php echo e(number_format($t->contador, 0, '.', ',')); ?></td>
					<td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecha))); ?></td>
				</tr>
				<?php echo $__env->make('seped.busquedas.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/busquedas/index.blade.php ENDPATH**/ ?>