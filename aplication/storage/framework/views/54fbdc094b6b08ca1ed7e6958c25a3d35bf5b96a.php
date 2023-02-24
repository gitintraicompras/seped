
<?php $__env->startSection('contenido'); ?>
 
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<?php echo $__env->make('seped.alcabala.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
</div> 

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead class="colorTitulo">
					<th style ="width:140px;">OPCION</th>
					<th title="Identificador del pedido">PEDIDO</th>
					<th title="Descripción del cliente">CLIENTE</th>
					<th title="Código del cliente">CODIGO</th>
					<th title="Fecha de creación">FECHA</th>
					<th title="Estado del pedido">ESTATUS</th>
					<?php if( $cfg->mostrarModnofiscal > 0 ): ?>
						<th title="Pedido fiscal o No fiscal">FISCAL</th>
					<?php endif; ?>
					<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
						<th title="Monto total del pedido en otra Moneda">TOTAL(<?php echo e($cfg->simboloOM); ?>)</th>
					<?php endif; ?>
					<th title="Monto total del pedido">TOTAL</th>
					<th>SUCURSAL</th>
				</thead>

				<?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<!-- CONSULTA DE PEDIDO -->
                        <a href="<?php echo e(URL::action('AdalcabalaController@show',$t->id)); ?>">
                        	<button class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip" title="Consultar pedido">
                        	</button>
                        </a>

                        <!-- DESCARGAR PEDIDO -->
                        <a href="<?php echo e(URL::action('AdpedidoController@descargar',$t->id)); ?>">
                        	<button class="btn btn-default btn-pedido fa fa-download" data-toggle="tooltip" title="Descargar pedido en pdf">
                        	</button>
                        </a>

						<!-- PRE-APROBAR PEDIDO -->
              			<?php if($t->estado == "POR-APROBAR"): ?>
              			<?php if(Auth::user()->tipo == 'A' || Auth::user()->tipo == 'R'): ?>
							<a href="<?php echo e(URL::action('AdalcabalaController@edit',$t->id)); ?>">
								<button class="btn btn-default btn-pedido fa fa-check" title="Pre-Aprobar pedido">
								</button>
							</a>
						<?php endif; ?>
						<?php if(Auth::user()->tipo == 'V'): ?>
							<a href="<?php echo e(URL::action('AdalcabalaController@edit',$t->id)); ?>">
								<button class="btn btn-default btn-pedido fa fa-search-plus" title="Ver estado crediticio">
								</button>
							</a>
						<?php endif; ?>
						<?php endif; ?>

					</td>
					<td><?php echo e($t->id); ?></td>
					<td><?php echo e($t->cliente); ?></td>
					<td><?php echo e($t->codcli); ?></td>
					<td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecha))); ?></td>
					<?php if($t->estado == 'POR-APROBAR'): ?> 
						<td style="color: red;"><?php echo e($t->estado); ?></td>
					<?php else: ?>
					    <td><?php echo e($t->estado); ?></td>
					<?php endif; ?>
					<?php if( $cfg->mostrarModnofiscal > 0 ): ?>
						<td align="center"><?php echo e(($t->pedfiscal==1) ? 'SI' : 'NO'); ?></td>
					<?php endif; ?>

					<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
						<td align="right" style="color: green">
							<?php echo e(number_format($t->total/$cfg->tasacambiaria, 2, '.', ',')); ?>

						</td>
					<?php endif; ?>

					<td align="right"><?php echo e(number_format($t->total, 2, '.', ',')); ?></td>
					<td><?php echo e(sLeercfg($t->codisb, "SedeSucursal")); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table><br>
	        <?php echo e($tabla->render()); ?>

		</div>
	</div>
</div>


<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
setTimeout('document.location.reload()',30000);
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/alcabala/index.blade.php ENDPATH**/ ?>