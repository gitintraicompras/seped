
<?php $__env->startSection('contenido'); ?>

<div id="page-wrapper">
 
 	<div class="form-group">
        <div style="margin-bottom: 10px; margin-top: 10px;" class="input-group input-group-sm">
            <span class="input-group-addon">Factura:</span>
            <input readonly type="text" class="form-control" value="<?php echo e($tabla->factnum); ?>" style="color: #000000; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
		    <span class="input-group-addon">Fecha:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

			<span class="input-group-addon" style="border:0px; "></span>     
            <span class="input-group-addon">Código:</span>
            <input readonly type="text" class="form-control" value="<?php echo e($tabla->codcli); ?>" style="color: #000000; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Cliente:</span>
            <input readonly type="text" class="form-control" value="<?php echo e($tabla->descrip); ?>" style="color: #000000; background: #F7F7F7;">
        </div>

        <div style="margin-bottom: 10px;" class="input-group input-group-sm">

            <span class="input-group-addon">Monto:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->monto, 2, '.', ',')); ?>" style="color: #000000;  background: #F7F7F7; text-align: right;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Iva:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->iva, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7;  background: #F7F7F7; text-align: right;">

			<span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Gravable:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->gravable, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Descuento:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->descuento, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Total:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;">
        </div>
    </div>

    <div  class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead class="colorTitulo">
                <th>#</th>
                <th>CODIGO</th>
                <th>DESCRIPCION</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>SUBTOTAL</th>
                <th>REFERENCIA</th>
            </thead>
          
            <?php $__currentLoopData = $tabla2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($t->codprod); ?></td>
                <td><?php echo e($t->desprod); ?></td>
                <td align="right"><?php echo e(number_format($t->cantidad, 0, '.', ',')); ?></td>
                <td align="right"><?php echo e(number_format($t->precio, 2, '.', ',')); ?></td>
                <td align="right"><?php echo e(number_format($t->subtotal, 2, '.', ',')); ?></td>
                <td><?php echo e($t->referencia); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
        </table>
    </div>

	<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/report/factver.blade.php ENDPATH**/ ?>