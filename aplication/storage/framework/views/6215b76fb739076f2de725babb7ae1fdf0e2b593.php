
<?php $__env->startSection('contenido'); ?>

<?php
$monto = 0;
$imp = 0;
$factr = DB::table('factren')
->select(DB::raw('sum(subtotal) as subtotal'), DB::raw('sum(subtotal * impuesto) as imp'))
->where('factnum','=',$factnum)
->where('marca','LIKE','%'.$codmarca.'%')
->first();
if ($factr) {
    $monto = $factr->subtotal;
    $imp = $factr->imp;
}
?>

<div id="page-wrapper">
 
 	<div class="form-group">
        <div style="margin-top: 4px;" class="input-group input-group-sm">
            <span class="input-group-addon">Factura:</span>
            <input readonly type="text" class="form-control" value="<?php echo e($fact->factnum); ?>" style="color: #000000; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
		    <span class="input-group-addon hidden-xs">Fecha:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($fact->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

            <span class="input-group-addon hidden-xs" style="border:0px; "></span>
            <span class="input-group-addon hidden-xs">Monto:</span>
            <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(number_format($monto, 2, '.', ',')); ?>" style="color: #000000; text-align: right; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon hidden-xs">Iva:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(number_format($imp, 2, '.', ',')); ?>" style="color: #000000; text-align: right; background: #F7F7F7;">

            <span class="input-group-addon" style="border:0px; "></span>
            <span class="input-group-addon">Total:</span>
            <input readonly type="text" class="form-control" value="<?php echo e(number_format($monto + $imp, 2, '.', ',')); ?>" style="color: #000000; text-align: right; background: #F7F7F7;">

        </div>

        <div style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observación:</span>
                <input id="idobs" readonly type="text" class="form-control" value="<?php echo e($fact->observacion); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>

    <div  class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead class="colorTitulo">
                <th>#</th>
                <?php if( $cfg->mostrarImagen > 0 ): ?>
                    <th class="hidden-xs">IMAGEN</th>
                <?php else: ?>
                    <th class="hidden-xs">OPCION</th>
                <?php endif; ?>
                <th>DESCRIPCION</th>
                <th class="hidden-xs">CODIGO</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>SUBTOTAL</th>
                <th class="hidden-xs">REFERENCIA</th>
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
                <td class="hidden-xs"><?php echo e($fr->codprod); ?></td>
                <td align="right"><?php echo e(number_format($fr->cantidad, 0, '.', ',')); ?></td>
                <td align="right"><?php echo e(number_format($fr->precio, 2, '.', ',')); ?></td>
                <td align="right"><?php echo e(number_format($fr->subtotal, 2, '.', ',')); ?></td>
                <td class="hidden-xs"><?php echo e($fr->referencia); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
        </table>
    </div>

    <button type="button" class="btn-normal" onclick="history.back(-1)">Regresar</button>
   
  
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/provfact/show.blade.php ENDPATH**/ ?>