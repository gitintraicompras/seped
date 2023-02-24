
<?php $__env->startSection('contenido'); ?>
  
<section class="content" >
	 <!-- Info boxes -->
	<div class="row" >

		<!-- CFG-->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid #CCCCCC;">
			<a href="<?php echo e(URL::action('AdconfigController@edit','1')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px; ">
	        		<i class="fa fa-gear"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Parametros</span>
	          <span class="info-box-number">
	          	Configuración del Seped 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- RECLAMOS -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(url('/seped/config/reclamo')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px; ">
	        		<i class="fa fa-phone-square"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">RECLAMOS</span>
	          <span class="info-box-number">
	          	Tabla de Motivos 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- CUENTAS DE BANCOS -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(url('/seped/config/cuenta')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px; ">
	        		<i class="fa fa-bars"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">CUENTAS</span>
	          <span class="info-box-number">
	          	Cuentas de Bancos 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- EDITAR LITERALES -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(url('/seped/config/literales')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px; ">
	        		<i class="fa fa-pencil-square-o"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">LITERALES</span>
	          <span class="info-box-number">
	          	Editar Literales 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- EDITAR TABLA DE LITERALES DE TRANSPORTE-->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdtransplitController@index','')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px; ">
	        		<i class="fa fa-text-width"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">TRANSPORTE</span>
	          <span class="info-box-number">
	          	Tabla de Literales de transporte
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>
 
	</div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/config/index.blade.php ENDPATH**/ ?>