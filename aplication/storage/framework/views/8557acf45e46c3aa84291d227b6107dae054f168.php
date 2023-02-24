
<?php $__env->startSection('contenido'); ?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab"><B>BASICA</B></a></li>
      <?php if($sucursal->count() > 1): ?>
      <li><a href="#tab_2" data-toggle="tab"><B>SUCURSALES</B></a></li>
      <?php endif; ?>
      <li class="pull-right"><a href="<?php echo e(url('/seped/config')); ?>" class="text-muted"><i class="fa fa-gear"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
			<div class="row">
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Código</label>
			            <input readonly id="codcli" type="text" class="form-control" name="name" value="<?php echo e($usuario->codcli); ?>" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Nombre</label>
			            <input readonly id="name" type="text" class="form-control" name="name" value="<?php echo e($usuario->name); ?>" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>

				<?php if($usuario->tipo=='C'): ?>
				 	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					    <div class="form-group">
					    	<label>Descripción del cliente</label>
					    	<input readonly type="text" class="form-control"  value="<?php echo !empty($cliven->nombre) ? $cliven->nombre : 'cliente no encontrado'; ?>" style="color: #000000; background: #F7F7F7;">
					    </div>
					</div>
				<?php endif; ?>
				<?php if($usuario->tipo=='V'): ?>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					    <div class="form-group">
					    	<label>Descripción del vendedor</label>
					    	<input readonly type="text" class="form-control" value="<?php echo e($cliven->nombre); ?>" style="color: #000000; background: #F7F7F7;">
					    </div>
					</div>
				<?php endif; ?>
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="form-group">
				        <label for="email">Correo:</label>
			            <input readonly id="email" type="email" class="form-control" name="email" value="<?php echo e($usuario->email); ?>" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="form-group">
				    	<label>Tipo usuario</label>
				    	<?php if($usuario->tipo == "C"): ?>
				    		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="CLIENTE" style="color: #000000; background: #F7F7F7;">
				    	<?php endif; ?>
				    	<?php if($usuario->tipo == "A"): ?>
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="ADMINISTRADOR" style="color: #000000; background: #F7F7F7;">
				    	<?php endif; ?>
				    	<?php if($usuario->tipo == "V"): ?>
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="VENDEDOR" style="color: #000000; background: #F7F7F7;">
				    	<?php endif; ?>
				    	<?php if($usuario->tipo == "G"): ?>
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="GRUPO" style="color: #000000; background: #F7F7F7;">
				    	<?php endif; ?>
				    	<?php if($usuario->tipo == "R"): ?>
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="CREDITO Y COBRANZA" style="color: #000000; background: #F7F7F7;">
				    	<?php endif; ?>
				    	<?php if($usuario->tipo == "S"): ?>
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="SUPERVISOR" style="color: #000000; background: #F7F7F7;">
				    	<?php endif; ?>
				    	<?php if($usuario->tipo == "T"): ?>
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="CHOFER" style="color: #000000; background: #F7F7F7;">
				    	<?php endif; ?>
				    	<?php if($usuario->tipo == "P"): ?>
				      		<input readonly id="tipo" type="text" class="form-control" name="tipo" value="PROVEEDOR" style="color: #000000; background: #F7F7F7;">
				    	<?php endif; ?>
				    </div>
			    </div>

			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				    <div class="form-group">
				        <label for="estado">Status</label>
			            <input readonly id="estado" type="text" class="form-control" name="estado" value="<?php echo e($usuario->estado); ?>" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>

			    <?php if(Auth::user()->tipo == 'A' || Auth::user()->tipo == 'S'): ?>
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Clave</label>
			            <input readonly id="clave" type="text" class="form-control" name="name" value="<?php echo e($usuario->clave); ?>" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Sucursal predeterminada</label>
			            <input readonly 
			            	type="text" 
			            	class="form-control" 
			            	value="<?php echo e(sLeercfg($usuario->codisbpredet, 'SedeSucursal')); ?>" 
			            	style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>
			    <?php endif; ?>

			    <?php if(Auth::user()->tipo == 'R' && $usuario->tipo != "A"): ?>
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="form-group">
				        <label>Clave</label>
			            <input readonly id="clave" type="text" class="form-control" name="name" value="<?php echo e($usuario->clave); ?>" style="color: #000000; background: #F7F7F7;">
				    </div>
			    </div>
			    <?php endif; ?>

				<?php if($usuario->tipo == "V"): ?>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group" style="padding-top: 25px;">
					    	<div class="form-check">
								<?php if($usuario->vendsuper==1): ?>
							    	<input disabled checked type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
							    <?php else: ?>
							    	<input disabled type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
							    <?php endif; ?>
							    <label class="form-check-label" for="materialUnchecked">Vendedor supervisor</label>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="form-group" style="padding-top: 25px;">
					    	<div class="form-check">
								<?php if($usuario->cambiarNegociacion==1): ?>
							    	<input disabled checked type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
							    <?php else: ?>
							    	<input disabled type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
							    <?php endif; ?>
							    <label class="form-check-label" for="materialUnchecked">Cambiar precios</label>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="tab-pane" id="tab_2">
			<div class="table-responsive">
                <table id="idtabla" 
                    class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <th style="width: 100px;">ACTIVO</th>
                        <th style="width: 100px;">PREDET</th>
                    </thead>
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $predet = 0;
                    if ($usuario->codisbpredet == $suc->codisb) {
                        $predet = 1;
                    }
                    ?>
                    <tr>
                        <td><?php echo e($suc->codisb); ?></td>
                        <td><?php echo e(sLeercfg($suc->codisb, "SedeSucursal")); ?></td>
                        <td>
                          <?php if($suc->codisbactivo==1): ?> 
                          	<i class="fa fa-check" aria-hidden="true"></i> 
                          <?php endif; ?> 
                        </td>
                        <td>
                        	<?php if($predet==1): ?> 
                        		<i class="fa fa-check" aria-hidden="true"></i>
                        	<?php endif; ?> 
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table><br>
            </div>
		</div>
	</div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/usuario/show.blade.php ENDPATH**/ ?>