@php  
$factor = $tabla->factorcambiario;
if ($tabla->estado == 'NUEVO') 
    $factor = $cfg->tasacambiaria;
$ruta = "";
if ($cfg->imagenPdfRutaAbsoluta == 0) 
    $ruta = 'http://'.$cfg->nomsubdominio.'/public/storage/logoRpt.jpg'; 
if ($cfg->imagenPdfRutaAbsoluta == 1) 
    $ruta = 'https://'.$cfg->nomsubdominio.'/public/storage/logoRpt.jpg'; 
if ($cfg->imagenPdfRutaAbsoluta == 2) 
    $ruta = public_path().'/public/storage/logoRpt.jpg'; 
@endphp
<head>
    <style>
    @page {
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
            
            @if ($cfg->imagenPdfRutaAbsoluta == 3) 
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/public/storage/logoRpt.jpg'))) }}">
            @else
                <img src="{{$ruta}}">
            @endif
            
        </div> 
        <div width="70%">
            <CENTER><h2 style="margin-top: 5px;">{{$titulo}}</h2></CENTER>
            <CENTER><h3 style="margin-top: 5px;">{{$subtitulo}}</h3></CENTER>
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
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))}}" /></td>

                        <td align="right" style="border: 0px;">IMPUESTO:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" /></td>

                        <td align="right" style="border: 0px;">TOTAL:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{number_format($tabla->total, 2, '.', ',')}}"  /></td>

                        @if ( $cfg->mostrarPedidoOM > 0 )
                        <td align="right" style="border: 0px;">TOTAL{{$cfg->simboloOM}}:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{number_format($tabla->total/$factor, 2, '.', ',')}}"  /></td>
                        @endif

                        <td align="right" style="border: 0px;">ESTADO:</td>
                        <td align="left" style="border: medium transparent; width: 100%;" ><input type="text" value="{{$tabla->estado}}"  /></td>

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
            <th align='right' style='width: 10%;'>{{$cfg->LitPrecio}}</th>
            <th align='right' style='width: 5%; '>IVA</th>

            <th align='right' style='width: 5%; '>{{$cfg->LitDa}}</th>
            @if ( $cfg->mostrarDi > 0 )
                <th align='right' style='width: 5%; '>{{$cfg->LitDi}}</th>
            @endif
            @if ( $cfg->mostrarDc > 0 )
                <th align='right' style='width: 5%; '>{{$cfg->LitDc}}</th>
            @endif
            @if ( $cfg->mostrarPp > 0 )
                <th align='right' style='width: 5%; '>{{$cfg->LitPp}}</th>
            @endif
            <th align='right' style='width: 5%; '>NETO</th>
            @if ( $cfg->mostrarPedidoOM > 0 )
                <th align='right' style='width: 10%;'>SUBTOTAL({{$cfg->simboloOM}})</th>
                <th align='right' style='width: 10%;'>SUBTOTAL</th>
            @else
                <th align='right' style='width: 10%;'>SUBTOTAL</th>
            @endif 
        </tr>

        @foreach ($tabla2 as $t)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$t->desprod}}</td>
            <td align="right">{{number_format($t->cantidad, 0, '.', ',')}}</td>
            <td align="right">{{number_format($t->precio, 2, '.', ',')}}</td>
            <td align="right">{{number_format($t->iva, 2, '.', ',')}}</td>
            <td align="right">{{number_format($t->da, 2, '.', ',')}}</td>
            @if ( sLeercfg($sucactiva, 'mostrarDi') > 0 )
                <td align="right">{{number_format($t->di, 2, '.', ',')}}</td>
            @endif 
            @if ( sLeercfg($sucactiva,'mostrarDc') > 0 )
                <td align="right">{{number_format($t->dc, 2, '.', ',')}}</td>
            @endif
            @if ( sLeercfg($sucactiva,'mostrarPp') > 0 )
                <td align="right">{{number_format($t->pp, 2, '.', ',')}}</td>
            @endif
            <td align="right">{{number_format($t->neto, 2, '.', ',')}}</td>
            
            @if ( $cfg->mostrarPedidoOM > 0 )
                <td align="right">{{number_format($t->subtotal/$factor, 2, '.', ',')}}</td>
            @endif
            <td align="right">{{number_format($t->subtotal, 2, '.', ',')}}</td>

        </tr>
        @endforeach
        @if ( $cfg->mostrarPedidoOM > 0 )
        <h4>
             *** {{$cfg->LiteralTasaCambiaria}} {{number_format($factor, 2, '.', ',')}} ***
        </h4>          
        @endif
    </table>

    <h4 style="margin-top: 10px;">
        <center>{{$cfg->nombre}} | RIF: {{$cfg->rif}}</center>
    </h4>

    <h5>
        <center>{{$cfg->direccion}}</center>
    </h5>

    <h5>
        <center>TELEFONO: {{$cfg->telefono}} | CONTACTO: {{$cfg->contacto}}</center>
    </h5>
</body>

