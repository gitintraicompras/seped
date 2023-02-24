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
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{date('d-m-Y H:i:s', strtotime($pago->fecprocesado))}}" /></td>

                        <td align="right" style="border: 0px;">TOTAL:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{number_format($pago->total, 2, '.', ',')}}"  /></td>

                        @if ( $cfg->mostrarPedidoOM > 0 )
                        <td align="right" style="border: 0px;">TOTAL{{$cfg->simboloOM}}:</td>
                        <td align="left" style="border: medium transparent" ><input type="text" value="{{number_format($pago->total/$cfg->tasacambiaria, 2, '.', ',')}}"  /></td>
                        @endif

                        <td align="right" style="border: 0px;">ESTADO:</td>
                        <td align="left" style="border: medium transparent" width="100%;"><input type="text" value="{{$pago->estado}}"  /></td>

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
                    @if ( strlen(trim($pago->observacion)) == 0 )
                        S/O
                    @else
                        {{$pago->observacion}}
                    @endif "
                    style="width: 702px;">           

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <CENTER><h4 style="margin-top: 15px;">DOCUMENTOS</h4></CENTER>
    </div>
    <table width="100%" border="1" cellpadding="4" cellspacing="0">   
        <tr style="background-color: #C3C3C3; color: #000000; height: 50px">
            <th align='left'  style='width: 2%;  '>#</th>
            <th align='left'  style='width: 38%; '>DOCUMENTO</th>
            <th align='left'  style='width: 10%; '>TIPO</th>
            <th align='left'  style='width: 10%; '>FECHA</th>
            <th align='left'  style='width: 10%; '>VENCE</th>
            <th align='right' style='width: 15%; '>MONTO</th>
            <th align='right' style='width: 15%; '>SALDO</th>
        </tr>

        @foreach ($pagdoc as $t)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$t->coddoc}}</td>
            <td>{{$t->tipo}}</td>
            <td>{{date('d-m-Y', strtotime($t->fecha))}}</td>
            <td>{{date('d-m-Y', strtotime($t->vence))}}</td>
            <td align="right">{{number_format($t->monto, 2, '.', ',')}}</td>
            <td align="right">{{number_format($t->saldo, 2, '.', ',')}}</td>
        </tr>
        @endforeach
    </table>
  
    <div class="row">
        <CENTER><h4 style="margin-top: 15px;">PAGOS</h4></CENTER>
    </div>
    <table width="100%" border="1" cellpadding="4" cellspacing="0">   
        <tr style="background-color: #C3C3C3; color: #000000; height: 50px">
            <th align='left'  style='width: 15%; '>REFERENCIA</th>
            <th align='left'  style='width: 15%; '>CUENTA</th>
            <th align='left'  style='width: 15%; ' >FECHA</th>
            <th align='right' style='width: 15%;' >MONTO</th>
            <th align='left'  style='width: 10%; ' >MODO</th>
            <th align='left'  style='width: 15%; '>CHEQUE</th>
            <th align='left'  style='width: 15%; '>BANCO</th>
        </tr>

        @foreach ($pagren as $t)
        <tr>
            <td>{{$t->referencia}}</td>
            <td>{{$t->cuenta}}</td>
            <td>{{date('d-m-Y', strtotime($t->fecha))}}</td>
            <td align="right">{{number_format($t->monto, 2, '.', ',')}}</td>
            <td>{{$t->modo}}</td>
            <td>{{$t->cheque}}</td>
            <td>{{$t->banco}}</td>
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