
<?php $__env->startSection('contenido'); ?>

<div id="page-wrapper">
 
 	<div class="form-group">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->codprov); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Descripción</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->nombre); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Rif</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->rif); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->direccion); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->telefono); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Contacto</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->contacto); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->estado); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Dias de credito</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->diascred); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Correo</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->email); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Saldo</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e(number_format($tabla->saldo, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

    </div>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="form-group" style="margin-left: 0px;">
        <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/report/provver.blade.php ENDPATH**/ ?>