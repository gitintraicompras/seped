<!-- MENU PRINCIPAL  -->
<?php 
  $modoInfo = Session::get('modoInfo', '0');
  $sidebarMode = Session::get('sidebarMode', '');
  if ($sidebarMode == '2') {
    $labelseped = "SEPED";
    $logo = "favicon.ico";
  } else {
    $labelseped = "Sistema de Envio de Pedidos";
    $logo = "favicon.png";
  }
  if (!isset($chart_data))
    $chart_data = "";
  $sucursal = sRetornaSucursal();
  $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
?> 


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ISB, SISTEMAS, ISAWEB, ISACOM, DROLAGO, DROGUESUR, PULSO, METROMEDICA, DROSOLVECA, ISASOFT, ISBCLIENTE, Compras, SAINT, PROFIT, Proveedores, Mauricio Blanco, ISAAP, ISABUSCAR, SAINT, DROEXCA, DROANDINA, DROSALUD, DRCLINICA, FARMACEUTICA24, MARAPLUS, FARMALIADAS, ISACOMMERCE, SEPED, SIAD, SIDES. STELLAR, FARMACIAMARAPLUS, DROMARKO, DROPLUS, EMMANUELLE, DROGUERIA365, BIOGENETICA ">
    <meta name="format-detection" content="telephone=no"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?php echo e($cfg->titulopagina); ?></title>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/AdminLTE.min.css')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/apple-touch-icon.png')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.ico')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/material-dashboard.css')); ?>"> 
    <?php echo $__env->make('layouts.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/slick.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/slick-theme.css')); ?>"/>
    <link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/nouislider.min.css')); ?>"/>
    <link href="<?php echo e(asset('css/plugins/morris/morris.css')); ?>" rel="stylesheet" type="text/css" />
  </head>

  <!--   
  <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
  -->
  <body class="hold-transition skin-blue sidebar-mini  
    <?php if( $sidebarMode == '2'): ?> sidebar-collapse <?php endif; ?>  ">
    <div class="wrapper">

      <header class="main-header">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top navbar-fixed-top" role="navigation" >
          <!-- Sidebar toggle button-->
          <a href="" class="sidebar-toggle btnmenuvertical" data-widget="collapse" data-toggle="offcanvas" role="button">
            <span class="sr-only" >Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu" >
            <ul class="nav navbar-nav">


              <!-- ACTUALIZADO-->
              <li class="dropdown messages-menu hidden-xs" >
                <a href="#" class="dropdown-toggle" title="Fecha de sincronizacón del catálogo">
                  <i class="fa fa-calendar" > 
                    <span style="font-size: 10px;"> ACTUALIZADO: </span> <br> 
                    <span><?php echo e(date('d-m-Y H:i', strtotime(sLeercfg($sucactiva, 'fecha')))); ?></span> 
                  </i>
                </a>
              </li>

              <?php if(Auth::user()->tipo != 'T'): ?>
                <!-- TASA CAMBIARIA -->
                <?php if( $cfg->mostrarTasaCambiaria == '1' ): ?>
                <li class="dropdown messages-menu hidden-xs" >
                  <a href="#" class="dropdown-toggle" title="Tasa cambiaria del dolar">
                    <i class="fa fa-money"> 
                      <span style="font-size: 10px;"><?php echo e($cfg->LiteralTasaCambiaria); ?> </span><br>
                      <span style="font-size: 14px;"><?php echo e(number_format($cfg->tasacambiaria, 2, '.', ',')); ?></span>
                    </i>
                  </a>
                </li>
                <?php endif; ?>
                
                <!-- Notifications: style can be found in dropdown.less -->
                <?php if($cfg->mostrarModNotificacion > 0): ?>
                  <?php if(Auth::user()->tipo == 'C' || Auth::user()->tipo == 'G' ): ?>
                    <?php $iContadorNoti = iContadorNotiCliente(); 
                    if ($iContadorNoti > 0) {
                      $codcli = sCodigoClienteActivo();
                      $noti=DB::table('notientradas')
                      ->where('destino','=', $codcli)
                      ->where('envio','=', 1)
                      ->where('leido','=', 0)
                      ->orderBy('id','desc')
                      ->get();
                    }
                    ?>
                    <li class="dropdown notifications-menu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Ver listado de Notificaciones">
                        <i class="fa fa-bell-o" style="font-size:26px;"></i>
                        <?php if($iContadorNoti > 0): ?>
                          <span class="label colorAlcabala" 
                            style="font-size: 18px; border-radius: 50% 50%;">
                            <?php echo e($iContadorNoti); ?>

                          </span>
                        <?php endif; ?>
                      </a>
                      <ul class="dropdown-menu">
                        <li class="header">Usted tiene <?php echo e($iContadorNoti); ?> notificaciones nuevas</li>
                        <li>
                          <!-- inner menu: contains the actual data -->
                          <ul class="menu">
                            <?php if($iContadorNoti > 0): ?> 
                            <?php $__currentLoopData = $noti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <a href="#">
                                <?php if($n->tipo == 'PFA'): ?>
                                  <i class="fa fa-download text-aqua"></i> 
                                <?php elseif($n->tipo == 'INFO'): ?>
                                  <i class="fa fa-users text-aqua"></i> 
                                <?php elseif($n->tipo == 'URGENTE'): ?>
                                  <i class="fa fa-warning text-yellow"></i> 
                                <?php elseif($n->tipo == 'COBRANZA'): ?>
                                  <i class="fa fa-money text-red"></i>
                                <?php elseif($n->tipo == 'OTRO'): ?>
                                  <i class="fa fa-shopping-cart text-green"></i>
                                <?php endif; ?>
                                <?php echo e($n->asunto); ?>

                              </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                          </ul>
                        </li>
                        <li class="footer">
                          <a href="<?php echo e(url('/seped/noticliente')); ?>">Ver todas</a>
                        </li>
                      </ul>
                    </li>
                  <?php endif; ?>
                  <?php if(Auth::user()->tipo == 'A' || Auth::user()->tipo == 'V' || Auth::user()->tipo == 'S' || Auth::user()->tipo == 'R' ): ?>
                    <?php $iContadorNoti = iContadorNotiServidor(); 
                    if ($iContadorNoti > 0) {
                      $codcli = $cfg->codisb;
                      $noti=DB::table('notientradas')
                      ->where('destino','=', $codcli)
                      ->where('envio','=', 1)
                      ->where('leido','=', 0)
                      ->orderBy('id','desc')
                      ->get();
                    }
                    ?>
                    <li class="dropdown notifications-menu">
                      <a href="#" 
                        class="dropdown-toggle" 
                        data-toggle="dropdown" 
                        title="Ver listado de Notificaciones">
                        <i class="fa fa-bell-o" style="font-size:28px;"></i>
                        <?php if($iContadorNoti > 0): ?>
                          <span class="label colorAlcabala" 
                            style="font-size: 18px; border-radius: 50% 50%;">
                            <?php echo e($iContadorNoti); ?>

                          </span>
                        <?php endif; ?>
                      </a>
                      <ul class="dropdown-menu">
                        <li class="header">Usted tiene <?php echo e($iContadorNoti); ?> notificaciones nuevas</li>
                        <li>
                          <!-- inner menu: contains the actual data -->
                          <ul class="menu">
                            <?php if($iContadorNoti > 0): ?> 
                            <?php $__currentLoopData = $noti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <a href="#">
                                <?php if($n->tipo == 'PFA'): ?>
                                  <i class="fa fa-download text-aqua"></i> 
                                <?php elseif($n->tipo == 'INFO'): ?>
                                  <i class="fa fa-users text-aqua"></i> 
                                <?php elseif($n->tipo == 'URGENTE'): ?>
                                  <i class="fa fa-warning text-yellow"></i> 
                                <?php elseif($n->tipo == 'COBRANZA'): ?>
                                  <i class="fa fa-money text-red"></i>
                                <?php elseif($n->tipo == 'OTRO'): ?>
                                  <i class="fa fa-shopping-cart text-green"></i>
                                <?php endif; ?>
                                <?php echo e($n->asunto); ?>

                              </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                          </ul>
                        </li>
                        <li class="footer">
                          <a href="<?php echo e(url('/seped/notiservidor')); ?>">Ver todas</a>
                        </li>
                      </ul>
                    </li>
                  <?php endif; ?>
                <?php endif; ?>
                
                <!-- MOSTRAR PRODUCTOS CARRITO DE COMPRAS -->
                <?php if(Auth::user()->tipo == 'A' || Auth::user()->tipo == 'R'): ?>
                  <?php $contreng=iContadorPedidos() ?>
                  <li class="dropdown tasks-menu">
                    <a href="<?php echo e(url('/seped/alcabala')); ?>" 
                      title="Alcabala, Contador de pedidos por aprobar">
                      <i class="fa fa-hand-paper-o" style="font-size:28px;"></i>
                      <?php if($contreng>0): ?>
                        <span class="label colorAlcabala" 
                          style="font-size: 18px; border-radius: 50% 50%;">
                          <?php echo e($contreng); ?>

                        </span>
                      <?php endif; ?>
                    </a>
                  </li>
                <?php else: ?>
                  <?php if(Auth::user()->tipo != 'S'): ?>
                    <?php 
                        $codcli = sCodigoClienteActivo();
                        $id = iIdUltPedAbierto($codcli);
                        $contreng = iContRengUltPedAbierto($codcli); 
                    ?>
                    <?php if(Auth::user()->tipo == 'C'): ?>
                      <?php if($contreng>0): ?>
                      <li class="dropdown tasks-menu">
                        <a
                          <?php if($id > 0): ?> 
                            href="<?php echo e(url("/seped/catalogo/".$id."/edit")); ?>"   
                          <?php else: ?>
                            href="<?php echo e(URL::action('AdcatalogoController@listado','D')); ?>"
                          <?php endif; ?>
                          title="Ver carrito de compra">
                          <i class="fa fa-shopping-cart" style="font-size:26px;"></i>
                            <span id="contreng" 
                              class="label colorAlcabala" 
                              style="font-size:18px; border-radius: 50% 50%;">
                              <?php echo e($contreng); ?>

                            </span>
                        </a>
                      </li>
                      <?php endif; ?>
                    <?php else: ?>
                      <?php if($contreng>0): ?>
                      <li class="dropdown tasks-menu">
                        <a
                        <?php if($id > 0): ?> 
                          href="<?php echo e(url("/seped/catalogo/".$id."/edit")); ?>"
                        <?php else: ?>
                          href="<?php echo e(URL::action('AdcatalogoController@listado','D')); ?>"
                        <?php endif; ?>
                        title="Ver carrito de compra">
                          <i class="fa fa-shopping-cart" style="font-size:26px;"></i>
                          <?php if($contreng>0): ?>
                            <span id="contreng" 
                              class="label colorAlcabala" 
                              style="font-size:18px; border-radius: 50% 50%;">
                              <?php echo e($contreng); ?>

                            </span>
                          <?php endif; ?>
                        </a>
                      </li>
                      <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if($contreng>0): ?>
                    <li class="dropdown messages-menu">
                      <a href="<?php echo e(url('/seped/catalogo/'.$id.'/edit')); ?>" 
                        title="Monto total del pedido, click para ver carrito de compra">
                          <span id="totpedido"> 
                            <?php echo e(number_format(dTotalPedido($id), 2, '.', ',')); ?> 
                          </span> <br>
                          <?php if( $cfg->mostrarPedidoOM == '1' ): ?>
                            <span id="totpedidoDolar" class="ColorDolar"> 
                              <?php echo e($cfg->simboloOM); ?>

                              <?php echo e(number_format(dTotalPedido($id)/$cfg->tasacambiaria, 2, '.', ',')); ?> 
                            </span>
                          <?php endif; ?>      
                      </a>
                    </li>
                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>

                <!-- WHATSAPP -->
                <?php if( !empty($cfg->linkWhatsappTel)): ?>  
                <li class="dropdown messages-menu">
                  <a href="https://<?php echo e($cfg->linkWhatsappTel); ?>" title="Link whatsapp de <?php echo e($cfg->nomcorto); ?>" >
                    <img src="<?php echo e(asset('images/whatsapp.png')); ?>" alt="whatsapp" style="width:24px;height:24px;">
                  </a>
                </li>
                <?php endif; ?>
              <?php endif; ?>

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" 
                  class="dropdown-toggle" 
                  data-toggle="dropdown" 
                  title="Usuario activo">
                  <span>
                    <?php if(Auth::user()->tipo == 'A'): ?>
                      <img src="<?php echo e(asset('images/userAdmin.png')); ?>" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    <?php elseif(Auth::user()->tipo == 'S'): ?>
                      <img src="<?php echo e(asset('images/userSuper.png')); ?>" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    <?php elseif(Auth::user()->tipo == 'R'): ?>
                      <img src="<?php echo e(asset('images/userCredito.png')); ?>" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    <?php elseif(Auth::user()->tipo == 'C'): ?>
                      <img src="<?php echo e(asset('images/userCliente.png')); ?>" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    <?php elseif(Auth::user()->tipo == 'V'): ?>
                      <img src="<?php echo e(asset('images/userVendedor.png')); ?>" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    <?php elseif(Auth::user()->tipo == 'P' ): ?>
                      <img src="<?php echo e(asset('images/userProveedor.png')); ?>" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    <?php elseif(Auth::user()->tipo == 'T' ): ?>
                      <img src="<?php echo e(asset('images/userTransporte.png')); ?>" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    <?php elseif(Auth::user()->tipo == 'G' ): ?>
                      <img src="<?php echo e(asset('images/userGrupo.png')); ?>" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    <?php endif; ?>
                    <span class="hidden-xs">
                      <?php echo e(Auth::user()->name); ?>

                    </span>
                  </span>
                </a>
                <ul class="dropdown-menu" 
                  style="border: 1px solid #CCCCCC;">
                  <!-- User image -->
                  <li class="user-header" style="height: 180px;">
                    <?php if(Auth::user()->tipo == 'A'): ?>
                    <img src="<?php echo e(asset('images/userAdmin.png')); ?>" class="img-circle" alt="SEPED" />
                    <?php elseif(Auth::user()->tipo == 'S'): ?>
                    <img src="<?php echo e(asset('images/userSuper.png')); ?>" class="img-circle" alt="SEPED" />
                    <?php elseif(Auth::user()->tipo == 'R'): ?>
                    <img src="<?php echo e(asset('images/userCredito.png')); ?>" class="img-circle" alt="SEPED" />
                    <?php elseif(Auth::user()->tipo == 'C'): ?>
                    <img src="<?php echo e(asset('images/userCliente.png')); ?>" class="img-circle" alt="SEPED" />
                    <?php elseif(Auth::user()->tipo == 'V'): ?>
                    <img src="<?php echo e(asset('images/userVendedor.png')); ?>" class="img-circle" alt="SEPED" />
                    <?php elseif(Auth::user()->tipo == 'T'): ?>
                    <img src="<?php echo e(asset('images/userTransporte.png')); ?>" class="img-circle" alt="SEPED" />
                    <?php elseif(Auth::user()->tipo == 'P'): ?>
                    <img src="<?php echo e(asset('images/userProveedor.png')); ?>" class="img-circle" alt="SEPED" />
                    <?php elseif(Auth::user()->tipo == 'G' ): ?>
                    <img src="<?php echo e(asset('images/userGrupo.png')); ?>" class="img-circle" alt="SEPED" />
                    <?php endif; ?>
                    <span class="user-header">
                      <br><br> 
                      Código: <?php echo e(Auth::user()->codcli); ?> <br>             
                      <?php echo e(Auth::user()->email); ?>                      
                    </span>
                  </li>
                  
                  <!-- Menu Body -->
                  <?php if(Auth::user()->tipo == "A"): ?>
                  <li class="user-body">
                    <div class="col-xs-4 text-center" 
                      style="border-radius: 10px 10px 10px 10px !important;" >
                      <a href="<?php echo e(url('/sincronizar')); ?>" 
                        style="text-decoration: underline black" 
                        title="Forzar sincronización con el Siad">
                        Sincronizar
                      </a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="<?php echo e(url('/cargarimagen')); ?>" 
                        style="text-decoration: underline black" 
                        title="Cargar masiva de Imagenes">
                        Imagenes
                      </a>
                    </div>
                    <?php if(0): ?>
                    <div class="col-xs-4 text-center">
                      <a href="<?php echo e(url('/seped/prueba')); ?>" 
                        style="text-decoration: underline black" 
                        title="Prueba de curl">
                        Curl
                      </a>
                    </div>
                    <?php endif; ?>
                  </li>
                  <?php endif; ?>

                  <!-- Menu Footer-->
                  <li class="user-footer" 
                    style="border: 1px solid #CCCCCC;">
                    <div class="pull-left">
                      <a href="" 
                        data-target="#modal-acerca" 
                        data-toggle="modal" 
                        class="btn btn-default btn-flat colorTitulo" 
                        title="Acerca del Seped" 
                        style="width: 100px; border-radius: 8px 8px 8px 8px">
                        Acerca
                      </a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo e(route('logout')); ?>" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                        class="btn btn-default btn-flat colorTitulo" 
                        title="Salir del Seped" 
                        style="width: 100px; border-radius: 8px 8px 8px 8px">
                        Cerrar sesión
                      </a>
                      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                          <?php echo e(csrf_field()); ?>

                      </form>
                    </div>
                  </li>

                </ul>
              </li>
              
            </ul>
          </div>
        </nav>
      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" style="margin: 0px; padding: 0px;">

        <!-- Logo -->
        <a href="https://<?php echo e($cfg->nomdominio); ?>" class="logo" >
          <span>
            <center>
            <img src="<?php echo e(asset('images/'.$logo)); ?>" alt="Seped" class="tamLogoMenu">
            </center>
          </span>
        </a>

        <section class="sidebar">
          <ul class="sidebar-menu" >
           
            <center>
                <br>
                <li class="title" style="font-size: 14px;"><i><?php echo e($labelseped); ?></i></li>
            </center>


            <?php if(Auth::user()->tipo == 'A'): ?>

              <?php if($sucursal->count() > 1): ?>
              <?php echo Form::open(['url' => '/seped/cambiarsucursal', 'method' => 'post']); ?>

              <div class="form-group">
                <div class="input-group input-group-sm" style="margin-right: 4px;">
                  <select name="sucactiva" 
                    class="form-control"
                    style="margin-left: 4px;" >
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option 
                        <?php if($suc->codisb == $sucactiva): ?>
                        selected 
                        <?php endif; ?>
                        value="<?php echo e($suc->codisb); ?>">
                        <?php echo e($suc->SedeSucursal); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <span style="padding: 0;" 
                    class="input-group-addon input-group">
                    <button type="submit" 
                      class="btn-peqbuscar">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
              </div>
              <?php echo e(Form::close()); ?>

              <?php endif; ?>
              
              <li class="header title" style="font-size: 16px; margin-top: 7px;">
                <center>ADMINISTRADOR </center>
              </li>
             
              <!-- HOME -->
              <li <?php if($menu=='Inicio'): ?> class='active' <?php endif; ?> >
                  <a href="<?php echo e(url('/home')); ?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <!-- ALCABALA -->
              <li <?php if($menu=='Alcabala'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/alcabala')); ?>">
                  <i class="fa fa-hand-paper-o"></i> <span>Alcabala</span>
                  <?php $iContadorPedidos = iContadorPedidos(); ?>
                  <?php if($iContadorPedidos>0): ?>
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      <?php echo e($iContadorPedidos); ?>

                    </small>
                  <?php endif; ?>
                </a>
              </li>

              <!-- RECLAMOS -->
              <li <?php if($menu=='Reclamos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/monitorreclamo')); ?>">
                  <i class="fa fa-phone-square"></i> <span>Reclamos</span>
                  <?php $iContadorRecRecibido = iContadorRecRecibido(); ?>
                  <?php if($iContadorRecRecibido>0): ?>
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      <?php echo e($iContadorRecRecibido); ?>

                    </small>
                  <?php endif; ?>
                </a>
              </li>

              <!-- PAGOS -->
              <li <?php if($menu=='Pagos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/monitorpago')); ?>">
                  <i class="fa fa-money"></i> <span>Pagos</span>
                  <?php $iContadorPagRecibido = iContadorPagRecibido(); ?>
                  <?php if($iContadorPagRecibido>0): ?>
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      <?php echo e($iContadorPagRecibido); ?>

                    </small>
                  <?php endif; ?>
                </a>
              </li>

              <!-- CLIENTES -->
              <li <?php if($menu=='Clientes'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/clientes')); ?>">
                  <i class="fa fa-user"></i> <span>Clientes</span>
                </a>
              </li>
 
              <!-- PEDIDOS -->
              <li <?php if($menu=='Pedidos' ): ?> class="active" <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/monitorpedido')); ?>">
                    <i class="fa fa-desktop"></i> <span>Pedidos</span>
                  </a>
              </li>

              <!-- CATALOGO -->
              <li <?php if($menu=='Catalogo'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdcatalogoController@listado','C')); ?>">
                  <i class="fa fa-cubes"></i> <span>Catálogo</span>
                </a>
              </li>

              <!-- IMAGENES -->
              <li <?php if($menu=='Imagenes'): ?> class='treeview active' <?php else: ?> class='treeview' <?php endif; ?>" >
                <a href="#">
                  <i class="fa fa-image"></i>
                  <span>Imagenes</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="<?php echo e(url('/seped/prodimg')); ?>">
                      <i class="fa fa-circle-o"></i> Productos
                    </a>
                  </li>

                  <?php if($cfg->activarCateProducto == '1'): ?>                  
                  <li>
                    <a href="<?php echo e(url('/seped/catimg')); ?>">
                      <i class="fa fa-circle-o"></i> Categorias
                    </a>
                  </li>
                  <?php endif; ?>

                  <li>
                    <a href="<?php echo e(url('/seped/marcaimg')); ?>">
                      <i class="fa fa-circle-o"></i> Marcas
                    </a>
                  </li>

                </ul>
              </li>

              <?php if( $cfg->mostrarModBlog == '1'): ?>
              <!-- BLOGS -->
              <li <?php if($menu=='BLOGS'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/blogs')); ?>">
                  <i class="fa fa-object-group"></i> <span>Blogs</span>
                </a>
              </li>
              <?php endif; ?>
       
              <?php if( $cfg->mostrarModDescarga == '1'): ?> 
                <!-- CARGAS -->
                <li <?php if($menu=='Cargas'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/carga')); ?>">
                    <i class="fa fa-upload"></i> <span>Cargas</span>
                  </a>
                </li>
                <!-- DESCARGAS -->
                <li <?php if($menu=='Descargas'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/descarga')); ?>">
                    <i class="fa fa-download"></i> <span>Descargas</span>
                  </a>
                </li>
              <?php endif; ?>

              <!-- GRUPOS -->
              <li <?php if($menu=='Grupos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/grupo')); ?>">
                  <i class="fa fa-users"></i> <span>Grupos</span>
                </a>
              </li>


              <?php if( $cfg->activarBotonDias == '1'): ?> 
              <!-- PROMOCION X DIAS -->
              <li <?php if($menu=='Promdias'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/promdias')); ?>">
                  <i class="fa fa-tags"></i> <span>Promoción x Dias</span>
                </a>
              </li>
              <?php endif; ?>

              <!-- USUARIOS -->
              <li <?php if($menu=='Usuarios'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/usuario')); ?>">
                  <i class="fa fa-user-plus"></i> <span>Usuarios</span>
                </a>
              </li>


              <!-- CARACTERISTICAS EXTENDIDAS -->
              <li <?php if($menu=='Caracteristicas'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/caracteristica')); ?>">
                  <i class="fa fa-commenting-o"></i> <span>Caracteristicas Extendidas</span>
                </a>
              </li>

              <?php if( $cfg->mostrarModnofiscal == '1'): ?> 
              <!-- CLIENTES NO FISCALES -->
              <li <?php if($menu=='ClienteNofical'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/clientenofiscal')); ?>">
                  <i class="fa fa-money"></i> <span>Clientes no Fiscales</span>
                </a>
              </li>
              <?php endif; ?>
   
              <!-- CRITERIO DE SEPARACION DE PEDIDOS -->
              <li <?php if($menu=='Criterios'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/pedcrisep')); ?>">
                  <i class="fa fa-scissors"></i> <span>Criterio de Separación</span>
                </a>
              </li>

              <!-- REPORTES -->
              <li <?php if($menu=='Reportes'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/report')); ?>">
                  <i class="fa fa-line-chart"></i> <span>Reportes</span>
                </a>
              </li>

              <!-- CONFIGURACION -->
              <li <?php if($menu=='Configuracion'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/config')); ?>">
                  <i class="fa fa-gear"></i> <span>Configuración</span>
                </a>
              </li>
            <?php elseif(Auth::user()->tipo == 'S'): ?>
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option  disabled 
                        selected 
                        value="<?php echo e($suc->codisb); ?>" >
                        <?php echo e(sLeercfg($suc->codisb, "SedeSucursal")); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <center>
                  <li class="header title" style="font-size: 16px; margin-top: 7px;">
                  SUPERVISOR
                  </li>
              </center>
              <!-- HOME -->
              <li <?php if($menu=='Inicio'): ?> class='active' <?php endif; ?> >
                  <a href="<?php echo e(url('/home')); ?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <!-- PEDIDOS -->
              <li <?php if($menu=='Pedidos' ): ?> class="active" <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/monitorpedido')); ?>">
                    <i class="fa fa-desktop"></i> <span>Pedidos</span>
                  </a>
              </li>

              <!-- CATALOGO -->
              <li <?php if($menu=='Catalogo'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdcatalogoController@listado','C')); ?>">
                  <i class="fa fa-cubes"></i> <span>Catálogo</span>
                </a>
              </li>

              <!-- IMAGENES -->
              <li <?php if($menu=='Imagenes'): ?> class='treeview active' <?php else: ?> class='treeview' <?php endif; ?>" >
                <a href="#">
                  <i class="fa fa-image"></i>
                  <span>Imagenes</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="<?php echo e(url('/seped/prodimg')); ?>">
                      <i class="fa fa-circle-o"></i> Productos
                    </a>
                  </li>

                  <?php if($cfg->activarCateProducto == '1'): ?>                  
                  <li>
                    <a href="<?php echo e(url('/seped/catimg')); ?>">
                      <i class="fa fa-circle-o"></i> Categorias
                    </a>
                  </li>
                  <?php endif; ?>

                  <li>
                    <a href="<?php echo e(url('/seped/marcaimg')); ?>">
                      <i class="fa fa-circle-o"></i> Marcas
                    </a>
                  </li>

                </ul>
              </li>

              <?php if( $cfg->mostrarModBlog == '1'): ?>
              <!-- BLOGS -->
              <li <?php if($menu=='BLOGS'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/blogs')); ?>">
                  <i class="fa fa-object-group"></i> <span>Blogs</span>
                </a>
              </li>
              <?php endif; ?>
       
              <?php if( $cfg->mostrarModDescarga == '1'): ?> 
                <!-- CARGAS -->
                <li <?php if($menu=='Cargas'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/carga')); ?>">
                    <i class="fa fa-upload"></i> <span>Cargas</span>
                  </a>
                </li>
                <!-- DESCARGAS -->
                <li <?php if($menu=='Descargas'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/descarga')); ?>">
                    <i class="fa fa-download"></i> <span>Descargas</span>
                  </a>
                </li>
              <?php endif; ?>

              <!-- PROMOCION X DIAS -->
              <li <?php if($menu=='Promdias'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/promdias')); ?>">
                  <i class="fa fa-tags"></i> <span>Promoción x Dias</span>
                </a>
              </li>

              <!-- GRUPOS -->
              <li <?php if($menu=='Grupos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/grupo')); ?>">
                  <i class="fa fa-users"></i> <span>Grupos</span>
                </a>
              </li>

              <!-- USUARIOS -->
              <li <?php if($menu=='Usuarios'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/usuario')); ?>">
                  <i class="fa fa-user-plus"></i> <span>Usuarios</span>
                </a>
              </li>

              <!-- CARACTERISTICAS EXTENDIDAS -->
              <li <?php if($menu=='Caracteristicas'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/caracteristica')); ?>">
                  <i class="fa fa-commenting-o"></i> <span>Caracteristicas Extendidas</span>
                </a>
              </li>

              <?php if( $cfg->mostrarModnofiscal == '1'): ?> 
              <!-- CLIENTES NO FISCALES -->
              <li <?php if($menu=='ClienteNofical'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/clientenofiscal')); ?>">
                  <i class="fa fa-money"></i> <span>Clientes no Fiscales</span>
                </a>
              </li>
              <?php endif; ?>

              <!-- REPORTES -->
              <li <?php if($menu=='Reportes'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/report')); ?>">
                  <i class="fa fa-line-chart"></i> <span>Reportes</span>
                </a>
              </li>
            <?php elseif(Auth::user()->tipo == 'R'): ?>
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option  disabled 
                        selected 
                        value="<?php echo e($suc->codisb); ?>" >
                        <?php echo e(sLeercfg($suc->codisb, "SedeSucursal")); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <center>
                  <li class="header title" style="font-size: 16px; margin-top: 7px;">
                    CREDITO Y COBRANZA
                  </li>
              </center>
              <!-- HOME -->
              <li <?php if($menu=='Inicio'): ?> class='active' <?php endif; ?> >
                  <a href="<?php echo e(url('/home')); ?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <!-- ALCABALA -->
              <li <?php if($menu=='Alcabala'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/alcabala')); ?>">
                  <i class="fa fa-hand-paper-o"></i> <span>Alcabala</span>
                  <?php $iContadorPedidos = iContadorPedidos(); ?>
                  <?php if($iContadorPedidos>0): ?>
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      <?php echo e($iContadorPedidos); ?>

                    </small>
                  <?php endif; ?>
                </a>
              </li>

              <!-- RECLAMOS -->
              <li <?php if($menu=='Reclamos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/monitorreclamo')); ?>">
                  <i class="fa fa-phone-square"></i> <span>Reclamos</span>
                  <?php $iContadorRecRecibido = iContadorRecRecibido(); ?>
                  <?php if($iContadorRecRecibido>0): ?>
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      <?php echo e($iContadorRecRecibido); ?>

                    </small>
                  <?php endif; ?>
                </a>
              </li>

              <!-- PAGOS -->
              <li <?php if($menu=='Pagos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/monitorpago')); ?>">
                  <i class="fa fa-money"></i> <span>Pagos</span>
                  <?php $iContadorPagRecibido = iContadorPagRecibido(); ?>
                  <?php if($iContadorPagRecibido>0): ?>
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      <?php echo e($iContadorPagRecibido); ?>

                    </small>
                  <?php endif; ?>
                </a>
              </li>

              <!-- CLIENTES -->
              <li <?php if($menu=='Clientes'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/clientes')); ?>">
                  <i class="fa fa-user"></i> <span>Clientes</span>
                </a>
              </li>

               <!-- CXC DEL VENDEDOR -->
              <li <?php if($menu=='Cxc'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdestadoctaController@index')); ?>">
                  <i class="fa fa-thumbs-up"></i> <span>Cuentas x Cobrar</span>
                </a>
              </li>

              <!-- FACTURAS -->
              <li <?php if($menu=='Facturas'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdreportController@facturas')); ?>" >
                  <i class="fa fa-building-o"></i> <span>Facturas</span>
                </a>
              </li>

              <!-- PEDIDOS -->
              <li <?php if($menu=='Pedidos' ): ?> class="active" <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/monitorpedido')); ?>">
                    <i class="fa fa-desktop"></i> <span>Pedidos</span>
                  </a>
              </li>

              <!-- USUARIOS -->
              <li <?php if($menu=='Usuarios'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/usuario')); ?>">
                  <i class="fa fa-user-plus"></i> <span>Usuarios</span>
                </a>
              </li>
            <?php elseif(Auth::user()->tipo == 'C'): ?>

              <?php if($sucursal->count() > 1): ?>
              <?php echo Form::open(['url' => '/seped/cambiarsucursal', 'method' => 'post']); ?>

              <div class="form-group" style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm">
                  <select name="sucactiva" class="form-control">
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option 
                        <?php if($suc->codisb == $sucactiva): ?>
                        selected 
                        <?php endif; ?>
                        value="<?php echo e($suc->codisb); ?>">
                        <?php echo e(sLeercfg($suc->codisb, "SedeSucursal")); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <span style="padding: 0;" class="input-group-addon input-group">
                    <button type="submit" 
                      class="btn-peqbuscar">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
              </div>
              <?php echo e(Form::close()); ?>

              <?php else: ?>
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option  disabled 
                        selected 
                        value="<?php echo e($suc->codisb); ?>" >
                        <?php echo e(sLeercfg($suc->codisb, "SedeSucursal")); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <?php endif; ?>

              <center>
                <li class="header title" style="font-size: 16px; margin-top: 7px;">CLIENTE</li>
              </center>
              <!-- HOME -->
              <li <?php if($menu=='Inicio'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/home')); ?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>
              <!-- CATALOGO -->
              <li <?php if($menu=='Catalogo'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdcatalogoController@listado','D')); ?>">
                  <i class="fa fa-cubes"></i> <span>Catálogo</span>
                </a>
              </li>
              <!-- PEDIDOS -->
              <li <?php if($menu=='Pedidos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdpedidoController@index')); ?>">
                  <i class="fa fa-shopping-cart"></i><span>Pedidos</span>
                </a>
              </li>
              <!-- RECLAMOS -->
              <li <?php if($menu=='Reclamos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdreclamoController@index')); ?>">
                  <i class="fa fa-phone-square"></i> <span>Reclamos</span>
                </a>
              </li>
              <!-- PAGOS -->
              <li <?php if($menu=='Pagos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdpagoController@index')); ?>">
                  <i class="fa fa-money"></i> <span>Pagos</span>
                </a>
              </li>
              <!-- CXP -->
              <li <?php if($menu=='Cxp'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdestadoctaController@index')); ?>">
                  <i class="fa fa-thumbs-up"></i> <span>Cuentas x Pagar</span>
                </a>
              </li>
              <!-- FACTURAS -->
              <li <?php if($menu=='Facturas'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdfacturaController@index')); ?>">
                  <i class="fa fa-building-o"></i> <span>Facturas</span>
                </a>
              </li>
         
              <?php if( $cfg->mostrarModCesta == '1'): ?>
                <!--  CESTAS POR DEVOLVER -->
                <li <?php if($menu=='Cestas'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/cestasentregar')); ?>">
                    <i class="fa fa-shopping-basket"></i> <span>Cestas</span>
                  </a>
                </li>
              <?php endif; ?>
         
              <!-- DESCARGAS -->
              <?php if( $cfg->mostrarModDescarga == '1'): ?> 
                <li <?php if($menu=='Descargas'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/descarga')); ?>">
                    <i class="fa fa-download"></i> <span>Descargas</span>
                  </a>
                </li>
              <?php endif; ?>

              <!-- CONFIGURACION -->
              <li <?php if($menu=='Configuracion'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/verconfig')); ?>">
                  <i class="fa fa-info-circle"></i> <span>Información</span>
                </a>
              </li>
            <?php elseif(Auth::user()->tipo == 'T'): ?>
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option  disabled 
                        selected 
                        value="<?php echo e($suc->codisb); ?>" >
                        <?php echo e(sLeercfg($suc->codisb, "SedeSucursal")); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <center>
                  <li class="header title" style="font-size: 16px; margin-top: 7px;">
                  CHOFER
                  </li>
              </center>
              <!-- HOME -->
              <li <?php if($menu=='Inicio'): ?> class='active' <?php endif; ?> >
                  <a href="<?php echo e(url('/home')); ?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>
            <?php elseif(Auth::user()->tipo == 'P'): ?>
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option  disabled 
                        selected 
                        value="<?php echo e($suc->codisb); ?>" >
                        <?php echo e(sLeercfg($suc->codisb, "SedeSucursal")); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <center>
                  <li class="header title" style="font-size: 16px; margin-top: 7px;">
                  PROVEEDOR
                  </li>
              </center>
              <!-- HOME -->
              <li <?php if($menu=='Inicio'): ?> class='active' <?php endif; ?> >
                  <a href="<?php echo e(url('/home')); ?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <!-- CATALOGO -->
              <li <?php if($menu=='Catalogo' ): ?> class="active" <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/provcata')); ?>">
                    <i class="fa fa-cubes"></i> <span>Catálogo</span>
                  </a>
              </li>
              <!-- FACTURAS -->
              <li <?php if($menu=='Facturas' ): ?> class="active" <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/provfact')); ?>">
                    <i class="fa fa-building-o"></i> <span>Facturas</span>
                  </a>
              </li>
              <!-- VENTAS -->
              <li <?php if($menu=='Ventas' ): ?> class="active" <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/provvtas')); ?>">
                    <i class="fa fa-tags"></i> <span>Ventas</span>
                  </a>
              </li>
              <!-- CONFIGURACION -->
              <li <?php if($menu=='Configuracion'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/provconf')); ?>">
                  <i class="fa fa-gear"></i> <span>Configuración</span>
                </a>
              </li>
            <?php elseif(Auth::user()->tipo == 'V' || Auth::user()->tipo == 'G'): ?>

              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    <?php $__currentLoopData = $sucursal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option  disabled 
                        selected 
                        value="<?php echo e($suc->codisb); ?>" >
                        <?php echo e(sLeercfg($suc->codisb, "SedeSucursal")); ?>

                      </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
            
              <center>
                <?php if(Auth::user()->tipo == 'V'): ?>
                <li class="header title" style="font-size: 16px; margin-top: 7px;">VENDEDOR</li>
                <?php else: ?>
                <li class="header title" style="font-size: 16px; margin-top: 7px;">GRUPO</li>
                <?php endif; ?>
              </center>
              <!-- HOME -->
              <li <?php if($menu=='Inicio'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/home')); ?>">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <?php if(Auth::user()->tipo == 'V'): ?>
              <!-- SEGUIMIENTO -->
              <li <?php if($menu=='Alcabala'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/alcabala')); ?>">
                  <i class="fa fa-hand-paper-o"></i> <span>Seguimiento</span>
                  <?php $iContadorPedidos = iContadorPedidos(); ?>
                  <?php if($iContadorPedidos>0): ?>
                    <small class="label pull-right colorResaltado"
                      style="font-size: 14px; border-radius: 50% 50%;">
                      <?php echo e($iContadorPedidos); ?>

                    </small>
                  <?php endif; ?>
                </a>
              </li>
              <?php endif; ?>

              <!-- CATALOGO -->
              <li <?php if($menu=='Catalogo'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdcatalogoController@listado','D')); ?>">
                  <i class="fa fa-cubes"></i> <span>Catálogo</span>
                </a>
              </li>
              <!-- PEDIDOS -->
              <li <?php if($menu=='Pedidos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdpedidoController@index')); ?>">
                  <i class="fa fa-shopping-cart"></i><span>Pedidos</span>
                </a>
              </li>
              <!-- RECLAMOS -->
              <li <?php if($menu=='Reclamos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdreclamoController@index')); ?>">
                  <i class="fa fa-phone-square"></i> <span>Reclamos</span>
                </a>
              </li>
              <!-- PAGOS -->
              <li <?php if($menu=='Pagos'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdpagoController@index')); ?>">
                  <i class="fa fa-money"></i> <span>Pagos</span>
                </a>
              </li>
             
              <!-- CXC DEL VENDEDOR -->
              <li <?php if($menu=='Cxc'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdestadoctaController@index')); ?>">
                  <i class="fa fa-thumbs-up"></i> <span>Cuentas x Cobrar</span>
                </a>
              </li>

              <!-- FACTURAS -->
              <li <?php if($menu=='Facturas'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(URL::action('AdfacturaController@index')); ?>">
                  <i class="fa fa-building-o"></i> <span>Facturas</span>
                </a>
              </li>

              <?php if( $cfg->mostrarModCesta == '1'): ?>
                <!--  CESTAS POR DEVOLVER -->
                <li <?php if($menu=='Cestas'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/cestasentregar')); ?>">
                    <i class="fa fa-shopping-basket"></i> <span>Cestas</span>
                  </a>
                </li>
              <?php endif; ?>

              <?php if( $cfg->mostrarModDescarga == '1'): ?> 
                <!-- DESCARGAS -->
                <li <?php if($menu=='Descargas'): ?> class='active' <?php endif; ?>>
                  <a href="<?php echo e(url('/seped/descarga')); ?>">
                    <i class="fa fa-download"></i> <span>Descargas</span>
                  </a>
                </li>
              <?php endif; ?>

              <!-- CONFIGURACION -->
              <li <?php if($menu=='Configuracion'): ?> class='active' <?php endif; ?>>
                <a href="<?php echo e(url('/seped/verconfig')); ?>">
                  <i class="fa fa-info-circle"></i> <span>Información</span>
                </a>
              </li>
            <?php endif; ?>

            <li>
              <a href="#" data-target="#modal-soporte" data-toggle="modal">
                <span>Soporte técnico</span>
                <small class="label pull-right bg-yellow"
                  style="font-size: 14px; border-radius: 50% 50%;">
                  <i class="fa fa-phone-square"></i>
                </small>
              </a>
            </li>

          </ul>
        </section>
      </aside>
 
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper"> 
        <!-- Content Header (Page header) -->
        <br><br><br>
        <section class="content-header">
          <h1>
            <?php if(Auth::user()->tipo == 'P'): ?>
              <?php echo e(NombreProveActivo()); ?>

            <?php else: ?> 
              <?php if(Auth::user()->tipo == 'C' || Auth::user()->tipo == 'V' || Auth::user()->tipo == 'G'): ?>
                <?php if($menu=="Inicio"): ?>
                  <?php echo e(sLeercfg($sucactiva, 'nombre')); ?>

                <?php else: ?>
                  <?php $codcli = sCodigoClienteActivo(); ?>
                  <?php if(Auth::user()->tipo == 'V' || Auth::user()->tipo == 'G'): ?> 
                    <?php echo e(NombreCliente($codcli)); ?>

                  <?php else: ?> 
                    <?php echo e(NombreCliente($codcli)); ?>

                  <?php endif; ?>
                <?php endif; ?>
              <?php else: ?>
                <?php echo e(sLeercfg($sucactiva, 'nombre')); ?>

              <?php endif; ?>
            <?php endif; ?>
          </h1>
          <ol class="breadcrumb">
          <li><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-home"></i> Inicio</a></li>
          <?php if( Route::currentRouteName() ): ?>
            <li>
              <a href="<?php echo e(url('/seped/'.explode('.', Route::currentRouteName())[0] )); ?>"> 
              <?php echo e($menu); ?>

              </a>
            </li>
            <li><?php echo e(explode(".", Route::currentRouteName())[1]); ?> </li>
          <?php else: ?>
              <li class="active"><?php echo e($menu); ?></li>
          <?php endif; ?>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          <?php if(Session::has('message')): ?>
            <div class="alert alert-info alert-dismissable" 
              role="alert"
              style="border-radius: 10px 10px 10px 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> <?php echo Session::get("message"); ?> </strong>
            </div>
          <?php endif; ?>
          
          <?php if(Session::has('warning')): ?>
            <div class="alert alert-warning alert-dismissable" 
              role="alert"
              style="border-radius: 10px 10px 10px 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> <?php echo Session::get("warning"); ?> </strong>
            </div>
          <?php endif; ?> 

          <?php if(Session::has('error')): ?>
            <div class="alert alert-error alert-dismissable" 
              role="alert"
              style="border-radius: 10px 10px 10px 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> <?php echo Session::get("error"); ?> </strong>
            </div>
          <?php endif; ?>
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">

                  <div class="box-header with-border" style="background-color: #F7F7F7;">
                    <center><h3 id="subtitulo" class="box-title"></h3></center>
                    <div class="box-tools pull-right"></div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                           <!--Contenido-->
                           <?php echo $__env->yieldContent('contenido'); ?>
                           <!--Fin Contenido-->
                       </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          
        </section>
      </div> 

      <?php if($menu=='Inicio'): ?>
      <footer class="main-footer navbar navbar-fixed-bottom">
        <div class="pull-right hidden-xs" title="Publicación: <?php echo e($cfg->fecversion); ?>">
          <b>Versión</b> <?php echo e($cfg->version); ?> 
        </div>
        <?php if($cfg->mostrarCopyRight > 0): ?>
          <strong>
              <a href="">
                 <?php echo e($cfg->CopyRight); ?>

              </a>
          </strong>
        <?php else: ?>
          <strong>Copyright © 2013-<script>document.write(new Date().getFullYear());</script>
              <a href="http://www.isbsistemas.com.ve">
                 <img src="<?php echo e(asset('images/isb.ico')); ?>" alt="ISB" style="width:16px; height: 16px;">
                 ISB SISTEMAS, C.A. 
              </a>
          </strong>
        <?php endif; ?>
      </footer>
      <?php endif; ?>
   
      <script src="<?php echo e(asset('js/jquery-3.5.1.min.js')); ?>"></script>
      <script type="text/javascript">
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      </script>

      <script type="text/javascript">
        function number_format(number, decimals, dec_point, thousands_sep) { 
          number = (number + '').replace(',', '').replace(' ', ''); 
          var n = !isFinite(+number) ? 0 : +number, 
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals), 
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep, 
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point, 
            s = '', 
            toFixedFix = function (n, prec) { 
             var k = Math.pow(10, prec); 
             return '' + Math.round(n * k)/k; 
            }; 
          // Fix for IE parseFloat(0.55).toFixed(0) = 0; 
          s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.'); 
          if (s[0].length > 3) { 
           s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep); 
          } 
          if ((s[1] || '').length < prec) { 
           s[1] = s[1] || ''; 
           s[1] += new Array(prec - s[1].length + 1).join('0'); 
          } 
          return s.join(dec); 
        }
      </script>     
      <!-- Bootstrap 3.3.5 -->
      <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/bootstrap-select.min.js')); ?>"></script>
      <!-- AdminLTE App -->
      <script src="<?php echo e(asset('js/app.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/slick.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/nouislider.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/main.js')); ?>"></script>

      <script type="text/javascript" src="<?php echo e(asset('js/raphael-min.js')); ?>"></script>
      <script type="text/javascript" src="<?php echo e(asset('css/plugins/morris/morris.min.js')); ?>"></script>
      <!--  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->

      <!-- bootstrap color picker -->
      <script src="<?php echo e(asset('js/jscolor.min.js')); ?>"></script>

      <?php echo $__env->yieldPushContent('scripts'); ?> 

    </div>
  </body>
  
</html>

<!--ACERCA PANTALLA MODAL -->
<div class="modal fade modal-slide-in-right" 
  aria-hidden="true" 
  role="dialog" 
  tabindex="-1" 
  id="modal-acerca">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px 10px 10px 10px;">
      <div class="modal-header colorTitulo" style="border-radius: 10px 10px 0px 0px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title">ACERCA</h4>
      </div>
      <div class="modal-body">
        <p>
          <img style="width: 120px;" src="<?php echo e(asset('images/seped.jpg')); ?>" alt="SEPED" />
        </p>
        <span style="font-size: 24px;">SISTEMA DE ENVIO DE PEDIDOS</span> 
        <span>&nbsp;Version <?php echo e($cfg->version); ?> (<?php echo e($cfg->fecversion); ?>)</span><br>
        ISB SISTEMAS, C.A.  Rif: J-40402421-2 <br>
        Somos una empresa de alta tecnologia, dedicada al desarrollo de aplicaciones a la 
        medidas de las necesidades de nuestros clientes.<br>
        Para obtener más información acerca de SEPED y sus diferentes
        productos. <br> 
        Visitenos:
        <a href="http://www.isbsistemas.com">
          <img src="<?php echo e(asset('images/isb.ico')); ?>" alt="ISB" style="width:16px; height: 16px;">
          www.isbsistemas.com
        </a> <br>
        CTO: Ing. Mauricio Blanco | +58 414-6454965 | 412-1677774<br>
        CEO: Ing. Gustavo Ferrer  | +58 412-1637530 <br>
        Copyright ©2013-<script>document.write(new Date().getFullYear());</script>  |  todos los derechos reservados <br>
        Maracaibo-Venezuela <br>
        <span style="font-size: 18px;">Se autoriza el uso de este producto a:</span> <br>
        <span style="font-size: 22px;"><?php echo e($cfg->nombre); ?></span><br>
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
      </div>
    </div>
  </div>
</div>

<!-- INFORMATIVO MODAL -->
<div class="modal fade modal-slide-in-right" 
  aria-hidden="true" 
  role="dialog" 
  tabindex="-1" 
  id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px 10px 10px 10px;">
      <div class="modal-header colorTitulo" style="border-radius: 10px 10px 0px 0px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">x</span>
        </button>
        <h4 class="modal-title">
        <span class="fa fa-info-circle" style="font-size: 24px;"> 
        INFORMATIVO
        </span>
        </h4>
      </div>
      <div class="modal-body">
        <span style="font-size: 24px; ; float: left;"><?php echo e($cfg->msgInfo); ?></span> 
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
      </div>
    </div>
  </div>
</div>

<!--SOPORTE TECNICO PANTALLA MODAL -->
<?php echo e(Form::Open(array('action'=>array('AdconfigController@correo')))); ?>

<?php echo e(Form::token()); ?>

<div class="modal fade modal-slide-in-right" 
  aria-hidden="true" 
  role="dialog" 
  tabindex="-1" 
  id="modal-soporte">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 10px 10px 10px 10px;">
      <div class="modal-header colorTitulo" style="border-radius: 10px 10px 0px 0px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: #ffffff;" aria-hidden="true">X</span>
        </button>
        <h4 class="modal-title">SOPORTE TECNICO</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-body">
              <form role="form">

                <div class="row">
                  <div class="col-md-8">
                    <div style="margin-bottom: 5px;">
                      <input name="nomsoporte" type="text" class="form-control" value="<?php echo e($cfg->nomsoporte); ?>" disabled/>
                    </div>

                    <div style="margin-bottom: 5px;">
                      <input name="telsoporte" type="text" class="form-control" value="<?php echo e($cfg->telsoporte); ?>" disabled/>
                    </div>

                    <div style="margin-bottom: 5px;">
                      <input name="destino" type="text" class="form-control" value="<?php echo e($cfg->correosoporte); ?>" disabled/>
                    </div>

                  </div>
                  <div class="col-md-4" >
                    <center>
                    <img src="<?php echo e(asset('images/userSoporte.png')); ?>" alt="seped" style="width:110px;" />
                    </center>
                  </div>
                </div>

                <div class="form-group">
                  <label>Remitente (Correo)</label>
                  <input name="remite" type="text" class="form-control" value="" />
                </div>

                <div class="form-group">
                  <label>Asunto (Identificación del cliente)</label>
                  <input name="asunto" type="text" class="form-control" value="" />
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Contenido (Descripción detallada)</label>
                  <textarea name="contenido" class="form-control" rows="3" placeholder="Descripción del soporte..."></textarea>
                </div>
    
              </form>
            </div><!-- /.box-body -->
          </div>
        </div>
      </div>
     
      <div class="modal-footer">
        <div class="col-md-12">
          <button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
          <button class="btn-confirmar" type="submit">Enviar</button>
        </div>
      </div>
    </div>
  </div>
</div> 
<?php echo e(Form::close()); ?>



<script>
$("[data-widget='collapse']").click(function() {
  var ancho = screen.width;
  var sb = '<?php echo e($sidebarMode); ?>';
  var rutaweb = './modmenu';
  var ruta = '<?php echo e(Route::currentRouteName()); ?>';
  if (ruta == "") 
    rutaweb = './seped/modmenu';
  if (ancho > 540 || sb == '2') { 
    $.ajax({
      type:'POST',
      url: rutaweb,
      dataType: 'json', 
      encode  : true,
      data: {modo : '1'},
      success:function(data) {
            window.location.reload(); 
      }
    });

  } 
});

var activo = '<?php echo e($cfg->modoInfo); ?>';
if (activo == 1) {
  var modoInfo = '<?php echo e($modoInfo); ?>';
  if (modoInfo == '1') {
    $('#modal-info').modal('show'); 
    $.ajax({
        type:'POST',
        url:'/seped/modoInfo',
        dataType: 'json', 
        encode  : true,
        data: {modo : '0'},
        success:function(data) {
        }
    });
  }
}

setTimeout( function() {
    var data = [ <?php echo $chart_data; ?>],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Cuota', 'Acumulado'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red'],
      barColors: ['#216BB4','#FFC242'],
    };
    config.element = 'bar-chart';
    Morris.Bar(config);
},9000);

$('#Selsucactiva').on('change', function()
{
    var sucactiva = this.value;
    $.ajax({
        type:'POST',
        url:'./seped/cambiarsucursal',
        dataType: 'json', 
        encode  : true,
        data: { sucactiva : sucactiva },
        success:function(data) {
            location.reload(true);
        }
    });
});

</script>


<?php /**PATH C:\xampp\htdocs\seped\aplication\resources\views/layouts/menu.blade.php ENDPATH**/ ?>