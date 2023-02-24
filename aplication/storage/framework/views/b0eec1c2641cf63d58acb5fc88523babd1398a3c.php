
<?php $__env->startSection('contenido'); ?>
<?php  $factor = $tabla->factorcambiario;
    if ($tabla->estado == 'NUEVO') 
        $factor = $cfg->tasacambiaria;
?>
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Id:</span>
                    <input readonly 
                        type="text" 
                        class="form-control" 
                        value="<?php echo e($tabla->id); ?>" 
                        style="color: #000000;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Recipiente</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->recipiente); ?>" style="color: #000000;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Fecha:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecha))); ?>" style="color: #000000;" >
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Reng:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->numren); ?>" style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Und:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->numund); ?>" style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Cliente:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->nomcli); ?>"  style="color: #000000;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Solicitado:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->numund); ?>"  style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Status:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->estado); ?>"  style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">Dias credito:</span>
                    <input readonly type="text" class="form-control" value="<?php echo e($tabla->dcredito); ?>"  style="color: #000000; text-align: right;" >
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
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
                    <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total/$factor, 2, '.', ',')); ?> <?php echo e($cfg->simboloOM); ?>" style="color: green; background: #F7F7F7; text-align: right;" id="idtotal">
                <?php endif; ?>


                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotal">                 
            </div>
        </div>
    </div>

    <br>
    <ul class="nav nav-tabs" >
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#menu1">BASICA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">DETALLE</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div style="margin-top: 10px;" class="tab-content" >
        <div id="menu1" class="container tab-pane active" style="width: 100%;">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Código:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->codcli); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Origen:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->origen); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Destino:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->destino); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Usuario:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->usuario); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Vendedor:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->codvend); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Tipo:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->tipedido); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Rif:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->rif); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Creado:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecha))); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Enviado:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecenviado))); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Procesado:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecprocesado))); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Recibido:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecrecibido))); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Picking:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecpicking))); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Packing:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecpacking))); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Facturado:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i', strtotime($tabla->fecfacturado))); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Despachador:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->despachador); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Documento:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->documento); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">Observación:</span>
                            <input readonly type="text" class="form-control" value="<?php echo e($tabla->observacion); ?>" style="color: #000000;" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu2" class="container tab-pane" style="width: 100%;">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                            <thead class="colorTitulo">
                                <th>#</th>
                                <th class="hidden-xs" style="width: 120px;">
                                    <center>IMAGEN</center>
                                </th>
                                <th>CODIGO</th>
                                <th>DESCRIPCION</th>
                                <th>REFERENCIA</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO</th>
                                <th>SUBTOTAL</th>
                                <th style="display:none;">ITEM</th>
                            </thead>
                          
                            <?php $__currentLoopData = $tabla2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>

                                <!-- 1 IMAGEN -->
                                <td class="hidden-xs">
                                    <div align="center" style="width: 110px;">
                                        <a href="<?php echo e(URL::action('AdreportController@producto',$t->codprod)); ?>">
                                            <img src="<?php echo e(asset('/public/storage/'.NombreImagen($t->codprod))); ?>" 
                                            width="100%"  
                                            class="img-responsive">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <?php echo e($t->codprod); ?>

                                    <?php if($t->dcredito > 0): ?>
                                        <div class="colorPromDias"
                                            style="margin-top: 5px;
                                            border-radius: 5px; 
                                            font-size: 14px;
                                            text-align: center;
                                            padding: 1px; 
                                            color: white;
                                            width: 100px;
                                            background-color: black;"
                                            title="DIAS DE CREDITO: <?php echo e($t->dcredito); ?>">
                                            DIAS: <?php echo e($t->dcredito); ?> 
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($t->desprod); ?></td>
                                <td><?php echo e($t->barra); ?></td>
                                <td align="right">
                                    <?php echo e(number_format($t->cantidad, 0, '.', ',')); ?>

                                </td>
                                <td align="right">
                                    <?php echo e(number_format($t->precio, 2, '.', ',')); ?>

                                    <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                                    <br>
                                    <span style="color: green">
                                        <?php echo e(number_format($t->precio/$factor, 2, '.', ',')); ?>

                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td align="right">
                                    <?php echo e(number_format($t->subtotal, 2, '.', ',')); ?>

                                    <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                                    <br>
                                    <span style="color: green">
                                        <?php echo e(number_format($t->subtotal/$factor, 2, '.', ',')); ?>

                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td style="display:none;"><?php echo e($t->item); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <br>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/monitorpedido/show.blade.php ENDPATH**/ ?>