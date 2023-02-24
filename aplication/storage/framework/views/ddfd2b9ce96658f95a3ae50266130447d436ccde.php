<head>
    <style>
    @page  {
        margin:2px; 
        padding:2px; 
    }
    span {
        vertical-align: middle;
    }
    table, th, td {
        border: 1px solid black;
    }
    h4, h5, h6 {
        margin: 0.5px;
        padding: 0.5px;
    }
    body {
        font-family: Times New Roman;
        font-size: 8px;
        border: 0;
        margin: 4px;
        padding: 4px;
    }
    </style>
</head>

<div class="row">
    <div width="100%">
        <div width="30%" style="float: left; margin-top: 15px; margin-left: 15px;">
           
            <?php if($cfg->imagenPdfRutaAbsoluta == 1): ?>
                <img src="<?php echo e(public_path().'/public/storage/logoRpt.png'); ?>" width="150" >
            <?php else: ?>
                <img src="<?php echo e('http://'.$cfg->nomsubdominio.'/public/storage/logoRpt.png'); ?>" width="150" > 
            <?php endif; ?>

        </div> 
        <div width="70%">
            <CENTER><h2 style="margin-top: 5px;"><?php echo e($titulo); ?></h2></CENTER>
            <CENTER><h3 style="margin-top: 5px;"><?php echo e($subtitulo); ?></h3></CENTER>
        </div>    
    </div>
</div>

<body>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <div class="row" style="margin-top: 20px;">

                <table style="border: 0px; width: 100%;">
                    <tr style="border: 0px;">
                        <td align="right" style="border: 0px;" >FECHA:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))); ?>" /></td>

                        <td align="right" style="border: 0px;">IMPUESTO:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="<?php echo e(number_format($tabla->impuesto, 2, '.', ',')); ?>" /></td>

                        <td align="right" style="border: 0px;">TOTAL:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="<?php echo e(number_format($tabla->total, 2, '.', ',')); ?>"  /></td>

                        <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                        <td align="right" style="border: 0px;">TOTAL<?php echo e($cfg->simboloOM); ?>:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="<?php echo e(number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')); ?>"  /></td>
                        <?php endif; ?>

                        <td align="right" style="border: 0px;">ESTADO:</td>
                        <td align="left" style="border: medium transparent; width="100%;" ><input type="text" value="<?php echo e($tabla->estado); ?>"  /></td>

                    </tr>
                </table>

            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <div class="row">

                <table style="border: 0px; width: 100%;">
                    <tr style="border: 0px;">
                        <td align="right" style="border: 0px;" >FACTURA:</td>
                        <td align="left" style="border: medium transparent;" ><input type="text" value="<?php echo e($tabla->factnum); ?>" /></td>

                        <td align="right" style="border: 0px;">FECHA FACTURA:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->fecfact))); ?>" /></td>

                        <td align="right" style="border: 0px;">VENCE:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="<?php echo e(date('d-m-Y H:i:s', strtotime($tabla->vence))); ?>"  /></td>

                    
                        <td align="right" style="border: 0px;">TOTAL FACTURA:</td>
                        <td align="left" style="border: medium transparent; width: 100%;" ><input type="text" value="<?php echo e(number_format($tabla->totalfactura, 2, '.', ',')); ?>"  /></td>

                    </tr>
                </table>

            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <div class="row">
                <div class="input-group input-group-sm">

                    <span class="input-group-addon">OBSERVACION:</span>
                    <input readonly type="text" value="
                    <?php if( strlen(trim($tabla->observacion)) == 0 ): ?>
                        S/O
                    <?php else: ?>
                        <?php echo e($tabla->observacion); ?>

                    <?php endif; ?> "
                    style="width: 702px;">           

                </div>
            </div>
        </div>
    </div>

    <table width="100%" border="1" cellpadding="4" cellspacing="0">   

        <tr style="background-color: #C3C3C3; color: #000000; height: 50px">
            <th align='left' style='width: 2%;  '>#</th>
            <th align='left' style='width: 50%; '>DESCRIPCION</th>
            <th align='left' style='width: 10%; '>CODIGO</th>
            <th align='right' style='width: 8%; '>CANT</th>
            <th align='right' style='width: 10%;'>PRECIO</th>
            <th align='right' style='width: 5%; '>RECLAMO</th>
            <th align='left' style='width: 15%; '>MOTIVO</th>
        </tr>
 
        <?php $__currentLoopData = $tabla2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($t->desprod); ?></td>
            <td><?php echo e($t->codprod); ?></td>
            <td align="right"><?php echo e(number_format($t->cantidad, 0, '.', ',')); ?></td>
            <td align="right"><?php echo e(number_format($t->precio, 2, '.', ',')); ?></td>
            <td align="right"><?php echo e(number_format($t->cantrec, 0, '.', ',')); ?></td>
            <td><?php echo e($t->motivo); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>

    <h4 style="margin-top: 10px;">
        <center><?php echo e($cfg->nombre); ?> | RIF: <?php echo e($cfg->rif); ?></center>
    </h4>

    <h5>
        <center><?php echo e($cfg->direccion); ?></center>
    </h5>

    <h5>
        <center>TELEFONO: <?php echo e($cfg->telefono); ?> | CONTACTO: <?php echo e($cfg->contacto); ?></center>
    </h5>

</body>


<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/layouts/rptreclamo.blade.php ENDPATH**/ ?>