@php
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
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{number_format($tabla->total/$cfg->tasacambiaria, 2, '.', ',')}}"  /></td>
                        @endif

                        <td align="right" style="border: 0px;">ESTADO:</td>
                        <td align="left" style="border: medium transparent; width="100%;" ><input type="text" value="{{$tabla->estado}}"  /></td>

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
                        <td align="left" style="border: medium transparent;" ><input type="text" value="{{$tabla->factnum}}" /></td>

                        <td align="right" style="border: 0px;">FECHA FACTURA:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecfact))}}" /></td>

                        <td align="right" style="border: 0px;">VENCE:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{date('d-m-Y H:i:s', strtotime($tabla->vence))}}"  /></td>

                    
                        <td align="right" style="border: 0px;">TOTAL FACTURA:</td>
                        <td align="left" style="border: medium transparent; width: 100%;" ><input type="text" value="{{number_format($tabla->totalfactura, 2, '.', ',')}}"  /></td>

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
                    @if ( strlen(trim($tabla->observacion)) == 0 )
                        S/O
                    @else
                        {{$tabla->observacion}}
                    @endif "
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
 
        @foreach ($tabla2 as $t)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$t->desprod}}</td>
            <td>{{$t->codprod}}</td>
            <td align="right">{{number_format($t->cantidad, 0, '.', ',')}}</td>
            <td align="right">{{number_format($t->precio, 2, '.', ',')}}</td>
            <td align="right">{{number_format($t->cantrec, 0, '.', ',')}}</td>
            <td>{{$t->motivo}}</td>
        </tr>
        @endforeach
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


