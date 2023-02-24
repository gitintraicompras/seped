
<?php $__env->startSection('contenido'); ?>

<div id="page-wrapper">
	
    <!-- BUSCAR FACTURAS  -->
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <?php echo $__env->make('seped.report.resumensearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        	<div class="table-responsive">
              <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                	<thead class="colorTitulo">
	                	<th>TABLA</th>
	                  <th>NUMERO</th>
		                <th>TOTAL</th>
                  </thead>
	                <tr>
	                  <td>FACTURAS</td>
                    <td align='right'><?php echo e(number_format($contFact, 0, '.', ',')); ?></td>  
	                	<td align='right'><?php echo e(number_format($totVentas, 2, '.', ',')); ?></td>	
	                </tr>
                  <tr>
                    <td>PEDIDOS ENVIADOS</td>
                    <td align='right'><?php echo e(number_format($contPedEnviado, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totPedEnviado, 2, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PEDIDOS APROBADOS</td>
                    <td align='right'><?php echo e(number_format($contPedAprobado, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totPedAprobado, 2, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PEDIDOS ANULADOS</td>
                    <td align='right'><?php echo e(number_format($contPedAnulado, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totPedAnulado, 2, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PEDIDOS PICKING</td>
                    <td align='right'><?php echo e(number_format($contPedPicking, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totPedPicking, 2, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PEDIDOS PACKING</td>
                    <td align='right'><?php echo e(number_format($contPedPacking, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totPedPacking, 2, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PEDIDOS PEND-FACTURA</td>
                    <td align='right'><?php echo e(number_format($contPedFacturando, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totPedFacturando, 2, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PEDIDOS FACTURADO</td>
                    <td align='right'><?php echo e(number_format($contPedFacturado, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totPedFacturado, 2, '.', ',')); ?></td>  
                  </tr>

                  <tr>
                    <td>RECLAMOS</td>
                    <td align='right'><?php echo e(number_format($contReclamo, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totReclamo, 2, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PAGOS</td>
                    <td align='right'><?php echo e(number_format($contPago, 0, '.', ',')); ?></td>  
                    <td align='right'><?php echo e(number_format($totPago, 2, '.', ',')); ?></td>  
                  </tr>
	            </table>
          </div>
        </div>
		</div>


    <CENTER><H3>TABLAS</H3></CENTER>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
          <div class="table-responsive">
              <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                  <thead class="colorTitulo">
                    <th>TABLA</th>
                    <th>CONTADOR</th>
                  </thead>
                  <tr>
                    <td>CUENTAS POR COBRAR</td>
                    <td align='right'><?php echo e(number_format($totCxc, 2, '.', ',')); ?></td> 
                  </tr>
                  <tr>
                    <td>CUENTAS POR PAGAR</td>
                    <td align='right'><?php echo e(number_format($totCxp, 2, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>CLIENTES</td>
                    <td align='right'><?php echo e(number_format($contCliente, 0, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PROVEEDORES</td>
                    <td align='right'><?php echo e(number_format($contProveedor, 0, '.', ',')); ?></td>  
                  </tr>
                  <tr>
                    <td>PRODUCTOS</td>
                    <td align='right'><?php echo e(number_format($contProducto, 0, '.', ',')); ?></td>  
                  </tr>
              </table><br>
          </div>
        </div>
    </div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="padding-left: 0px;">
			<button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
		</div>
    <br><br>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
setTimeout('document.location.reload()',30000);
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/report/resumen.blade.php ENDPATH**/ ?>