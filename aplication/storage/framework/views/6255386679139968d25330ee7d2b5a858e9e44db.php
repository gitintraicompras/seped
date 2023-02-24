
<?php $__env->startSection('contenido'); ?>

<?php if(count($errors)>0): ?>
<div class="alert alert-danger">
	<ul>
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li><?php echo e($error); ?></li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>
<?php endif; ?>

<?php echo Form::model($usuario,['method'=>'PATCH','route'=>['usuario.update',$usuario->id]]); ?>

<?php echo e(Form::token()); ?>

<input hidden="" name="tipo" value="<?php echo e($usuario->tipo); ?>" >
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1" data-toggle="tab"><B>BASICA</B></a></li>
      <?php if($sucursal->count() > 1): ?>
      <li><a href="#tab_2" data-toggle="tab"><B>SUCURSALES</B></a></li>
      <?php endif; ?>
      <li class="pull-right">
        <a href="<?php echo e(url('/seped/config')); ?>" class="text-muted">
            <i class="fa fa-window-close-o"></i>
        </a>
      </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Código</label>
                        <input readonly 
                            id="codcli" 
                            type="text" 
                            class="form-control" 
                            name="codcli" 
                            value="<?php echo e($usuario->codcli); ?>" 
                            style="color: #000000; background: #F7F7F7;">
                    </div>
                </div>

                <!-- NOMBRE DEL USUARIO (IDENTIFICADOR) -->
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            		<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
            	        <label for="name">Nombre</label>
                        <input id="name" type="text" class="form-control" name="name" value="<?php echo e($usuario->name); ?>" >
                        <?php if($errors->has('name')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('name')); ?></strong>
                            </span>
                        <?php endif; ?>
            	    </div>
                </div>

            	<!-- CORREO -->
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            	    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            	        <label for="email">Correo:</label>
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo e($usuario->email); ?>" >
                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
            	    </div>
                </div>

             	<!-- TIPO DE USUARIO -->
            	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            	    <div class="form-group">
            	    	<label>Tipo usuario</label>
                        <?php if($usuario->tipo=='C'): ?>
                            <input readonly type="text" class="form-control" value="CLIENTE" style="color: #000000; background: #F7F7F7;">
                        <?php endif; ?> 
                        <?php if($usuario->tipo=='A'): ?>
                        	<input readonly type="text" class="form-control" value="ADMINISTRADOR" style="color: #000000; background: #F7F7F7;">
                        <?php endif; ?> 
                        <?php if($usuario->tipo=='V'): ?>
                           	<input readonly type="text" class="form-control" value="VENDEDOR" style="color: #000000; background: #F7F7F7;">
                        <?php endif; ?>
                        <?php if($usuario->tipo=='G'): ?>
                            <input readonly type="text" class="form-control" value="GRUPO" style="color: #000000; background: #F7F7F7;">
                        <?php endif; ?>  
                        <?php if($usuario->tipo=='S'): ?>
                            <input readonly type="text" class="form-control" value="SUPERVISOR" style="color: #000000; background: #F7F7F7;">
                        <?php endif; ?>  
                        <?php if($usuario->tipo=='R'): ?>
                            <input readonly type="text" class="form-control" value="CREDITO Y COBRANZA" style="color: #000000; background: #F7F7F7;">
                        <?php endif; ?>
                        <?php if($usuario->tipo=='P'): ?>
                            <input readonly type="text" class="form-control" value="PROVEEDOR" style="color: #000000; background: #F7F7F7;">
                        <?php endif; ?>
                        <?php if($usuario->tipo=='T'): ?>
                            <input readonly type="text" class="form-control" value="CHOFER" style="color: #000000; background: #F7F7F7;">
                        <?php endif; ?>  
                    </div>
                </div>

                <!-- ACTIVAR/INACTIVAR USUARIO -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            		<div class="form-group">
            	    	<label>Status</label>
            	    	<select name="estado" class="form-control">
            	    		<?php if($usuario->estado == 'ACTIVO'): ?>
            		    		<option value="ACTIVO" selected>ACTIVO</option>
            		    		<option value="INACTIVO">INACTIVO</option>
            	    		<?php else: ?>
            		    		<option value="ACTIVO">ACTIVO</option>
            		    		<option value="INACTIVO" selected>INACTIVO</option>
            	    		<?php endif; ?>
            	    	</select>
            	    </div>
                </div>

                <?php if($usuario->tipo == "V"): ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group" style="padding-top: 25px;">
                            <div class="form-check">
                                <?php if($usuario->vendsuper==1): ?>
                                    <input checked name="vendsuper" type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
                                <?php else: ?>
                                    <input name="vendsuper" type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
                                <?php endif; ?>
                                <label class="form-check-label" for="materialUnchecked">Vendedor supervisor</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group" style="padding-top: 25px;">
                            <div class="form-check">
                                <?php if($usuario->cambiarNegociacion==1): ?>
                                    <input checked name="cambiarNegociacion" type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
                                <?php else: ?>
                                    <input name="cambiarNegociacion" type="checkbox" class="form-check-input" style="color: #000000; background: #F7F7F7;">
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
                        <th style="width: 100px;">ACTIVAR</th>
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
                            <input type="checkbox" 
                                class="BtnModcuenta" 
                                name="codisbactivo[<?php echo e($suc->codisb); ?>]"
                                <?php if($suc->codisbactivo==1): ?> checked <?php endif; ?> />
                        </td>
                        <td>
                            <input type="checkbox" 
                                class="BtnModcuenta case"  
                                name="predeter[<?php echo e($suc->codisb); ?>]"
                                onclick='clickmodpredet(event);'
                                id='idcheck_<?php echo e($suc->codisb); ?>'
                                <?php if($predet==1): ?> checked <?php endif; ?> />
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table><br>
            </div>
        </div>
    </div>
</div>

<!-- BOTON REGRESAR/GUARDAR -->
<div class="form-group" style="margin-top: 20px;">
    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
	<button class="btn-confirmar" type="submit">Guardar</button>
</div>
<?php echo e(Form::close()); ?>


<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
if ($(".case").length == $(".case:checked").length) {
    $("#selectall").prop("checked", true);
} else {
    $("#selectall").prop("checked", false);
}
function clickmodpredet(e) {
    var id = e.target.id.split('_');
    var codsuc = id[1];
    $(".case").prop("checked", false);
    $("#idcheck_" + codsuc).prop("checked", true);
}

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/usuario/edit.blade.php ENDPATH**/ ?>