
<?php $__env->startSection('contenido'); ?> 

<div class="row">
	
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <a href="<?php echo e(url('/seped/pago/create')); ?>">
            <button class="btn-normal" data-toggle="tooltip" style="font-size: 18px; width: 200px;" title="Crear pago nuevo">
                Pago nuevo
            </button>
        </a>
    </div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<?php echo $__env->make('seped.pago.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead class="colorTitulo">
                    <th>#</th>
                	<th style="width:190px;">OPCION</th>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>ENVIADO</th>
                    <th>PROCESADO</th>
                    <th>ESTADO</th>
                    <th>ORIGEN</th>
                    <th>TOTAL</th>
                    <th>SUCURSAL</th>
                </thead>

	            <?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                  	<td>

                        <?php CalculaTotalesPagos($t->id); ?>
                		<!-- VER RECLAMO -->
                        <a href="<?php echo e(URL::action('AdpagoController@show',$t->id)); ?>">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" 
                                data-toggle="tooltip" 
                                title="Consular Pago">
                        	</button>
                        </a>

                        <!-- DESCARGAR PAGO -->
                        <a href="<?php echo e(URL::action('AdpagoController@descargar',$t->id)); ?>">
                            <button class="btn btn-default btn-pedido fa fa-download" 
                                data-toggle="tooltip" 
                                title="Descargar pago en pdf">
                            </button>
                        </a>

                        <?php if($t->estado == 'NUEVO'): ?> 
                            <!-- MODIFICAR PEDIDO -->
                            <a href="<?php echo e(URL::action('AdpagoController@edit',$t->id)); ?>">
                                <button class="btn btn-default btn-pedido fa fa-pencil" 
                                    data-toggle="tooltip" 
                                    title="Modificar Pago">
                                </button>
                            </a>

                            <!-- ELIMINAR RECLAMO -->
                            <a href="" 
                                data-target="#modal-delete-<?php echo e($t->id); ?>" 
                                data-toggle="modal">
                                <button class="btn btn-default btn-pedido fa fa-trash-o" 
                                    data-toggle="tooltip" 
                                    title="Eliminar Pago">
                                </button>
                            </a>
                        <?php endif; ?>
               
                	</td>
                    <td><?php echo e($t->id); ?></td>
                    <td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecha))); ?></td>
                    <td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecenviado))); ?></td>
                    <td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecprocesado))); ?></td>
                    <?php if($t->estado == 'ENVIADO'): ?>
                        <td style="color: red;"><?php echo e($t->estado); ?></td>
                    <?php else: ?>
                        <td><?php echo e($t->estado); ?></td>
                    <?php endif; ?>
                    <td><?php echo e($t->origen); ?></td>
                    <td align="right"><?php echo e(number_format(SubtotalPago($t->id), 2, '.', ',')); ?></td>
                    <td><?php echo e(sLeercfg($t->codisb, "SedeSucursal")); ?></td>
                </tr>
                <?php echo $__env->make('seped.pago.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table><br>
            <div align='right'>
                <?php echo e($tabla->render()); ?>

            </div><br>
        </div>
 	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pago/index.blade.php ENDPATH**/ ?>