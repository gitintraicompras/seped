
<?php $__env->startSection('contenido'); ?>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<?php echo $__env->make('seped.provvtas.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div> 

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th>#</th>
					<?php if( $cfg->mostrarImagen > 0 ): ?>
                        <th class="hidden-xs">IMAGEN</th>
                    <?php else: ?>
                        <th class="hidden-xs">OPCION</th>
                    <?php endif; ?>
                    <th title="Descripción de producto">DESCRIPCION</th>
                    <th title="Unidades vendidas">CANTIDAD</th>
                    <th <?php if( $cfg->mostrarCodigo > 0 ): ?>
                            class="hidden-xs" title="Código del producto">
                        <?php else: ?>
                            style="display:none;">
                        <?php endif; ?>
                        CODIGO
                    </th>
                    <th <?php if( $cfg->mostrarBarra > 0 ): ?>
                            class="hidden-xs" title="Código de referencia del producto">
                        <?php else: ?>
                            style="display:none;">
                        <?php endif; ?>
                        BARRA
                    </th>
                    <th>MARCA</th>
                    <th>SUCURSAL</th>
  				</thead>
				<?php $__currentLoopData = $factren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($loop->iteration); ?></td>
					<?php if( $cfg->mostrarImagen > 0): ?>
                        <td class="hidden-xs">
                            <div align="center">
                                <a href="<?php echo e(URL::action('AdreportController@producto',$fr->codprod)); ?>">
                                    <img src="<?php echo e(asset('/public/storage/'.NombreImagen($fr->codprod)  )); ?>" width="50" height="25" class="img-responsive">
                                </a>
                            </div>
                        </td>
                    <?php else: ?>
                        <td class="hidden-xs">
                            <!-- VER DETALLES -->
                            <a href="<?php echo e(URL::action('AdreportController@producto',$fr->codprod)); ?>">
                                <button class="btn btn-default fa fa-file-o" title="Consultar producto">
                                </button>
                            </a>
                        </td>
                    <?php endif; ?>
                    
                    <td><?php echo e($fr->desprod); ?></td>
                    <td align="right">    
                        <?php echo e(number_format($fr->cantidad, 0, '.', ',')); ?>

                    </td>
                    <td <?php if( $cfg->mostrarCodigo > 0 ): ?>
                        class="hidden-xs">
                    <?php else: ?>
                        style="display:none;">
                    <?php endif; ?>
                    <?php echo e($fr->codprod); ?>

                    </td>
                    <td <?php if( $cfg->mostrarBarra > 0 ): ?>
                        class="hidden-xs"> 
                    <?php else: ?>
                        style="display:none;">
                    <?php endif; ?>
                    <?php echo e($fr->referencia); ?>

                    </td>
                    <td><?php echo e($fr->marca); ?></td>
                    <td><?php echo e(sLeercfg($fr->codisb, "SedeSucursal")); ?></td>
				</tr>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/provvtas/index.blade.php ENDPATH**/ ?>