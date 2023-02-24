<?php $__env->startSection('contenido'); ?>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?php echo $__env->make('seped.monitorpedido.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="colorTitulo">
                        <th style="width:140px;">OPCION</th>
                        <th>PEDIDO</th>
                        <th>CLIENTE</th>
                        <th>ENVIADO</th>
                        <th>RENGLON</th>
                        <th>UNIDAD</th>
                        <th>PROCESADO</th>
                        <th>ORIGEN</th>
                        <th>STATUS</th>
                        <?php if(sLeercfg($sucactiva, 'mostrarModnofiscal') > 0): ?>
                            <th title="Pedido fiscal o No fiscal">FISCAL</th>
                        <?php endif; ?>
                        <th title="Factor cambiario del pedido">FACTOR</th>
                        <th>TOTAL</th>
                        <th>SUCURSAL</th>
                    </thead>
                    <?php $__currentLoopData = $tabla; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <!-- CONSULTA DE PEDIDO -->
                                <a href="<?php echo e(URL::action('AdmonitorpedidoController@show', $t->id)); ?>">
                                    <button class="btn btn-default btn-pedido fa fa-file-o" data-toggle="tooltip"
                                        title="Consultar pedido">
                                    </button>
                                </a>

                                <?php if(Auth::user()->tipo == 'A' || Auth::user()->tipo == 'S'): ?>
                                    <!-- ELIMINAR PEDIDO -->
                                    <a href="" data-target="#modal-delete-<?php echo e($t->id); ?>" data-toggle="modal">
                                        <button class="btn btn-default btn-pedido fa fa-trash-o" data-toggle="tooltip"
                                            title="Eliminar pedido"></button>
                                    </a>
                                    <?php if($t->estado == 'ANULADO' || $t->estado == 'ENVIADO'): ?>
                                        <!-- MODIFICAR PEDIDO -->
                                        <a href="<?php echo e(URL::action('AdmonitorpedidoController@edit', $t->id)); ?>">
                                            <button class="btn btn-default btn-pedido fa fa-pencil"
                                                title="Modificar estatus del pedido">
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </td>
                            <td><?php echo e($t->id); ?></td>
                            <td><?php echo e($t->nomcli); ?></td>
                            <td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecenviado))); ?></td>
                            <td align="right"><?php echo e($t->numren); ?></td>
                            <td align="right"><?php echo e($t->numund); ?></td>
                            <td><?php echo e(date('d-m-Y H:i:s', strtotime($t->fecprocesado))); ?></td>
                            <td><?php echo e($t->origen); ?></td>
                            <td><?php echo e($t->estado); ?></td>
                            <?php if(sLeercfg($sucactiva, 'mostrarModnofiscal') > 0): ?>
                                <td align="center"><?php echo e($t->pedfiscal == 1 ? 'SI' : 'NO'); ?></td>
                            <?php endif; ?>
                            <td align="right"><?php echo e(number_format($t->factorcambiario, 2, '.', ',')); ?></td>
                            <td align="right">
                                <b><?php echo e(number_format($t->total, 2, '.', ',')); ?></b>
                            </td>
                            <td><?php echo e(sLeercfg($t->codisb, 'SedeSucursal')); ?></td>
                        </tr>
                        <?php echo $__env->make('seped.monitorpedido.delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <div align='right'>
                    <?php echo e($tabla->render()); ?>

                </div><br>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
            $('#subtitulo').text('<?php echo e($subtitulo); ?>');
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/monitorpedido/index.blade.php ENDPATH**/ ?>