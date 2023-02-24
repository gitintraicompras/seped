@extends ('layouts.menu')
@section ('contenido')
 
@php
$chart_data = "";
@endphp
@if (Auth::user()->tipo == 'C' 
  || Auth::user()->tipo == 'G'
  || Auth::user()->tipo == 'V' ) 
  @php
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
  @endphp
  @if (!empty($DctoPreferencial))
     @if ($contador > 0)
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
                      @for ($x=0; $x < $contador; $x++)
                        @php
                        $campo = explode("-", $reg[$x]);
                        $mes = $campo[0];
                        @endphp
                        @if ($mes <= $idmes)
                            <th colspan="3">&nbsp;&nbsp;&nbsp;&nbsp{{$campo[0]}}</th>
                        @endif
                      @endfor
                  </thead>
                  <tr style="font-size: 10px;">
                      <td title="{{$cfg->msgLitVip}}">
                        <b title="{{$cfg->msgLitVip}}">{{$cfg->LitVip}}</b>
                      </td>
                      @for ($x=0; $x < $contador; $x++)
                        @php
                        $campo = explode("-", $reg[$x]);
                        $mes = $campo[0];
                        $dcto = $campo[1]; 
                        $cuota = $campo[2];
                        $acum = $campo[3];
                        @endphp
                        @if ($mes <= $idmes)
                            <td align="right" 
                                title="DESCUENTO {{$cfg->msgLitVip}} {{number_format($dcto, 2, '.', ',')}}% ">
                              {{number_format($dcto, 2, '.', ',')}}%
                            </td>
                            <td align="right" 
                                title="CUOTA {{$cfg->msgLitVip}}">
                              {{number_format($cuota, 0, '.', ',')}}
                            </td>
                            <td align="right" 
                                title="ACUMULADO {{$cfg->msgLitVip}}">
                              <b>{{number_format($acum, 0, '.', ',')}}</b>
                            </td>
                        @endif
                      @endfor
                  </tr>
                </table>
            </a>
            @include('seped.catalogo.vip')
        </div>
      @endif
  @endif
@endif


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

<input hidden id="idforma" type="text" value="{{$forma}}">
<!-- BOTONES BARRA DE BOTONESS -->
@include('seped.catalogo.catabarra')
@if ($modovisual == "T")
    @if ($tipo=="G")
        <!-- CATEGORIAS -->
        <div class="col-md-12">
            <div class="row" style="width: 100%; margin-bottom: 0px; margin-top: 30px;">
                <div class="products-tab">
                    <!-- tab -->
                    <div id="tab1" class="tab-pane active">
                        <div class="products-slick" data-nav="#slick-nav-1">
                            @foreach ($categoria as $cat)
                                <!-- shop -->
                                <div class="col-md-4 col-xs-6">
                                    <div class="shop">
                                        <div class="shop-img" >
                                            <center>
                                            <a href="{{URL::action('AdcatalogoController@listado','G_'.$cat->codcat) }}" class="cta-btn">
                                                <img src="{{ asset( '/public/storage/'.NombreImagenCat($cat->codcat) ) }}" alt="" style="height: 100px;">
                                            </a>
                                            </center>
                                        </div>
                                        <div class="shop-body">
                                            <a href="{{URL::action('AdcatalogoController@listado','G_'.$cat->codcat) }}" class="cta-btn">
                                                <center><h4>{{$cat->nomcat}}</h4></center>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="slick-nav-1" 
                            class="products-slick-nav colorPromDias">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($tipo=="M")
        <!-- MARCAS -->
        <div class="col-md-12">
            <div class="row" style="width: 100%; margin-bottom: 15px; margin-top: 30px;">
                <div class="products-tab">
                    <!-- tab -->
                    <div id="tab1" class="tab-pane active">
                        <div class="products-slick" data-nav="#slick-nav-1">
                            @foreach ($marca as $m)

                                <!-- shop -->
                                <div class="col-md-4 col-xs-6">
                                    <div class="shop">
                                        <div class="shop-img" >
                                            <center>
                                            <a href="{{URL::action('AdcatalogoController@listado','M_'.$m->codmarca) }}" 
                                                class="cta-btn">
                                                <img src="{{ asset( '/public/storage/'.NombreImagenMarca($m->codmarca) ) }}" alt="" style="height: 100px;">
                                            </a>
                                            </center>
                                        </div>
                                        <div class="shop-body">
                                            <a href="{{URL::action('AdcatalogoController@listado','M_'.$m->codmarca) }}" 
                                                class="cta-btn">
                                                <center><h4>{{$m->desmarca}}</h4></center>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div> 
                        <div id="slick-nav-1" 
                            class="products-slick-nav colorPromDias">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($tipo=="F")
        @if (Auth::user()->tipo == "C" || Auth::user()->tipo == "G" || Auth::user()->tipo == "V")
            <a href="{{url('/seped/catalogo/borrar')}}" title="Borrar todas las alertas de notificación">
                <i class="fa fa-trash-o"></i> Borrar todas las alertas
            </a>
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    @if ($cfg->mostrarBarraNavCatInicio > 0)
                        <div align='right' style="height: 60px;" >
                            {{$catalogo->appends(["filtro" => $filtro])->links()}}
                        </div>
                    @else
                        <br>
                    @endif
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead class="colorTitulo">
                            <th>#</th>
                            @if (Auth::user()->tipo == "C" || Auth::user()->tipo == "G" || Auth::user()->tipo == "V")
                                <th style="width:60px;" title="Activar notificación">ALERTA</th>
                            @endif
                            <th>PRODUCTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>CODIGO</th>
                            <th>BARRA</th>
                            <th>MARCA</th>
                            <th>PRINCIPIO ACTIVO</th>
                        </thead>
                        @foreach ($catalogo as $c)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            @if (Auth::user()->tipo == "C" || Auth::user()->tipo == "G" || Auth::user()->tipo == "V")
                                <td style="padding-top: 10px;">
                                    <span onclick='tdclickAlerta(event);' >
                                    <center>
                                    @if (VerificarProdFallaAlerta($c->codprod))
                                        <input type="checkbox" id="idalerta_{{$c->codprod}}" checked />
                                    @else
                                        <input type="checkbox" id="idalerta_{{$c->codprod}}"  />
                                    @endif
                                    </center>
                                    </span>
                                </td>
                            @endif
                            <td>
                                <b>{{$c->desprod}}</b>
                            </td>
                            <td>{{$c->codprod}}</td>
                            <td>{{$c->barra}}</td>
                            <td>{{$c->marcamodelo}}</td>
                            <td>{{$c->pactivo}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <div align='right'>
                        {{$catalogo->appends(["filtro" => $filtro])->links()}}
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- TABLAS DE PRODUCTOS -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive"> 
                    @if ($cfg->mostrarBarraNavCatInicio > 0)
                        @if ($catalogo->count()>=200)
                            <div align='right' style="height: 60px;" >
                                {{$catalogo->appends(["filtro" => $filtro])->links()}}
                            </div>
                        @else
                            <br>
                        @endif
                    @else
                        <br>
                    @endif
                    <table id="idtabla" 
                        class="table table-striped table-bordered table-condensed table-hover" >
                        <thead class="colorTitulo">
                            <!-- O NUMERO -->
                            <th>#</th>

                            <!-- 1 IMAGEN -->
                            @if ( $cfg->mostrarImagen > 0 )
                                <th class="hidden-xs"
                                    style="width: 120px;">
                                    <center>IMAGEN</center>
                                </th>
                            @else
                                <th class="hidden-xs">OPCION</th>
                            @endif

                            <!-- 2 PEDIR -->
                            @if (Auth::user()->tipo!='A' && Auth::user()->tipo!='S')
                                <th style="width: 110px;" 
                                    title="Cantidad a pedir">
                                    PEDIR
                                </th>
                            @endif

                            <!-- 3 DESCRIPCION -->
                            <th title="Descripción de producto">
                                PRODUCTO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </th>

                            <!-- 4 LOTE -->
                            @if (Auth::user()->tipo == "V")
                                <th @if ( $cfg->mostrarLote > 0 )
                                        class="hidden-xs" title="Lote/Vencimiento del producto"
                                    @else
                                        style="display:none;"
                                    @endif >
                                    LOTE
                                </th>
                            @endif
                            @if (Auth::user()->tipo == "C" || Auth::user()->tipo == "G")
                                <th @if ( $cfg->mostrarLoteCliente > 0 )
                                        class="hidden-xs" title="Lote/Vencimiento del producto"
                                    @else
                                        style="display:none;"
                                    @endif >
                                    LOTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </th>
                            @endif

                            <!-- 5 CODIGO -->
                            <th @if ( $cfg->mostrarCodigo > 0 )
                                    class="hidden-xs" title="Código del producto"
                                @else
                                    style="display:none;"
                                @endif >
                                CODIGO
                            </th>

                            <!-- 6 BULTO -->
                            <th @if ( $cfg->mostrarBulto > 0 )
                                    class="hidden-xs" title="Unidad de manejo del bulto"
                                @else
                                    style="display:none;"
                                @endif >
                                U.M.
                            </th>

                            <!-- 7 CEXISTENCIA -->
                            <th title="Cantidad dispoible del inventario">EXIST.</th>
                            
                            <!-- 8 PRECIO -->
                            @if (Auth::user()->tipo=='A' || Auth::user()->tipo=='S')
                                @for ($i = 1; $i <= $cfg->cantPrecioUtilizar; $i++)
                                    <th title="{{$cfg->msgLitPrecio}}">
                                        {{$cfg->LitPrecio}}{{$i}}
                                    </th>
                                @endfor
                            @else
                                <th title="{{$cfg->msgLitPrecio}}">
                                    {{$cfg->LitPrecio}}
                                </th>
                            @endif

                            <!-- 9 IVA -->
                            <th class="hidden-xs" title="Impuesto al valor agregado">IVA</th>
                      
                            <!-- 10 DV -->
                            <th @if ( $cfg->mostrarDv > 0 )
                                    class="hidden-xs" title="{{$cfg->msgLitDv}}"
                                    style = "width: 100px;";
                                @else
                                    style="display:none;"
                                @endif >
                                {{ $cfg->LitDv }} &nbsp;&nbsp;&nbsp;
                            </th>

                            <!-- 11 DA -->
                            <th @if ( $cfg->mostrarDa > 0 )
                                    class="hidden-xs" title="{{$cfg->msgLitDa}}"
                                @else
                                    style="display:none;"
                                @endif >
                                {{ $cfg->LitDa }}
                            </th>

                            <!-- 12 DP -->
                            <th @if ( $cfg->mostrarDp > 0 )
                                    class="hidden-xs" title="{{$cfg->msgLitDp}}"
                                @else
                                    style="display:none;"
                                @endif >
                                {{ $cfg->LitDp }}
                            </th>

                            @if (Auth::user()->tipo=='V' || Auth::user()->tipo=='C' || Auth::user()->tipo=='G')
                                <th @if ( $cfg->mostrarDi > 0 )
                                        class="hidden-xs" title="{{ $cfg->msgLitDi}}"
                                    @else
                                        style="display:none;"
                                    @endif >
                                    {{ $cfg->LitDi }}
                                </th>
         
                                <th @if ( $cfg->mostrarDc > 0 )
                                        class="hidden-xs" title="{{ $cfg->msgLitDc }}"
                                    @else
                                        style="display:none;"
                                    @endif >
                                    {{ $cfg->LitDc }}
                                </th>

                                <th @if ( $cfg->mostrarPp > 0 )
                                        class="hidden-xs" title="{{ $cfg->msgLitPp }}"
                                    @else
                                        style="display:none;"
                                    @endif >
                                    {{ $cfg->LitPp }}
                                </th>
                            @endif

                          
                            @if (Auth::user()->tipo=='V' || Auth::user()->tipo=='C' || Auth::user()->tipo=='G')
                                @if ( $cfg->mostrarNetoCatalogo > 0 )
                                    <th>NETO</th>
                                @endif
                                <th @if (!empty($cliente->DctoPreferencial))
                                        title="NETO {{$cfg->msgLitVip}}"
                                        class="colorVip"
                                    @else
                                        style="display:none;"
                                    @endif >
                                    <center>
                                        <img src="{{asset('images/clientepref.png')}}" 
                                        alt="seped" 
                                        style="margin-top: 0px; width: 28px;">
                                    </center>
                                </th>
                            @endif

                            <th @if ( $cfg->mostrarBarra > 0 )
                                    class="hidden-xs" title="Código de referencia del producto"
                                @else
                                    style="display:none;"
                                @endif >
                                BARRA
                            </th>
                    
                            <th @if ( $cfg->mostrarMarca > 0 )
                                    class="hidden-xs" title="Nombre de la marca del producto"
                                @else
                                    style="display:none;"
                                @endif >
                                MARCA
                            </th>

                            <th @if ( $cfg->mostrarComponente > 0 )
                                    class="hidden-xs" title="Componente o principio activo del producto"
                                @else
                                    style="display:none;"
                                @endif >
                                P.ACTIVO
                            </th>

                            <th style="display:none;">CANTIDAD</th>

                            @if ($tipo=="E")
                                <th class="hidden-xs" title="Fecha de entrada del producto" style="width: 90px;">
                                    ENTRADA
                                </th>
                            @endif

                            @if ($tipo=="G")
                                <th class="hidden-xs" title="Categoria del producto">
                                CATEGORIA
                                </th>
                            @endif
                        </thead>
                        @foreach ($catalogo as $cat)
                            @php
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
                            @endphp
                            <tr>

                                <!-- O NUMERO -->
                                <td >
                                    <div class="col-xs-12 input-group">
                                        <div align="center">
                                        {{$loop->iteration}}
                                        </div>
                                    </div>
                                    @if ($cfg->ActivarMincp > 0 && !empty($cfg->KeyMincp))
                                        @if ($cat->SuperOFertaMincp > 0 && !empty($cat->barra) )
                                            <div align="center" style="width: 35px;">
                                                <a href="" 
                                                   data-target="#modal-superoferta-{{$cat->codprod}}" 
                                                   data-toggle="modal">
                                                    <blink>
                                                    <img src="{{asset('/images/superoferta.png')}}" width="100%" 
                                                    class="img-responsive">
                                                    </blink>
                                                </a>
                                                @include('seped.catalogo.superoferta')
                                            </div>
                                        @else
                                            @if ( $cfg->mostrarDv > 0 || $cfg->mostrarDa > 0) 
                                                @if ( ($dv > 0 && !is_null($cat->dvDetalle)) 
                                                    || ($da > 0) )
                                                    <div align="center" style="width: 35px;">
                                                    <blink>
                                                    <img src="{{asset('/images/superoferta.png')}}" 
                                                        width="100%" 
                                                        class="img-responsive">
                                                    </blink>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                </td>

                                <!-- 1 IMAGEN -->
                                @if ( $cfg->mostrarImagen > 0)
                                    <td class="hidden-xs">
                                        <div align="center" 
                                            style="width: 110px;">
                                            <a href="{{URL::action('AdreportController@producto',$cat->codprod)}}">
                                                <img src="{{asset('/public/storage/'.NombreImagen($cat->codprod))}}" 
                                                width="100%"  
                                                style="border: 2px solid #D2D6DE;"
                                                class="img-responsive">
                                            </a>
                                        </div>
                                    </td>
                                @else
                                    <td class="hidden-xs">
                                        <!-- VER DETALLES -->
                                        <a href="{{URL::action('AdreportController@producto',$cat->codprod)}}">
                                            <button class="btn btn-default fa fa-file-o" title="Consultar producto">
                                            </button>
                                        </a>
                                    </td>
                                @endif

                                <!-- 2 PEDIR -->
                                @if (Auth::user()->tipo!='A' && Auth::user()->tipo!='S')
                                <td style="width: 110px;">
                                    <!-- AGREGAR A CARRO DE COMPRA -->
                                    <div class="col-xs-12 input-group" >
                                        
                                        <input id="idpedir_{{$cat->codprod}}" 
                                            style="text-align: center; 
                                            color: #000000; 
                                            width: 60px;" 
                                            value="" 
                                            class="form-control" >

                                        <span class="input-group-btn" 
                                            onclick='tdclick(event);'>
                                            <button id="idBtn1_{{$cat->codprod}}"
                                                type="button" 
                                                class="btn btn-default btn-pedido
                                            
                                            @if (VerificarCarrito($cat->codprod))
                                                colorResaltado
                                            @endif

                                            " data-toggle="tooltip" 
                                                title="Agregar al carrito" >
                                                <span class="fa fa-cart-plus" 
                                                    aria-hidden="true" 
                                                    id="idBtn2_{{$cat->codprod}}">
                                                </span>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                @endif

                                <!-- 3 DESCRIPCION -->
                                <td title = "{{$tooltip}}">
                                    @if ($tooltip != '')
                                        <span 
                                            style="color: red; font-size: 20px;"> <b>!</b> 
                                        </span>
                                    @endif
                                    @if ( $cfg->mostrarPactaDesc > 0 && $cfg->mostrarMarcaDesc)
                                        <!-- 3 DESCRIPCION, P.ACTIVO Y MARCA -->
                                        <b>{{$cat->desprod}}</b> 
                                        @if ( !empty($cat->pactivo) 
                                            && $cat->pactivo != 'N/A')
                                            <span title="PRINCIPIO ACTIVO DEL PRODUCTO">
                                                <br><small>
                                                <i class="fa fa-bars" aria-hidden="true"></i>
                                                &nbsp;{{$cat->pactivo}}
                                                </small> 
                                            </span>
                                        @endif
                                        @if ( !empty($cat->marcamodelo) 
                                            && $cat->marcamodelo != 'N/A')
                                            <span title="MARCA DEL PRODUCTO">
                                                <br><small>
                                                    <i class="fa fa-shield" aria-hidden="true"></i>
                                                    &nbsp;{{$cat->marcamodelo}}
                                                </small> 
                                            </span>
                                        @endif
                                    @else
                                        @if ( $cfg->mostrarPactaDesc > 0 
                                            && $cfg->mostrarMarcaDesc == 0)
                                            <!-- 3 DESCRIPCION Y P.ACTIVO  -->
                                            <b>{{$cat->desprod}}</b> 
                                            @if ( !empty($cat->pactivo) 
                                                && $cat->pactivo != 'N/A')
                                                <span title="PRINCIPIO ACTIVO DEL PRODUCTO"> 
                                                    <br><small>
                                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                                    &nbsp;{{$cat->pactivo}}
                                                    </small> 
                                                </span>
                                            @endif
                                        @else
                                            @if ( $cfg->mostrarMarcaDesc > 0 && $cfg->mostrarPactaDesc == 0)
                                                <!-- 3 DESCRIPCION Y MARCA  -->
                                                <b>{{$cat->desprod}}</b> 
                                                @if ( !empty($cat->marcamodelo) 
                                                    && $cat->marcamodelo != 'N/A')
                                                    <span title="MARCA DEL PRODUCTO">
                                                        <br><small>
                                                        <i class="fa fa-shield" aria-hidden="true"></i>
                                                        &nbsp;{{$cat->marcamodelo}}
                                                        </small> 
                                                    </span>
                                                @endif
                                            @else
                                                <!-- 3 DESCRIPCION (SOLO)  -->
                                                <B>{{$cat->desprod}}</B>
                                            @endif
                                        @endif
                                    @endif
                                    @if ($dias > 0)
                                        <div class="colorPromDias"
                                            style="margin-top: 5px;
                                            border-radius: 5px; 
                                            font-size: 14px;
                                            text-align: center;
                                            padding: 1px; 
                                            color: white;
                                            width: 70px;
                                            background-color: black;"
                                            title="DIAS DE CREDITO: {{$dias}}">
                                            DIAS: {{$dias}} 
                                        </div>
                                    @endif
                                </td>

                                <!-- 4 LOTE -->
                                @if (Auth::user()->tipo == "V")
                                    @if ( $cfg->mostrarLote > 0 )
                                        <td class="hidden-xs">
                                            {{$cadlote}} 
                                        </td>
                                    @else
                                        <td style="display:none;">
                                            {{$cadlote}} 
                                        </td>
                                    @endif
                                @endif
                                @if (Auth::user()->tipo == "C" || Auth::user()->tipo == "G")
                                    @if ( $cfg->mostrarLoteCliente > 0 )
                                        <td  class="hidden-xs">
                                             {{$cadlote}} 
                                        </td>
                                    @else
                                        <td style="display:none;">
                                            {{$cadlote}} 
                                        </td>
                                    @endif
                                @endif

                                <!-- 5 CODIGO -->
                                @if ( $cfg->mostrarCodigo > 0 )
                                    <td id="idcodprod_{{$loop->iteration}}" class="hidden-xs">
                                        {{$cat->codprod}}
                                    </td>
                                @else
                                    <td id="idcodprod_{{$loop->iteration}}" style="display:none;">
                                        {{$cat->codprod}}
                                    </td>
                                @endif

                                <!-- 6 BULTO -->
                                @if ( $cfg->mostrarBulto > 0 )
                                    <td  class="hidden-xs" align="right">
                                        {{$cat->original}}
                                    </td>
                                @else
                                    <td style="display:none;" >
                                        1
                                    </td>
                                @endif
                              
                                <!-- 7 EXISTENCIA -->
                                <td id="idCant_{{$cat->codprod}}" align="right">        
                                    {{number_format($cat->cantidad, 0, '.', ',')}}
                                </td>

                                <!-- 8 PRECIO -->
                                @if (Auth::user()->tipo=='A' || Auth::user()->tipo=='S')
                                    @for ($i = 1; $i <= $cfg->cantPrecioUtilizar; $i++)
                                        @php 
                                        $var1 = 'precio'.$i;
                                        $precio = $cat->$var1 
                                        @endphp
                                        <td align='right'>
                                            <b>{{number_format($precio, 2, '.', ',')}}</b>
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <br>
                                                <span style="color: green;" >
                                                    <b>{{number_format($precio / (
                                                   ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                </span>
                                            @endif
                                        </td>
                                    @endfor
                                @else
                                    <td align='right' >
                                        @if ($tipoprecio == 1)
                                            <span title= "{{$cfg->simboloMoneda}}">
                                            <b>{{number_format($cat->precio1, 2, '.', ',')}}</b>
                                            </span>
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <br>
                                                <span style="color: green;" 
                                                    title= "{{$cfg->simboloOM}}">
                                                    <b>{{number_format($cat->precio1/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                </span>
                                            @endif
                                        @elseif ($tipoprecio == 2)
                                            <span title= "{{$cfg->simboloMoneda}}">
                                            <b>{{number_format($cat->precio2, 2, '.', ',')}}</b>
                                            </span>
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <br>
                                                <span style="color: green;" 
                                                    title= "{{$cfg->simboloOM}}">
                                                    <b>{{number_format($cat->precio2/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                </span>
                                            @endif
                                        @elseif ($tipoprecio == 3)
                                            <span title= "{{$cfg->simboloMoneda}}">
                                            <b>{{number_format($cat->precio3, 2, '.', ',')}}</b>
                                            </span>
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <br>
                                                <span style="color: green;" 
                                                    title= "{{$cfg->simboloOM}}">
                                                    <b>{{number_format($cat->precio3/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                </span>
                                            @endif
                                        @elseif ($tipoprecio == 4)
                                            <span title= "{{$cfg->simboloMoneda}}">
                                            <b>{{number_format($cat->precio4, 2, '.', ',')}}</b>
                                            </span>
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <br>
                                                <span style="color: green;" 
                                                    title= "{{$cfg->simboloOM}}">
                                                    <b>{{number_format($cat->precio4/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                </span>
                                            @endif
                                        @elseif ($tipoprecio == 5)
                                            <span title= "{{$cfg->simboloMoneda}}">
                                            <b>{{number_format($cat->precio5, 2, '.', ',')}}</b>
                                            </span>
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <br>
                                                <span style="color: green;" 
                                                    title= "{{$cfg->simboloOM}}">
                                                    <b>{{number_format($cat->precio5/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                </span>
                                            @endif
                                        @elseif ($tipoprecio == 6)
                                            <span title= "{{$cfg->simboloMoneda}}">
                                            <b>{{number_format($cat->precio6, 2, '.', ',')}}</b>
                                            </span>
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <br>
                                                <span style="color: green;" 
                                                    title= "{{$cfg->simboloOM}}">
                                                    <b>{{number_format($cat->precio6/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                @endif

                                <!-- 9 IVA -->
                                <td class="hidden-xs" align="right">
                                    {{number_format($cat->iva, 2, '.', ',')}}
                                </td>

                                <!-- 10 DV -->
                                @if ( $cfg->mostrarDv > 0 )
                                    @if ($dv > 0 && !is_null($cat->dvDetalle))
                                        <td class="hidden-xs" 
                                            align='right' 
                                            style="color: red; width: 90px;">
                                            {{number_format($dv, 2, '.', ',')}}
                                            <br>
                                            <div class="tooltip-container">

                                              <blink>
                                              <img src="{{asset('/images/preemp.png')}}"  
                                                    class="tooltip-trigger"
                                                    style="margin-top: 5px; width: 60px;"
                                                    id="focusArea" 
                                                    onmousemove="getPos(event)" >
                                              </blink>
                                              <div class="tooltip-one">
                                                <img src="{{asset('/images/preemp.png')}}"  
                                                    class="img-responsive"
                                                    align="left"
                                                    style="margin-top: 5px; width: 60px;">
                                                <span style="color: black;">
                                                    {{strtoupper($cfg->msgLitDv)}}
                                                </span><br>
                                                <span style="color: black;">
                                                    ============================
                                                </span><br>
                                                @for ($x = 0; $x < count($tooltipDv); $x++) 
                                                    <span style="color: black;">
                                                        {{ $tooltipDv[$x] }}
                                                    </span><br>
                                                @endfor
                                              </div>
                                            </div>
                                        </td>
                                    @else
                                        <td class="hidden-xs" 
                                            align='right'
                                            style="width: 90px;">
                                            {{number_format($dv, 2, '.', ',')}}
                                        </td>
                                    @endif
                                @else
                                    <td style="display:none;">
                                        {{number_format($dv, 2, '.', ',')}}
                                    </td>
                                @endif
                            
                                <!-- 11 DA -->
                                @if ( $cfg->mostrarDa > 0 )
                                    @if ($da > 0)
                                        <td title = "{{strtoupper($cfg->msgLitDa)}}" 
                                            class="hidden-xs" 
                                            align='right' 
                                            style="color: red;">
                                            {{number_format($da, 2, '.', ',')}}
                                        </td>
                                    @else
                                        <td class="hidden-xs" align='right'>
                                            {{number_format($da, 2, '.', ',')}}
                                        </td>
                                    @endif
                                @else
                                    <td style="display:none;">
                                        {{number_format($da, 2, '.', ',')}}
                                    </td>
                                @endif

                                <!-- 12 DP -->
                                @if ( $cfg->mostrarDp > 0 )
                                    @if ($dp > 0)
                                        <td
                                            title = "{{strtoupper($cfg->msgLitDp)}} &#10======================== &#10Multiplos de pre-emapque: {{$cat->upre}}"
                                            class="hidden-xs" 
                                            align='right' 
                                            style="color: red;">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($dp, 2, '.', ',')}}
                                            <div title="UNIDAD DE PRE-EMPAQUE">
                                            {{$up}}
                                            </div>
                                        </td>
                                    @else
                                        <td class="hidden-xs" align='right'>
                                            {{number_format($dp, 2, '.', ',')}}
                                        </td>
                                    @endif
                                @else
                                    <td style="display:none;">
                                        {{number_format($dp, 2, '.', ',')}}
                                    </td>
                                @endif

                                @if (Auth::user()->tipo=='V' || Auth::user()->tipo=='C' || Auth::user()->tipo=='G')
                                    <!-- 13 Di -->
                                    @if ( $cfg->mostrarDi > 0 )
                                        @if ($di > 0)
                                            <td title = "{{strtoupper($cfg->msgLitDi)}}" 
                                                class="hidden-xs" 
                                                align='right' 
                                                style="color: red;">
                                                {{number_format($di, 2, '.', ',')}}
                                            </td>
                                        @else
                                            <td class="hidden-xs" align='right'>
                                                {{number_format($di, 2, '.', ',')}}
                                            </td>
                                        @endif
                                    @else
                                        <td  style="display:none;">
                                           {{number_format($di, 2, '.', ',')}} 
                                        </td>
                                    @endif
                              
                                    <!-- 14 DC -->
                                    @if ( $cfg->mostrarDc > 0 )
                                        @if ($dc > 0)
                                            <td title = "{{strtoupper($cfg->msgLitDc)}}" 
                                                class="hidden-xs" 
                                                align='right' 
                                                style="color: red;">
                                                {{number_format($dc, 2, '.', ',')}}
                                            </td>
                                        @else
                                            <td class="hidden-xs" align='right'>
                                                {{number_format($dc, 2, '.', ',')}} 
                                            </td>
                                        @endif
                                    @else
                                        <td style="display:none;">
                                            {{number_format($dc, 2, '.', ',')}}
                                        </td>
                                    @endif
                                 
                                    <!-- 15 PP -->
                                    @if ( $cfg->mostrarPp > 0 )
                                        @if ($pp > 0)
                                            <td title = "{{strtoupper($cfg->msgLitPp)}}" 
                                                class="hidden-xs" 
                                                align='right' 
                                                style="color: red;">
                                                {{number_format($pp, 2, '.', ',')}}
                                            </td>
                                        @else
                                            <td class="hidden-xs" align='right'>
                                                {{number_format($pp, 2, '.', ',')}} 
                                            </td>
                                        @endif
                                    @else
                                        <td style="display:none;">
                                            {{number_format($pp, 2, '.', ',')}}
                                        </td>
                                    @endif
                                @endif

                                <!-- 16 PRECIO NETO -->
                                @if (Auth::user()->tipo=='V' || Auth::user()->tipo=='C' || Auth::user()->tipo=='G')
                                    @if ( $cfg->mostrarNetoCatalogo > 0 )
                                        @php 
                                            $dvpx = 0.00;
                                            //$dvx = 0.00;
                                            $neto1 = CalculaPrecioNeto($cat->precio1, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto2 = CalculaPrecioNeto($cat->precio2, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto3 = CalculaPrecioNeto($cat->precio3, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto4 = CalculaPrecioNeto($cat->precio4, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto5 = CalculaPrecioNeto($cat->precio5, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                            $neto6 = CalculaPrecioNeto($cat->precio6, $da, $di, $dc, $pp, $dp, $dv, $dvpx);
                                        @endphp
                                        <td align='right'>
                                            @if ($tipoprecio == 1)
                                                <span title= "{{$cfg->simboloMoneda}}">
                                                <b>{{number_format($neto1, 2, '.', ',')}}</b>
                                                </span>
                                                @if ( $cfg->mostrarPrecioOM > 0 )
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "{{$cfg->simboloOM}}">
                                                        <b>{{number_format($neto1/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                    </span>
                                                @endif
                                            @elseif ($tipoprecio == 2)
                                                <span title= "{{$cfg->simboloMoneda}}">
                                                <b>{{number_format($neto2, 2, '.', ',')}}</b>
                                                </span>
                                                @if ( $cfg->mostrarPrecioOM > 0 )
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "{{$cfg->simboloOM}}">
                                                        <b>{{number_format($neto2/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                    </span>
                                                @endif
                                            @elseif ($tipoprecio == 3)
                                                <span title= "{{$cfg->simboloMoneda}}">
                                                <b>{{number_format($neto3, 2, '.', ',')}}</b>
                                                </span>
                                                @if ( $cfg->mostrarPrecioOM > 0 )
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "{{$cfg->simboloOM}}">
                                                        <b>{{number_format($neto3/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                    </span>
                                                @endif
                                            @elseif ($tipoprecio == 4)
                                                <span title= "{{$cfg->simboloMoneda}}">
                                                <b>{{number_format($neto4, 2, '.', ',')}}</b>
                                                </span>
                                                @if ( $cfg->mostrarPrecioOM > 0 )
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "{{$cfg->simboloOM}}">
                                                        <b>{{number_format($neto4/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                    </span>
                                                @endif
                                            @elseif ($tipoprecio == 5)
                                                <span title= "{{$cfg->simboloMoneda}}">
                                                <b>{{number_format($neto5, 2, '.', ',')}}</b>
                                                </span>
                                                @if ( $cfg->mostrarPrecioOM > 0 )
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "{{$cfg->simboloOM}}">
                                                        <b>{{number_format($neto5/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                    </span>
                                                @endif
                                            @elseif ($tipoprecio == 6)
                                                <span title= "{{$cfg->simboloMoneda}}">
                                                <b>{{number_format($neto6, 2, '.', ',')}}</b>
                                                </span>
                                                @if ( $cfg->mostrarPrecioOM > 0 )
                                                    <br>
                                                    <span style="color: green;" 
                                                        title= "{{$cfg->simboloOM}}">
                                                        <b>{{number_format($neto6/(
                                                        ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                    </span>
                                                @endif
                                            @endif
                                        </td>
                                        <!-- PRECIO NETO VIP -->
                                        @if (!empty($cliente->DctoPreferencial))
                                            <td align='right'
                                                class="colorVip2">
                                                @php 
                                                    $neto1 = CalculaPrecioNeto($cat->precio1, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto2 = CalculaPrecioNeto($cat->precio2, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto3 = CalculaPrecioNeto($cat->precio3, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto4 = CalculaPrecioNeto($cat->precio4, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto5 = CalculaPrecioNeto($cat->precio5, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                    $neto6 = CalculaPrecioNeto($cat->precio6, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                                @endphp
                                                @if ($tipoprecio == 1)
                                                    <span title= "{{$cfg->simboloMoneda}}, DESCUENTO {{$cfg->msgLitVip}}: {{$dvp}}%">
                                                    <b>{{number_format($neto1, 2, '.', ',')}}<b>
                                                    </span>
                                                    @if ( $cfg->mostrarPrecioOM > 0 )
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "{{$cfg->simboloOM}}, DESCUENTO {{$cfg->msgLitVip}}: {{$dvp}}%">
                                                            <b>{{number_format($neto1/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                        </span>
                                                    @endif
                                                @elseif ($tipoprecio == 2)
                                                    <span title= "{{$cfg->simboloMoneda}}">
                                                    <b>{{number_format($neto2, 2, '.', ',')}}</b>
                                                    </span>
                                                    @if ( $cfg->mostrarPrecioOM > 0 )
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "{{$cfg->simboloOM}}">
                                                            <b>{{number_format($neto2/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                        </span>
                                                    @endif
                                                @elseif ($tipoprecio == 3)
                                                    <span title= "{{$cfg->simboloMoneda}}">
                                                    <b>{{number_format($neto3, 2, '.', ',')}}</b>
                                                    </span>
                                                    @if ( $cfg->mostrarPrecioOM > 0 )
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "{{$cfg->simboloOM}}">
                                                            <b>{{number_format($neto3/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                        </span>
                                                    @endif
                                                @elseif ($tipoprecio == 4)
                                                    <td align='right'>
                                                        <span title= "{{$cfg->simboloMoneda}}">
                                                        <b>{{number_format($neto4, 2, '.', ',')}}</b>
                                                        </span>
                                                        @if ( $cfg->mostrarPrecioOM > 0 )
                                                            <br>
                                                            <span style="color: green;" 
                                                                title= "{{$cfg->simboloOM}}">
                                                                <b>{{number_format($neto4/(
                                                                ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                            </span>
                                                        @endif
                                                    </td>
                                                @elseif ($tipoprecio == 5)
                                                    <span title= "{{$cfg->simboloMoneda}}">
                                                    <b>{{number_format($neto5, 2, '.', ',')}}</b>
                                                    </span>
                                                    @if ( $cfg->mostrarPrecioOM > 0 )
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "{{$cfg->simboloOM}}">
                                                            <b>{{number_format($neto5/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                        </span>
                                                    @endif
                                                @elseif ($tipoprecio == 6)
                                                    <span title= "{{$cfg->simboloMoneda}}">
                                                    <b>{{number_format($neto6, 2, '.', ',')}}</b>
                                                    </span>
                                                    @if ( $cfg->mostrarPrecioOM > 0 )
                                                        <br>
                                                        <span style="color: green;" 
                                                            title= "{{$cfg->simboloOM}}">
                                                            <b>{{number_format($neto6/(
                                                            ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}</b>
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                        @else
                                            <td style="display:none;"></td>
                                        @endif
                                    @else
                                        <td style="display:none;"></td>
                                        <td style="display:none;"></td>
                                    @endif
                                @endif

                                <!-- 17 BARRA -->
                                @if ( $cfg->mostrarBarra > 0 )
                                    <td class="hidden-xs">
                                        {{$cat->barra}}
                                    </td> 
                                @else
                                    <td style="display:none;">
                                        {{$cat->barra}}
                                    </td>
                                @endif
                       
                                <!-- 18 MARCA -->
                                @if ( $cfg->mostrarMarca > 0 )
                                    <td class="hidden-xs"> 
                                        {{$cat->marcamodelo}}
                                    </td>
                                @else
                                    <td style="display:none;">
                                        {{$cat->marcamodelo}}
                                    </td>
                                @endif
                              
                                <!-- 19 PRINCIPIO ACTIVO -->
                                @if ( $cfg->mostrarComponente > 0 )
                                    <td class="hidden-xs"> 
                                        {{$cat->pactivo}}
                                    </td>
                                @else
                                    <td style="display:none;">
                                        {{$cat->pactivo}}
                                    </td>
                                @endif
                                
                                <!-- 20 CANTIDAD -->
                                <td style="display:none;">{{$cat->cantidad}}</td>

                                <!-- 21 FECHA ENTRADA -->
                                @if ($tipo=="E")
                                    <td>{{date('d-m-Y', strtotime($cat->fechafalla))}}</td>
                                @endif

                                <!-- 22 DEPARTAMENTO -->
                                @if ($tipo=="G")
                                    <td class="hidden-xs">
                                        {{ $cat->departamento }}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                    <div align='right'>
                        {{$catalogo->appends(["filtro" => $filtro])->links()}}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif

@if ($modovisual == "I")
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
                        @foreach ($catalogo as $c)

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td></td>
                            <td></td>
                            <td>{{$c->desprod}}</td>
                            <td>{{$c->lote}} {{$c->fecvence}}</td>
                            <td id="idcodprod_{{$loop->iteration}}">
                                {{$c->codprod}}
                            </td>
                            <td>{{$c->original}}</td>
                            <td>{{number_format($c->cantidad, 0, '.', ',')}}</td>
                            <td>{{number_format($c->precio1, 2, '.', ',')}}</td>
                            <td>{{number_format($c->iva, 2, '.', ',')}}</td>
                            <td>{{number_format($c->da, 2, '.', ',')}}</td>
                            <td>{{number_format($di, 2, '.', ',')}}</td>
                            <td>{{number_format($dc, 2, '.', ',')}}</td>
                            <td>{{number_format($pp, 2, '.', ',')}}</td>
                            <td>{{$c->barra}}</td>
                            <td>{{$c->marcamodelo}}</td>
                            <td>{{$c->pactivo}}</td>
                            <td>{{$c->cantidad}}</td>
                            <td>{{date('d-m-Y', strtotime($c->fechafalla))}}</td>
                        </tr>

                        <div class="col-md-4" >
                            @php
                            $desprod = substr($c->desprod, 0, 40);  
                            $marcamodelo = substr($c->marcamodelo, 0, 40);  
                            @endphp
                            <!-- product -->
                            <div class="product" 
                                style="@if (Auth::user()->tipo=='A' || Auth::user()->tipo=='S') 
                                height: (100 + ({{$cfg->cantPrecioUtilizar}} * 30)px; @endif" >
                                <div class="product-img">
                                    <center>
                                    <a href="{{URL::action('AdreportController@producto',$c->codprod)}}">
                                        <img src="{{asset('/public/storage/'.NombreImagen($c->codprod))}}" 
                                        style="width: 180px; height: 180px; padding-top: 15px;">
                                        <div class="product-label">
                                            @if ($c->clase == "NUEVO")
                                                <span class="new colorResaltado"
                                                    style="border-radius: 8px 8px 8px 8px;">
                                                    NUEVO
                                                </span>
                                            @endif
                                        </div>
                                    </a>
                                    </center>
                                </div>
                                <div class="product-body">
                                    <p class="product-category"
                                        title="MARCA DEL PRODUCTO">
                                        {{($marcamodelo=="") ? "N/A" : $marcamodelo}}
                                    </p>
                                    <h4 class="product-name" 
                                        style="height: 30px;">
                                        <a href="{{URL::action('AdreportController@producto',$c->codprod)}}">
                                            <b>{{$desprod}}</b>
                                        </a>
                                    </h4>
                                    <h4 class="product-price">
                                    @if (Auth::user()->tipo=='A' || Auth::user()->tipo=='S')

                                        @for ($i = 1; $i <= $cfg->cantPrecioUtilizar; $i++)
                                            <?php 
                                            $var1 = 'precio'.$i;
                                            $precio = $c->$var1 ?>
                                            <h4 class="product-price" >
                                            @if ($i==1)
                                                @if ($c->da != '0.00')
                                                    <del style="color: #B7B7B7; font-size: 12px;"> {{number_format($precio,2,'.', ',')}}
                                                    </del>&nbsp;&nbsp;
                                                    <b>                                                   {{number_format(CalculaPrecioNeto($precio, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00' ),2,'.', ',')}} 
                                                    <span style="font-size: 10px; color: #B7B7B7">(P{{$i}})</span>
                                                    </b>&nbsp;&nbsp;
                                                @else
                                                    <b>{{number_format($precio,2,'.', ',')}}
                                                    <span style="font-size: 10px; color: #B7B7B7">(P{{$i}})</span>
                                                    </b>&nbsp;&nbsp;
                                                @endif
                                                @if ($c->iva != '0.00') 
                                                    <span style="font-size: 10px;">+IVA</span>
                                                @endif
                                            @else
                                                <b>{{number_format($precio,2,'.', ',')}} 
                                                <span style="font-size: 10px; color: #B7B7B7">
                                                    (P{{$i}})
                                                </span>
                                                </b>
                                            @endif
                                            </h4>
                                        @endfor
                                    @else
                                        @if ($tipoprecio == 1)
                                            @if ($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00')
                                                <del style="color: #B7B7B7"> {{number_format($c->precio1,2,'.', ',')}}
                                                </del>
                                                &nbsp;&nbsp;
                                                <b>
                                                {{number_format(CalculaPrecioNeto($c->precio1, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')}}
                                                </b>&nbsp;&nbsp;
                                            @else
                                                <b>{{number_format($c->precio1,2,'.', ',')}}</b>
                                                &nbsp;&nbsp;
                                            @endif
                                            @if ($c->iva != '0.00') 
                                                +IVA
                                            @endif
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <p>{{$cfg->simboloOM}} 
                                                    {{number_format(CalculaPrecioNeto($c->precio1, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}
                                                </p>
                                            @endif
                                        @elseif ($tipoprecio == 2)
                                            @if ($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00')
                                                <del style="color: #B7B7B7"> {{number_format($c->precio2,2,'.', ',')}}</del>
                                                &nbsp;&nbsp;
                                                <b>
                                                {{number_format(CalculaPrecioNeto($c->precio2, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @else
                                                <b>{{number_format($c->precio2,2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @endif
                                            @if ($c->iva != '0.00') 
                                                +IVA
                                            @endif
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <p>{{$cfg->simboloOM}} {{number_format(CalculaPrecioNeto($c->precio2, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}
                                                </p>
                                            @endif
                                        @elseif ($tipoprecio == 3)
                                            @if ($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00')
                                                <del style="color: #B7B7B7"> {{number_format($c->precio3,2,'.', ',')}}</del>
                                                &nbsp;&nbsp;
                                                <b>
                                                {{number_format(CalculaPrecioNeto($c->precio3, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @else
                                                <b>{{number_format($c->precio3,2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @endif
                                            @if ($c->iva != '0.00') 
                                                +IVA
                                            @endif
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <p>{{$cfg->simboloOM}} {{number_format(CalculaPrecioNeto($c->precio3, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}
                                                </p>
                                            @endif
                                        @elseif ($tipoprecio == 4)
                                            @if ($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00')
                                                <del style="color: #B7B7B7"> {{number_format($c->precio4,2,'.', ',')}}</del>
                                                &nbsp;&nbsp;
                                                <b>
                                                {{number_format(CalculaPrecioNeto($c->precio4, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @else
                                                <b>{{number_format($c->precio4,2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @endif
                                            @if ($c->iva != '0.00') 
                                                +IVA
                                            @endif
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <p>{{$cfg->simboloOM}} 
                                                    {{number_format(CalculaPrecioNeto($c->precio4, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}
                                                </p>
                                            @endif
                                        @elseif ($tipoprecio == 5)
                                            @if ($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00')
                                                <del style="color: #B7B7B7"> {{number_format($c->precio5,2,'.', ',')}}</del>
                                                &nbsp;&nbsp;
                                                <b>
                                                {{number_format(CalculaPrecioNeto($c->precio5, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @else
                                                <b>{{number_format($c->precio5,2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @endif
                                            @if ($c->iva != '0.00') 
                                                +IVA
                                            @endif
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <p>{{$cfg->simboloOM}}&nbsp; 
                                                    {{number_format(CalculaPrecioNeto($c->precio5, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}
                                                </p>
                                            @endif
                                        @elseif ($tipoprecio == 6)
                                            @if ($cfg->aplicarDaPrecio == $tipoprecio && $c->da != '0.00')
                                                <del style="color: #B7B7B7"> {{number_format($c->precio6,2,'.', ',')}}</del>
                                                &nbsp;&nbsp;
                                                <b>
                                                {{number_format(CalculaPrecioNeto($c->precio6, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @else
                                                <b>{{number_format($c->precio6,2,'.', ',')}}</b>&nbsp;&nbsp;
                                            @endif
                                            @if ($c->iva != '0.00') 
                                                +IVA
                                            @endif
                                            @if ( $cfg->mostrarPrecioOM > 0 )
                                                <p>{{$cfg->simboloOM}} 
                                                    {{number_format(CalculaPrecioNeto($c->precio6, $c->da, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00')/(
                                                    ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria : 1), 2, '.', ',')}}
                                                </p>
                                            @endif
                                        @endif
                                    @endif
                                    </h4>
                                    <p class="product-category">
                                        Existencia:&nbsp 
                                        <span id="idCant_{{$c->codprod}}" style="font-size: 20px;">{{number_format($c->cantidad,0,'.', ',')}}
                                        </span>
                                    </p>
                                    @if (Auth::user()->tipo!='A' && Auth::user()->tipo!='S')
                                    <h3 class="product-name">
                                        <center>
                                        <div class="col-xs-4 input-group">
                                            <p style="width: 100px;">
                                                <input id="idpedir_{{$c->codprod}}" style="text-align: center; color: #000000; width: 60px;" value="" class="form-control">
                                                <span class="input-group-btn" onclick='tdclick(event);'>
                                                    <button id="idBtn1_{{$c->codprod}}" type="button" class="btn btn-default btn-pedido
                                                    
                                                    @if (VerificarCarrito($c->codprod))
                                                        colorResaltado
                                                    @endif

                                                    " data-toggle="tooltip" title="Agregar al carrito" >
                                                        <span class="fa fa-cart-plus" aria-hidden="true" id="idBtn2_{{$c->codprod}}">
                                                        </span>
                                                    </button>
                                                </span>
                                            </p>
                                        </div>
                                        </center>
                                    </h3>                   
                                    @endif           
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
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- /tab -->
        </div>
    </div>
</div>
@endif
  
@if ($catalogo->count() == 0)
    <div class="row">
        @if ($tipo=='C')
            <center><h3>Catálogo de productos vacio</h3></center>
        @endif
        @if ($tipo=='E')
            <center><h3>Sin Entradas recientes</h3></center>
        @endif
        @if ($tipo=='O')
            <center><h3>Sin Ofertas de productos</h3></center>
        @endif      
        @if ($tipo=='G')
            <center><h3>Categoria sin productos</h3></center>
        @endif
        @if ($tipo=='M')
            <center><h3>Marca sin productos</h3></center>
        @endif
        @if ($tipo=='I')
            <center><h3>Sin promoción de dias de credito</h3></center>
        @endif            
    </div>
    <br>
@endif
@if ($catalogo->count()>20)
    <!-- BOTONES BARRA DE BOTONESS -->
    <br>
    @include('seped.catalogo.catabarra')
    <br>
@endif

@push ('scripts')
<script>
$('#subtitulo').text('{{$subtitulo}}');
var forma = document.getElementById("idforma").value;

$(document).keypress(function(e) {
   if(e.which == 13) {
        vAceptar();
   }
});

function vAceptar() {
    var tableReg = document.getElementById('idtabla');
    var contItem = '{{$contItem}}';
    var tasacambiaria = '{{$cfg->tasacambiaria}}';
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
    var tasacambiaria = '{{$cfg->tasacambiaria}}';
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
@endpush
@endsection 

