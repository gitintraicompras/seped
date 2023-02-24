
<?php $__env->startSection('contenido'); ?>

<div class="row">
	
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
		<div class="form-group">
	        <label>ID</label>
            <input readonly type="text" class="form-control" value="<?php echo e($reg->id); ?>" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
        <div class="form-group">
            <label>ITEM</label>
            <input readonly type="text" class="form-control" value="<?php echo e($reg->id); ?>" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="form-group">
	        <label>Remite</label>
            <input readonly type="text" class="form-control" value="<?php echo e($reg->remite); ?> <?php echo e($cfg->nombre); ?>" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label>MARCA</label>
            <?php if($reg->leido > 0): ?>
                <input readonly type="text" class="form-control" value="LEIDO" style="color: #000000; background: #F7F7F7;">
            <?php else: ?>
                <input readonly type="text" class="form-control" value="SIN LEER" style="color: #000000; background: #F7F7F7;">
            <?php endif; ?>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Tipo</label>
            <input readonly type="text" class="form-control" value="<?php echo e($reg->tiponoti); ?>" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Fecha envio</label>
            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($reg->fechaenvio))); ?>" style="color: #000000; background: #F7F7F7;">
	    </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label>Fecha leido</label>
            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($reg->fechaleido))); ?>" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-xs-12">
		<div class="form-group">
	        <label>Asunto</label>
            <textarea readonly rows="5" style="width: 100%; color: #000000; background: #F7F7F7;"><?php echo e($reg->asunto); ?></textarea>
	    </div>
    </div>

    <div class="col-xs-12">
        <div class="form-group">
            <a href="<?php echo e(url('/seped/noticliente?tab=1')); ?>" class="text-muted">
                <button type="button" class="btn-normal">Regresar</button>
            </a>
        </div> 
    </div> 
</div>

   

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/noticliente/show.blade.php ENDPATH**/ ?>