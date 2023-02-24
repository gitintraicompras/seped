
<?php $__env->startSection('contenido'); ?>
 
<section class="content" >
	<div class="row" >
	 	<!--- CESTAS POR ENTREGAR --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-1" style="background-color: #f7f7f7;">
	      	<a href="<?php echo e(url('/seped/cestasentregar')); ?>">
	        	<span class="info-box-icon info-box-icon-1 bg-aqua">
	        		<i class="fa fa-shopping-basket"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Cestas</span>
	          <span class="info-box-number">
	          	<?php echo e($cestasxEntregar); ?>

	          	<small>Por entregar</small>
	          </span>
	        </div>
	      </div>
	    </div>
	    &nbsp;
	    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/indexChofer.blade.php ENDPATH**/ ?>