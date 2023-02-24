
<?php $__env->startSection('contenido'); ?>

 
<?php echo Form::model($tabla,['method'=>'PATCH','route'=>['clientes.update',$tabla->codcli]]); ?>

<?php echo e(Form::token()); ?>


<div class="row">
    <div class="form-group">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Código</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e($tabla->codcli); ?>" style="color: #000000; background: #F7F7F7;">
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
                <label>Limite de credito</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e(number_format($tabla->limite, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Saldo</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e(number_format($tabla->saldo, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Vencido</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e(number_format($tabla->vencido, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Dias de credito</label>
                <input type="text" class="form-control" readonly="" value="<?php echo e(number_format($tabla->dcredito, 0, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label>Status</label>
                <select name="estado" class="form-control">
                    <?php if($tabla->estado == 'ACTIVO'): ?>
                        <option value="ACTIVO" selected>ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    <?php else: ?>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO" selected>INACTIVO</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group" style="padding-top: 25px;">
                <div class="form-check">
                    <input type="checkbox" name="critSepMoneda" 
                    <?php if($tabla->critSepMoneda): ?> checked <?php endif; ?> />
                    <span class="text">Activar separación de pedidos por tipo de moneda del producto</span>
                    <small class="label label-danger"><i class="fa fa-clock-o"></i>
                    Función
                    </small>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group" style="padding-top: 25px;">
                <div class="form-check">
                    <input type="checkbox" name="codisbactivo" 
                    <?php if($tabla->codisbactivo): ?> checked <?php endif; ?> />
                    <span class="text">Activar cliente para la Sucursal</span>
                    <small class="label label-danger"><i class="fa fa-clock-o"></i>
                    Función
                    </small>
                </div>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/clientes/edit.blade.php ENDPATH**/ ?>