<?php
$tasacambiaria = ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria:1;
$variable = 'precio'.$tipoprecio;
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
        font-size: 10px;
        border: 0;
        margin: 4px;
        padding: 4px;
    }
    </style>
</head>
 
<body>
    <div class="row">
        <div width="100%">
            <div width="30%" style="float: left; margin-top: 15px; margin-left: 15px;">

                <?php if($cfg->imagenPdfRutaAbsoluta == 1): ?>
                    <img src="<?php echo e(public_path().'/public/storage/logoRpt.png'); ?>" 
                    width="200"
                    height="55" >
                <?php else: ?>
                    <img src="<?php echo e('http://'.$cfg->nomsubdominio.'/public/storage/logoRpt.png'); ?>" 
                    wwidth="200"
                    height="55" >
                <?php endif; ?>

            </div> 
            <div width="70%">
                <CENTER><h2 style="margin-top: 5px;"><?php echo e($subtitulo); ?></h2></CENTER>
                <CENTER><h3 style="margin-top: 2px;">FECHA: <?php echo e($fecha); ?></h3></CENTER>
                <CENTER><h4 style="margin-top: 2px;"><?php echo e($cfg->LiteralTasaCambiaria); ?>: <?php echo e(number_format($cfg->tasacambiaria, 2, '.', ',')); ?> </h4></CENTER>
            </div>    
        </div>
    </div>

    <?php if($orden == 'ALFABETICO'): ?>
        <?php if($id == 'F'): ?> // FALLAS
            <table width="100%" border="1" cellpadding="4" cellspacing="0" style="margin-top: 20px;">    
           
                <tr style="background-color: #C3C3C3; color: #000000; height: 50px">
                    <th align='left' style='width: 5%; '>#</th>
                    <th align='left'  style='width: 7%;'>CODIGO</th>
                    <th align='left'  style='width: 50%;'>DESCRIPCION</th>
                    <th align='left'  style='width: 10%;'>BARRA</th>
                    <th align='left'  style='width: 10%;'>MARCA</th>
                </tr>

                <?php $__currentLoopData = $catalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($t->codprod); ?></td>
                    <td><?php echo e($t->desprod); ?></td>
                    <td><?php echo e($t->barra); ?></td>
                    <td><?php echo e($t->marcamodelo); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        <?php else: ?>
            <table width="100%" 
                border="1" 
                cellpadding="4" 
                cellspacing="0" 
                style="margin-top: 20px;">    
           
                <tr style="background-color: #C3C3C3; 
                    color: #000000; 
                    height: 50px;
                    width: 95%;">
                    <th align='left' style='width: 3%; '>#</th>
                   
                    <?php if($cfg->mostrarCodigo > 0): ?>
                        <th align='left' style='width: 10%;'>CODIGO</th>
                    <?php endif; ?>

                    <?php if($mostrarCantidad > 0): ?>
                        <th align='left'  style='width: 45%;'>DESCRIPCION</th>
                        <th align='left'  style='width: 5%;'>MARCA</th>
                        <th align='right' style='width: 5%;'>EXIST.</th>
                    <?php else: ?>
                         <th align='left'  style='width: 50%;'>DESCRIPCION</th>
                         <th align='left'  style='width: 5%;'>MARCA</th>
                    <?php endif; ?>

                    <?php if($cfg->mostrarDa > 0): ?>
                        <th align='right' style='width: 5%;'>IVA</th>
                        <th align='right' style='width: 5% ;'>DA</th>
                    <?php else: ?>
                        <th align='right' style='width: 10%;'>IVA</th>
                    <?php endif; ?>

                    <?php if(Auth::user()->tipo=='C'): ?>
                        <th align='right' style='width: 12%;'>NETO</th>
                    <?php else: ?>
                        <th align='right' style='width: 12%;'>
                            NETO<?php echo e($tipoprecio); ?>

                        </th>
                    <?php endif; ?>
                    
                </tr>

                <?php $__currentLoopData = $catalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $dp = $t->ppre;
                $dv = $t->dv;
                if ($tipo == 'A') {
                    $dp = 0.00;
                    $dv = 0.00;
                }
                $desprod = $t->desprod;
                if (strlen($desprod)>35)
                    $desprod = substr($desprod,0,35);
                $marca = $t->marcamodelo;
                if (strlen($marca)>10)
                    $marca = substr($marca,0,10);  
                $precio = CalculaPrecioNeto($t->$variable, $t->da, $di, $dc, $pp, $dp, $dv, $dvp);
                ?>
                <tr style="width: 95%;">
                	<td><?php echo e($loop->iteration); ?></td>
                    <?php if($cfg->mostrarCodigo > 0): ?>
                        <td><?php echo e($t->codprod); ?></td>
                    <?php endif; ?>
                	<td><?php echo e($desprod); ?></td>
                    <td><?php echo e($marca); ?></td>

                    <?php if($mostrarCantidad > 0): ?>
                	   <td align='right'><?php echo e(number_format($t->cantidad, 0, '.', ',')); ?></td>	
                    <?php endif; ?>

                	<td align='right'>
                        <?php echo e(number_format($t->iva, 2, '.', ',')); ?>

                    </td>
                    <?php if($cfg->mostrarDa > 0): ?>
               		   <td align='right'><?php echo e(number_format($t->da, 2, '.', ',')); ?></td>
                    <?php endif; ?>

                    <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                        <td align='right'>
                            <span style="font-size: 6px;"><?php echo e($cfg->simboloOM); ?></span> 
                            <?php echo e(number_format($precio/$tasacambiaria, 2, '.', ',')); ?>

                            <div>
                                <?php echo e(number_format($precio, 2, '.', ',')); ?>

                            </div>
                        </td>
                    <?php else: ?>
                        <td align='right'>
                            <?php echo e(number_format($precio, 2, '.', ',')); ?>

                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        <?php endif; ?>
    <?php else: ?>
        <?php if($cate): ?>
            <?php $__currentLoopData = $cate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="row">
            <b>CATEGORIA: <?php echo e($c->nomcat); ?></b>
            </div>
            <table width="100%" border="1" cellpadding="4" cellspacing="0">    

                <tr style="background-color: #C3C3C3; 
                        color: #000000; 
                        height: 50px;
                        width: 95%;">
                    <th align='left' style='width: 5%; '>#</th>
                   
                    <?php if($cfg->mostrarCodigo > 0): ?>
                        <th align='left'  style='width: 10%;'>CODIGO</th>
                    <?php endif; ?>

                    <?php if($mostrarCantidad > 0): ?>
                        <th align='left'  style='width: 45%;'>DESCRIPCION</th>
                        <th align='right' style='width: 10%;'>EXISTENCIA</th>
                    <?php else: ?>
                         <th align='left'  style='width: 55%;'>DESCRIPCION</th>
                    <?php endif; ?>
                    <?php if($cfg->mostrarDa > 0): ?>
                        <th align='right' style='width: 5%;'>IVA</th>
                        <th align='right' style='width: 5% ;'>DA</th>
                    <?php else: ?>
                        <th align='right' style='width: 10%;'>IVA</th>
                    <?php endif; ?>

                    <?php if(Auth::user()->tipo=='C'): ?>
                        <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                            <th align='right' style='width: 10%;'>NETO(<?php echo e($cfg->simboloOM); ?>)</th>
                        <?php endif; ?>
                        <th align='right' style='width: 10%;'>NETO</th>
                    <?php else: ?>
                        <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                            <th align='right' style='width: 10%;'>NETO<?php echo e($tipoprecio); ?>(<?php echo e($cfg->simboloOM); ?>)</th>
                        <?php endif; ?>
                        <th align='right' style='width: 10%;'>
                            NETO<?php echo e($tipoprecio); ?>

                        </th>
                    <?php endif; ?>
                </tr>

                <?php $linea=0; ?>
                <?php $__currentLoopData = $catalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $dp = $t->ppre;
                $dv = $t->dv;
                if ($tipo == 'A') {
                    $dp = 0.00;
                    $dv = 0.00;
                }
                $precio = CalculaPrecioNeto($t->$variable, $t->da, $di, $dc, $pp, $dp, $dv, $dvp);
                ?>
                <?php if(!is_null($t->opc1)): ?>
                    <?php if($c->codcat == $t->opc1): ?>
                    <tr>
                        <?php $linea++; ?>
                        <td><?php echo e($linea); ?></td>
                        <?php if($cfg->mostrarCodigo > 0): ?>
                            <td><?php echo e($t->codprod); ?></td>
                        <?php endif; ?>
                        <td><?php echo e($t->desprod); ?></td>

                        <?php if($mostrarCantidad > 0): ?>
                           <td align='right'><?php echo e(number_format($t->cantidad, 0, '.', ',')); ?></td>  
                        <?php endif; ?>
                
                        <td align='right'><?php echo e(number_format($t->iva, 2, '.', ',')); ?></td>
                        <?php if($cfg->mostrarDa > 0): ?>
                           <td align='right'><?php echo e(number_format($t->da, 2, '.', ',')); ?></td>
                        <?php endif; ?>

                        <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                            <td align='right'>
                                <?php echo e(number_format($precio/$tasacambiaria, 2, '.', ',')); ?>

                            </td>
                        <?php endif; ?>
                        <td align='right'>
                            <?php echo e(number_format($precio, 2, '.', ',')); ?>

                        </td>
                   
                    </tr>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>  
    <?php endif; ?>

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

<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/layouts/rptcatalogo.blade.php ENDPATH**/ ?>