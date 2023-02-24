
<?php $__env->startSection('contenido'); ?>
 
<section class="content" >
	<div class="row" >
	 	<!--- CATALOGO --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-1" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid aqua;">
	      	<a href="<?php echo e(url('/seped/provcata')); ?>">
	        	<span class="info-box-icon info-box-icon-1 bg-aqua"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-cubes"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Catálogo</span>
	          <span class="info-box-number">
	          	<?php echo e(number_format($contCata,0, '.', ',')); ?>

	          	<small>Productos</small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!--- FACTURAS --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-2" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid red;">
	      	<a href="<?php echo e(url('/seped/provfact')); ?>">
	        	<span class="info-box-icon info-box-icon-2 bg-red"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-building-o"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Facturas</span>
	          <span class="info-box-number">
	          <?php echo e(number_format($contFact,0, '.', ',')); ?>

	          <small>Ultimo 7 dias</small>
	      	  </span>
	        </div>
	      </div>
	    </div>

	    <div class="clearfix visible-sm-block"></div>

	    <!--- MAS VENDIDOS --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-3" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid green;">
	      	<a href="<?php echo e(url('/seped/provvtas')); ?>">
	        	<span class="info-box-icon info-box-icon-3 bg-green"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-tags"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Ventas</span>
	          <span class="info-box-number">
	          <small>Productos más vendidos</small>
	      	  </span>
	        </div>
	      </div>
	    </div>
 
	    <!--- CONFIGURACION --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-4" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid yellow;">
	      	<a href="<?php echo e(url('/seped/provconf')); ?>">
	        	<span class="info-box-icon info-box-icon-4 bg-yellow"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-gear"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Configuración</span>
	          <span class="info-box-number">
	          <small>Información del proveedor</small>
	      	  </span>
	        </div>
	      </div>
	    </div>
	    &nbsp;
	    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	 	
	</div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/indexProveedor.blade.php ENDPATH**/ ?>