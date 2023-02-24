
<?php $__env->startSection('contenido'); ?>
<?php
$contCesta = 0;
?>
 
<div id="page-wrapper">

	<!-- TABLA DE CESTAS POR ENTREGAR -->
	<div class="row" >
		<div class="col-xs-12" >
			<div class="table-responsive" >
				<table id="idtabla" 
					   class="table table-striped table-bordered table-condensed table-hover">
					<thead class="colorTitulo">
						<th style="width:140px;">CESTA</th>
						<th>PEDIDO</th>
		 	            <th style="width: 100px;">FECHA</th>
         				<th>CLIENTE</th>
         				<th>SUCURSAL</th>
					</thead>
					<?php $__currentLoopData = $cestas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr >
                        <td>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group" >
                                <input readonly 
                                	style="width: 130px;" 
                                	value="<?php echo e($c->cesta_co); ?>" 
                                	class="form-control" >
                            </div>
                        </td>

						<td><?php echo e($c->pedido_num); ?></td>
						<td><?php echo e(date('d-m-Y', strtotime($c->fecha_rec))); ?></td>
						<td><?php echo e(NombreCliente($c->co_cli)); ?></td>
						<td><?php echo e(sLeercfg($c->codisb, "SedeSucursal")); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</table>
			</div>
		</div>
	</div>
	
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/cestasentregar/index.blade.php ENDPATH**/ ?>