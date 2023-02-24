
<?php $__env->startSection('contenido'); ?>
<section class="content" >
	 <!-- Info boxes -->
	<div class="row" >

		<!-- CATALOGO -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
      		border-radius: 10px 10px 10px 10px;
      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdcatalogoController@listado','C')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px; ">
	        		<i class="fa fa-cubes"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">Catálogo</span>
	          <span class="info-box-number">
	          	Catálogo de Productos 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- PROVEEDORES -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdreportController@proveedores')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px; ">
	        		<i class="fa fa-truck"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">PROVEEDORES</span>
	          <span class="info-box-number">
	          	Tabla de Proveedores 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- FACTURAS -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdreportController@facturas')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-building-o"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">FACTURAS</span>
	          <span class="info-box-number">
	          	Facturas de Ventas 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- CUENTAS X COBRAR -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdestadoctaController@index')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-cc"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">CXC</span>
	          <span class="info-box-number">
	          	Cuentas por Cobrar 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- CUENTAS X PAGAR -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdreportController@cxps')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-thumbs-up"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">CXP</span>
	          <span class="info-box-number">
	          	Cuentas por Pagar 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- VENDEDORES -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdreportController@vendedores')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-tags"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">VENDEDORES</span>
	          <span class="info-box-number">
	          	Tabla de Vendedores 
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- CUENTAS BANCARIAS -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdreportController@ctabancos')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-bars"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">CUENTAS</span>
	          <span class="info-box-number">
	          	Tablas cuentas Bancarias
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

	    <!-- MONEDAS -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdreportController@monedas')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-money"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">MONEDAS</span>
	          <span class="info-box-number">
	          	Tasas cambiaria
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

   	    <!-- BUSQUEDAS -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(url('/seped/busquedas')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-list-alt"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">BUSQUEDAS</span>
	          <span class="info-box-number">
	          	Productos más buscados
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>

        <!-- RESUMEN DE OPERACIONES -->
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(URL::action('AdreportController@resumen')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-bar-chart"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">RESUMEN</span>
	          <span class="info-box-number">
	          	Resumen Operaciones
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>


	    <!-- CONSIGNACION DE PROVEEDORES -->
	    <?php if($cfg->mostrarModProveedor > 0): ?>
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(url('/seped/provvtas')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa">&#xf2b5;</i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">PROVEEDORES</span>
	          <span class="info-box-number">
	          	Consignación de Mercancia
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>
	    <?php endif; ?>

	    <!-- NOTIFICACION DE ENTRADAS DE FALLAS -->
	    <?php if($cfg->mostrarModNotificacion > 0): ?>
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(url('/seped/notiservidor')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-bell"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">NOTIFICACION</span>
	          <span class="info-box-number">
	          	Modulo de Notificaciones
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>
	    <?php endif; ?>
	    
	    <!-- HISTORIAL DE CESTAS -->
	    <?php if($cfg->mostrarModCesta > 0): ?>
	    <div class="col-md-6 col-sm-12 col-xs-12">
	      <div class="info-box" 
	      	style="background-color: #f7f7f7; 
	      		border-radius: 10px 10px 10px 10px;
	      		border: 1px solid #CCCCCC;">
	      	<a href="<?php echo e(url('/seped/cestasentregar')); ?>">
	        	<span class="info-box-icon bg-aqua colorTitulo"
	        		style="border-radius: 10px 0px 0px 10px;">
	        		<i class="fa fa-shopping-basket"></i>
	        	</span>
	    	</a>
	        <div class="info-box-content">
	          <span class="info-box-text">CESTAS</span>
	          <span class="info-box-number">
	          	Seguimientos de Cestas
	          	<br>
	          	<small></small>
	          </span>
	        </div>
	      </div>
	    </div>
	    <?php endif; ?>

	</div>
</section>

    
<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/report/index.blade.php ENDPATH**/ ?>