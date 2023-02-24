<html>
    <head>
        <style>
        /** 
        * Establecer los márgenes del PDF en 0
        * por lo que la imagen de fondo cubrirá toda la página.
        **/
        @page {
            margin: 0cm 0cm;
        }

        /**
        * Define los márgenes reales del contenido de tu PDF
        * Aquí arreglarás los márgenes del encabezado y pie de página
        * De tu imagen de fondo.
        **/
        body {
            font-family: Times New Roman;
            font-size: 8px;
            border: 0;
            margin: 4px;
            padding: 4px;
        }

        /** 
        * Defina el ancho, alto, márgenes y posición de la marca de agua.
        **/
        #watermark {
            position: fixed;
            bottom:   0px;
            left:     0px;
            /** El ancho y la altura pueden cambiar
                según las dimensiones de su membrete
            **/
            width:    21.6cm;
            height:   27.9cm;

            /** Tu marca de agua debe estar detrás de cada contenido **/
            z-index:  -1000;
        }
        </style>
    </head>

    <body>

        <div id="watermark">

            @if ($cfg->imagenPdfRutaAbsoluta == 1)
                <img src="{{ public_path().'/public/storage/logoRpt.png' }}" width="150" >
            @else
                <img src="{{'http://'.$cfg->nomsubdominio.'/public/storage/logoRpt.png'}}" width="150" > 
            @endif

        </div>

        <div class="row">
            <div width="100%">
                    <CENTER><h2 style="margin-top: 5px;">{{$titulo}}</h2></CENTER>
                    <CENTER><h3 style="margin-top: 5px;">{{$subtitulo}}</h3></CENTER>
            </div>
        </div>

        <main> 

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <div class="row" style="margin-top: 20px;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon">FECHA:</span>
                            <input readonly type="text" value="{{date('d-m-Y H:i:s', strtotime($tabla->fecprocesado))}}" style="color: #000000; background: #F7F7F7; width: 120px;">

                            <span class="input-group-addon" style="border:0px; "></span>                    
                            <span class="input-group-addon">IMPUESTO:</span>
                            <input readonly type="text" value="{{number_format($tabla->impuesto, 2, '.', ',')}}" style="color: #000000; background: #F7F7F7; text-align: right; width: 150px;">

                            <span class="input-group-addon" style="border:0px; "></span>
                            <span class="input-group-addon">TOTAL:</span>
                            <input readonly type="text" value="{{number_format($tabla->total, 2, '.', ',')}}" style="color:#000000; background: #F7F7F7; text-align: right; width: 150px;">      

                            <span class="input-group-addon" style="border:0px; "></span>
                            <span class="input-group-addon">ESTADO:</span>
                            <input readonly type="text" value="{{$tabla->estado}}" style="color: #000000; background: #F7F7F7; width: 160px;">           
                        </div>
                    </div>
                </div>
            </div>

            <table width="100%" border="1" cellpadding="4" cellspacing="0">    
           
                <tr style="background-color: #C3C3C3; color: #000000; height: 50px">
                    <th align='left' style='width: 2%;  '>#</th>
                    <th align='left' style='width: 40%; '>DESCRIPCION</th>
                    <th align='right' style='width: 8%; '>CANT</th>
                    <th align='right' style='width: 10%;'>PRECIO</th>
                    <th align='right' style='width: 5%; '>IVA</th>

                    <th align='right' style='width: 5%; '>DA</th>
                    @if ( sLeercfg($sucactiva, 'mostrarDi') > 0 )
                        <th align='right' style='width: 5%; '>DI</th>
                    @endif
                    @if ( sLeercfg($sucactiva,'mostrarDc') > 0 )
                        <th align='right' style='width: 5%; '>DC</th>
                    @endif
                    @if ( sLeercfg($sucactiva,'mostrarPp') > 0 )
                        <th align='right' style='width: 5%; '>PP</th>
                    @endif
                    <th align='right' style='width: 5%; '>NETO</th>
                    <th align='right' style='width: 10%;'>SUBTOTAL</th>
                </tr>

                @foreach ($tabla2 as $t)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$t->desprod}}</td>
                    <td align="right">{{number_format($t->cantidad, 0, '.', ',')}}</td>
                    <td align="right">{{number_format($t->precio, 2, '.', ',')}}</td>
                    <td align="right">{{number_format($t->iva, 2, '.', ',')}}</td>
                    <td align="right">{{number_format($t->da, 2, '.', ',')}}</td>
                    @if ( sLeercfg($sucactiva,'mostrarDi') > 0 )
                        <td align="right">{{number_format($t->di, 2, '.', ',')}}</td>
                    @endif
                    @if ( sLeercfg($sucactiva,'mostrarDc') > 0 )
                        <td align="right">{{number_format($t->dc, 2, '.', ',')}}</td>
                    @endif
                    @if ( sLeercfg($sucactiva,'mostrarPp') > 0 )
                        <td align="right">{{number_format($t->pp, 2, '.', ',')}}</td>
                    @endif
                    <td align="right">{{number_format($t->neto, 2, '.', ',')}}</td>
                    <td align="right">{{number_format($t->subtotal, 2, '.', ',')}}</td>
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
            <h5 style="margin-top: 5px;">
                <center>Desarrollado por: ISB SISTEMAS, C.A.</center>
            </h5>
        </main>

    </body>
</html>
