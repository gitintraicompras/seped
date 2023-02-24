
<?php $__env->startSection('contenido'); ?>

<div class="row">

	<?php echo Form::open(array('url'=>'/seped/promdias','method'=>'POST','autocomplete'=>'off')); ?>

	<?php echo e(Form::token()); ?>


	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
	        <label>Nombre de la Promoción</label>
            <input type="text" 
            	class="form-control" 
            	name="descrip" 
            	value=""
            	autofocus>
	    </div> 
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
            <label>Dias</label>
            <input type="text" 
            	class="form-control" 
            	name="dias"
            	value="14" >
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
            <label>Desde</label>
            <input type="date" 
            	class="form-control" 
            	name="desde"
            	value="<?php echo e(date('Y-m-d')); ?>" >
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <div class="form-group">
            <label>Hasta</label>
            <input type="date" 
            	class="form-control" 
            	name="hasta"
            	value="<?php echo e(date('Y-m-d')); ?>" >
        </div>
    </div>

   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="form-group">
			<br>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/promdias/create.blade.php ENDPATH**/ ?>