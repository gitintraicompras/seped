
<?php $__env->startSection('contenido'); ?>

<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label>Id</label>
            <input readonly type="text" class="form-control" name="id" value="<?php echo e($grupo->id); ?>" style="color: #000000; background: #F7F7F7;">
        </div>
    </div>

	<div class="col-xs-8">
		<div class="form-group">
	        <label>Nombre</label>
            <input readonly type="text" class="form-control" name="nomgrupo" value="<?php echo e($grupo->nomgrupo); ?>" >
 	    </div>
    </div>
</div>

<div class="row" style="margin-bottom: 10px;"> 
    <div class="col-xs-12">
        <?php echo $__env->make('seped.grupo.gruporen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead class="colorTitulo">
                    <th style="width: 50px;">#</th>
                    <th style="width: 50px;"></th>
                    <th style="width: 50px;">CODIGO</th>
                    <th>CLIENTE</th>
                    <th>SUCURSAL</th>
                </thead>
                <?php $__currentLoopData = $gruporen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                        <a href="" data-target="#modal-delete-<?php echo e($gr->id); ?>-<?php echo e($gr->codcli); ?>" data-toggle="modal">
                            <button 
                                class="btn btn-default btn-pedido fa fa-trash-o" title="Eliminar cliente">
                            </button>
                        </a>
                    </td>
                    <td><?php echo e($gr->codcli); ?></td>
                    <td><?php echo e($gr->nomcli); ?></td>
                    <td><?php echo e(sLeercfg($gr->codisb, "SedeSucursal")); ?></td>
                </tr>
                <?php echo $__env->make('seped.grupo.delcli', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/grupo/edit.blade.php ENDPATH**/ ?>