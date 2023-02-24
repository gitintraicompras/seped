
<?php $__env->startSection('contenido'); ?>

<!-- ENCABEZADO -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if($cfg->modoVisual=="1"): ?>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                
                <span class="input-group-addon">Pago:</span>
                <input readonly id="id" type="text" class="form-control" value="<?php echo e($pago->id); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Estado:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->estado); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Fecha:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(number_format(SubtotalPago($pago->id), 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotalpago">                   
                

            </div>
        </div>
        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Enviado:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecenviado))); ?>" style="color:#000000; background: #F7F7F7;" >                  
                
                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Procesado:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecprocesado))); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Origen:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->origen); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon hidden-xs" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Usuario:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->usuario); ?>" style="color: #000000; background: #F7F7F7;">

            </div>
        </div>
        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observación:</span>
                <input readonly id="idobs" type="text" class="form-control" value="<?php echo e($pago->observacion); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if($cfg->modoVisual=="2"): ?>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                
                <span class="input-group-addon">Pago:</span>
                <input readonly id="id" type="text" class="form-control" value="<?php echo e($pago->id); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Estado:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->estado); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Fecha:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(number_format(SubtotalPago($pago->id), 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotalpago">                   
                

            </div>
        </div>
        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observación:</span>
                <input readonly id="idobs" type="text" class="form-control" value="<?php echo e($pago->observacion); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if($cfg->modoVisual=="3"): ?>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                
                <span class="input-group-addon">Pago:</span>
                <input readonly id="id" type="text" class="form-control" value="<?php echo e($pago->id); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Estado:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e($pago->estado); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon hidden-xs">Fecha:</span>
                <input readonly type="text" class="form-control hidden-xs" value="<?php echo e(date('d-m-Y H:i:s', strtotime($pago->fecha))); ?>" style="color: #000000; background: #F7F7F7;">

                <span class="input-group-addon" style="border:0px; "></span>
                <span class="input-group-addon">Total:</span>
                <input readonly type="text" class="form-control" value="<?php echo e(number_format(SubtotalPago($pago->id), 2, '.', ',')); ?>" style="color:#000000; background: #F7F7F7; text-align: right;" id="idtotalpago">                   
                

            </div>
        </div>
        <div class="row" style="margin-top: 4px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm">
                <span class="input-group-addon">Observación:</span>
                <input readonly id="idobs" type="text" class="form-control" value="<?php echo e($pago->observacion); ?>" style="color: #000000; background: #F7F7F7;">
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty($tabla->nota)): ?>
    <div class="form-group">
        <div class="row">
            <div class="input-group input-group-sm" >
                <span class="input-group-addon">Notas:</span>
                <input readonly type="text" class="form-control" value="<?php echo e($tabla->nota); ?>" >
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<ul class="nav nav-tabs" >
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#menu1">DOCUMENTOS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#menu2">PAGOS</a>
    </li>
</ul>

<!-- Tab panes -->
<div style="margin-top: 10px;" class="tab-content" >
    <div id="menu1" class="container tab-pane active" style="width: 100%;">
        <div class="row">
            <!-- TABLA DOCUMENTOS PENDIENTES-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table id="idtabla" class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="colorTitulo">
                            <th>#</th>
                            <th>DOCUMENTO</th>
                            <th>TIPO</th>
                            <th>FECHA</th>
                            <th>VENCE</th>
                            <th>MONTO</th>
                            <th>SALDO</th>
                        </thead>
                        <?php $__currentLoopData = $pagdoc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($t->coddoc); ?></td>
                            <td><?php echo e($t->tipo); ?></td>
                            <td><?php echo e(date('d-m-Y', strtotime($t->fecha))); ?></td>
                            <td><?php echo e(date('d-m-Y', strtotime($t->vence))); ?></td>
                            <td align="right"><?php echo e(number_format($t->monto, 2, '.', ',')); ?></td>
                            <td align="right"><?php echo e(number_format($t->saldo, 2, '.', ',')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="menu2" class="container tab-pane fade" style="width: 100%;">
        <div class="row">
            <!-- TABLA PAGOS ENGLON-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table id="idtabla2" class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="colorTitulo">
                            <th>ITEM</th>
                            <th>REFERENCIA</th>
                            <th>CUENTA</th>
                            <th>FECHA</th>
                            <th>MONTO</th>
                            <th>MODO</th>
                            <th>CHEQUE</th>
                            <th>BANCO</th>
                        </thead>

                        <?php $__currentLoopData = $pagren; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($t->item); ?></td>
                            <td><?php echo e($t->referencia); ?></td>
                            <td><?php echo e($t->cuenta); ?></td>
                            <td><?php echo e(date('d-m-Y', strtotime($t->fecha))); ?></td>
                            <td align="right"><?php echo e(number_format($t->monto, 2, '.', ',')); ?></td>
                            <td><?php echo e($t->modo); ?></td>
                            <td><?php echo e($t->cheque); ?></td>
                            <td><?php echo e($t->banco); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table><br>
                </div>
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
<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/pago/show.blade.php ENDPATH**/ ?>