
<?php $__env->startSection('contenido'); ?>
<?php  $factor = $tabla->factorcambiario;
    if ($tabla->estado == 'NUEVO') 
        $factor = $cfg->tasacambiaria;
?> 
<div id="page-wrapper">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php if($cfg->modoVisual=="1"): ?>
     	<div class="form-group">
            <div class="row" style="margin-top: 4px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Pedido:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>-<?php echo e($tabla->tipedido); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Estado:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->estado); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fecha:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Enviado:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecenviado))); ?>" style="color: #000000; background: #F7F7F7;">

                </div>
            </div>
            <div class="row" style="margin-top: 4px; margin-bottom: 4px;">
                <div class="input-group input-group-sm">
           
                    <span class="input-group-addon">Procesado:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Origen:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->origen); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Usuario:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->usuario); ?>" style="color: #000000; background: #F7F7F7;">

                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon hidden-xs">Descuento:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(number_format($tabla->descuento, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="iddescuento">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs" >Subtotal:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->subtotal, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idsubtotal">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Monto IVA:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->impuesto, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

                    <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total/$factor, 2, '.', ',')); ?> <?php echo e($cfg->simboloOM); ?>" style="color: green; background: #F7F7F7; text-align: right;" id="idtotal"></b>
                    <?php endif; ?>

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Total:</span>
                    <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>   

                    <?php if(!empty($tabla->documento)): ?>
                    <span class="input-group-addon" style="border:0px; "></span>
                    <input readonly type="text" class="form-control" value="DOC: <?php echo e($tabla->documento); ?>" style="color: #000000; background: #F7F7F7;">
                    <?php endif; ?>
                  

                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($cfg->modoVisual=="2"): ?>
        <div class="form-group">
            <div class="row" style="margin-top: 4px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Pedido:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>-<?php echo e($tabla->tipedido); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Estado:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->estado); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Fecha:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Enviado:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecenviado))); ?>" style="color: #000000; background: #F7F7F7;">

                </div>
            </div>
            <div class="row" style="margin-top: 4px;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                    
                    <span class="input-group-addon hidden-xs">Descuento:</span>
                    <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(number_format($tabla->descuento, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="iddescuento">

                    <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs" >Subtotal:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->subtotal, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idsubtotal">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Impuesto:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->impuesto, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

                    <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total/$factor, 2, '.', ',')); ?> <?php echo e($cfg->simboloOM); ?>" style="color: green; background: #F7F7F7; text-align: right;" id="idtotal"></b>
                    <?php endif; ?>


                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon">Total:</span>
                    <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"> </b>  

                    <?php if(!empty($tabla->documento)): ?>
                    <span class="input-group-addon" style="border:0px; "></span>
                    <input readonly type="text" class="form-control" value="DOC: <?php echo e($tabla->documento); ?>" style="color: #000000; background: #F7F7F7;">
                    <?php endif; ?>
     

                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($cfg->modoVisual=="3"): ?>
        <div class="form-group">
            <div class="row" style="margin-top: 4px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Pedido:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->id); ?>-<?php echo e($tabla->tipedido); ?>" style="color: #000000; background: #F7F7F7;">

                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Impuesto:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->impuesto, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;" id="idimpuesto">

                    <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                        <span class="input-group-addon" style="border:0px; "></span>
                        <span class="input-group-addon">Total:</span>
                        <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total/$factor, 2, '.', ',')); ?> <?php echo e($cfg->simboloOM); ?>" style="color: green; background: #F7F7F7; text-align: right;" id="idtotal"></b>
                    <?php endif; ?>


                    <span class="input-group-addon" style="border:0px; "></span>
                    <span class="input-group-addon hidden-xs">Total:</span>
                    <b><input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal"></b>     

                    <?php if(!empty($tabla->documento)): ?>
                    <span class="input-group-addon" style="border:0px; "></span>
                    <input readonly type="text" class="form-control" value="DOC: <?php echo e($tabla->documento); ?>" style="color: #000000; background: #F7F7F7;">           
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="form-group">
            <div class="row">
                <div class="input-group input-group-sm" >
                    <span class="input-group-addon">Observación:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->observacion); ?>" >

                    <span class="input-group-addon" style="border:0px; "></span>
                    
                    <span class="input-group-addon">Transporte de Mercancia:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->codtransp); ?>" >
         
                    <span class="input-group-addon" style="border:0px; "></span>

                    <span class="input-group-addon" >Unidades:</span>
                    <input readonly 
                        type="text" 
                        class="form-control" 
                        value="<?php echo e($tabla->numund); ?>" >
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table id="idtabla" 
                    class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
                        <th>#</th>
                        <?php if( $cfg->mostrarImagenPedido > 0 ): ?>
                            <th class="hidden-xs">IMAGEN</th>
                        <?php endif; ?>
                        <th>DESCRIPCION</th>
                        <?php if( $cfg->mostrarCodigo > 0 ): ?>
                            <th class="hidden-xs">CODIGO</th>
                        <?php endif; ?>
                        <th>LOTE</th>
                        <th>CANTIDAD</th>

                        <th title="<?php echo e($cfg->msgLitPrecio); ?>">
                            <?php echo e($cfg->LitPrecio); ?>

                        </th>

                        <th class="hidden-xs">IVA</th>

                        <?php if( $cfg->mostrarDa > 0 ): ?>
                            <th title="<?php echo e($cfg->msgLitDa); ?>" class="hidden-xs">
                                <?php echo e($cfg->LitDa); ?>

                            </th>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarDp > 0 ): ?>
                            <th title="<?php echo e($cfg->msgLitDp); ?>" class="hidden-xs">
                                <?php echo e($cfg->LitDp); ?>

                            </th>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarDi > 0 ): ?>
                            <th title="<?php echo e($cfg->msgLitDi); ?>" class="hidden-xs">
                                <?php echo e($cfg->LitDi); ?>

                            </th>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarDc > 0 ): ?>
                            <th title="<?php echo e($cfg->msgLitDc); ?>" class="hidden-xs">
                                <?php echo e($cfg->LitDc); ?>

                            </th>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarDv > 0 ): ?>     
                            <th class="hidden-xs" title="<?php echo e($cfg->msgLitDv); ?>">
                                <?php echo e($cfg->LitDv); ?>

                            </th>
                        <?php endif; ?> 

                        <?php if( $cfg->mostrarPp > 0 ): ?>
                            <th title="<?php echo e($cfg->msgLitPp); ?>" class="hidden-xs">
                                <?php echo e($cfg->LitPp); ?>

                            </th>
                        <?php endif; ?>

                        <th>NETO</th>
                        <th>SUBTOTAL</th>
                    </thead>
                  
                    <?php $__currentLoopData = $tabla2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <?php if( $cfg->mostrarImagenPedido > 0 ): ?>
                        <td class="hidden-xs">
                            <div align="center">
                                <a href="<?php echo e(URL::action('AdreportController@producto',$t->codprod)); ?>">
                                    <img src="<?php echo e(asset('/public/storage/'.NombreImagen($t->codprod)  )); ?>" width="40" height="25" class="img-responsive">
                                </a>
                            </div>
                        </td>
                        <?php endif; ?>
                        <td><?php echo e($t->desprod); ?></td>
                        <?php if( $cfg->mostrarCodigo > 0 ): ?>
                            <td class="hidden-xs"><?php echo e($t->codprod); ?></td>
                        <?php endif; ?>
                        <td><?php echo e($t->lote); ?></td>
                        <td align="right"><?php echo e(number_format($t->cantidad, 0, '.', ',')); ?></td>
                        <td align="right">
                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                <?php echo e(number_format($t->precio, 2, '.', ',')); ?>

                            </span>
                            <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                                <br>
                                <span style="color: green;" title= "<?php echo e($cfg->simboloOM); ?>">
                                    <b><?php echo e(number_format($t->precio/$factor, 2, '.', ',')); ?></b>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs" align="right"><?php echo e(number_format($t->iva, 2, '.', ',')); ?></td>
                        
                        <?php if( $cfg->mostrarDa > 0 ): ?>
                            <td class="hidden-xs" align="right"
                                <?php if($t->da > 0): ?> style="color: red;" <?php endif; ?>>
                                <?php echo e(number_format($t->da, 2, '.', ',')); ?>

                            </td>
                        <?php endif; ?>
                        
                        <?php if( $cfg->mostrarDp > 0 ): ?>
                            <td class="hidden-xs" align="right"
                                <?php if($t->dp > 0): ?> style="color: red;" <?php endif; ?>>
                                <?php echo e(number_format($t->dp, 2, '.', ',')); ?>

                            </td>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarDi > 0 ): ?>
                            <td class="hidden-xs" align="right"
                                <?php if($t->di > 0): ?> style="color: red;" <?php endif; ?>>
                                <?php echo e(number_format($t->di, 2, '.', ',')); ?>

                            </td>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarDc > 0 ): ?>
                            <td class="hidden-xs" align="right"
                                <?php if($t->dc > 0): ?> style="color: red;" <?php endif; ?>>
                                <?php echo e(number_format($t->dc, 2, '.', ',')); ?>

                            </td>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarDv > 0 ): ?>
                            <td class="hidden-xs" align="right"
                                <?php if($t->dv > 0): ?> style="color: red;" <?php endif; ?>>
                                <?php echo e(number_format($t->dv, 2, '.', ',')); ?>

                            </td>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarPp > 0 ): ?>
                            <td class="hidden-xs" align="right"
                                <?php if($t->pp > 0): ?> style="color: red;" <?php endif; ?>>
                                <?php echo e(number_format($t->pp, 2, '.', ',')); ?>

                            </td>
                        <?php endif; ?>

                        <td align="right">
                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                <?php echo e(number_format($t->neto, 2, '.', ',')); ?>

                            </span>
                            <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                                <br>
                                <span style="color: green;" title= "<?php echo e($cfg->simboloOM); ?>">
                                    <b><?php echo e(number_format($t->neto/$factor, 2, '.', ',')); ?></b>
                                </span>
                            <?php endif; ?>
                        </td>

                        <td align="right">
                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                <?php echo e(number_format($t->subtotal, 2, '.', ',')); ?>

                            </span>
                            <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                                <br>
                                <span style="color: green;" title= "<?php echo e($cfg->simboloOM); ?>">
                                    <b><?php echo e(number_format($t->subtotal/$factor, 2, '.', ',')); ?></b>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                <h4>
                     *** <?php echo e($cfg->LiteralTasaCambiaria); ?> <?php echo e(number_format($factor, 2, '.', ',')); ?> ***
                </h4>          
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <br>
     <div class="form-group" style="margin-left: 0px;">
        <button type="button" 
            class="btn-normal" 
            onclick="history.back(-1)">
            Regresar
        </button>
     </div>
</div>
<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pedido/show.blade.php ENDPATH**/ ?>