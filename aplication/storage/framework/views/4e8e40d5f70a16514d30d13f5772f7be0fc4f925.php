
<?php $__env->startSection('contenido'); ?>

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="pedcrisep/create">
			<button class="btn-normal" style="font-size: 18px; width: 200px;" title="Crear criterio nuevo">
				Criterio Nuevo 
			</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<?php echo $__env->make('seped.pedcrisep.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width: 50px;">ID</th>
					<th style="width: 150px;">OPCION</th>
					<th>DESCRIPCION</th>
					<th>ESTADO</th>
				</thead>
				<?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($t->id); ?></td>
					<td>
						<a href="<?php echo e(URL::action('AdpedcrisepController@show',$t->id)); ?>"><button class="btn btn-default btn-pedido fa fa-file-o" title="Consultar criterio"></button></a>

						<a href="<?php echo e(URL::action('AdpedcrisepController@edit',$t->id)); ?>"><button class="btn btn-default btn-pedido fa fa-pencil" title="Modificar criterio"></button></a>

						<a href="" data-target="#modal-delete-<?php echo e($t->id); ?>" data-toggle="modal"><button class="btn btn-default btn-pedido fa fa-trash-o" title="Eliminar criterio"></button></a>

					</td>
					<td><?php echo e($t->descrip); ?></td>
					<td><?php echo e($t->estado); ?></td>
				</tr>
				<?php echo $__env->make('seped.pedcrisep.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pedcrisep/index.blade.php ENDPATH**/ ?>