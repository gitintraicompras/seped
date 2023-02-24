
<?php $__env->startSection('contenido'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">BASICA</a></li>
              <li><a href="#tab_2" data-toggle="tab">PRECIOS</a></li>
              <li><a href="#tab_3" data-toggle="tab">DETALLES</a></li>
              <li><a href="#tab_4" data-toggle="tab">ADICIONALES</a></li>
              <li class="pull-right">
                <a href="<?php echo e(url('/home')); ?>" class="text-muted">
                    <i class="fa fa-window-close-o"></i>
                </a>
              </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">

                        <?php if( $cfg->mostrarImagen > 0): ?>
                            <td>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <center>
                                        <img src="<?php echo e(asset('/public/storage/'.NombreImagen($tabla->codprod)  )); ?>" class="img-responsive" style="width: 370px; height: 370px;">
                                    </center>
                                </div>
                            </td>
                        <?php endif; ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Código</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e($tabla->codprod); ?>" style="color: #000000; background: #F7F7F7;" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->cantidad, 0, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Iva</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->iva, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e($tabla->tipo); ?>" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Regulado</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e($tabla->regulado); ?>" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Referencia</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e($tabla->barra); ?>" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Principio Activo</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e($tabla->pactivo); ?>" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <?php if(Auth::user()->tipo == "A" ||  Auth::user()->tipo == "V" || Auth::user()->tipo == "S"): ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label>Fecha Última compra</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fechafalla))); ?>" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input readonly  type="text" class="form-control" value="<?php echo e($tabla->desprod); ?>" style="color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="row">

                        <?php if(Auth::user()->tipo == "A" ||  Auth::user()->tipo == "V" || Auth::user()->tipo == "S"): ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label><?php echo e($cfg->LitPrecio); ?>1</label>
                                    <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio1, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label><?php echo e($cfg->LitPrecio); ?>2</label>
                                    <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio2, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label><?php echo e($cfg->LitPrecio); ?>3</label>
                                    <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio3, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label><?php echo e($cfg->LitPrecio); ?>4</label>
                                    <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio4, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label><?php echo e($cfg->LitPrecio); ?>5</label>
                                    <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio5, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Precio6</label>
                                    <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio6, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                </div>
                            </div>
                        <?php else: ?> 
                            <?php 
                                $usaprecio = 1;
                                $codcli = sCodigoClienteActivo();
                                $cliente = DB::table('cliente')
                                ->where('codcli','=',$codcli)
                                ->first();
                                if ($cliente) {
                                    $usaprecio = $cliente->usaprecio;
                                }
                            ?>   
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label><?php echo e($cfg->LitPrecio); ?></label>
                                    <?php if($usaprecio == 1): ?>
                                        <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio1, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    <?php endif; ?>
                                    <?php if($usaprecio == 2): ?>
                                        <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio2, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    <?php endif; ?>
                                    <?php if($usaprecio == 3): ?>
                                        <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio3, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    <?php endif; ?>
                                    <?php if($usaprecio == 4): ?>
                                        <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio4, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    <?php endif; ?>
                                    <?php if($usaprecio == 5): ?>
                                        <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio5, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    <?php endif; ?>
                                    <?php if($usaprecio == 6): ?>
                                        <input title="<?php echo e($cfg->msgLitPrecio); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->precio1, 6, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Unidad Preempaque</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->upre, 0, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>
                                    <?php echo e($cfg->LitDp); ?>

                                </label>
                                <input title="<?php echo e($cfg->msgLitDp); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->ppre, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Precio Sugerido</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->psugerido, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Precio Gris</label>
                                <input readonly type="text" class="form-control" value="<?php echo e($tabla->pgris); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Descuento Neto</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->dctoneto); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Tipo catálogo</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->tipocatalogo); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Proveedor</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->codprov); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Bulto</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->original); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label><?php echo e($cfg->LitDa); ?></label>
                                <input title="<?php echo e($cfg->msgLitDa); ?>" readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->da, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Otra Oferta</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->oferta, 2, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Unidad Minima facturación</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->undmin, 0, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Unidad Maxima facturación</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->undmax, 0, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Unidad Multiplo facturación</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->undmultiplo, 0, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <?php if(Auth::user()->tipo == "A" ||  Auth::user()->tipo == "V" || Auth::user()->tipo == "S"): ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Cantidad a Publicar</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->cantpub, 0, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Cantidad Real</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e(number_format($tabla->cantreal, 0, '.', ',')); ?>" style="text-align: right; color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="tab-pane" id="tab_4">
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Lote</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->lote); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Vencimiento</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->fecvence); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Marca o Modelo</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->marcamodelo); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                      
                        <?php if(Auth::user()->tipo == "A" ||  Auth::user()->tipo == "V" || Auth::user()->tipo == "S"): ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Costo</label>
                                <input readonly type="text" class="form-control" value="<?php echo e(number_format($tabla->costo, 2, '.', ',')); ?>" style="color: #000000; background: #F7F7F7; text-align: right;">
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Ubicación</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->ubicacion); ?>" style="color: #000000; background: #F7F7F7;" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Descripción corta</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->descorta); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Codisb</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->codisb); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Fecha catálogo</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->feccatalogo); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Departamento</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->departamento); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Grupo</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->grupo); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Subgrupo</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->subgrupo); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Opcional1</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->opc1); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Opcional2</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->opc2); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Opcional3</label>
                                <input readonly  type="text" class="form-control" value="<?php echo e($tabla->opc3); ?>" style="color: #000000; background: #F7F7F7;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group" style="margin-left: 15px;">
    <button type="button" 
        class="btn-normal" 
        onclick="history.back(-1)">
        Regresar
    </button>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/report/prodver.blade.php ENDPATH**/ ?>