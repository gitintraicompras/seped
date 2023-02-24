
<?php $__env->startSection('contenido'); ?>

<div id="page-wrapper">

	<div class="row">
	    <!-- BUSCAR CLIENTES  -->
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<?php echo $__env->make('seped.clientes.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	</div>   
   
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                   <thead class="colorTitulo">
	                	<th>#</th>
	                	<th style="width: 100px;">OPCION</th>
	                	<th>DESCRIPCION</th>
		                <th>CODIGO</th>
		                <th>RIF</th>
		                <th>TELEFONO</th>
		                <th>CONTACTO</th>
		                <th>ESTADO</th>
		                <th>SUCURSAL</th>
		            </thead>

		            <?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
		                	<td><?php echo e($loop->iteration); ?></td>
		                	<td>

								<!-- VER DETALLES -->
                                <a href="<?php echo e(URL::action('AdclientesController@show',$t->codcli)); ?>">
                                	<button class="btn btn-default  btn-pedido fa fa-file-o" title="Consultar cliente">
                                	</button>
                                </a>


								<a href="<?php echo e(URL::action('AdclientesController@edit',$t->codcli)); ?>">
									<button class="btn btn-default btn-pedido fa fa-pencil" title="Modificar estado del cliente">
									</button>
								</a>


                        	</td>
                        	<td><?php echo e($t->nombre); ?></td>
		                    <td><?php echo e($t->codcli); ?></td>
		                	<td><?php echo e($t->rif); ?></td>
		                	<td><?php echo e($t->telefono); ?></td>
		                	<td><?php echo e($t->contacto); ?></td>
		                	<td><?php echo e($t->estado); ?></td>
		                	<td><?php echo e(sLeercfg($t->codisb, 'SedeSucursal')); ?></td>
		                </tr>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            </table><br>
	            <div align='right'>
					<?php echo e($tabla->render()); ?>

				</div><br>
            </div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
		</div>
	</div>

</div>


<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/clientes/index.blade.php ENDPATH**/ ?>