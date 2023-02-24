<!-- MENU PRINCIPAL  -->
@php 
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
@endphp 


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ISB, SISTEMAS, ISAWEB, ISACOM, DROLAGO, DROGUESUR, PULSO, METROMEDICA, DROSOLVECA, ISASOFT, ISBCLIENTE, Compras, SAINT, PROFIT, Proveedores, Mauricio Blanco, ISAAP, ISABUSCAR, SAINT, DROEXCA, DROANDINA, DROSALUD, DRCLINICA, FARMACEUTICA24, MARAPLUS, FARMALIADAS, ISACOMMERCE, SEPED, SIAD, SIDES. STELLAR, FARMACIAMARAPLUS, DROMARKO, DROPLUS, EMMANUELLE, DROGUERIA365, BIOGENETICA ">
    <meta name="format-detection" content="telephone=no"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>{{ $cfg->titulopagina }}</title>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('images/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/material-dashboard.css')}}"> 
    @include('layouts.styles')
    <link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>
    <link href="{{asset('css/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
  </head>

  <!--   
  <body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
  -->
  <body class="hold-transition skin-blue sidebar-mini  
    @if ( $sidebarMode == '2') sidebar-collapse @endif  ">
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
                    <span>{{date('d-m-Y H:i', strtotime(sLeercfg($sucactiva, 'fecha')))}}</span> 
                  </i>
                </a>
              </li>

              @if (Auth::user()->tipo != 'T')
                <!-- TASA CAMBIARIA -->
                @if ( $cfg->mostrarTasaCambiaria == '1' )
                <li class="dropdown messages-menu hidden-xs" >
                  <a href="#" class="dropdown-toggle" title="Tasa cambiaria del dolar">
                    <i class="fa fa-money"> 
                      <span style="font-size: 10px;">{{ $cfg->LiteralTasaCambiaria }} </span><br>
                      <span style="font-size: 14px;">{{number_format($cfg->tasacambiaria, 2, '.', ',')}}</span>
                    </i>
                  </a>
                </li>
                @endif
                
                <!-- Notifications: style can be found in dropdown.less -->
                @if ($cfg->mostrarModNotificacion > 0)
                  @if (Auth::user()->tipo == 'C' || Auth::user()->tipo == 'G' )
                    @php $iContadorNoti = iContadorNotiCliente(); 
                    if ($iContadorNoti > 0) {
                      $codcli = sCodigoClienteActivo();
                      $noti=DB::table('notientradas')
                      ->where('destino','=', $codcli)
                      ->where('envio','=', 1)
                      ->where('leido','=', 0)
                      ->orderBy('id','desc')
                      ->get();
                    }
                    @endphp
                    <li class="dropdown notifications-menu">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Ver listado de Notificaciones">
                        <i class="fa fa-bell-o" style="font-size:26px;"></i>
                        @if ($iContadorNoti > 0)
                          <span class="label colorAlcabala" 
                            style="font-size: 18px; border-radius: 50% 50%;">
                            {{$iContadorNoti}}
                          </span>
                        @endif
                      </a>
                      <ul class="dropdown-menu">
                        <li class="header">Usted tiene {{$iContadorNoti}} notificaciones nuevas</li>
                        <li>
                          <!-- inner menu: contains the actual data -->
                          <ul class="menu">
                            @if ($iContadorNoti > 0) 
                            @foreach ($noti as $n)
                            <li>
                              <a href="#">
                                @if ($n->tipo == 'PFA')
                                  <i class="fa fa-download text-aqua"></i> 
                                @elseif ($n->tipo == 'INFO')
                                  <i class="fa fa-users text-aqua"></i> 
                                @elseif ($n->tipo == 'URGENTE')
                                  <i class="fa fa-warning text-yellow"></i> 
                                @elseif ($n->tipo == 'COBRANZA')
                                  <i class="fa fa-money text-red"></i>
                                @elseif ($n->tipo == 'OTRO')
                                  <i class="fa fa-shopping-cart text-green"></i>
                                @endif
                                {{ $n->asunto }}
                              </a>
                            </li>
                            @endforeach
                            @endif
                          </ul>
                        </li>
                        <li class="footer">
                          <a href="{{url('/seped/noticliente')}}">Ver todas</a>
                        </li>
                      </ul>
                    </li>
                  @endif
                  @if (Auth::user()->tipo == 'A' || Auth::user()->tipo == 'V' || Auth::user()->tipo == 'S' || Auth::user()->tipo == 'R' )
                    @php $iContadorNoti = iContadorNotiServidor(); 
                    if ($iContadorNoti > 0) {
                      $codcli = $cfg->codisb;
                      $noti=DB::table('notientradas')
                      ->where('destino','=', $codcli)
                      ->where('envio','=', 1)
                      ->where('leido','=', 0)
                      ->orderBy('id','desc')
                      ->get();
                    }
                    @endphp
                    <li class="dropdown notifications-menu">
                      <a href="#" 
                        class="dropdown-toggle" 
                        data-toggle="dropdown" 
                        title="Ver listado de Notificaciones">
                        <i class="fa fa-bell-o" style="font-size:28px;"></i>
                        @if ($iContadorNoti > 0)
                          <span class="label colorAlcabala" 
                            style="font-size: 18px; border-radius: 50% 50%;">
                            {{$iContadorNoti}}
                          </span>
                        @endif
                      </a>
                      <ul class="dropdown-menu">
                        <li class="header">Usted tiene {{$iContadorNoti}} notificaciones nuevas</li>
                        <li>
                          <!-- inner menu: contains the actual data -->
                          <ul class="menu">
                            @if ($iContadorNoti > 0) 
                            @foreach ($noti as $n)
                            <li>
                              <a href="#">
                                @if ($n->tipo == 'PFA')
                                  <i class="fa fa-download text-aqua"></i> 
                                @elseif ($n->tipo == 'INFO')
                                  <i class="fa fa-users text-aqua"></i> 
                                @elseif ($n->tipo == 'URGENTE')
                                  <i class="fa fa-warning text-yellow"></i> 
                                @elseif ($n->tipo == 'COBRANZA')
                                  <i class="fa fa-money text-red"></i>
                                @elseif ($n->tipo == 'OTRO')
                                  <i class="fa fa-shopping-cart text-green"></i>
                                @endif
                                {{ $n->asunto }}
                              </a>
                            </li>
                            @endforeach
                            @endif
                          </ul>
                        </li>
                        <li class="footer">
                          <a href="{{url('/seped/notiservidor')}}">Ver todas</a>
                        </li>
                      </ul>
                    </li>
                  @endif
                @endif
                
                <!-- MOSTRAR PRODUCTOS CARRITO DE COMPRAS -->
                @if (Auth::user()->tipo == 'A' || Auth::user()->tipo == 'R')
                  @php $contreng=iContadorPedidos() @endphp
                  <li class="dropdown tasks-menu">
                    <a href="{{url('/seped/alcabala')}}" 
                      title="Alcabala, Contador de pedidos por aprobar">
                      <i class="fa fa-hand-paper-o" style="font-size:28px;"></i>
                      @if ($contreng>0)
                        <span class="label colorAlcabala" 
                          style="font-size: 18px; border-radius: 50% 50%;">
                          {{ $contreng }}
                        </span>
                      @endif
                    </a>
                  </li>
                @else
                  @if (Auth::user()->tipo != 'S')
                    @php 
                        $codcli = sCodigoClienteActivo();
                        $id = iIdUltPedAbierto($codcli);
                        $contreng = iContRengUltPedAbierto($codcli); 
                    @endphp
                    @if (Auth::user()->tipo == 'C')
                      @if ($contreng>0)
                      <li class="dropdown tasks-menu">
                        <a
                          @if ($id > 0) 
                            href="{{url("/seped/catalogo/".$id."/edit")}}"   
                          @else
                            href="{{URL::action('AdcatalogoController@listado','D')}}"
                          @endif
                          title="Ver carrito de compra">
                          <i class="fa fa-shopping-cart" style="font-size:26px;"></i>
                            <span id="contreng" 
                              class="label colorAlcabala" 
                              style="font-size:18px; border-radius: 50% 50%;">
                              {{ $contreng }}
                            </span>
                        </a>
                      </li>
                      @endif
                    @else
                      @if ($contreng>0)
                      <li class="dropdown tasks-menu">
                        <a
                        @if ($id > 0) 
                          href="{{url("/seped/catalogo/".$id."/edit")}}"
                        @else
                          href="{{URL::action('AdcatalogoController@listado','D')}}"
                        @endif
                        title="Ver carrito de compra">
                          <i class="fa fa-shopping-cart" style="font-size:26px;"></i>
                          @if ($contreng>0)
                            <span id="contreng" 
                              class="label colorAlcabala" 
                              style="font-size:18px; border-radius: 50% 50%;">
                              {{ $contreng }}
                            </span>
                          @endif
                        </a>
                      </li>
                      @endif
                    @endif
                    
                    @if ($contreng>0)
                    <li class="dropdown messages-menu">
                      <a href="{{url('/seped/catalogo/'.$id.'/edit')}}" 
                        title="Monto total del pedido, click para ver carrito de compra">
                          <span id="totpedido"> 
                            {{number_format(dTotalPedido($id), 2, '.', ',')}} 
                          </span> <br>
                          @if ( $cfg->mostrarPedidoOM == '1' )
                            <span id="totpedidoDolar" class="ColorDolar"> 
                              {{ $cfg->simboloOM }}
                              {{number_format(dTotalPedido($id)/$cfg->tasacambiaria, 2, '.', ',')}} 
                            </span>
                          @endif      
                      </a>
                    </li>
                    @endif
                  @endif
                @endif

                <!-- WHATSAPP -->
                @if ( !empty($cfg->linkWhatsappTel))  
                <li class="dropdown messages-menu">
                  <a href="https://{{ $cfg->linkWhatsappTel }}" title="Link whatsapp de {{ $cfg->nomcorto}}" >
                    <img src="{{asset('images/whatsapp.png')}}" alt="whatsapp" style="width:24px;height:24px;">
                  </a>
                </li>
                @endif
              @endif

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" 
                  class="dropdown-toggle" 
                  data-toggle="dropdown" 
                  title="Usuario activo">
                  <span>
                    @if (Auth::user()->tipo == 'A')
                      <img src="{{asset('images/userAdmin.png')}}" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    @elseif (Auth::user()->tipo == 'S')
                      <img src="{{asset('images/userSuper.png')}}" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    @elseif (Auth::user()->tipo == 'R')
                      <img src="{{asset('images/userCredito.png')}}" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    @elseif (Auth::user()->tipo == 'C')
                      <img src="{{asset('images/userCliente.png')}}" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    @elseif (Auth::user()->tipo == 'V')
                      <img src="{{asset('images/userVendedor.png')}}" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    @elseif (Auth::user()->tipo == 'P' )
                      <img src="{{asset('images/userProveedor.png')}}" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    @elseif (Auth::user()->tipo == 'T' )
                      <img src="{{asset('images/userTransporte.png')}}" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    @elseif (Auth::user()->tipo == 'G' )
                      <img src="{{asset('images/userGrupo.png')}}" 
                        alt="seped" 
                        style="width:28px; height: 28px;">
                    @endif
                    <span class="hidden-xs">
                      {{ Auth::user()->name }}
                    </span>
                  </span>
                </a>
                <ul class="dropdown-menu" 
                  style="border: 1px solid #CCCCCC;">
                  <!-- User image -->
                  <li class="user-header" style="height: 180px;">
                    @if (Auth::user()->tipo == 'A')
                    <img src="{{asset('images/userAdmin.png')}}" class="img-circle" alt="SEPED" />
                    @elseif (Auth::user()->tipo == 'S')
                    <img src="{{asset('images/userSuper.png')}}" class="img-circle" alt="SEPED" />
                    @elseif (Auth::user()->tipo == 'R')
                    <img src="{{asset('images/userCredito.png')}}" class="img-circle" alt="SEPED" />
                    @elseif (Auth::user()->tipo == 'C')
                    <img src="{{asset('images/userCliente.png')}}" class="img-circle" alt="SEPED" />
                    @elseif (Auth::user()->tipo == 'V')
                    <img src="{{asset('images/userVendedor.png')}}" class="img-circle" alt="SEPED" />
                    @elseif (Auth::user()->tipo == 'T')
                    <img src="{{asset('images/userTransporte.png')}}" class="img-circle" alt="SEPED" />
                    @elseif (Auth::user()->tipo == 'P')
                    <img src="{{asset('images/userProveedor.png')}}" class="img-circle" alt="SEPED" />
                    @elseif (Auth::user()->tipo == 'G' )
                    <img src="{{asset('images/userGrupo.png')}}" class="img-circle" alt="SEPED" />
                    @endif
                    <span class="user-header">
                      <br><br> 
                      Código: {{ Auth::user()->codcli }} <br>             
                      {{Auth::user()->email}}                      
                    </span>
                  </li>
                  
                  <!-- Menu Body -->
                  @if (Auth::user()->tipo == "A")
                  <li class="user-body">
                    <div class="col-xs-4 text-center" 
                      style="border-radius: 10px 10px 10px 10px !important;" >
                      <a href="{{url('/sincronizar')}}" 
                        style="text-decoration: underline black" 
                        title="Forzar sincronización con el Siad">
                        Sincronizar
                      </a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="{{url('/cargarimagen')}}" 
                        style="text-decoration: underline black" 
                        title="Cargar masiva de Imagenes">
                        Imagenes
                      </a>
                    </div>
                    @if (0)
                    <div class="col-xs-4 text-center">
                      <a href="{{url('/seped/prueba')}}" 
                        style="text-decoration: underline black" 
                        title="Prueba de curl">
                        Curl
                      </a>
                    </div>
                    @endif
                  </li>
                  @endif

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
                      <a href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                        class="btn btn-default btn-flat colorTitulo" 
                        title="Salir del Seped" 
                        style="width: 100px; border-radius: 8px 8px 8px 8px">
                        Cerrar sesión
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
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
        <a href="https://{{ $cfg->nomdominio }}" class="logo" >
          <span>
            <center>
            <img src="{{asset('images/'.$logo)}}" alt="Seped" class="tamLogoMenu">
            </center>
          </span>
        </a>

        <section class="sidebar">
          <ul class="sidebar-menu" >
           
            <center>
                <br>
                <li class="title" style="font-size: 14px;"><i>{{$labelseped}}</i></li>
            </center>


            @if (Auth::user()->tipo == 'A')

              @if ($sucursal->count() > 1)
              {!! Form::open(['url' => '/seped/cambiarsucursal', 'method' => 'post']) !!}
              <div class="form-group">
                <div class="input-group input-group-sm" style="margin-right: 4px;">
                  <select name="sucactiva" 
                    class="form-control"
                    style="margin-left: 4px;" >
                    @foreach($sucursal as $suc)
                      <option 
                        @if ($suc->codisb == $sucactiva)
                        selected 
                        @endif
                        value="{{$suc->codisb}}">
                        {{$suc->SedeSucursal}}
                      </option>
                    @endforeach
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
              {{ Form::close() }}
              @endif
              
              <li class="header title" style="font-size: 16px; margin-top: 7px;">
                <center>ADMINISTRADOR </center>
              </li>
             
              <!-- HOME -->
              <li @if ($menu=='Inicio') class='active' @endif >
                  <a href="{{url('/home')}}">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <!-- ALCABALA -->
              <li @if ($menu=='Alcabala') class='active' @endif>
                <a href="{{url('/seped/alcabala')}}">
                  <i class="fa fa-hand-paper-o"></i> <span>Alcabala</span>
                  @php $iContadorPedidos = iContadorPedidos(); @endphp
                  @if ($iContadorPedidos>0)
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      {{ $iContadorPedidos }}
                    </small>
                  @endif
                </a>
              </li>

              <!-- RECLAMOS -->
              <li @if ($menu=='Reclamos') class='active' @endif>
                <a href="{{url('/seped/monitorreclamo')}}">
                  <i class="fa fa-phone-square"></i> <span>Reclamos</span>
                  <?php $iContadorRecRecibido = iContadorRecRecibido(); ?>
                  @if ($iContadorRecRecibido>0)
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      {{ $iContadorRecRecibido }}
                    </small>
                  @endif
                </a>
              </li>

              <!-- PAGOS -->
              <li @if ($menu=='Pagos') class='active' @endif>
                <a href="{{url('/seped/monitorpago')}}">
                  <i class="fa fa-money"></i> <span>Pagos</span>
                  @php $iContadorPagRecibido = iContadorPagRecibido(); @endphp
                  @if ($iContadorPagRecibido>0)
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      {{ $iContadorPagRecibido }}
                    </small>
                  @endif
                </a>
              </li>

              <!-- CLIENTES -->
              <li @if ($menu=='Clientes') class='active' @endif>
                <a href="{{url('/seped/clientes')}}">
                  <i class="fa fa-user"></i> <span>Clientes</span>
                </a>
              </li>
 
              <!-- PEDIDOS -->
              <li @if ($menu=='Pedidos' ) class="active" @endif>
                  <a href="{{url('/seped/monitorpedido')}}">
                    <i class="fa fa-desktop"></i> <span>Pedidos</span>
                  </a>
              </li>

              <!-- CATALOGO -->
              <li @if ($menu=='Catalogo') class='active' @endif>
                <a href="{{URL::action('AdcatalogoController@listado','C')}}">
                  <i class="fa fa-cubes"></i> <span>Catálogo</span>
                </a>
              </li>

              <!-- IMAGENES -->
              <li @if ($menu=='Imagenes') class='treeview active' @else class='treeview' @endif" >
                <a href="#">
                  <i class="fa fa-image"></i>
                  <span>Imagenes</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{url('/seped/prodimg')}}">
                      <i class="fa fa-circle-o"></i> Productos
                    </a>
                  </li>

                  @if ($cfg->activarCateProducto == '1')                  
                  <li>
                    <a href="{{url('/seped/catimg')}}">
                      <i class="fa fa-circle-o"></i> Categorias
                    </a>
                  </li>
                  @endif

                  <li>
                    <a href="{{url('/seped/marcaimg')}}">
                      <i class="fa fa-circle-o"></i> Marcas
                    </a>
                  </li>

                </ul>
              </li>

              @if ( $cfg->mostrarModBlog == '1')
              <!-- BLOGS -->
              <li @if ($menu=='BLOGS') class='active' @endif>
                <a href="{{url('/seped/blogs')}}">
                  <i class="fa fa-object-group"></i> <span>Blogs</span>
                </a>
              </li>
              @endif
       
              @if ( $cfg->mostrarModDescarga == '1') 
                <!-- CARGAS -->
                <li @if ($menu=='Cargas') class='active' @endif>
                  <a href="{{url('/seped/carga')}}">
                    <i class="fa fa-upload"></i> <span>Cargas</span>
                  </a>
                </li>
                <!-- DESCARGAS -->
                <li @if ($menu=='Descargas') class='active' @endif>
                  <a href="{{url('/seped/descarga')}}">
                    <i class="fa fa-download"></i> <span>Descargas</span>
                  </a>
                </li>
              @endif

              <!-- GRUPOS -->
              <li @if ($menu=='Grupos') class='active' @endif>
                <a href="{{url('/seped/grupo')}}">
                  <i class="fa fa-users"></i> <span>Grupos</span>
                </a>
              </li>


              @if ( $cfg->activarBotonDias == '1') 
              <!-- PROMOCION X DIAS -->
              <li @if ($menu=='Promdias') class='active' @endif>
                <a href="{{url('/seped/promdias')}}">
                  <i class="fa fa-tags"></i> <span>Promoción x Dias</span>
                </a>
              </li>
              @endif

              <!-- USUARIOS -->
              <li @if ($menu=='Usuarios') class='active' @endif>
                <a href="{{url('/seped/usuario')}}">
                  <i class="fa fa-user-plus"></i> <span>Usuarios</span>
                </a>
              </li>


              <!-- CARACTERISTICAS EXTENDIDAS -->
              <li @if ($menu=='Caracteristicas') class='active' @endif>
                <a href="{{url('/seped/caracteristica')}}">
                  <i class="fa fa-commenting-o"></i> <span>Caracteristicas Extendidas</span>
                </a>
              </li>

              @if ( $cfg->mostrarModnofiscal == '1') 
              <!-- CLIENTES NO FISCALES -->
              <li @if ($menu=='ClienteNofical') class='active' @endif>
                <a href="{{url('/seped/clientenofiscal')}}">
                  <i class="fa fa-money"></i> <span>Clientes no Fiscales</span>
                </a>
              </li>
              @endif
   
              <!-- CRITERIO DE SEPARACION DE PEDIDOS -->
              <li @if ($menu=='Criterios') class='active' @endif>
                <a href="{{url('/seped/pedcrisep')}}">
                  <i class="fa fa-scissors"></i> <span>Criterio de Separación</span>
                </a>
              </li>

              <!-- REPORTES -->
              <li @if ($menu=='Reportes') class='active' @endif>
                <a href="{{url('/seped/report')}}">
                  <i class="fa fa-line-chart"></i> <span>Reportes</span>
                </a>
              </li>

              <!-- CONFIGURACION -->
              <li @if ($menu=='Configuracion') class='active' @endif>
                <a href="{{url('/seped/config')}}">
                  <i class="fa fa-gear"></i> <span>Configuración</span>
                </a>
              </li>
            @elseif (Auth::user()->tipo == 'S')
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    @foreach($sucursal as $suc)
                      <option  disabled 
                        selected 
                        value="{{$suc->codisb}}" >
                        {{sLeercfg($suc->codisb, "SedeSucursal")}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <center>
                  <li class="header title" style="font-size: 16px; margin-top: 7px;">
                  SUPERVISOR
                  </li>
              </center>
              <!-- HOME -->
              <li @if ($menu=='Inicio') class='active' @endif >
                  <a href="{{url('/home')}}">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <!-- PEDIDOS -->
              <li @if ($menu=='Pedidos' ) class="active" @endif>
                  <a href="{{url('/seped/monitorpedido')}}">
                    <i class="fa fa-desktop"></i> <span>Pedidos</span>
                  </a>
              </li>

              <!-- CATALOGO -->
              <li @if ($menu=='Catalogo') class='active' @endif>
                <a href="{{URL::action('AdcatalogoController@listado','C')}}">
                  <i class="fa fa-cubes"></i> <span>Catálogo</span>
                </a>
              </li>

              <!-- IMAGENES -->
              <li @if ($menu=='Imagenes') class='treeview active' @else class='treeview' @endif" >
                <a href="#">
                  <i class="fa fa-image"></i>
                  <span>Imagenes</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{url('/seped/prodimg')}}">
                      <i class="fa fa-circle-o"></i> Productos
                    </a>
                  </li>

                  @if ($cfg->activarCateProducto == '1')                  
                  <li>
                    <a href="{{url('/seped/catimg')}}">
                      <i class="fa fa-circle-o"></i> Categorias
                    </a>
                  </li>
                  @endif

                  <li>
                    <a href="{{url('/seped/marcaimg')}}">
                      <i class="fa fa-circle-o"></i> Marcas
                    </a>
                  </li>

                </ul>
              </li>

              @if ( $cfg->mostrarModBlog == '1')
              <!-- BLOGS -->
              <li @if ($menu=='BLOGS') class='active' @endif>
                <a href="{{url('/seped/blogs')}}">
                  <i class="fa fa-object-group"></i> <span>Blogs</span>
                </a>
              </li>
              @endif
       
              @if ( $cfg->mostrarModDescarga == '1') 
                <!-- CARGAS -->
                <li @if ($menu=='Cargas') class='active' @endif>
                  <a href="{{url('/seped/carga')}}">
                    <i class="fa fa-upload"></i> <span>Cargas</span>
                  </a>
                </li>
                <!-- DESCARGAS -->
                <li @if ($menu=='Descargas') class='active' @endif>
                  <a href="{{url('/seped/descarga')}}">
                    <i class="fa fa-download"></i> <span>Descargas</span>
                  </a>
                </li>
              @endif

              <!-- PROMOCION X DIAS -->
              <li @if ($menu=='Promdias') class='active' @endif>
                <a href="{{url('/seped/promdias')}}">
                  <i class="fa fa-tags"></i> <span>Promoción x Dias</span>
                </a>
              </li>

              <!-- GRUPOS -->
              <li @if ($menu=='Grupos') class='active' @endif>
                <a href="{{url('/seped/grupo')}}">
                  <i class="fa fa-users"></i> <span>Grupos</span>
                </a>
              </li>

              <!-- USUARIOS -->
              <li @if ($menu=='Usuarios') class='active' @endif>
                <a href="{{url('/seped/usuario')}}">
                  <i class="fa fa-user-plus"></i> <span>Usuarios</span>
                </a>
              </li>

              <!-- CARACTERISTICAS EXTENDIDAS -->
              <li @if ($menu=='Caracteristicas') class='active' @endif>
                <a href="{{url('/seped/caracteristica')}}">
                  <i class="fa fa-commenting-o"></i> <span>Caracteristicas Extendidas</span>
                </a>
              </li>

              @if ( $cfg->mostrarModnofiscal == '1') 
              <!-- CLIENTES NO FISCALES -->
              <li @if ($menu=='ClienteNofical') class='active' @endif>
                <a href="{{url('/seped/clientenofiscal')}}">
                  <i class="fa fa-money"></i> <span>Clientes no Fiscales</span>
                </a>
              </li>
              @endif

              <!-- REPORTES -->
              <li @if ($menu=='Reportes') class='active' @endif>
                <a href="{{url('/seped/report')}}">
                  <i class="fa fa-line-chart"></i> <span>Reportes</span>
                </a>
              </li>
            @elseif (Auth::user()->tipo == 'R')
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    @foreach($sucursal as $suc)
                      <option  disabled 
                        selected 
                        value="{{$suc->codisb}}" >
                        {{sLeercfg($suc->codisb, "SedeSucursal")}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <center>
                  <li class="header title" style="font-size: 16px; margin-top: 7px;">
                    CREDITO Y COBRANZA
                  </li>
              </center>
              <!-- HOME -->
              <li @if ($menu=='Inicio') class='active' @endif >
                  <a href="{{url('/home')}}">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <!-- ALCABALA -->
              <li @if ($menu=='Alcabala') class='active' @endif>
                <a href="{{url('/seped/alcabala')}}">
                  <i class="fa fa-hand-paper-o"></i> <span>Alcabala</span>
                  @php $iContadorPedidos = iContadorPedidos(); @endphp
                  @if ($iContadorPedidos>0)
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      {{ $iContadorPedidos }}
                    </small>
                  @endif
                </a>
              </li>

              <!-- RECLAMOS -->
              <li @if ($menu=='Reclamos') class='active' @endif>
                <a href="{{url('/seped/monitorreclamo')}}">
                  <i class="fa fa-phone-square"></i> <span>Reclamos</span>
                  @php $iContadorRecRecibido = iContadorRecRecibido(); @endphp
                  @if ($iContadorRecRecibido>0)
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      {{ $iContadorRecRecibido }}
                    </small>
                  @endif
                </a>
              </li>

              <!-- PAGOS -->
              <li @if ($menu=='Pagos') class='active' @endif>
                <a href="{{url('/seped/monitorpago')}}">
                  <i class="fa fa-money"></i> <span>Pagos</span>
                  @php $iContadorPagRecibido = iContadorPagRecibido(); @endphp
                  @if ($iContadorPagRecibido>0)
                    <small class="label pull-right colorResaltado" 
                      style="font-size: 14px; border-radius: 50% 50%;">
                      {{ $iContadorPagRecibido }}
                    </small>
                  @endif
                </a>
              </li>

              <!-- CLIENTES -->
              <li @if ($menu=='Clientes') class='active' @endif>
                <a href="{{url('/seped/clientes')}}">
                  <i class="fa fa-user"></i> <span>Clientes</span>
                </a>
              </li>

               <!-- CXC DEL VENDEDOR -->
              <li @if ($menu=='Cxc') class='active' @endif>
                <a href="{{URL::action('AdestadoctaController@index')}}">
                  <i class="fa fa-thumbs-up"></i> <span>Cuentas x Cobrar</span>
                </a>
              </li>

              <!-- FACTURAS -->
              <li @if ($menu=='Facturas') class='active' @endif>
                <a href="{{URL::action('AdreportController@facturas')}}" >
                  <i class="fa fa-building-o"></i> <span>Facturas</span>
                </a>
              </li>

              <!-- PEDIDOS -->
              <li @if ($menu=='Pedidos' ) class="active" @endif>
                  <a href="{{url('/seped/monitorpedido')}}">
                    <i class="fa fa-desktop"></i> <span>Pedidos</span>
                  </a>
              </li>

              <!-- USUARIOS -->
              <li @if ($menu=='Usuarios') class='active' @endif>
                <a href="{{url('/seped/usuario')}}">
                  <i class="fa fa-user-plus"></i> <span>Usuarios</span>
                </a>
              </li>
            @elseif (Auth::user()->tipo == 'C')

              @if ($sucursal->count() > 1)
              {!! Form::open(['url' => '/seped/cambiarsucursal', 'method' => 'post']) !!}
              <div class="form-group" style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm">
                  <select name="sucactiva" class="form-control">
                    @foreach($sucursal as $suc)
                      <option 
                        @if ($suc->codisb == $sucactiva)
                        selected 
                        @endif
                        value="{{$suc->codisb}}">
                        {{sLeercfg($suc->codisb, "SedeSucursal")}}
                      </option>
                    @endforeach
                  </select>
                  <span style="padding: 0;" class="input-group-addon input-group">
                    <button type="submit" 
                      class="btn-peqbuscar">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
              </div>
              {{ Form::close() }}
              @else
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    @foreach($sucursal as $suc)
                      <option  disabled 
                        selected 
                        value="{{$suc->codisb}}" >
                        {{sLeercfg($suc->codisb, "SedeSucursal")}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              @endif

              <center>
                <li class="header title" style="font-size: 16px; margin-top: 7px;">CLIENTE</li>
              </center>
              <!-- HOME -->
              <li @if ($menu=='Inicio') class='active' @endif>
                  <a href="{{url('/home')}}">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>
              <!-- CATALOGO -->
              <li @if ($menu=='Catalogo') class='active' @endif>
                <a href="{{URL::action('AdcatalogoController@listado','D')}}">
                  <i class="fa fa-cubes"></i> <span>Catálogo</span>
                </a>
              </li>
              <!-- PEDIDOS -->
              <li @if ($menu=='Pedidos') class='active' @endif>
                <a href="{{URL::action('AdpedidoController@index')}}">
                  <i class="fa fa-shopping-cart"></i><span>Pedidos</span>
                </a>
              </li>
              <!-- RECLAMOS -->
              <li @if ($menu=='Reclamos') class='active' @endif>
                <a href="{{URL::action('AdreclamoController@index')}}">
                  <i class="fa fa-phone-square"></i> <span>Reclamos</span>
                </a>
              </li>
              <!-- PAGOS -->
              <li @if ($menu=='Pagos') class='active' @endif>
                <a href="{{URL::action('AdpagoController@index')}}">
                  <i class="fa fa-money"></i> <span>Pagos</span>
                </a>
              </li>
              <!-- CXP -->
              <li @if ($menu=='Cxp') class='active' @endif>
                <a href="{{URL::action('AdestadoctaController@index')}}">
                  <i class="fa fa-thumbs-up"></i> <span>Cuentas x Pagar</span>
                </a>
              </li>
              <!-- FACTURAS -->
              <li @if ($menu=='Facturas') class='active' @endif>
                <a href="{{URL::action('AdfacturaController@index')}}">
                  <i class="fa fa-building-o"></i> <span>Facturas</span>
                </a>
              </li>
         
              @if ( $cfg->mostrarModCesta == '1')
                <!--  CESTAS POR DEVOLVER -->
                <li @if ($menu=='Cestas') class='active' @endif>
                  <a href="{{url('/seped/cestasentregar')}}">
                    <i class="fa fa-shopping-basket"></i> <span>Cestas</span>
                  </a>
                </li>
              @endif
         
              <!-- DESCARGAS -->
              @if ( $cfg->mostrarModDescarga == '1') 
                <li @if ($menu=='Descargas') class='active' @endif>
                  <a href="{{url('/seped/descarga')}}">
                    <i class="fa fa-download"></i> <span>Descargas</span>
                  </a>
                </li>
              @endif

              <!-- CONFIGURACION -->
              <li @if ($menu=='Configuracion') class='active' @endif>
                <a href="{{url('/seped/verconfig')}}">
                  <i class="fa fa-info-circle"></i> <span>Información</span>
                </a>
              </li>
            @elseif (Auth::user()->tipo == 'T')
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    @foreach($sucursal as $suc)
                      <option  disabled 
                        selected 
                        value="{{$suc->codisb}}" >
                        {{sLeercfg($suc->codisb, "SedeSucursal")}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <center>
                  <li class="header title" style="font-size: 16px; margin-top: 7px;">
                  CHOFER
                  </li>
              </center>
              <!-- HOME -->
              <li @if ($menu=='Inicio') class='active' @endif >
                  <a href="{{url('/home')}}">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>
            @elseif (Auth::user()->tipo == 'P')
              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    @foreach($sucursal as $suc)
                      <option  disabled 
                        selected 
                        value="{{$suc->codisb}}" >
                        {{sLeercfg($suc->codisb, "SedeSucursal")}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <center>
                  <li class="header title" style="font-size: 16px; margin-top: 7px;">
                  PROVEEDOR
                  </li>
              </center>
              <!-- HOME -->
              <li @if ($menu=='Inicio') class='active' @endif >
                  <a href="{{url('/home')}}">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              <!-- CATALOGO -->
              <li @if ($menu=='Catalogo' ) class="active" @endif>
                  <a href="{{url('/seped/provcata')}}">
                    <i class="fa fa-cubes"></i> <span>Catálogo</span>
                  </a>
              </li>
              <!-- FACTURAS -->
              <li @if ($menu=='Facturas' ) class="active" @endif>
                  <a href="{{url('/seped/provfact')}}">
                    <i class="fa fa-building-o"></i> <span>Facturas</span>
                  </a>
              </li>
              <!-- VENTAS -->
              <li @if ($menu=='Ventas' ) class="active" @endif>
                  <a href="{{url('/seped/provvtas')}}">
                    <i class="fa fa-tags"></i> <span>Ventas</span>
                  </a>
              </li>
              <!-- CONFIGURACION -->
              <li @if ($menu=='Configuracion') class='active' @endif>
                <a href="{{url('/seped/provconf')}}">
                  <i class="fa fa-gear"></i> <span>Configuración</span>
                </a>
              </li>
            @elseif (Auth::user()->tipo == 'V' || Auth::user()->tipo == 'G')

              <div class="form-group"
                style="padding: 2px 5px 0px 5px;">
                <div class="input-group input-group-sm col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                  <select name="sucactiva" class="form-control">
                    @foreach($sucursal as $suc)
                      <option  disabled 
                        selected 
                        value="{{$suc->codisb}}" >
                        {{sLeercfg($suc->codisb, "SedeSucursal")}}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            
              <center>
                @if (Auth::user()->tipo == 'V')
                <li class="header title" style="font-size: 16px; margin-top: 7px;">VENDEDOR</li>
                @else
                <li class="header title" style="font-size: 16px; margin-top: 7px;">GRUPO</li>
                @endif
              </center>
              <!-- HOME -->
              <li @if ($menu=='Inicio') class='active' @endif>
                  <a href="{{url('/home')}}">
                    <i class="fa fa-home"></i> <span>Inicio</span>
                  </a>
              </li>

              @if (Auth::user()->tipo == 'V')
              <!-- SEGUIMIENTO -->
              <li @if ($menu=='Alcabala') class='active' @endif>
                <a href="{{url('/seped/alcabala')}}">
                  <i class="fa fa-hand-paper-o"></i> <span>Seguimiento</span>
                  @php $iContadorPedidos = iContadorPedidos(); @endphp
                  @if ($iContadorPedidos>0)
                    <small class="label pull-right colorResaltado"
                      style="font-size: 14px; border-radius: 50% 50%;">
                      {{ $iContadorPedidos }}
                    </small>
                  @endif
                </a>
              </li>
              @endif

              <!-- CATALOGO -->
              <li @if ($menu=='Catalogo') class='active' @endif>
                <a href="{{URL::action('AdcatalogoController@listado','D')}}">
                  <i class="fa fa-cubes"></i> <span>Catálogo</span>
                </a>
              </li>
              <!-- PEDIDOS -->
              <li @if ($menu=='Pedidos') class='active' @endif>
                <a href="{{URL::action('AdpedidoController@index')}}">
                  <i class="fa fa-shopping-cart"></i><span>Pedidos</span>
                </a>
              </li>
              <!-- RECLAMOS -->
              <li @if ($menu=='Reclamos') class='active' @endif>
                <a href="{{URL::action('AdreclamoController@index')}}">
                  <i class="fa fa-phone-square"></i> <span>Reclamos</span>
                </a>
              </li>
              <!-- PAGOS -->
              <li @if ($menu=='Pagos') class='active' @endif>
                <a href="{{URL::action('AdpagoController@index')}}">
                  <i class="fa fa-money"></i> <span>Pagos</span>
                </a>
              </li>
             
              <!-- CXC DEL VENDEDOR -->
              <li @if ($menu=='Cxc') class='active' @endif>
                <a href="{{URL::action('AdestadoctaController@index')}}">
                  <i class="fa fa-thumbs-up"></i> <span>Cuentas x Cobrar</span>
                </a>
              </li>

              <!-- FACTURAS -->
              <li @if ($menu=='Facturas') class='active' @endif>
                <a href="{{URL::action('AdfacturaController@index')}}">
                  <i class="fa fa-building-o"></i> <span>Facturas</span>
                </a>
              </li>

              @if ( $cfg->mostrarModCesta == '1')
                <!--  CESTAS POR DEVOLVER -->
                <li @if ($menu=='Cestas') class='active' @endif>
                  <a href="{{url('/seped/cestasentregar')}}">
                    <i class="fa fa-shopping-basket"></i> <span>Cestas</span>
                  </a>
                </li>
              @endif

              @if ( $cfg->mostrarModDescarga == '1') 
                <!-- DESCARGAS -->
                <li @if ($menu=='Descargas') class='active' @endif>
                  <a href="{{url('/seped/descarga')}}">
                    <i class="fa fa-download"></i> <span>Descargas</span>
                  </a>
                </li>
              @endif

              <!-- CONFIGURACION -->
              <li @if ($menu=='Configuracion') class='active' @endif>
                <a href="{{url('/seped/verconfig')}}">
                  <i class="fa fa-info-circle"></i> <span>Información</span>
                </a>
              </li>
            @endif

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
            @if (Auth::user()->tipo == 'P')
              {{ NombreProveActivo() }}
            @else 
              @if (Auth::user()->tipo == 'C' || Auth::user()->tipo == 'V' || Auth::user()->tipo == 'G')
                @if ($menu=="Inicio")
                  {{ sLeercfg($sucactiva, 'nombre') }}
                @else
                  @php $codcli = sCodigoClienteActivo(); @endphp
                  @if (Auth::user()->tipo == 'V' || Auth::user()->tipo == 'G') 
                    {{NombreCliente($codcli)}}
                  @else 
                    {{NombreCliente($codcli)}}
                  @endif
                @endif
              @else
                {{ sLeercfg($sucactiva, 'nombre') }}
              @endif
            @endif
          </h1>
          <ol class="breadcrumb">
          <li><a href="{{url('/home')}}"><i class="fa fa-home"></i> Inicio</a></li>
          @if ( Route::currentRouteName() )
            <li>
              <a href="{{url('/seped/'.explode('.', Route::currentRouteName())[0] )}}"> 
              {{$menu}}
              </a>
            </li>
            <li>{{ explode(".", Route::currentRouteName())[1] }} </li>
          @else
              <li class="active">{{$menu}}</li>
          @endif
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">

          @if (Session::has('message'))
            <div class="alert alert-info alert-dismissable" 
              role="alert"
              style="border-radius: 10px 10px 10px 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> {!! Session::get("message") !!} </strong>
            </div>
          @endif
          
          @if (Session::has('warning'))
            <div class="alert alert-warning alert-dismissable" 
              role="alert"
              style="border-radius: 10px 10px 10px 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> {!! Session::get("warning") !!} </strong>
            </div>
          @endif 

          @if (Session::has('error'))
            <div class="alert alert-error alert-dismissable" 
              role="alert"
              style="border-radius: 10px 10px 10px 10px;">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> {!! Session::get("error") !!} </strong>
            </div>
          @endif
          
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
                           @yield('contenido')
                           <!--Fin Contenido-->
                       </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          
        </section>
      </div> 

      @if ($menu=='Inicio')
      <footer class="main-footer navbar navbar-fixed-bottom">
        <div class="pull-right hidden-xs" title="Publicación: {{ $cfg->fecversion }}">
          <b>Versión</b> {{ $cfg->version }} 
        </div>
        @if ($cfg->mostrarCopyRight > 0)
          <strong>
              <a href="">
                 {{$cfg->CopyRight}}
              </a>
          </strong>
        @else
          <strong>Copyright © 2013-<script>document.write(new Date().getFullYear());</script>
              <a href="http://www.isbsistemas.com.ve">
                 <img src="{{asset('images/isb.ico')}}" alt="ISB" style="width:16px; height: 16px;">
                 ISB SISTEMAS, C.A. 
              </a>
          </strong>
        @endif
      </footer>
      @endif
   
      <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
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
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
      <!-- AdminLTE App -->
      <script src="{{asset('js/app.min.js')}}"></script>
      <script src="{{asset('js/slick.min.js')}}"></script>
      <script src="{{asset('js/nouislider.min.js')}}"></script>
      <script src="{{asset('js/main.js')}}"></script>

      <script type="text/javascript" src="{{asset('js/raphael-min.js')}}"></script>
      <script type="text/javascript" src="{{asset('css/plugins/morris/morris.min.js')}}"></script>
      <!--  <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->

      <!-- bootstrap color picker -->
      <script src="{{asset('js/jscolor.min.js')}}"></script>

      @stack('scripts') 

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
          <img style="width: 120px;" src="{{asset('images/seped.jpg')}}" alt="SEPED" />
        </p>
        <span style="font-size: 24px;">SISTEMA DE ENVIO DE PEDIDOS</span> 
        <span>&nbsp;Version {{$cfg->version}} ({{$cfg->fecversion}})</span><br>
        ISB SISTEMAS, C.A.  Rif: J-40402421-2 <br>
        Somos una empresa de alta tecnologia, dedicada al desarrollo de aplicaciones a la 
        medidas de las necesidades de nuestros clientes.<br>
        Para obtener más información acerca de SEPED y sus diferentes
        productos. <br> 
        Visitenos:
        <a href="http://www.isbsistemas.com">
          <img src="{{asset('images/isb.ico')}}" alt="ISB" style="width:16px; height: 16px;">
          www.isbsistemas.com
        </a> <br>
        CTO: Ing. Mauricio Blanco | +58 414-6454965 | 412-1677774<br>
        CEO: Ing. Gustavo Ferrer  | +58 412-1637530 <br>
        Copyright ©2013-<script>document.write(new Date().getFullYear());</script>  |  todos los derechos reservados <br>
        Maracaibo-Venezuela <br>
        <span style="font-size: 18px;">Se autoriza el uso de este producto a:</span> <br>
        <span style="font-size: 22px;">{{ $cfg->nombre }}</span><br>
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
        <span style="font-size: 24px; ; float: left;">{{$cfg->msgInfo}}</span> 
      </div>
     
      <div class="modal-footer">
        <button type="button" class="btn-normal" data-dismiss="modal">Regresar</button>
      </div>
    </div>
  </div>
</div>

<!--SOPORTE TECNICO PANTALLA MODAL -->
{{Form::Open(array('action'=>array('AdconfigController@correo')))}}
{{ Form::token() }}
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
                      <input name="nomsoporte" type="text" class="form-control" value="{{ $cfg->nomsoporte}}" disabled/>
                    </div>

                    <div style="margin-bottom: 5px;">
                      <input name="telsoporte" type="text" class="form-control" value="{{ $cfg->telsoporte}}" disabled/>
                    </div>

                    <div style="margin-bottom: 5px;">
                      <input name="destino" type="text" class="form-control" value="{{$cfg->correosoporte}}" disabled/>
                    </div>

                  </div>
                  <div class="col-md-4" >
                    <center>
                    <img src="{{asset('images/userSoporte.png')}}" alt="seped" style="width:110px;" />
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
{{Form::close()}}


<script>
$("[data-widget='collapse']").click(function() {
  var ancho = screen.width;
  var sb = '{{$sidebarMode}}';
  var rutaweb = './modmenu';
  var ruta = '{{Route::currentRouteName()}}';
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

var activo = '{{$cfg->modoInfo}}';
if (activo == 1) {
  var modoInfo = '{{$modoInfo}}';
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


