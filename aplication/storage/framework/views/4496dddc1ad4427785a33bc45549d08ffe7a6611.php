
<?php $__env->startSection('contenido'); ?>
 
<?php
$chart_data = "";
?>
<?php if(Auth::user()->tipo == 'C' 
  || Auth::user()->tipo == 'G'
  || Auth::user()->tipo == 'V' ): ?> 
  <?php
  $codcli = sCodigoClienteActivo();
  $cliente = DB::table('cliente')
  ->where('codcli','=',$codcli)
  ->first();
  if ($cliente) {
    $DctoPreferencial = $cliente->DctoPreferencial;
    $reg = explode(";", $DctoPreferencial);
    $contador = count($reg);
    $chart_data = MesesActivoPreferencial();
  }
  $fechaHoy = date("Y-m-d H:i:s");
  $mes = date("m", strtotime($fechaHoy));  
  $anio = date("Y", strtotime($fechaHoy)); 
  $idmes = $mes.'/'.$anio;
  ?>
  <?php if(!empty($DctoPreferencial)): ?>
     <?php if($contador > 0): ?>
        <div class="table-responsive hidden-xs hidden-sm hidden-md" 
            style="margin-bottom: 8px;">
            <a href="" 
                data-target="#modal-vip" 
                data-toggle="modal"
                style="color: #000000;">
                <table class="table-striped 
                    table-bordered 
                    table-condensed 
                    table-hover"
                    id="idtabla2">
                  <thead style="background-color: #b7b7b7;"
                      title="VER GRAFICAS">
                      <th><center>MES</center></th>
                      <?php for($x=0; $x < $contador; $x++): ?>
                        <?php
                        $campo = explode("-", $reg[$x]);
                        $mes = $campo[0];
                        ?>
                        <?php if($mes <= $idmes): ?>
                            <th colspan="3">&nbsp;&nbsp;&nbsp;&nbsp<?php echo e($campo[0]); ?></th>
                        <?php endif; ?>
                      <?php endfor; ?>
                  </thead>
                  <tr style="font-size: 10px;">
                      <td title="<?php echo e($cfg->msgLitVip); ?>">
                        <b title="<?php echo e($cfg->msgLitVip); ?>"><?php echo e($cfg->LitVip); ?></b>
                      </td>
                      <?php for($x=0; $x < $contador; $x++): ?>
                        <?php
                        $campo = explode("-", $reg[$x]);
                        $mes = $campo[0];
                        $dcto = $campo[1]; 
                        $cuota = $campo[2];
                        $acum = $campo[3];
                        ?>
                        <?php if($mes <= $idmes): ?>
                            <td align="right" 
                                title="DESCUENTO <?php echo e($cfg->msgLitVip); ?> <?php echo e(number_format($dcto, 2, '.', ',')); ?>% ">
                              <?php echo e(number_format($dcto, 2, '.', ',')); ?>%
                            </td>
                            <td align="right" 
                                title="CUOTA <?php echo e($cfg->msgLitVip); ?>">
                              <?php echo e(number_format($cuota, 0, '.', ',')); ?>

                            </td>
                            <td align="right" 
                                title="ACUMULADO <?php echo e($cfg->msgLitVip); ?>">
                              <b><?php echo e(number_format($acum, 0, '.', ',')); ?></b>
                            </td>
                        <?php endif; ?>
                      <?php endfor; ?>
                  </tr>
                </table>
            </a>
            <?php echo $__env->make('seped.catalogo.vip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>


<style type="text/css">
.tooltip-container {
  margin: 0 auto;
  display: inline-block;
}
/* EMPIEZA AQUÍ */
.tooltip-container {
  position: relative;
  cursor: pointer;
}


.tooltip-one {
  padding: 18px 32px;
  background: #fff;
  position: absolute;
  width: 260px;
  height: 192px;
  border-radius: 5px;
  text-align: center;
  filter: drop-shadow(0 3px 5px #ccc);
  line-height: 1.5;
  display: none;
  top: -50px;
  right: 280%;
  margin-right: -100px;
  margin-left: 5px;
  border-radius: 15px;
}

.tooltip-one:after {
  content: "";
  position: absolute;
  top: 50%;
  left: 100%;
  margin-left: -9px;
  width: 18px;
  height: 18px;
  background: white;
  transform: rotate(45deg);
}

.tooltip-trigger:hover + .tooltip-one {
  display: block;
}
</style>

<input hidden id="idforma" type="text" value="<?php echo e($forma); ?>">
<!-- BOTONES BARRA DE BOTONESS -->
<?php echo $__env->make('seped.catalogo.catabarra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($modovisual == "T"): ?>
    <?php if($tipo=="G"): ?>
        <!-- CATEGORIAS -->
        <div class="col-md-12">
            <div class="row" style="width: 100%; margin-bottom: 0px; margin-top: 30px;">
                <div class="products-tab">
                    <!-- tab -->
                    <div id="tab1" class="tab-pane active">
                        <div class="products-slick" data-nav="#slick-nav-1">
                            <?php $__currentLoopData = $categoria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- shop -->
                                <div class="col-md-4 col-xs-6">
                                    <div class="shop">
                                        <div class="shop-img" >
                                            <center>
                                            <a href="<?php echo e(URL::action('AdcatalogoController@listado','G_'.$cat->codcat)); ?>" class="cta-btn">
                                                <img src="<?php echo e(asset( '/public/storage/'.NombreImagenCat($cat->codcat) )); ?>" alt="" style="height: 100px;">
                                            </a>
                                            </center>
                                        </div>
                                        <div class="shop-body">
                                            <a href="<?php echo e(URL::action('AdcatalogoController@listado','G_'.$cat->codcat)); ?>" class="cta-btn">
                                                <center><h4><?php echo e($cat->nomcat); ?></h4></center>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div id="slick-nav-1" 
                            class="products-slick-nav colorPromDias">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($tipo=="M"): ?>
        <!-- MARCAS -->
        <div class="col-md-12">
            <div class="row" style="width: 100%; margin-bottom: 15px; margin-top: 30px;">
                <div class="products-tab">
                    <!-- tab -->
                    <div id="tab1" class="tab-pane active">
                        <div class="products-slick" data-nav="#slick-nav-1">
                            <?php $__currentLoopData = $marca; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <!-- shop -->
                                <div class="col-md-4 col-xs-6">
                                    <div class="shop">
                                        <div class="shop-img" >
                                            <center>
                                            <a href="<?php echo e(URL::action('AdcatalogoController@listado','M_'.$m->codmarca)); ?>" 
                                                class="cta-btn">
                                                <img src="<?php echo e(asset( '/public/storage/'.NombreImagenMarca($m->codmarca) )); ?>" alt="" style="height: 100px;">
                                            </a>
                                            </center>
                                        </div>
                                        <div class="shop-body">
                                            <a href="<?php echo e(URL::action('AdcatalogoController@listado','M_'.$m->codmarca)); ?>" 
                                                class="cta-btn">
                                                <center><h4><?php echo e($m->desmarca); ?></h4></center>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div> 
                        <div id="slick-nav-1" 
                            class="products-slick-nav colorPromDias">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($tipo=="F"): ?>
        <?php if(Auth::user()->tipo == "C" || Auth::user()->tipo == "G" || Auth::user()->tipo == "V"): ?>
            <a href="<?php echo e(url('/seped/catalogo/borrar')); ?>" title="Borrar todas las alertas de notificación">
                <i class="fa fa-trash-o"></i> Borrar todas las alertas
            </a>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <?php if($cfg->mostrarBarraNavCatInicio > 0): ?>
                        <div align='right' style="height: 60px;" >
                            <?php echo e($catalogo->appends(["filtro" => $filtro])->links()); ?>

                        </div>
                    <?php else: ?>
                        <br>
                    <?php endif; ?>
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="colorTitulo">
                            <th>#</th>
                            <?php if(Auth::user()->tipo == "C" || Auth::user()->tipo == "G" || Auth::user()->tipo == "V"): ?>
                                <th style="width:60px;" title="Activar notificación">ALERTA</th>
                            <?php endif; ?>
                            <th>PRODUCTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>CODIGO</th>
                            <th>BARRA</th>
                            <th>MARCA</th>
                            <th>PRINCIPIO ACTIVO</th>
                        </thead>
                        <?php $__currentLoopData = $catalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <?php if(Auth::user()->tipo == "C" || Auth::user()->tipo == "G" || Auth::user()->tipo == "V"): ?>
                                <td style="padding-top: 10px;">
                                    <span onclick='tdclickAlerta(event);' >
                                    <center>
                                    <?php if(VerificarProdFallaAlerta($c->codprod)): ?>
                                        <input type="checkbox" id="idalerta_<?php echo e($c->codprod); ?>" checked />
                                    <?php else: ?>
                                        <input type="checkbox" id="idalerta_<?php echo e($c->codprod); ?>"  />
                                    <?php endif; ?>
                                    </center>
                                    </span>
                                </td>
                            <?php endif; ?>
                            <td>
                                <b><?php echo e($c->desprod); ?></b>
                            </td>
                            <td><?php echo e($c->codprod); ?></td>
                            <td><?php echo e($c->barra); ?></td>
                            <td><?php echo e($c->marcamodelo); ?></td>
                            <td><?php echo e($c->pactivo); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                    <div align='right'>
                        <?php echo e($catalogo->appends(["filtro" => $filtro])->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- TABLAS DE PRODUCTOS -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive"> 
                    <?php if($cfg->mostrarBarraNavCatInicio > 0): ?>
                        <?php if($catalogo->count()>=200): ?>
                            <div align='right' style="height: 60px;" >
                                <?php echo e($catalogo->appends(["filtro" => $filtro])->links()); ?>

                            </div>
                        <?php else: ?>
                            <br>
                        <?php endif; ?>
                    <?php else: ?>
                        <br>
                    <?php endif; ?>
                    <table id="idtabla" 
                        class="table table-striped table-bordered table-condensed table-hover" >
                        <thead class="colorTitulo">
                            <!-- O NUMERO -->
                            <th>#</th>

                            <!-- 1 IMAGEN -->
                            <?php if( $cfg->mostrarImagen > 0 ): ?>
                                <th class="hidden-xs"
                                    style="width: 120px;">
                                    <center>IMAGEN</center>
                                </th>
                            <?php else: ?>
                                <th class="hidden-xs">OPCION</th>
                            <?php endif; ?>

                            <!-- 2 PEDIR -->
                            <?php if(Auth::user()->tipo!='A' && Auth::user()->tipo!='S'): ?>
                                <th style="width: 110px;" 
                                    title="Cantidad a pedir">
                                    PEDIR
                                </th>
                            <?php endif; ?>

                            <!-- 3 DESCRIPCION -->
                            <th title="Descripción de producto">
                                PRODUCTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </th>

                            <!-- 4 LOTE -->
                            <?php if(Auth::user()->tipo == "V"): ?>
                                <th <?php if( $cfg->mostrarLote > 0 ): ?>
                                        class="hidden-xs" title="Lote/Vencimiento del producto"
                                    <?php else: ?>
                                        style="display:none;"
                                    <?php endif; ?> >
                                    LOTE
                                </th>
                            <?php endif; ?>
                            <?php if(Auth::user()->tipo == "C" || Auth::user()->tipo == "G"): ?>
                                <th <?php if( $cfg->mostrarLoteCliente > 0 ): ?>
                                        class="hidden-xs" title="Lote/Vencimiento del producto"
                                    <?php else: ?>
                                        style="display:none;"
                                    <?php endif; ?> >
                                    LOTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </th>
                            <?php endif; ?>

                            <!-- 5 CODIGO -->
                            <th <?php if( $cfg->mostrarCodigo > 0 ): ?>
                                    class="hidden-xs" title="Código del producto"
                                <?php else: ?>
                                    style="display:none;"
                                <?php endif; ?> >
                                CODIGO
                            </th>

                            <!-- 6 BULTO -->
                            <th <?php if( $cfg->mostrarBulto > 0 ): ?>
                                    class="hidden-xs" title="Unidad de manejo del bulto"
                                <?php else: ?>
                                    style="display:none;"
                                <?php endif; ?> >
                                U.M.
                            </th>

                            <!-- 7 CEXISTENCIA -->
                            <th title="Cantidad dispoible del inventario">EXIST.</th>
                            
                            <!-- 8 PRECIO -->
                            <?php if(Auth::user()->tipo=='A' || Auth::user()->tipo=='S'): ?>
                                <?php for($i = 1; $i <= $cfg->cantPrecioUtilizar; $i++): ?>
                                    <th title="<?php echo e($cfg->msgLitPrecio); ?>">
                                        <?php echo e($cfg->LitPrecio); ?><?php echo e($i); ?>

                                    </th>
                                <?php endfor; ?>
                            <?php else: ?>
                                <th title="<?php echo e($cfg->msgLitPrecio); ?>">
                                    <?php echo e($cfg->LitPrecio); ?>

                                </th>
                            <?php endif; ?>

                            <!-- 9 IVA -->
                            <th class="hidden-xs" title="Impuesto al valor agregado">IVA</th>
                      
                            <!-- 10 DV -->
                            <th <?php if( $cfg->mostrarDv > 0 ): ?>
                                    class="hidden-xs" title="<?php echo e($cfg->msgLitDv); ?>"
                                    style = "width: 100px;";
                                <?php else: ?>
                                    style="display:none;"
                                <?php endif; ?> >
                                <?php echo e($cfg->LitDv); ?> &nbsp;&nbsp;&nbsp;
                            </th>

                            <!-- 11 DA -->
                            <th <?php if( $cfg->mostrarDa > 0 ): ?>
                                    class="hidden-xs" title="<?php echo e($cfg->msgLitDa); ?>"
                                <?php else: ?>
                                    style="display:none;"
                                <?php endif; ?> >
                                <?php echo e($cfg->LitDa); ?>

                            </th>

                            <!-- 12 DP -->
                            <th <?php if( $cfg->mostrarDp > 0 ): ?>
                                    class="hidden-xs" title="<?php echo e($cfg->msgLitDp); ?>"
                                <?php else: ?>
                                    style="display:none;"
                                <?php endif; ?> >
                                <?php echo e($cfg->LitDp); ?>

                            </th>

                            <?php if(Auth::user()->tipo=='V' || Auth::user()->tipo=='C' || Auth::user()->tipo=='G'): ?>
                                <th <?php if( $cfg->mostrarDi > 0 ): ?>
                                        class="hidden-xs" title="<?php echo e($cfg->msgLitDi); ?>"
                                    <?php else: ?>
                                        style="display:none;"
                                    <?php endif; ?> >
                                    <?php echo e($cfg->LitDi); ?>

                                </th>
         
                                <th <?php if( $cfg->mostrarDc > 0 ): ?>
                                        class="hidden-xs" title="<?php echo e($cfg->msgLitDc); ?>"
                                    <?php else: ?>
                                        style="display:none;"
                                    <?php endif; ?> >
                                    <?php echo e($cfg->LitDc); ?>

                                </th>

                                <th <?php if( $cfg->mostrarPp > 0 ): ?>
                                        class="hidden-xs" title="<?php echo e($cfg->msgLitPp); ?>"
                                    <?php else: ?>
                                        style="display:none;"
                                    <?php endif; ?> >
                                    <?php echo e($cfg->LitPp); ?>

                                </th>
                            <?php endif; ?>

                          
                            <?php if(Auth::user()->tipo=='V' || Auth::user()->tipo=='C' || Auth::user()->tipo=='G'): ?>
                                <?php if( $cfg->mostrarNetoCatalogo > 0 ): ?>
                                    <th>NETO</th>
                                <?php endif; ?>
                                <th <?php if(!empty($cliente->DctoPreferencial)): ?>
                                        title="NETO <?php echo e($cfg->msgLitVip); ?>"
                                        class="colorVip"
                                    <?php else: ?>
                                        style="display:none;"
                                    <?php endif; ?> >
                                    <center>
                                        <img src="<?php echo e(asset('images/clientepref.png')); ?>" 
                                        alt="seped" 
                                        style="margin-top: 0px; width: 28px;">
                                    </center>
                                </th>
                            <?php endif; ?>

                            <th <?php if( $cfg->mostrarBarra > 0 ): ?>
                                    class="hidden-xs" title="Código de referencia del producto"
                                <?php else: ?>
                                    style="display:none;"
                                <?php endif; ?> >
                                BARRA
                            </th>
                    
                            <th <?php if( $cfg->mostrarMarca > 0 ): ?>
                                    class="hidden-xs" title="Nombre de la marca del producto"
                                <?php else: ?>
                                    style="display:none;"
                                <?php endif; ?> >
                                MARCA
                            </th>

                            <th <?php if( $cfg->mostrarComponente > 0 ): ?>
                                    class="hidden-xs" title="Componente o principio activo del producto"
                                <?php else: ?>
                                    style="display:none;"
                                <?php endif; ?> >
                                P.ACTIVO
                            </th>

                            <th style="display:none;">CANTIDAD</th>

                            <?php if($tipo=="E"): ?>
                                <th class="hidden-xs" title="Fecha de entrada del producto" style="width: 90px;">
                                    ENTRADA
                                </th>
                            <?php endif; ?>

                            <?php if($tipo=="G"): ?>
                                <th class="hidden-xs" title="Categoria del producto">
                                CATEGORIA
                                </th>
                            <?php endif; ?>
                        </thead>
                        <?php $__currentLoopData = $catalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $da = 0.00;
                            $dv = 0.00;
                            $dp = 0.00;
                            $dvp = 0.00;
                            $up = "";
                            $dias = sRetornaPromDias($cat->codprod, "");
                            $tooltipDv = array();
                            if ($cfg->aplicarDaPrecio == $tipoprecio) {
                                $da = $cat->da;
                                $dv = $cat->dv;
                                $dp = $cat->ppre;
                                $up = 'UP: '.$cat->upre;
                                if (isset($cliente->DctoPreferencial)) {
                                    $datadvp = MesActivoPreferencial($cliente->DctoPreferencial);
                                    $dvp = $datadvp['dcto'];
                                }
                            }
                            $fecvence = str_replace('12:00:00 AM', '', $cat->fecvence);
                            $fecvence = str_replace('12:00:00 PM', '', $fecvence);
                            $fecvence = str_replace('00:00:00', '', $fecvence);
                            $cadlote = trim($cat->lote.' '.$fecvence);
                            if (empty($cadlote))
                                $cadlote = 'N/A';
                            $tooltip = sVerificarCaractExt($cat->codprod); 
                           
                            $toltips = "\n";
                            $separador = ";";
                            $listaDcto = $cat->dvDetalle;
                            if (substr($listaDcto, -1) != $separador)
                                $listaDcto = $listaDcto.$separador;
                            $listaDcto = explode($separador, $listaDcto);
                            for ($i = 0; $i < count($listaDcto); $i++) {
                                $s1 = explode("-", $listaDcto[$i]);
                                if (count($s1) > 1) {
                                    $desde = $s1[0];
                                    $hasta = $s1[1];
                                    $dcto = $s1[2];
                                    $liq = "";
                                    if (isset($s1[3])) {
                                        $liq = $s1[3];
                                    }
                                    if ($liq == "") {
                                        $toltips .=    "mas de ".$desde." => ".$dcto."% \n";
                                        $tooltipDv[] = "mas de ".$desde." => ".$dcto."% ";
                                    } else {
                                        $toltips    .= "mas de ".$desde." = ".$dcto."% => ".$liq." ".$cfg->simboloOM." \n";
                                        $tooltipDv[] = "mas de ".$desde." - ".$dcto."% => ".$liq." ".$cfg->simboloOM;
                                    }
                                }
                            }
                            ?>
                            <tr>

                                <!-- O NUMERO -->
                                <td >
                                    <div class="col-xs-12 input-group">
                                        <div align="center">
                                        <?php echo e($loop->iteration); ?>

                                        </div>
                                    </div>
                                    <?php if($cfg->ActivarMincp > 0 && !empty($cfg->KeyMincp)): ?>
                                        <?php if($cat->SuperOFertaMincp > 0 && !empty($cat->barra) ): ?>
                                            <div align="center" style="width: 35px;">
                                                <a href="" 
                                                   data-target="#modal-superoferta-<?php echo e($cat->codprod); ?>" 
                                                   data-toggle="modal">
                                                    <blink>
                                                    <img src="<?php echo e(asset('/images/superoferta.png')); ?>" width="100%" 
                                                    class="img-responsive">
                                                    </blink>
                                                </a>
                                                <?php echo $__env->make('seped.catalogo.superoferta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        <?php else: ?>
                                            <?php if( $cfg->mostrarDv > 0 || $cfg->mostrarDa > 0): ?> 
                                                <?php if( ($dv > 0 && !is_null($cat->dvDetalle)) 
                                                    || ($da > 0) ): ?>
                                                    <div align="center" style="width: 35px;">
                                                    <blink>
                                                    <img src="<?php echo e(asset('/images/superoferta.png')); ?>" 
                                                        width="100%" 
                                                        class="img-responsive">
                                                    </blink>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>

                                <!-- 1 IMAGEN -->
                                <?php if( $cfg->mostrarImagen > 0): ?>
                                    <td class="hidden-xs">
                                        <div align="center" 
                                            style="width: 110px;">
                                            <a href="<?php echo e(URL::action('AdreportController@producto',$cat->codprod)); ?>">
                                                <img src="<?php echo e(asset('/public/storage/'.NombreImagen($cat->codprod))); ?>" 
                                                width="100%"  
                                                style="border: 2px solid #D2D6DE;"
                                                class="img-responsive">
                                            </a>
                                        </div>
                                    </td>
                                <?php else: ?>
                                    <td class="hidden-xs">
                                        <!-- VER DETALLES -->
                                        <a href="<?php echo e(URL::action('AdreportController@producto',$cat->codprod)); ?>">
                                            <button class="btn btn-default fa fa-file-o" title="Consultar producto">
                                            </button>
                                        </a>
                                    </td>
                                <?php endif; ?>

                                <!-- 2 PEDIR -->
                                <?php if(Auth::user()->tipo!='A' && Auth::user()->tipo!='S'): ?>
                                <td style="width: 110px;">
                                    <!-- AGREGAR A CARRO DE COMPRA -->
                                    <div class="col-xs-12 input-group" >
                                        
                                        <input id="idpedir_<?php echo e($cat->codprod); ?>" 
                                            style="text-align: center; 
                                            color: #000000; 
                                            width: 60px;" 
                                            value="" 
                                            class="form-control" >

                                        <span class="input-group-btn" 
                                            onclick='tdclick(event);'>
                                            <button id="idBtn1_<?php echo e($cat->codprod); ?>"
                                                type="button" 
                                                class="btn btn-default btn-pedido
                                            
                                            <?php if(VerificarCarrito($cat->codprod)): ?>
                                                colorResaltado
                                            <?php endif; ?>

                                            " data-toggle="tooltip" 
                                                title="Agregar al carrito" >
                                                <span class="fa fa-cart-plus" 
                                                    aria-hidden="true" 
                                                    id="idBtn2_<?php echo e($cat->codprod); ?>">
                                                </span>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <?php endif; ?>

                                <!-- 3 DESCRIPCION -->
                                <td title = "<?php echo e($tooltip); ?>">
                                    <?php if($tooltip != ''): ?>
                                        <span 
                                            style="color: red; font-size: 20px;"> <b>!</b> 
                                        </span>
                                    <?php endif; ?>
                                    <?php if( $cfg->mostrarPactaDesc > 0 && $cfg->mostrarMarcaDesc): ?>
                                        <!-- 3 DESCRIPCION, P.ACTIVO Y MARCA -->
                                        <b><?php echo e($cat->desprod); ?></b> 
                                        <?php if( !empty($cat->pactivo) 
                                            && $cat->pactivo != 'N/A'): ?>
                                            <span title="PRINCIPIO ACTIVO DEL PRODUCTO">
                                                <br><small>
                                                <i class="fa fa-bars" aria-hidden="true"></i>
                                                &nbsp;<?php echo e($cat->pactivo); ?>

                                                </small> 
                                            </span>
                                        <?php endif; ?>
                                        <?php if( !empty($cat->marcamodelo) 
                                            && $cat->marcamodelo != 'N/A'): ?>
                                            <span title="MARCA DEL PRODUCTO">
                                                <br><small>
                                                    <i class="fa fa-shield" aria-hidden="true"></i>
                                                    &nbsp;<?php echo e($cat->marcamodelo); ?>

                                                </small> 
                                            </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if( $cfg->mostrarPactaDesc > 0 
                                            && $cfg->mostrarMarcaDesc == 0): ?>
                                            <!-- 3 DESCRIPCION Y P.ACTIVO  -->
                                            <b><?php echo e($cat->desprod); ?></b> 
                                            <?php if( !empty($cat->pactivo) 
                                                && $cat->pactivo != 'N/A'): ?>
                                                <span title="PRINCIPIO ACTIVO DEL PRODUCTO"> 
                                                    <br><small>
                                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                                    &nbsp;<?php echo e($cat->pactivo); ?>

                                                    </small> 
                                                </span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if( $cfg->mostrarMarcaDesc > 0 && $cfg->mostrarPactaDesc == 0): ?>
                                                <!-- 3 DESCRIPCION Y MARCA  -->
                                                <b><?php echo e($cat->desprod); ?></b> 
                                                <?php if( !empty($cat->marcamodelo) 
                                                    && $cat->marcamodelo != 'N/A'): ?>
                                                    <span title="MARCA DEL PRODUCTO">
                                                        <br><small>
                                                        <i class="fa fa-shield" aria-hidden="true"></i>
                                                        &nbsp;<?php echo e($cat->marcamodelo); ?>

                                                        </small> 
                                                    </span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <!-- 3 DESCRIPCION (SOLO)  -->
                                                <B><?php echo e($cat->desprod); ?></B>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($dias > 0): ?>
                                        <div class="colorPromDias"
                                            style="margin-top: 5px;
                                            border-radius: 5px; 
                                            font-size: 14px;
                                            text-align: center;
                                            padding: 1px; 
                                            color: white;
                                            width: 70px;
                                            background-color: black;"
                                            title="DIAS DE CREDITO: <?php echo e($dias); ?>">
                                            DIAS: <?php echo e($dias); ?> 
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <!-- 4 LOTE -->
                                <?php if(Auth::user()->tipo == "V"): ?>
                                    <?php if( $cfg->mostrarLote > 0 ): ?>
                                        <td class="hidden-xs">
                                            <?php echo e($cadlote); ?> 
                                        </td>
                                    <?php else: ?>
                                        <td style="display:none;">
                                            <?php echo e($cadlote); ?> 
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(Auth::user()->tipo == "C" || Auth::user()->tipo == "G"): ?>
                                    <?php if( $cfg->mostrarLoteCliente > 0 ): ?>
                                        <td  class="hidden-xs">
                                             <?php echo e($cadlote); ?> 
                                        </td>
                                    <?php else: ?>
                                        <td style="display:none;">
                                            <?php echo e($cadlote); ?> 
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- 5 CODIGO -->
                                <?php if( $cfg->mostrarCodigo > 0 ): ?>
                                    <td id="idcodprod_<?php echo e($loop->iteration); ?>" class="hidden-xs">
                                        <?php echo e($cat->codprod); ?>

                                    </td>
                                <?php else: ?>
                                    <td id="idcodprod_<?php echo e($loop->iteration); ?>" style="display:none;">
                                        <?php echo e($cat->codprod); ?>

                                    </td>
                                <?php endif; ?>

                                <!-- 6 BULTO -->
                                <?php if( $cfg->mostrarBulto > 0 ): ?>
                                    <td  class="hidden-xs" align="right">
                                        <?php echo e($cat->original); ?>

                                    </td>
                                <?php else: ?>
                                    <td style="display:none;" >
                                        1
                                    </td>
                                <?php endif; ?>
                              
                                <!-- 7 EXISTENCIA -->
                                <td id="idCant_<?php echo e($cat->codprod); ?>" align="right">        
                                    <?php echo e(number_format($cat->cantidad, 0, '.', ',')); ?>

                                </td>

                                <!-- 8 PRECIO -->
                                <?php if(Auth::user()->tipo=='A' || Auth::user()->tipo=='S'): ?>
                                    <?php for($i = 1; $i <= $cfg->cantPrecioUtilizar; $i++): ?>
                                        <?php 
                                        $var1 = 'precio'.$i;
                                        $precio = $cat->$var1 
                                        ?>
                                        <td align='right'>
                                            <b><?php echo e(number_format($precio, 2, '.', ',')); ?></b>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <br>
                                                <span style="color: green;" >
                                                    <b><?php echo e(number_format($precio / (
                                                   ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endfor; ?>
                                <?php else: ?>
                                    <td align='right' >
                                        <?php if($tipoprecio == 1): ?>
                                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                            <b><?php echo e(number_format($cat->precio1, 2, '.', ',')); ?></b>
                                            </span>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <br>
                                                <span style="color: green;" 
                                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                                    <b><?php echo e(number_format($cat->precio1/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                </span>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 2): ?>
                                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                            <b><?php echo e(number_format($cat->precio2, 2, '.', ',')); ?></b>
                                            </span>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <br>
                                                <span style="color: green;" 
                                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                                    <b><?php echo e(number_format($cat->precio2/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                </span>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 3): ?>
                                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                            <b><?php echo e(number_format($cat->precio3, 2, '.', ',')); ?></b>
                                            </span>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <br>
                                                <span style="color: green;" 
                                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                                    <b><?php echo e(number_format($cat->precio3/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                </span>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 4): ?>
                                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                            <b><?php echo e(number_format($cat->precio4, 2, '.', ',')); ?></b>
                                            </span>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <br>
                                                <span style="color: green;" 
                                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                                    <b><?php echo e(number_format($cat->precio4/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                </span>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 5): ?>
                                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                            <b><?php echo e(number_format($cat->precio5, 2, '.', ',')); ?></b>
                                            </span>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <br>
                                                <span style="color: green;" 
                                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                                    <b><?php echo e(number_format($cat->precio5/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                </span>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 6): ?>
                                            <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                            <b><?php echo e(number_format($cat->precio6, 2, '.', ',')); ?></b>
                                            </span>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <br>
                                                <span style="color: green;" 
                                                    title= "<?php echo e($cfg->simboloOM); ?>">
                                                    <b><?php echo e(number_format($cat->precio6/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                </span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>

                                <!-- 9 IVA -->
                                <td class="hidden-xs" align="right">
                                    <?php echo e(number_format($cat->iva, 2, '.', ',')); ?>

                                </td>

                                <!-- 10 DV -->
                                <?php if( $cfg->mostrarDv > 0 ): ?>
                                    <?php if($dv > 0 && !is_null($cat->dvDetalle)): ?>
                                        <td class="hidden-xs" 
                                            align='right' 
                                            style="color: red; width: 90px;">
                                            <?php echo e(number_format($dv, 2, '.', ',')); ?>

                                            <br>
                                            <div class="tooltip-container">

                                              <blink>
                                              <img src="<?php echo e(asset('/images/preemp.png')); ?>"  
                                                    class="tooltip-trigger"
                                                    style="margin-top: 5px; width: 60px;"
                                                    id="focusArea" 
                                                    onmousemove="getPos(event)" >
                                              </blink>
                                              <div class="tooltip-one">
                                                <img src="<?php echo e(asset('/images/preemp.png')); ?>"  
                                                    class="img-responsive"
                                                    align="left"
                                                    style="margin-top: 5px; width: 60px;">
                                                <span style="color: black;">
                                                    <?php echo e(strtoupper($cfg->msgLitDv)); ?>

                                                </span><br>
                                                <span style="color: black;">
                                                    ============================
                                                </span><br>
                                                <?php for($x = 0; $x < count($tooltipDv); $x++): ?> 
                                                    <span style="color: black;">
                                                        <?php echo e($tooltipDv[$x]); ?>

                                                    </span><br>
                                                <?php endfor; ?>
                                              </div>
                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td class="hidden-xs" 
                                            align='right'
                                            style="width: 90px;">
                                            <?php echo e(number_format($dv, 2, '.', ',')); ?>

                                        </td>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <td style="display:none;">
                                        <?php echo e(number_format($dv, 2, '.', ',')); ?>

                                    </td>
                                <?php endif; ?>
                            
                                <!-- 11 DA -->
                                <?php if( $cfg->mostrarDa > 0 ): ?>
                                    <?php if($da > 0): ?>
                                        <td title = "<?php echo e(strtoupper($cfg->msgLitDa)); ?>" 
                                            class="hidden-xs" 
                                            align='right' 
                                            style="color: red;">
                                            <?php echo e(number_format($da, 2, '.', ',')); ?>

                                        </td>
                                    <?php else: ?>
                                        <td class="hidden-xs" align='right'>
                                            <?php echo e(number_format($da, 2, '.', ',')); ?>

                                        </td>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <td style="display:none;">
                                        <?php echo e(number_format($da, 2, '.', ',')); ?>

                                    </td>
                                <?php endif; ?>

                                <!-- 12 DP -->
                                <?php if( $cfg->mostrarDp > 0 ): ?>
                                    <?php if($dp > 0): ?>
                                        <td
                                            title = "<?php echo e(strtoupper($cfg->msgLitDp)); ?> &#10======================== &#10Multiplos de pre-emapque: <?php echo e($cat->upre); ?>"
                                            class="hidden-xs" 
                                            align='right' 
                                            style="color: red;">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e(number_format($dp, 2, '.', ',')); ?>

                                            <div title="UNIDAD DE PRE-EMPAQUE">
                                            <?php echo e($up); ?>

                                            </div>
                                        </td>
                                    <?php else: ?>
                                        <td class="hidden-xs" align='right'>
                                            <?php echo e(number_format($dp, 2, '.', ',')); ?>

                                        </td>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <td style="display:none;">
                                        <?php echo e(number_format($dp, 2, '.', ',')); ?>

                                    </td>
                                <?php endif; ?>

                                <?php if(Auth::user()->tipo=='V' || Auth::user()->tipo=='C' || Auth::user()->tipo=='G'): ?>
                                    <!-- 13 Di -->
                                    <?php if( $cfg->mostrarDi > 0 ): ?>
                                        <?php if($di > 0): ?>
                                            <td title = "<?php echo e(strtoupper($cfg->msgLitDi)); ?>" 
                                                class="hidden-xs" 
                                                align='right' 
                                                style="color: red;">
                                                <?php echo e(number_format($di, 2, '.', ',')); ?>

                                            </td>
                                        <?php else: ?>
                                            <td class="hidden-xs" align='right'>
                                                <?php echo e(number_format($di, 2, '.', ',')); ?>

                                            </td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td  style="display:none;">
                                           <?php echo e(number_format($di, 2, '.', ',')); ?> 
                                        </td>
                                    <?php endif; ?>
                              
                                    <!-- 14 DC -->
                                    <?php if( $cfg->mostrarDc > 0 ): ?>
                                        <?php if($dc > 0): ?>
                                            <td title = "<?php echo e(strtoupper($cfg->msgLitDc)); ?>" 
                                                class="hidden-xs" 
                                                align='right' 
                                                style="color: red;">
                                                <?php echo e(number_format($dc, 2, '.', ',')); ?>

                                            </td>
                                        <?php else: ?>
                                            <td class="hidden-xs" align='right'>
                                                <?php echo e(number_format($dc, 2, '.', ',')); ?> 
                                            </td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td style="display:none;">
                                            <?php echo e(number_format($dc, 2, '.', ',')); ?>

                                        </td>
                                    <?php endif; ?>
                                 
                                    <!-- 15 PP -->
                                    <?php if( $cfg->mostrarPp > 0 ): ?>
                                        <?php if($pp > 0): ?>
                                            <td title = "<?php echo e(strtoupper($cfg->msgLitPp)); ?>" 
                                                class="hidden-xs" 
                                                align='right' 
                                                style="color: red;">
                                                <?php echo e(number_format($pp, 2, '.', ',')); ?>

                                            </td>
                                        <?php else: ?>
                                            <td class="hidden-xs" align='right'>
                                                <?php echo e(number_format($pp, 2, '.', ',')); ?> 
                                            </td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td style="display:none;">
                                            <?php echo e(number_format($pp, 2, '.', ',')); ?>

                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- 16 PRECIO NETO -->
                                <?php if(Auth::user()->tipo=='V' || Auth::user()->tipo=='C' || Auth::user()->tipo=='G'): ?>
                                    <?php if( $cfg->mostrarNetoCatalogo > 0 ): ?>
                                        <?php 
                                            $dvpx = 0.00;
                                            //$dvx = 0.00;
                                            $neto1 = CalculaPrecioNeto($cat->precio1, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto2 = CalculaPrecioNeto($cat->precio2, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto3 = CalculaPrecioNeto($cat->precio3, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto4 = CalculaPrecioNeto($cat->precio4, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto5 = CalculaPrecioNeto($cat->precio5, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto6 = CalculaPrecioNeto($cat->precio6, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                        ?>
                                        <td align='right'>
                                            <?php if($tipoprecio == 1): ?>
                                                <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                <b><?php echo e(number_format($neto1, 2, '.', ',')); ?></b>
                                                </span>
                                                <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "<?php echo e($cfg->simboloOM); ?>">
                                                        <b><?php echo e(number_format($neto1/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                    </span>
                                                <?php endif; ?>
                                            <?php elseif($tipoprecio == 2): ?>
                                                <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                <b><?php echo e(number_format($neto2, 2, '.', ',')); ?></b>
                                                </span>
                                                <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "<?php echo e($cfg->simboloOM); ?>">
                                                        <b><?php echo e(number_format($neto2/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                    </span>
                                                <?php endif; ?>
                                            <?php elseif($tipoprecio == 3): ?>
                                                <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                <b><?php echo e(number_format($neto3, 2, '.', ',')); ?></b>
                                                </span>
                                                <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "<?php echo e($cfg->simboloOM); ?>">
                                                        <b><?php echo e(number_format($neto3/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                    </span>
                                                <?php endif; ?>
                                            <?php elseif($tipoprecio == 4): ?>
                                                <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                <b><?php echo e(number_format($neto4, 2, '.', ',')); ?></b>
                                                </span>
                                                <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "<?php echo e($cfg->simboloOM); ?>">
                                                        <b><?php echo e(number_format($neto4/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                    </span>
                                                <?php endif; ?>
                                            <?php elseif($tipoprecio == 5): ?>
                                                <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                <b><?php echo e(number_format($neto5, 2, '.', ',')); ?></b>
                                                </span>
                                                <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "<?php echo e($cfg->simboloOM); ?>">
                                                        <b><?php echo e(number_format($neto5/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                    </span>
                                                <?php endif; ?>
                                            <?php elseif($tipoprecio == 6): ?>
                                                <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                <b><?php echo e(number_format($neto6, 2, '.', ',')); ?></b>
                                                </span>
                                                <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "<?php echo e($cfg->simboloOM); ?>">
                                                        <b><?php echo e(number_format($neto6/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <!-- PRECIO NETO VIP -->
                                        <?php if(!empty($cliente->DctoPreferencial)): ?>
                                            <td align='right'
                                                class="colorVip2">
                                                <?php 
                                                    $neto1 = CalculaPrecioNeto($cat->precio1, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto2 = CalculaPrecioNeto($cat->precio2, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto3 = CalculaPrecioNeto($cat->precio3, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto4 = CalculaPrecioNeto($cat->precio4, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto5 = CalculaPrecioNeto($cat->precio5, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto6 = CalculaPrecioNeto($cat->precio6, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                ?>
                                                <?php if($tipoprecio == 1): ?>
                                                    <span title= "<?php echo e($cfg->simboloMoneda); ?>, DESCUENTO <?php echo e($cfg->msgLitVip); ?>: <?php echo e($dvp); ?>%">
                                                    <b><?php echo e(number_format($neto1, 2, '.', ',')); ?><b>
                                                    </span>
                                                    <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "<?php echo e($cfg->simboloOM); ?>, DESCUENTO <?php echo e($cfg->msgLitVip); ?>: <?php echo e($dvp); ?>%">
                                                            <b><?php echo e(number_format($neto1/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php elseif($tipoprecio == 2): ?>
                                                    <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                    <b><?php echo e(number_format($neto2, 2, '.', ',')); ?></b>
                                                    </span>
                                                    <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "<?php echo e($cfg->simboloOM); ?>">
                                                            <b><?php echo e(number_format($neto2/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php elseif($tipoprecio == 3): ?>
                                                    <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                    <b><?php echo e(number_format($neto3, 2, '.', ',')); ?></b>
                                                    </span>
                                                    <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "<?php echo e($cfg->simboloOM); ?>">
                                                            <b><?php echo e(number_format($neto3/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php elseif($tipoprecio == 4): ?>
                                                    <td align='right'>
                                                        <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                        <b><?php echo e(number_format($neto4, 2, '.', ',')); ?></b>
                                                        </span>
                                                        <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                            <br>
                                                            <span style="color: green;" 
                                                                title= "<?php echo e($cfg->simboloOM); ?>">
                                                                <b><?php echo e(number_format($neto4/(
                                                                ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php elseif($tipoprecio == 5): ?>
                                                    <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                    <b><?php echo e(number_format($neto5, 2, '.', ',')); ?></b>
                                                    </span>
                                                    <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "<?php echo e($cfg->simboloOM); ?>">
                                                            <b><?php echo e(number_format($neto5/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php elseif($tipoprecio == 6): ?>
                                                    <span title= "<?php echo e($cfg->simboloMoneda); ?>">
                                                    <b><?php echo e(number_format($neto6, 2, '.', ',')); ?></b>
                                                    </span>
                                                    <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "<?php echo e($cfg->simboloOM); ?>">
                                                            <b><?php echo e(number_format($neto6/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?></b>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        <?php else: ?>
                                            <td style="display:none;"></td>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <td style="display:none;"></td>
                                        <td style="display:none;"></td>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <!-- 17 BARRA -->
                                <?php if( $cfg->mostrarBarra > 0 ): ?>
                                    <td class="hidden-xs">
                                        <?php echo e($cat->barra); ?>

                                    </td> 
                                <?php else: ?>
                                    <td style="display:none;">
                                        <?php echo e($cat->barra); ?>

                                    </td>
                                <?php endif; ?>
                       
                                <!-- 18 MARCA -->
                                <?php if( $cfg->mostrarMarca > 0 ): ?>
                                    <td class="hidden-xs"> 
                                        <?php echo e($cat->marcamodelo); ?>

                                    </td>
                                <?php else: ?>
                                    <td style="display:none;">
                                        <?php echo e($cat->marcamodelo); ?>

                                    </td>
                                <?php endif; ?>
                              
                                <!-- 19 PRINCIPIO ACTIVO -->
                                <?php if( $cfg->mostrarComponente > 0 ): ?>
                                    <td class="hidden-xs"> 
                                        <?php echo e($cat->pactivo); ?>

                                    </td>
                                <?php else: ?>
                                    <td style="display:none;">
                                        <?php echo e($cat->pactivo); ?>

                                    </td>
                                <?php endif; ?>
                                
                                <!-- 20 CANTIDAD -->
                                <td style="display:none;"><?php echo e($cat->cantidad); ?></td>

                                <!-- 21 FECHA ENTRADA -->
                                <?php if($tipo=="E"): ?>
                                    <td><?php echo e(date('d-m-Y', strtotime($cat->fechafalla))); ?></td>
                                <?php endif; ?>

                                <!-- 22 DEPARTAMENTO -->
                                <?php if($tipo=="G"): ?>
                                    <td class="hidden-xs">
                                        <?php echo e($cat->departamento); ?>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                    <div align='right'>
                        <?php echo e($catalogo->appends(["filtro" => $filtro])->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if($modovisual == "I"): ?>
<div class="container" style="width: 100%;">
    <div class="row" style="padding: 0px; margin-top: 10px;">
        <div class="products-tabs">
            <!-- tab -->
            <div class="tab-pane fade in active" >
                <div data-nav="#slick-nav-2"  >
                    <table id="idtabla" style="display:none;" >
                        <thead>
                            <th>#</th>
                            <th>IMAGEN</th>
                            <th>PEDIR</th>
                            <th>PRODUCTO</th>
                            <th>LOTE</th>
                            <th>CODIGO</th>
                            <th>U.M.</th>
                            <th>EXIST.</th>
                            <th>PRECIO</th>
                            <th>IVA</th>
                            <th>DA</th>
                            <th>DI</th>
                            <th>DC</th>
                            <th>PP</th>
                            <th>BARRA</th>
                            <th>MARCA</th>
                            <th>P.ACTIVO</th>
                            <th>CANTIDAD</th>
                            <th>ENTRADA</th>
                        </thead>
                        <?php $__currentLoopData = $catalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td></td>
                            <td></td>
                            <td><?php echo e($c->desprod); ?></td>
                            <td><?php echo e($c->lote); ?> <?php echo e($c->fecvence); ?></td>
                            <td id="idcodprod_<?php echo e($loop->iteration); ?>">
                                <?php echo e($c->codprod); ?>

                            </td>
                            <td><?php echo e($c->original); ?></td>
                            <td><?php echo e(number_format($c->cantidad, 0, '.', ',')); ?></td>
                            <td><?php echo e(number_format($c->precio1, 2, '.', ',')); ?></td>
                            <td><?php echo e(number_format($c->iva, 2, '.', ',')); ?></td>
                            <td><?php echo e(number_format($c->da, 2, '.', ',')); ?></td>
                            <td><?php echo e(number_format($di, 2, '.', ',')); ?></td>
                            <td><?php echo e(number_format($dc, 2, '.', ',')); ?></td>
                            <td><?php echo e(number_format($pp, 2, '.', ',')); ?></td>
                            <td><?php echo e($c->barra); ?></td>
                            <td><?php echo e($c->marcamodelo); ?></td>
                            <td><?php echo e($c->pactivo); ?></td>
                            <td><?php echo e($c->cantidad); ?></td>
                            <td><?php echo e(date('d-m-Y', strtotime($c->fechafalla))); ?></td>
                        </tr>

                        <div class="col-md-4" >
                            <?php
                            $desprod = substr($c->desprod, 0, 40);  
                            $marcamodelo = substr($c->marcamodelo, 0, 40);  
                            ?>
                            <!-- product -->
                            <div class="product" 
                                style="<?php if(Auth::user()->tipo=='A' || Auth::user()->tipo=='S'): ?> 
                                height: (100 + (<?php echo e($cfg->cantPrecioUtilizar); ?> * 30)px; <?php endif; ?>" >
                                <div class="product-img">
                                    <center>
                                    <a href="<?php echo e(URL::action('AdreportController@producto',$c->codprod)); ?>">
                                        <img src="<?php echo e(asset('/public/storage/'.NombreImagen($c->codprod))); ?>" 
                                        style="width: 180px; height: 180px; padding-top: 15px;">
                                        <div class="product-label">
                                            <?php if($c->clase == "NUEVO"): ?>
                                                <span class="new colorResaltado"
                                                    style="border-radius: 8px 8px 8px 8px;">
                                                    NUEVO
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    </center>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"
                                        title="MARCA DEL PRODUCTO">
                                        <?php echo e(($marcamodelo=="") ? "N/A" : $marcamodelo); ?>

                                    </p>
                                    <h4 class="product-name" 
                                        style="height: 30px;">
                                        <a href="<?php echo e(URL::action('AdreportController@producto',$c->codprod)); ?>">
                                            <b><?php echo e($desprod); ?></b>
                                        </a>
                                    </h4>
                                    <h4 class="product-price">
                                    <?php if(Auth::user()->tipo=='A' || Auth::user()->tipo=='S'): ?>

                                        <?php for($i = 1; $i <= $cfg->cantPrecioUtilizar; $i++): ?>
                                            <?php 
                                            $var1 = 'precio'.$i;
                                            $precio = $c->$var1 ?>
                                            <h4 class="product-price" >
                                            <?php if($i==1): ?>
                                                <?php if($c->da != '0.00'): ?>
                                                    <del style="color: #B7B7B7; font-size: 12px;"> <?php echo e(number_format($precio,2,'.', ',')); ?>

                                                    </del>&nbsp;&nbsp;
                                                    <b>                                                   <?php echo e(number_format(CalculaPrecioNeto($precio, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00' ),2,'.', ',')); ?> 
                                                    <span style="font-size: 10px; color: #B7B7B7">(P<?php echo e($i); ?>)</span>
                                                    </b>&nbsp;&nbsp;
                                                <?php else: ?>
                                                    <b><?php echo e(number_format($precio,2,'.', ',')); ?>

                                                    <span style="font-size: 10px; color: #B7B7B7">(P<?php echo e($i); ?>)</span>
                                                    </b>&nbsp;&nbsp;
                                                <?php endif; ?>
                                                <?php if($c->iva != '0.00'): ?> 
                                                    <span style="font-size: 10px;">+IVA</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <b><?php echo e(number_format($precio,2,'.', ',')); ?> 
                                                <span style="font-size: 10px; color: #B7B7B7">
                                                    (P<?php echo e($i); ?>)
                                                </span>
                                                </b>
                                            <?php endif; ?>
                                            </h4>
                                        <?php endfor; ?>
                                    <?php else: ?>
                                        <?php if($tipoprecio == 1): ?>
                                            <?php if($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00'): ?>
                                                <del style="color: #B7B7B7"> <?php echo e(number_format($c->precio1,2,'.', ',')); ?>

                                                </del>
                                                &nbsp;&nbsp;
                                                <b>
                                                <?php echo e(number_format(CalculaPrecioNeto($c->precio1, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')); ?>

                                                </b>&nbsp;&nbsp;
                                            <?php else: ?>
                                                <b><?php echo e(number_format($c->precio1,2,'.', ',')); ?></b>
                                                &nbsp;&nbsp;
                                            <?php endif; ?>
                                            <?php if($c->iva != '0.00'): ?> 
                                                +IVA
                                            <?php endif; ?>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <p><?php echo e($cfg->simboloOM); ?> 
                                                    <?php echo e(number_format(CalculaPrecioNeto($c->precio1, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?>

                                                </p>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 2): ?>
                                            <?php if($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00'): ?>
                                                <del style="color: #B7B7B7"> <?php echo e(number_format($c->precio2,2,'.', ',')); ?></del>
                                                &nbsp;&nbsp;
                                                <b>
                                                <?php echo e(number_format(CalculaPrecioNeto($c->precio2, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php else: ?>
                                                <b><?php echo e(number_format($c->precio2,2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php endif; ?>
                                            <?php if($c->iva != '0.00'): ?> 
                                                +IVA
                                            <?php endif; ?>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <p><?php echo e($cfg->simboloOM); ?> <?php echo e(number_format(CalculaPrecioNeto($c->precio2, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?>

                                                </p>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 3): ?>
                                            <?php if($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00'): ?>
                                                <del style="color: #B7B7B7"> <?php echo e(number_format($c->precio3,2,'.', ',')); ?></del>
                                                &nbsp;&nbsp;
                                                <b>
                                                <?php echo e(number_format(CalculaPrecioNeto($c->precio3, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php else: ?>
                                                <b><?php echo e(number_format($c->precio3,2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php endif; ?>
                                            <?php if($c->iva != '0.00'): ?> 
                                                +IVA
                                            <?php endif; ?>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <p><?php echo e($cfg->simboloOM); ?> <?php echo e(number_format(CalculaPrecioNeto($c->precio3, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?>

                                                </p>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 4): ?>
                                            <?php if($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00'): ?>
                                                <del style="color: #B7B7B7"> <?php echo e(number_format($c->precio4,2,'.', ',')); ?></del>
                                                &nbsp;&nbsp;
                                                <b>
                                                <?php echo e(number_format(CalculaPrecioNeto($c->precio4, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php else: ?>
                                                <b><?php echo e(number_format($c->precio4,2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php endif; ?>
                                            <?php if($c->iva != '0.00'): ?> 
                                                +IVA
                                            <?php endif; ?>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <p><?php echo e($cfg->simboloOM); ?> 
                                                    <?php echo e(number_format(CalculaPrecioNeto($c->precio4, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?>

                                                </p>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 5): ?>
                                            <?php if($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00'): ?>
                                                <del style="color: #B7B7B7"> <?php echo e(number_format($c->precio5,2,'.', ',')); ?></del>
                                                &nbsp;&nbsp;
                                                <b>
                                                <?php echo e(number_format(CalculaPrecioNeto($c->precio5, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php else: ?>
                                                <b><?php echo e(number_format($c->precio5,2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php endif; ?>
                                            <?php if($c->iva != '0.00'): ?> 
                                                +IVA
                                            <?php endif; ?>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <p><?php echo e($cfg->simboloOM); ?>&nbsp; 
                                                    <?php echo e(number_format(CalculaPrecioNeto($c->precio5, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?>

                                                </p>
                                            <?php endif; ?>
                                        <?php elseif($tipoprecio == 6): ?>
                                            <?php if($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00'): ?>
                                                <del style="color: #B7B7B7"> <?php echo e(number_format($c->precio6,2,'.', ',')); ?></del>
                                                &nbsp;&nbsp;
                                                <b>
                                                <?php echo e(number_format(CalculaPrecioNeto($c->precio6, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php else: ?>
                                                <b><?php echo e(number_format($c->precio6,2,'.', ',')); ?></b>&nbsp;&nbsp;
                                            <?php endif; ?>
                                            <?php if($c->iva != '0.00'): ?> 
                                                +IVA
                                            <?php endif; ?>
                                            <?php if( $cfg->mostrarPrecioOM > 0 ): ?>
                                                <p><?php echo e($cfg->simboloOM); ?> 
                                                    <?php echo e(number_format(CalculaPrecioNeto($c->precio6, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')); ?>

                                                </p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </h4>
                                    <p class="product-category">
                                        Existencia:&nbsp 
                                        <span id="idCant_<?php echo e($c->codprod); ?>" style="font-size: 20px;"><?php echo e(number_format($c->cantidad,0,'.', ',')); ?>

                                        </span>
                                    </p>
                                    <?php if(Auth::user()->tipo!='A' && Auth::user()->tipo!='S'): ?>
                                    <h3 class="product-name">
                                        <center>
                                        <div class="col-xs-4 input-group">
                                            <p style="width: 100px;">
                                                <input id="idpedir_<?php echo e($c->codprod); ?>" style="text-align: center; color: #000000; width: 60px;" value="" class="form-control">
                                                <span class="input-group-btn" onclick='tdclick(event);'>
                                                    <button id="idBtn1_<?php echo e($c->codprod); ?>" type="button" class="btn btn-default btn-pedido
                                                    
                                                    <?php if(VerificarCarrito($c->codprod)): ?>
                                                        colorResaltado
                                                    <?php endif; ?>

                                                    " data-toggle="tooltip" title="Agregar al carrito" >
                                                        <span class="fa fa-cart-plus" aria-hidden="true" id="idBtn2_<?php echo e($c->codprod); ?>">
                                                        </span>
                                                    </button>
                                                </span>
                                            </p>
                                        </div>
                                        </center>
                                    </h3>                   
                                    <?php endif; ?>           
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /product -->
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
            <!-- /tab -->
        </div>
    </div>
</div>
<?php endif; ?>
  
<?php if($catalogo->count() == 0): ?>
    <div class="row">
        <?php if($tipo=='C'): ?>
            <center><h3>Catálogo de productos vacio</h3></center>
        <?php endif; ?>
        <?php if($tipo=='E'): ?>
            <center><h3>Sin Entradas recientes</h3></center>
        <?php endif; ?>
        <?php if($tipo=='O'): ?>
            <center><h3>Sin Ofertas de productos</h3></center>
        <?php endif; ?>      
        <?php if($tipo=='G'): ?>
            <center><h3>Categoria sin productos</h3></center>
        <?php endif; ?>
        <?php if($tipo=='M'): ?>
            <center><h3>Marca sin productos</h3></center>
        <?php endif; ?>
        <?php if($tipo=='I'): ?>
            <center><h3>Sin promoción de dias de credito</h3></center>
        <?php endif; ?>            
    </div>
    <br>
<?php endif; ?>
<?php if($catalogo->count()>20): ?>
    <!-- BOTONES BARRA DE BOTONESS -->
    <br>
    <?php echo $__env->make('seped.catalogo.catabarra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <br>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
<script>
$('#subtitulo').text('<?php echo e($subtitulo); ?>');
var forma = document.getElementById("idforma").value;

$(document).keypress(function(e) {
   if(e.which == 13) {
        vAceptar();
   }
});

function vAceptar() {
    var tableReg = document.getElementById('idtabla');
    var contItem = '<?php echo e($contItem); ?>';
    var tasacambiaria = '<?php echo e($cfg->tasacambiaria); ?>';
    var contAgregado = 0;
    var elementStyles = window.getComputedStyle(document.getElementById('idforma'));
    var color5 = elementStyles.getPropertyValue("--main-c-resaltar").trim();
    var Lcolor5 = elementStyles.getPropertyValue("--main-l-resaltar").trim();
    var url = '../agregar';
    for (var i = 1; i < tableReg.rows.length; i++) {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var codprod = $('#idcodprod_'+i).text();
        codprod = codprod.trim();
        //var codprod = cellsOfRow[5].innerHTML.trim();
        var cantidad = cellsOfRow[7].innerHTML.trim();
        cantidad = parseInt(cantidad.replace(/,/g, ""));
        //alert(codprod + ' - ' + cantidad);
        var pedir = $('#idpedir_'+codprod).val();
        if (parseInt(pedir) > 0) {
            if (parseInt(pedir) > parseInt(cantidad)) {
                pedir = cantidad;
            }
            contAgregado++;
            $('#idpedir_'+codprod).val('');
            var y = 'idBtn1_' + codprod;
            var btn = document.getElementById(y);
            btn.style.backgroundColor = color5;
            btn.style.color = Lcolor5;
            //alert("2 ->" + codprod + " - " +  pedir);
            $.ajax({
                type:'POST',
                url: url,
                dataType: 'json', 
                encode  : true,
                data: {codprod : codprod, pedir : pedir },
                success:function(data) {
                    if (data.msg != "") {
                        alert(data.msg);
                    } 
                    $('#idpedir_'+codprod).val('');
                    $("#totpedido").text(number_format(data.total, 2, '.', ','));
                    $("#totpedidoDolar").text('$ ' + number_format(data.total/tasacambiaria, 2, '.', ','));
                    $("#contreng").text(number_format(data.item, 0, '.', ','));
                }
            });
        }
    }
    if (parseInt(contItem) == 0) {
        location.reload(true);
    }
}

function tdclick(e) {
    var id = e.target.id.split('_');
    var tasacambiaria = '<?php echo e($cfg->tasacambiaria); ?>';
    var codprodx = id[1];
    var codprod = codprodx.trim();
    var pedir = $('#idpedir_'+codprod).val();
    var cantidad = $('#idCant_'+codprod).text().replace(/,/g, "").trim();
    var elementStyles = window.getComputedStyle(document.getElementById('idforma'));
    var color5 = elementStyles.getPropertyValue("--main-c-resaltar").trim();
    var Lcolor5 = elementStyles.getPropertyValue("--main-l-resaltar").trim();

    //alert("ID: " + id + " CODPROD: " + codprod + " PEDIR: " + pedir);

    var url = '../agregar';
    if (parseInt(pedir) <= 0 || (parseInt(pedir) > parseInt(cantidad)) ) {

        if (parseInt(pedir) <= 0) {
            alert("La cantidad a pedir no pueder ser menor o igual a cero");
            $('#idpedir_'+codprod).val('');
        }
        else {
            alert("La cantidad a pedir ("+parseInt(pedir)+") es mayor > al inventario ("+parseInt(cantidad)+")");
            $('#idpedir_'+codprod).val('');
        }

    } else {
        //alert("1 ->" + codprod + " - " +  pedir);
        $.ajax({
            type:'POST',
            url: url,
            dataType: 'json', 
            encode  : true,
            data: {codprod : codprod, pedir : pedir },
            success:function(data) {
                if (data.msg != "") {
                    alert(data.msg);
                    location.reload(true);
                } else {
                    $('#idpedir_'+codprod).val('');
                    $("#totpedido").text(number_format(data.total, 2, '.', ','));

                    $("#totpedidoDolar").text('$ ' + number_format(data.total/tasacambiaria, 2, '.', ','));
         
                    $("#contreng").text(number_format(data.item, 0, '.', ','));
                    if (data.item == 1) {
                        location.reload(true);
                    }
                    var y = 'idBtn1_' + codprod;
                    var btn = document.getElementById(y);
                    btn.style.backgroundColor = color5;
                    btn.style.color = Lcolor5;
                }
           }
        });
    }
};

function tdclickAlerta(e) {
    var id = e.target.id.split('_');
    var codprod = id[1];
    $.ajax({
      type:'POST',
      url:'../modalerta',
      dataType: 'json', 
      encode  : true,
      data: {codprod : codprod },
      success:function(data) {
        if (data.msg != "") {
            alert(data.msg);
        } 
      }
    });
}

function getPos(e) {
    x=e.clientX;
    y=e.clientY;
    cursor = "La posicion del mouse es : " + x + " and " + y ;

    //alert(cursor);

    //document.getElementById("displayArea").innerHTML=cursor
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 


<?php echo $__env->make('layouts.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/seped/catalogo/listado.blade.php ENDPATH**/ ?>