
<?php $__env->startSection('contenido'); ?>

<div class="row">
	
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
		<div class="form-group">
	        <label>ID</label>
            <input readonly type="text" class="form-control" value="<?php echo e($reg->id); ?>" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
		<div class="form-group">
	        <label>Remite</label>
            <input readonly type="text" class="form-control" value="<?php echo e($reg->remite); ?> <?php echo e($cfg->nombre); ?>" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
		<div class="form-group">
	        <label>Tipo</label>
            <input readonly type="text" class="form-control" value="<?php echo e($reg->tipo); ?>" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Fecha envio</label>
            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($reg->fecha))); ?>" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-xs-12">
		<div class="form-group">
	        <label>Asunto</label>
            <textarea readonly rows="5" style="width: 100%; color: #000000; background: #F7F7F7;"><?php echo e($reg->asunto); ?></textarea>
	    </div>
    </div>


</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead class="colorTitulo">
            <th style="width: 5%">ITEM</th>
            <th style="width: 85%">DESTINO</th>
            <th style="width: 120px;">LEIDO</th>
        </thead>
      
        <?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
        	<?php if($t->leido > 0): ?>
                <td><?php echo e($t->item); ?></td>
                <td><?php echo e($t->destino); ?> <?php echo e($t->nombre); ?></td>
                <td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fechaleido))); ?></td>
            <?php else: ?>
            	<td><b><?php echo e($t->item); ?></b></td>
                <td><b><?php echo e($t->destino); ?> <?php echo e($t->nombre); ?></b></td>
                <td><b><?php echo e(date('d-m-Y H:i:s', strtotime($t->fechaleido))); ?></b></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
    </table>
</div>

    <div class="form-group">
        <a href="<?php echo e(url('/seped/notiservidor?tab=1')); ?>" class="text-muted">
            <button type="button" class="btn-normal">Regresar</button>
        </a>
    </div> 

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/notiservidor/show.blade.php ENDPATH**/ ?>