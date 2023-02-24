
<?php $__env->startSection('contenido'); ?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php echo $__env->make('seped.provfact.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th>#</th>
                    <th style="width: 50px;">OPCION</th>
                    <th>FACTURA</th>
                    <th>CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th style="width: 100px;">FECHA</th>
                    <th>MONTO</th>
                    <th>IVA</th>
                    <th>TOTAL</th>
                    <th>SUCURSAL</th>
	          	</thead>
				<?php $__currentLoopData = $fact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($loop->iteration); ?></td>
					<td>
                        <!-- VER FACTURA -->
                        <a href="<?php echo e(URL::action('AdprovfactController@show',$f->factnum)); ?>">
                            <button 
                            class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip" title="Consular Factura">
                            </button>
                        </a>
                    </td>
                    <td><?php echo e($f->factnum); ?></td>
                    <td><?php echo e($f->codcli); ?></td>
			        <td><?php echo e($f->descrip); ?></td>
                    <td><?php echo e(date('d-m-Y H:i:s', strtotime($f->fecha))); ?></td>

                    <?php
                    $monto = 0;
                    $imp = 0;
                    $factren = DB::table('factren')
                    ->select(DB::raw('sum(subtotal) as subtotal'), DB::raw('sum(impuesto) as imp'))
                    ->where('factnum','=',$f->factnum)
                    ->where('marca','LIKE','%'.$codmarca.'%')
                    ->first();
                    if ($factren) {
                        $monto = $factren->subtotal;
                        $imp = $factren->imp;
                    }
                    ?>

                    <td align="right">    
                    	<?php echo e(number_format($monto, 2, '.', ',')); ?>

                    </td>
                    <td align="right">    
                        <?php echo e(number_format($imp, 2, '.', ',')); ?>

                    </td>
                    <td align="right">    
                        <?php echo e(number_format($monto + $imp, 2, '.', ',')); ?>

                    </td>
                    <td><?php echo e(sLeercfg($f->codisb, "SedeSucursal")); ?></td>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/provfact/index.blade.php ENDPATH**/ ?>