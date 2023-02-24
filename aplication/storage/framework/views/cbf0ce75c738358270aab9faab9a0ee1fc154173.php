
<?php $__env->startSection('contenido'); ?>

<div class="row">
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		<a href="<?php echo e(url('/seped/marcaimg/create')); ?>">
			<button class="btn-normal" data-toggle="tooltip" style="font-size: 18px; width: 200px;" title="Agregar marca">Agregar marca</button>
		</a>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<?php echo $__env->make('seped.marcaimg.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>

<br>
<div class="col-md-12">
	<div class="nav-tabs-custom" >
	    <ul class="nav nav-tabs" >
	      <li class="active"><a href="#tab_1" data-toggle="tab">IMAGENES</a></li>
	      <li><a href="#tab_2" data-toggle="tab">LISTADO DE MARCAS</a></li>
	      <li class="pull-right">
	      	<a href="<?php echo e(url('/home')); ?>" class="text-muted">
	      		<i class="fa fa-window-close-o"></i>
	      	</a>
	      </li>
	    </ul>
	</div>
	<div class="tab-content">
      	<div class="tab-pane active" id="tab_1">
	        <div class="row">
	        	<?php if($marcaimg != null): ?>
	        	<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead class="colorTitulo">
							<th style="width: 40px;">#</th>
							<th style="width: 80px;" class="hidden-xs">IMAGEN</th>
							<th style="width: 70px;">OPCION</th>
							<th style="width: 120px;">CODIGO</th>
							<th>DESCRIPCION</th>
							<th style="width: 200px;">NOMBRE IMAGEN</th>
						</thead>
						<?php $__currentLoopData = $marcaimg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td class="hidden-xs">
		                		<div align="center">
		                			<img src="<?php echo e(asset('/public/storage/'.NombreImagenMarca($m->codmarca))); ?>" style="width: 120px;" class="img-responsive">
		                		</div>
		                	</td>
							<td>
								<!-- ELIMINAR IMAGENES -->
								<a href="" data-target="#modal-delete-<?php echo e($m->codmarca); ?>" data-toggle="modal">
									<button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip" title="Eliminar imagen">
									</button>
								</a>
							</td>
							<td><?php echo e($m->codmarca); ?></td>
							<td><?php echo e($m->desmarca); ?></td>
							<td><?php echo e($m->nomimagen); ?></td>
						</tr>
						<?php echo $__env->make('seped.marcaimg.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				</div>
				<?php endif; ?>
	      	</div>
	    </div>
	    <div class="tab-pane" id="tab_2">
	        <div class="row">
	        	<?php if($marca != null): ?>
	        	<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead class="colorTitulo">
							<th style="width: 40px;">#</th>
							<th>DESCRIPCION</th>
						</thead>
						<?php $__currentLoopData = $marca; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->iteration); ?></td>
							<td><?php echo e($m->codmarca); ?></td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				</div>
				<?php endif; ?>
	      	</div>
	    </div>
	</div>
</div>  	

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');

$('.nav-tabs').click(function(event) {
	var x=$(event.target).text();
	var tab = '1';
	if (x == 'IMAGENES') 
		tab = '0';
	var url = "<?php echo e(url('/seped/marcaimg?tab=X')); ?>";
	url = url.replace('X', tab);
	window.location.href=url;
})
$('.nav-tabs li:eq( <?php echo e($tab); ?> ) a').tab('show');


</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/marcaimg/index.blade.php ENDPATH**/ ?>