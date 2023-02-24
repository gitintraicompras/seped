
<?php $__env->startSection('contenido'); ?>

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="grupo/create">
			<button class="btn-normal" style="font-size: 18px; width: 200px;" title="Crear grupo nuevo">
				Nuevo grupo
			</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<?php echo $__env->make('seped.grupo.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style="width: 50px;">#</th>
					<th style="width: 150px;">OPCION</th>
					<th style="width: 50px;">ID</th>
					<th>DESCRIPCION</th>
					<th>SUCURSAL</th>
				</thead>
				<?php $__currentLoopData = $grupo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($loop->iteration); ?></td>
					<td>
						<a href="<?php echo e(URL::action('AdgrupoController@show',$gp->id)); ?>"><button class="btn btn-default btn-pedido fa fa-file-o" title="Consultar Grupo"></button></a>

						<a href="<?php echo e(URL::action('AdgrupoController@edit',$gp->id)); ?>"><button class="btn btn-default btn-pedido fa fa-pencil" title="Modificar Grupo"></button></a>

						<a href="" data-target="#modal-delete-<?php echo e($gp->id); ?>" data-toggle="modal"><button class="btn btn-default btn-pedido fa fa-trash-o" title="Eliminar Grupo"></button></a>

					</td>
					<td><?php echo e($gp->id); ?></td>
					<td><?php echo e($gp->nomgrupo); ?></td>
					<td><?php echo e(sLeercfg($gp->codisb, "SedeSucursal")); ?></td>
				</tr>
				<?php echo $__env->make('seped.grupo.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/grupo/index.blade.php ENDPATH**/ ?>