
<?php $__env->startSection('contenido'); ?>

<div class="row">

	<?php echo Form::open(array('url'=>'/seped/grupo','method'=>'POST','autocomplete'=>'off')); ?>

	<?php echo e(Form::token()); ?>



	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
	        <label>Nombre del Grupo</label>
            <input type="text" class="form-control" name="nomgrupo" value="<?php echo e(old('nomgrupo')); ?>">
	    </div>
    </div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
			<button class="btn-confirmar" type="submit">Crear</button>
			
		</div>
	</div>

	<?php echo e(Form::close()); ?>


</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/grupo/create.blade.php ENDPATH**/ ?>