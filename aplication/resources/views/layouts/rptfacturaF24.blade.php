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
            margin: 1px;
            padding: 1px;
            width:    27.9cm;
            height:   21.6cm;
        }

        /** 
        * Defina el ancho, alto, márgenes y posición de la marca de agua.
        **/
        #watermark {
            position: fixed;
            top:   0px;
            left:  0px;
            /** El ancho y la altura pueden cambiar
                según las dimensiones de su membrete
            **/
            width:    27.9cm;
            height:   21.6cm;

            /** Tu marca de agua debe estar detrás de cada contenido **/
            z-index:  -1000;
        }
        </style>
    </head>
    <body>

        <div id="watermark">

            @if ($cfg->imagenPdfRutaAbsoluta == 1)
                <img src="{{ public_path().'/public/storage/factura.png' }}" width="100%" height="100%" >
            @else
                <img src="{{'http://'.$cfg->nomsubdominio.'/public/storage/factura.png'}}" width="100%" height="100%" > 
            @endif

        </div>

        <main> 

            <div class="row">
                <input readonly type="text" value="{{$tabla->nroctrol}}" style="font-size: 23px; margin-left: 750px; margin-top: 47px; border: none; width: 100px;">      
            </div>



            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{$tabla->descrip}}" style="font-size: 12px; margin-left: 100px;  margin-top: 6px; width: 580px; margin-bottom: 0px; padding: 0px; border: none;" >      

                <b>
                <input readonly type="text" value="{{$tabla->factnum}}" style="font-size: 12px; margin-left: 90px; margin-bottom: 0px; padding: 0px; border: none;">
                </b>
            </div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{$tabla->codcli}}" style="font-size: 9px; margin-left: 100px; border: none; margin-top: 2px; padding-top: 0px;">  
            </div> 

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{$tabla->rif}}" style="font-size: 9px; margin-left: 100px; border: none; margin-top: 0px; padding-top: 0px;">  
            </div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{$cliente->direccion}}" style="font-size: 9px; margin-left: 120px; width: 900px; margin-top: 1px; padding-top: 0px; border: none;">  
            </div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{date('d-m-Y', strtotime($tabla->fecha))}}" style="font-size: 9px; margin-left: 100px; margin-top: 3px; padding-top: 0px; border: none; width: 50px;">  
                <input readonly type="text" value="{{date('d-m-Y', strtotime($tabla->fechav))}}" style="font-size: 9px; margin-left: 140px; margin-top: 0px; margin-bottom: 0px; padding: 0px; border: none; width: 50px;">  
            </div>

            
            <div class="row" style="margin-top: 15px;"></div>  
            <?php  $i=0; ?>
            @foreach ($tabla2 as $t) 
            <div class="row" style="margin: 0px; padding: 0px;">

                <?php $i++; ?>

                <input readonly type="text" value="{{number_format($t->cantidad, 0, '.', ',')}}" style="font-size: 6px; margin-left: 48px; margin-top: 0px; padding-top: 0px; width: 30px; border: none;">  

                <input readonly type="text" value="{{$t->desprod}}" style="font-size: 6px; margin-left: 15px; margin-top: 0px; margin-bottom: 0px; padding: 0px; width: 440px; border: none;">  

                <input readonly type="text" value="{{number_format($t->impuesto, 2, '.', ',')}}" style="font-size: 6px; margin-left: 20px; margin-top: 0px; margin-bottom: 0px; padding: 0px; width: 30px; text-align: right; border: none;">  

                <input readonly type="text" value="{{number_format($t->precio, 2, '.', ',')}}" style="font-size: 6px; margin-left: 20px; margin-top: 0px; margin-bottom: 0px; padding: 0px; width: 110px; text-align: right; border: none;"> 

                 <input readonly type="text" value="{{number_format($t->descto, 2, '.', ',')}}" style="font-size: 6px; margin-left: 25px; margin-top: 0px; margin-bottom: 0px; padding: 0px; width: 30px; text-align: right; border: none;">  

                <input readonly type="text" value="{{number_format($t->precio - ($t->precio * ($t->descto/100)), 2, '.', ',')}}" style="font-size: 6px; margin-left: 10px; margin-top: 0px; margin-bottom: 0px; padding: 0px; width: 110px; text-align: right; border: none;">  

                <input readonly type="text" value="{{number_format($t->subtotal, 2, '.', ',')}}" style="font-size: 6px; margin-left: 10px; margin-top: 0px; margin-bottom: 0px; padding: 0px; width: 110px; text-align: right; border: none;">  
            </div>
            @endforeach 

            @for ($x=$i; $x < $cfg->numRengPedido; $x++) 
            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{number_format($x, 0, '.', ',')}}" style="font-size: 6px; margin-left: 48px; margin-top: 0px; padding-top: 0px; width: 30px; border: none; color: #ffffff;">  
            </div>
            @endfor 
  
        
            <div class="row" style="margin-top: 0px;"></div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{number_format(($tabla->monto/$cfg->tasacambiaria), 2, '.', ',')}}" style="font-size: 8px; margin-left: 550px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">  
                <input readonly type="text" value="{{number_format($tabla->monto, 2, '.', ',')}}" style="font-size: 8px; margin-left: 180px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">  
            </div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{number_format(($tabla->monto - $tabla->gravable)/$cfg->tasacambiaria, 2, '.', ',')}}" style="font-size: 8px; margin-left: 550px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">  
                <input readonly type="text" value="{{number_format(($tabla->monto - $tabla->gravable), 2, '.', ',')}}" style="font-size: 8px; margin-left: 180px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">  
            </div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{number_format(($tabla->gravable/$cfg->tasacambiaria), 2, '.', ',')}}" style="font-size: 8px; margin-left: 550px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">  
                <input readonly type="text" value="{{number_format($tabla->gravable, 2, '.', ',')}}" style="font-size: 8px; margin-left: 180px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">  
            </div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{number_format($cfg->tasacambiaria, 2, '.', ',')}}" style="font-size: 8px; margin-left: 190px; width: 80px; text-align: right; border: none; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;"> 

                <input readonly type="text" value="{{number_format(($tabla->descuento/$cfg->tasacambiaria), 2, '.', ',')}}" style="font-size: 8px; margin-left: 274px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">  
                <input readonly type="text" value="{{number_format($tabla->descuento, 2, '.', ',')}}" style="font-size: 8px; margin-left: 180px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px;">  
            </div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{number_format($cfg->valorIva, 2, '.', ',')}}" style="font-size: 8px; margin-left: 482px; width: 30px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px; margin-bottom: 0px; border: none;"> 

                <input readonly type="text" value="{{number_format(($tabla->iva/$cfg->tasacambiaria), 2, '.', ',')}}" style="font-size: 8px; margin-left: 32px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px; margin-bottom: 0px;">  

                <input readonly type="text" value="{{number_format($cfg->valorIva, 2, '.', ',')}}" style="font-size: 8px; margin-left: 106px; width: 30px; text-align: right; border: none; margin-bottom: 0px;">  

                <input readonly type="text" value="{{number_format($tabla->iva, 2, '.', ',')}}" style="font-size: 8px; margin-left: 38px; width: 140px; text-align: right; padding-top: 0px; padding-bottom: 0px; margin-top: 0px; margin-bottom: 0px;" >  
            </div>

            <div class="row" style="margin: 0px; padding: 0px;">
                <input readonly type="text" value="{{$numreng}}" style="font-size: 8px; margin-left: 120px; margin-top: 2px; margin-bottom: 0px; padding: 0px; width: 30px; border: none;">  
                <input readonly type="text" value="{{$numund}}" style="font-size: 8px; margin-left: 110px; margin-top: 0px; margin-bottom: 0px; padding: 0px; width: 40px; border: none;">  
                <input readonly type="text" value="{{number_format(($tabla->total/$cfg->tasacambiaria), 2, '.', ',')}}" style="font-size: 8px; margin-left: 246px; margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px; width: 140px; text-align: right;">  
                <input readonly type="text" value="{{number_format($tabla->total, 2, '.', ',')}}" style="font-size: 8px; margin-left: 180px; margin-top: 0px; margin-bottom: 0px; padding-top: 0px; padding-bottom: 0px; width: 140px; text-align: right;">  
            </div>


        </main>
    </body>
</html>


