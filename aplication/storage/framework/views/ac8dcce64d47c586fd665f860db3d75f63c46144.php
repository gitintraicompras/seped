
<?php $__env->startSection('contenido'); ?>

<div class="row">

	<?php echo Form::open(array('url'=>'/seped/pedcrisep','method'=>'POST','autocomplete'=>'off')); ?>

	<?php echo e(Form::token()); ?>



	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	        <label>Descripción</label>
            <input type="text" class="form-control" name="descrip" value="<?php echo e(old('descrip')); ?>">
	    </div>
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<div class="form-group">
	        <label>Criterio</label>
            <input type="text" class="form-control" name="criterio" value="<?php echo e(old('criterio')); ?>">
	    </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
	        <label>Días crédito</label>
            <input type="number" class="form-control" name="diasCredito" value="0">
	    </div>
    </div>

    <!-- ACTIVAR/INACTIVAR CLIENTE -->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
	    	<label>Estado</label>
	    	<select name="estado" class="form-control">
		   		<option value="ACTIVO" selected>ACTIVO</option>
		   		<option value="INACTIVO">INACTIVO</option>
	    	</select>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pedcrisep/create.blade.php ENDPATH**/ ?>