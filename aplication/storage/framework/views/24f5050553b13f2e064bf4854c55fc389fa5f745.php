
<?php $__env->startSection('contenido'); ?>

<div id="page-wrapper">
 
 	<div class="form-group">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla2->codprov); ?>" style="color: #000000; background: #F7F7F7;" >
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Descipción</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla2->nombre); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Número</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->tipocxp); ?> - <?php echo e($tabla->numerod); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Total operación</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e(number_format($tabla->monto, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;" >
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Número control</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->nroctrol); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Comentario</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->notas1); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Fecha emisión</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fechai))); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Estación</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->codesta); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->codusua); ?>" style="color: #000000; background: #F7F7F7;">
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


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/report/cxpver.blade.php ENDPATH**/ ?>