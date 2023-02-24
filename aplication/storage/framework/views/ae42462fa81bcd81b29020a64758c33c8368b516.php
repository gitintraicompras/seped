
<?php $__env->startSection('contenido'); ?>

<section class="content" >
	 <!-- Info boxes -->
	<div class="row">
		<?php $__currentLoopData = $carga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    <div class="col-md-6 col-sm-12 col-xs-12" >
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AddescargaController@show',$c->id)); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px !important;">
	        		<i class="fa fa-download"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">
	          	<?php echo e($c->ruta); ?>

	          </span>
	          <span class="info-box-number">
	          	<?php echo e($c->descrip); ?> 
	          	<br>
	          	<small>
	          		(<?php echo e(number_format($c->contdescarga, 0, '.', ',')); ?>) descargas
	          	</small>
	          </span>
	        </div>
	      </div>
	    </div>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/descargas/index.blade.php ENDPATH**/ ?>