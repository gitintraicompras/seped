
<?php $__env->startSection('contenido'); ?>

<div id="page-wrapper">
	
	<div class="row">
		<!-- BUSCAR FACTURAS  -->
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      		<div class="form-group">
          		<?php echo $__env->make('seped.estadocta.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          	</div> 
	    </div>
	    <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
	    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
     		<div class="form-group">
  				<div class="input-group input-group-sm">
					<span class="input-group-addon" >Total(<?php echo e($cfg->simboloOM); ?>):</span>
					<input readonly 
						type="text" 
						class="form-control" 
						id="idtotDs" 
						value="0.00" 
						style="font-size: 16px; color:green; 
						text-align: right; background: #F7F7F7;"
						placeholder="Monto total">
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
     		<div class="form-group">
  				<div class="input-group input-group-sm">
					<span class="input-group-addon" >Total:</span>
					<input readonly 
						type="text" 
						class="form-control" 
						id="idtotBs" 
						value="0.00" 
						style="font-size: 16px; color: #000000; 
						text-align: right; background: #F7F7F7;" 
						placeholder="Monto total">
				</div>
			</div>
		</div>
		<?php else: ?>
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     		<div class="form-group">
  				<div class="input-group input-group-sm">
					<span class="input-group-addon" >Total:</span>
					<input readonly 
						type="text" 
						class="form-control" 
						id="idtotBs" 
						value="0.00" 
						style="font-size: 16px; color: #000000; text-align: right; 
						background: #F7F7F7;" placeholder="Monto total">
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>   
  	<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
                <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
	                	<th style="width: 40px;">#</th>
	                	<th style="width: 70px;">OPCION</th>
                    	<th style="width: 120px;">DOCUMENTO</th>
	                  	<th>TIPO</th>
	                  	<th>DETALLE</th>
	                    <th style="width: 80px;">EMISION</th>
		                <th style="width: 80px;">VENCE</th>
		                <th>DIAS</th>
		                <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
		                	<th >SALDO(<?php echo e($cfg->simboloOM); ?>)</th>
		                <?php else: ?>
		                	<th style="display:none;"></th>
		                <?php endif; ?>
		                <th>SALDO</th>
		                <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
		                	<th>TASA</th>
		                <?php else: ?>
	                		<th style="display:none;">TASA</th>
	                	<?php endif; ?>
	                	<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
		                	<th>MONEDA</th>
		                <?php else: ?>
	                		<th style="display:none;">MONEDA</th>
	                	<?php endif; ?>
	                	<th>DESCRIPCION</th>
	                	<th>SUCURSAL</th>
	
		            </thead>

		            <?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <tr>
		                	<td><?php echo e($loop->iteration); ?></td>
		                	<td>
		                	    <a href="<?php echo e(URL::action('AdestadoctaController@show',$t->tipocxc.'-'.$t->numerod)); ?>">
		                        	<button class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip" title="Consultar cxp">
		                        	</button>
		                        </a>
 
	                        </td>
		                	<td><?php echo e($t->numerod); ?></td>
	                        <td><?php echo e($t->tipocxc); ?></td>
	                      	<td><?php echo e(substr($t->notas1, 0,30)); ?></td>
		                	<td><?php echo e(date('d-m-Y', strtotime($t->fecha))); ?></td>
		                	<td><?php echo e(date('d-m-Y', strtotime($t->fechai))); ?></td>
		                	<td style="text-align: right;"><?php echo e(DiferenciaDias($t->fechai)); ?></td>
		                	<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
		                		<td align='right' <?php if($t->ccsaldoDs <0): ?> style="color: red;" <?php else: ?> style="color: blue;" <?php endif; ?>>
		                			<?php echo e(number_format($t->ccsaldoDs, 2, '.', ',')); ?>

		                		</td>
		                	<?php else: ?>
		                		<td style="display:none;"></td>
		                	<?php endif; ?>
		    
		                	<td align='right' 
		                		<?php if($t->ccsaldo <0): ?> style="color: red;" <?php else: ?> style="color: blue;" <?php endif; ?>>
		                		<?php echo e(number_format($t->ccsaldo, 2, '.', ',')); ?>

		                	</td>
		                	<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
		                		<td align='right'><?php echo e(number_format($t->factorcambiario, 2, '.', ',')); ?></td>
		                	<?php else: ?>
		                		<td style="display:none;">0.00</td>
		                	<?php endif; ?>
		                	<?php if( $cfg->mostrarPedidoOM > 0 ): ?>
		                		<td align='right'><?php echo e($t->codmoneda); ?></td>
		                	<?php else: ?>
		                		<td style="display:none;"><?php echo e($t->codmoneda); ?></td>
		                	<?php endif; ?>
	                	    <td><?php echo e($t->descrip); ?></td>
	                	    <td><?php echo e(sLeercfg($t->codisb, "SedeSucursal")); ?></td>
		                </tr>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            </table><br>
            </div>
		</div>
	</div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
window.onload = function(){
    var tableReg = document.getElementById('idtabla');
    var totBs = 0.00;
    var totDs = 0.00;

    var venBs = 0.00;
    var venDs = 0.00;


    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var sTipo = cellsOfRow[3].innerHTML;
        var s1 = cellsOfRow[9].innerHTML;
        var s2 = s1.replace(/,/g, '');
        var inv = parseFloat(s2).toFixed(2);
        totBs += parseFloat(inv);

        s1 = cellsOfRow[8].innerHTML;
        s2 = s1.replace(/,/g, '');
        inv = parseFloat(s2).toFixed(2);
        totDs += parseFloat(inv);


    }
    $("#idtotBs").val(number_format(totBs, 2, '.', ','));
    $("#idtotDs").val(number_format(totDs, 2, '.', ','));
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/estadocta/index.blade.php ENDPATH**/ ?>