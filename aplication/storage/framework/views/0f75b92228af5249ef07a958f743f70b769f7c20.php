
<?php $__env->startSection('contenido'); ?>

<section class="content" >
	<div class="row" >
	 	<!--- PEDIDOS --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-1" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid aqua">
	      	<a href="<?php echo e(url('/seped/monitorpedido')); ?>">
	        	<span class="info-box-icon info-box-icon-1 bg-aqua"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-desktop"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Pedidos</span>
	          <span class="info-box-number">
	          	<?php echo e(number_format($contPedido,0, '.', ',')); ?>

	          	<small>Todos los Pedidos</small>
	          </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>

	    <!--- CATALOGO--->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-2" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid red">
      		<a href="<?php echo e(URL::action('AdcatalogoController@listado','C')); ?>">
	        	<span class="info-box-icon info-box-icon-2 bg-red"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-cubes">
	       		</i></span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Catálogo</span>
	          <span class="info-box-number">
	          <?php echo e(number_format($contCatalogo,0, '.', ',')); ?>

	          <small>Productos</small>
	      	  </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>

	    <div class="clearfix visible-sm-block"></div>

	   	<!--- IMAGENES  --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-3" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid green">
	      	<a href="<?php echo e(url('/seped/prodimg')); ?>">
	        	<span class="info-box-icon info-box-icon-3 bg-green"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-image"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Imagenes</span>
	          <span class="info-box-number">
	          <?php echo e(number_format($contImg,0, '.', ',')); ?>

			  <small>Productos</small>
	      	  </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>

	    <?php if( $cfg->mostrarModnofiscal == '1'): ?> 
    	<!--- CLIENTES NO FISCALES --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-4" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid yellow">
	      	<a href="<?php echo e(url('/seped/clientenofiscal')); ?>">
	        	<span class="info-box-icon info-box-icon-4 bg-yellow"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-money"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">No fiscales</span>
	          <span class="info-box-number">
	          <?php echo e(number_format($contNofiscal,0, '.', ',')); ?>

	          <small>Items</small>
	      	  </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>
	    <?php endif; ?>

	    <div class="clearfix visible-sm-block"></div>

	    <!--- GRUPOS  --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-4" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid aqua">
	      	<a href="<?php echo e(url('/seped/grupo')); ?>">
	        	<span class="info-box-icon info-box-icon-4 bg-aqua"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-users"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Grupos</span>
	          <span class="info-box-number">
	          	<?php echo e(number_format($contGrupo,0, '.', ',')); ?>

	          	<small>Items</small>
	          </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>

	   	<!--- CARACTERISTICAS EXTENDIDAS  --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-1" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid red">
	      	<a href="<?php echo e(url('/seped/caracteristica')); ?>">
	        	<span class="info-box-icon info-box-icon-1 bg-red"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-commenting-o"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Caracteristicas</span>
	          <span class="info-box-number">
	          <?php echo e(number_format($contCatalogo,0, '.', ',')); ?>

			  <small>Productos</small>
	      	  </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>

    	<?php if( $cfg->mostrarModDescarga == '1'): ?> 
    	<!--- CARGAS --->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-2" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid green">
	      	<a href="<?php echo e(url('/seped/carga')); ?>">
	        	<span class="info-box-icon info-box-icon-2 bg-green"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-upload"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Cargas</span>
	          <span class="info-box-number">
	          	<?php echo e(number_format($contCarga,0, '.', ',')); ?>

	          	<small>Items</small>
	          </span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div>

	    <!--- DESCARGAS-->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box info-box-3" 
	      	style="background-color: #f7f7f7;
	      	border-radius: 10px 10px 10px 10px;
	      	border: 1px solid yellow">
	      	<a href="<?php echo e(url('/seped/descarga')); ?>">
	        	<span class="info-box-icon info-box-icon-3 bg-yellow"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-download"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Descargas</span>
	          <span class="info-box-number">
	          <?php echo e(number_format($contCarga,0, '.', ',')); ?>

	          <small>Items</small>
	      	  </span>
	        </div>
	      </div>
	    </div>
	    <?php endif; ?>

	</div>
	&nbsp;
	<br><br><br><br><br><br><br><br><br>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/indexSuper.blade.php ENDPATH**/ ?>