<?php  $factor = $tabla->factorcambiario;
    if ($tabla->estado == 'NUEVO') 
        $factor = $cfg->tasacambiaria;
?> 
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
                        <td align="left" style="border: medium transparent" ><input type="text" value="<?php echo e(number_format($tabla->total/$factor, 2, '.', ',')); ?>"  /></td>
                        <?php endif; ?>

                        <td align="right" style="border: 0px;">ESTADO:</td>
                        <td align="left" style="border: medium transparent; width: 100%;" ><input type="text" value="<?php echo e($tabla->estado); ?>"  /></td>

                    </tr>
                </table>

            </div>
        </div>
    </div>

    <table width="100%" border="1" cellpadding="4" cellspacing="0">    
   
        <tr style="background-color: #C3C3C3; color: #000000; height: 50px">
            <th align='left' style='width: 2%;  '>#</th>
            <th align='left' style='width: 30%; '>DESCRIPCION</th>
            <th align='right' style='width: 8%; '>CANT</th>
            <th align='right' style='width: 10%;'><?php echo e($cfg->LitPrecio); ?></th>
            <th align='right' style='width: 5%; '>IVA</th>

            <th align='right' style='width: 5%; '><?php echo e($cfg->LitDa); ?></th>
            <?php if( $cfg->mostrarDi > 0 ): ?>
                <th align='right' style='width: 5%; '><?php echo e($cfg->LitDi); ?></th>
            <?php endif; ?>
            <?php if( $cfg->mostrarDc > 0 ): ?>
                <th align='right' style='width: 5%; '><?php echo e($cfg->LitDc); ?></th>
            <?php endif; ?>
            <?php if( $cfg->mostrarPp > 0 ): ?>
                <th align='right' style='width: 5%; '><?php echo e($cfg->LitPp); ?></th>
            <?php endif; ?>
            <th align='right' style='width: 5%; '>NETO</th>
            <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                <th align='right' style='width: 10%;'>SUBTOTAL(<?php echo e($cfg->simboloOM); ?>)</th>
                <th align='right' style='width: 10%;'>SUBTOTAL</th>
            <?php else: ?>
                <th align='right' style='width: 10%;'>SUBTOTAL</th>
            <?php endif; ?>
        </tr>

        <?php $__currentLoopData = $tabla2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($t->desprod); ?></td>
            <td align="right"><?php echo e(number_format($t->cantidad, 0, '.', ',')); ?></td>
            <td align="right"><?php echo e(number_format($t->precio, 2, '.', ',')); ?></td>
            <td align="right"><?php echo e(number_format($t->iva, 2, '.', ',')); ?></td>
            <td align="right"><?php echo e(number_format($t->da, 2, '.', ',')); ?></td>
            <?php if( sLeercfg($sucactiva, 'mostrarDi') > 0 ): ?>
                <td align="right"><?php echo e(number_format($t->di, 2, '.', ',')); ?></td>
            <?php endif; ?>
            <?php if( sLeercfg($sucactiva,'mostrarDc') > 0 ): ?>
                <td align="right"><?php echo e(number_format($t->dc, 2, '.', ',')); ?></td>
            <?php endif; ?>
            <?php if( sLeercfg($sucactiva,'mostrarPp') > 0 ): ?>
                <td align="right"><?php echo e(number_format($t->pp, 2, '.', ',')); ?></td>
            <?php endif; ?>
            <td align="right"><?php echo e(number_format($t->neto, 2, '.', ',')); ?></td>
            
            <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
                <td align="right"><?php echo e(number_format($t->subtotal/$factor, 2, '.', ',')); ?></td>
            <?php endif; ?>
            <td align="right"><?php echo e(number_format($t->subtotal, 2, '.', ',')); ?></td>

        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if( $cfg->mostrarPedidoOM > 0 ): ?>
        <h4>
             *** <?php echo e($cfg->LiteralTasaCambiaria); ?> <?php echo e(number_format($factor, 2, '.', ',')); ?> ***
        </h4>          
        <?php endif; ?>
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

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/layouts/rptpedido.blade.php ENDPATH**/ ?>