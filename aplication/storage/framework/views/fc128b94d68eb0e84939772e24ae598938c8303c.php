
<?php $__env->startSection('contenido'); ?>

<div class="row">
    <div class="col-md-12">
      	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	          <li class="active"><a href="#tab_1" data-toggle="tab"><B>LITERALES DE TRANSPORTE</B></a></li>
	          <li class="pull-right"><a href="<?php echo e(url('/seped/config')); ?>" class="text-muted"><i class="fa fa-gear"></i></a></li>
	        </ul>
	        
	        <div class="tab-content">
	          	<div class="tab-pane active" id="tab_1">
					<div class="row">
						
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
							<a href="transplit/create">
								<button class="btn-normal" style="font-size: 18px; width: 200px;" title="Crear nuevo literal">
									Nuevo literal
								</button>
							</a>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
							<?php echo $__env->make('seped.transplit.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-condensed table-hover">
									<thead class="colorTitulo">
										<th style="width: 50px;">#</th>
										<th style="width: 50px;">OPCION</th>
										<th style="width: 50px;">ID</th>
										<th>DESCRIPCION</th>
									</thead>
									<?php $__currentLoopData = $transplit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($loop->iteration); ?></td>
										<td>
											<a href="" data-target="#modal-delete-<?php echo e($tl->id); ?>" data-toggle="modal"><button class="btn btn-default btn-pedido fa fa-trash-o" title="Eliminar literal"></button></a>
										</td>
										<td><?php echo e($tl->id); ?></td>
										<td><?php echo e($tl->literal); ?></td>
									</tr>
									<?php echo $__env->make('seped.transplit.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</table>
							</div>
						</div>
					</div>
		        </div>
		    </div>
		</div>
	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/transplit/index.blade.php ENDPATH**/ ?>