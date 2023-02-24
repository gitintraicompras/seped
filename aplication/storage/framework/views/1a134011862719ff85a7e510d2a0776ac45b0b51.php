
<?php $__env->startSection('contenido'); ?>

<div id="page-wrapper">
 
    <div class="form-group">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input readonly  type="text" class="form-control"  value="<?php echo e($tabla2->codcli); ?>" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Cliente</label>
                <input readonly  type="text" class="form-control"  value="<?php echo e($tabla2->nombre); ?>" style="background: #F7F7F7;" >
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Número</label>
                <input readonly  type="text" class="form-control"  value="<?php echo e($tabla->tipocxc); ?> - <?php echo e($tabla->numerod); ?>" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Total Operación</label>
                <input readonly type="text" class="form-control"  value="<?php echo e(number_format($tabla->monto, 2, '.', ',')); ?>" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Número control</label>
                <input readonly  type="text" class="form-control"  value="<?php echo e($tabla->nroctrol); ?>" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Comentario</label>
                <input readonly  type="text" class="form-control"  value="<?php echo e($tabla->notas1); ?>" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Fecha emisión</label>
                <input readonly  type="text" class="form-control"  value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fechai))); ?>" style="background: #F7F7F7;" >
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Estación</label>
                <input readonly  type="text" class="form-control"  value="<?php echo e($tabla->codesta); ?>" style="background: #F7F7F7;">
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Usuarios</label>
                <input readonly  type="text" class="form-control"  value="<?php echo e($tabla->codusua); ?>" style="background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group" style="margin-left: 0px;">
                <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
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


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/estadocta/show.blade.php ENDPATH**/ ?>