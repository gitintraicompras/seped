
<?php $__env->startSection('contenido'); ?>

<?php echo Form::open(array('url'=>'/seped/marcaimg','method'=>'POST','autocomplete'=>'off', 'enctype'=>'multipart/form-data')); ?>

<?php echo e(Form::token()); ?>


<div class="container">
    <p>&nbsp;</p>
    <div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3">
			<center>
			<i class="fa fa-upload color3 lcolor5" style="font-size: 120px;"></i>
			</center>
    	</div>
		<div class="col-lg-9 col-md-9 col-sm-9" style="width: 60%;">
			<div class="row">
				<div>
					<img src="<?php echo e(asset('images/linea.png')); ?>" class="img-responsive">
				</div>
				<p><strong>SUBIR ARCHIVO</strong></p>
		  		<p align="justify">Seleccione el nombre del archivo que desea subir al portal web</p> 
			</div>   
			<div class="row">
				<div class="form-group">
					<input type="file" name="linkarchivo">
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<div class="col-xs-12 input-group input-group-sm">
						<label>Código:</label>						
				    	<select name="codmarca" class="form-control selectpicker" data-live-search="true">
				    		<?php $__currentLoopData = $marca; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				    			<option value="<?php echo e($m->codmarca); ?>"><?php echo e($m->codmarca); ?></option>
				    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    	</select>
					</div>
				</div>

				<div class="form-group">
			        <label>Descripción de la marca:</label>
		            <input type="text" class="form-control" name="desmarca" value="" >
			    </div>
		
			</div>
		</div>
	</div>
</div>

<br><br>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="form-group">
		<div class="form-group">
		    <button type="button" class="btn-normal" onclick="history.back(-1)" data-toggle="tooltip" title="Regresar">
		    Regresar
			</button>
			<button class="btn-confirmar" type="submit" data-toggle="tooltip" title="Subir imagen">
			Subir
			</button>
		</div>
	</div>
</div>
<?php echo e(Form::close()); ?>



<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/marcaimg/create.blade.php ENDPATH**/ ?>