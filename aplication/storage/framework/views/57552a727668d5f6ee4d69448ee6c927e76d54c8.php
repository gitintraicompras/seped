
<?php $__env->startSection('contenido'); ?>


<?php echo Form::model($tabla,['method'=>'PATCH','route'=>['monitorpedido.update',$tabla->id]]); ?>

<?php echo e(Form::token()); ?>


<div class="row">

<div class="form-group">

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label>Id</label>
            <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->id); ?>" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">
            <label>Cliente</label>
            <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->nomcli); ?>" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

    <!-- VOLVER ACTIVAR PEDIDO -->
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
	    	<label>Estatus</label>
	    	<select name="estado" class="form-control">
	    		<?php if($tabla->estado == 'ENVIADO'): ?>
		    		<option value="ENVIADO" selected>ENVIADO</option>
		    		<option value="ANULADO">ANULADO</option>
	    		<?php else: ?>
		    		<option value="ENVIADO">ENVIADO</option>
                    <option value="ANULADO" selected>ANULADO</option>
	    		<?php endif; ?>
	    	</select>
	    </div>
    </div>
</div>

</div>

<!-- BOTON GUARDAR/CANCELAR -->
<div class="form-group" style="margin-top: 20px;">
    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
	<button class="btn-confirmar" type="submit">Guardar</button>
</div>

<?php echo e(Form::close()); ?>


<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/monitorpedido/edit.blade.php ENDPATH**/ ?>