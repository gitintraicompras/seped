<?php

/**************************************************************
* Programa   : EnviarResumen.php
* Detalles   : Envia Rsumen de Operaciones al Gerente de 
*            : Operaciones
* Proyecto   : SEPED
***************************************************************
* Realizado  : Ing. Mauricio Blanco
* Empresa    : ISB SISTEMAS, C.A.
* Fecha      : 18-08-2020
* Modificado : 18-08-2020
***************************************************************/

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;


class EnviarResumen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  
    protected $signature = 'EnviarResumen:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar mail con el Resumen de Operaciones al Gerente de Operaciones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fechaHoy = date('j-m-Y');
        $Fechax = strtotime('-1 day', strtotime($fechaHoy));
        $fechay = date('Y-m-d', $Fechax);
        $FechaVenta = substr($fechay, 0, 10);

        $desde = $FechaVenta.' 00:00:00';
        $hasta = $FechaVenta.' 23:59:00';
       
        $cfg = DB::table('cfg')->first();
        $correo = $cfg->correoResumen;
        $correoRemitente = $cfg->correoRemitente;
        if (empty($correoRemitente)) {
            log::info("RESUMEN ********* SIN CORREO REMITENTE");
            return;
        }
        if (empty($correo))
            return;

        // TOTAL DE VENTAS
        $reg = DB::table('fact')
            ->selectRaw('sum(total) as contador')
            ->whereBetween('fecha', array($desde, $hasta))
            ->first();
        $totVentas = $reg->contador;
        $reg = DB::table('fact')
            ->selectRaw('count(*) as contador')
            ->whereBetween('fecha', array($desde, $hasta))
            ->first();
        $contFact = $reg->contador;

        // CONTADOR PEDIDO ENVIADO
        $reg = DB::table('pedido')
            ->selectRaw('sum(total) as contador')
            ->where('estado','=','ENVIADO')
            ->first();
        $totPedEnviado = $reg->contador;
        $reg = DB::table('pedido')
            ->selectRaw('count(*) as contador')
            ->where('estado','=','ENVIADO')
            ->first();
        $contPedEnviado = $reg->contador;

        // CONTADOR PEDIDO APROBADOS
        $reg = DB::table('pedido')
            ->selectRaw('sum(total) as contador')
            ->whereBetween('fecprocesado', array($desde, $hasta))
            ->where('estado','=','RECIBIDO')
            ->first();
        $totPedAprobado = $reg->contador;
        $reg = DB::table('pedido')
            ->selectRaw('count(*) as contador')
            ->whereBetween('fecprocesado', array($desde, $hasta))
            ->where('estado','=','RECIBIDO')
            ->first();
        $contPedAprobado = $reg->contador;

        // CONTADOR PEDIDO ANULADOS
        $reg = DB::table('pedido')
            ->selectRaw('sum(total) as contador')
            ->whereBetween('fecprocesado', array($desde, $hasta))
            ->where('estado','=','ANULADO')
            ->first();
        $totPedAnulado = $reg->contador;
        $reg = DB::table('pedido')
            ->selectRaw('count(*) as contador')
            ->whereBetween('fecprocesado', array($desde, $hasta))
            ->where('estado','=','ANULADO')
            ->first();
        $contPedAnulado = $reg->contador;

        // CONTADOR RECLAMO
        $reg = DB::table('reclamo')
            ->selectRaw('sum(total) as contador')
            ->whereBetween('fecenviado', array($desde, $hasta))
            ->first();
        $totReclamo = $reg->contador;
        $reg = DB::table('reclamo')
            ->selectRaw('count(*) as contador')
            ->whereBetween('fecenviado', array($desde, $hasta))
            ->first();
        $contReclamo = $reg->contador;

        // CONTADOR DE PAGO
        $reg = DB::table('pago')
            ->selectRaw('sum(total) as contador')
            ->whereBetween('fecenviado', array($desde, $hasta))
            ->first();
        $totPago = $reg->contador;
        $reg = DB::table('pago')
            ->selectRaw('count(*) as contador')
            ->whereBetween('fecenviado', array($desde, $hasta))
            ->first();
        $contPago = $reg->contador;

        // MONTO CUENTA POR COBRAR
        $reg = DB::table('cxc')
            ->selectRaw('sum(saldo) as contador')
            ->where('saldo','>','0')
            ->first();
        $totCxc = $reg->contador;

        // MONTO CUENTA POR PAGAR
        $reg = DB::table('cxp')
            ->selectRaw('sum(saldo) as contador')
            ->where('saldo','>','0')
            ->first();
        $totCxp = $reg->contador;

        // CONTADOR DE PROVEEDORES 
        $reg = DB::table('proveedor')
            ->selectRaw('count(*) as contador')
            ->where('estado','=','ACTIVO')
            ->first();
        $contProveedor = $reg->contador;

        // CONTADOR DE CLIENTES 
        $reg = DB::table('cliente')
            ->selectRaw('count(*) as contador')
            ->where('estado','=','ACTIVO')
            ->first();
        $contCliente = $reg->contador;

        // CONTADOR DE PRODUCTO
        $reg = DB::table('producto')
            ->selectRaw('count(*) as contador')
            ->first();
        $contProducto = $reg->contador;
    
        // FORMULARIO DEL CORREO
        $subject = "RESUMEN DE OPERACIONES (".$FechaVenta.") - ".$cfg->nombre;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= "X-MSMail-Priority: High\r\n";
        $headers .= "From: <".$correoRemitente.">\r\n";
        $headers .= "Reply-To: <".$correoRemitente.">\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "X-originating-IP: \r\n";
        // ENCABEZADO
        $message = "
        <html>
        <head>
        <title>HTML</title>
        </head>
        <body>
        <center><h1>RESUMEN DE OPERACIONES</h1></center>";

        $contFact = number_format($contFact, 0, '.', ',');
        $totVentas = number_format($totVentas, 2, '.', ',');

        $contPedEnviado = number_format($contPedEnviado, 0, '.', ',');
        $totPedEnviado = number_format($totPedEnviado, 2, '.', ',');

        $contPedAprobado = number_format($contPedAprobado, 0, '.', ',');
        $totPedAprobado = number_format($totPedAprobado, 2, '.', ',');

        $contPedAnulado = number_format($contPedAnulado, 0, '.', ',');
        $totPedAnulado = number_format($totPedAnulado, 2, '.', ',');

        $contReclamo = number_format($contReclamo, 0, '.', ',');
        $totReclamo = number_format($totReclamo, 2, '.', ',');

        $contPago = number_format($contPago, 0, '.', ',');
        $totPago = number_format($totPago, 2, '.', ',');

        $message = "
        <center><h3>RESUMEN DE OPERACIONES</h3></center>
        <center><h4>FECHA: $FechaVenta</h4></center>
        <div class='row'>
            <div class='table-responsive'>
                <table border: black 5px solid class='table table-striped table-bordered table-condensed table-hover ' style='width: 100%'>
                    <thead style='background-color: #c3c3c3; color: #000000'>
                        <th align='left' style='width: 20%;'>TABLA</th>
                        <th align='right' style='width: 40%;'>NUMERO</th>
                        <th align='right' style='width: 40%;'>TOTAL</th>
                    </thead>
                    <tr style='background-color: #f7f7f7; color: black;'>
                        <td>FACTURAS</td>
                        <td align='right'>$contFact</td>  
                        <td align='right'>$totVentas</td>   
                    </tr>
                    <tr style='background-color: #ffffff; color: black;'>
                        <td>PEDIDOS ENVIADOS</td>
                        <td align='right'>$contPedEnviado</td>  
                        <td align='right'>$totPedEnviado</td>  
                    </tr>
                    <tr style='background-color: #f7f7f7; color: black;'>
                        <td>PEDIDOS APROBADOS</td>
                        <td align='right'>$contPedAprobado</td>  
                        <td align='right'>$totPedAprobado</td>  
                    </tr>
                    <tr style='background-color: #ffffff; color: black;'>
                        <td>PEDIDOS ANULADOS</td>
                        <td align='right'>$contPedAnulado</td>  
                        <td align='right'>$totPedAnulado</td>  
                    </tr>
                    <tr style='background-color: #f7f7f7; color: black;'>
                        <td>RECLAMOS</td>
                        <td align='right'>$contReclamo</td>  
                        <td align='right'>$totReclamo</td>  
                    </tr>
                    <tr style='background-color: #ffffff; color: black;'>
                        <td>PAGOS</td>
                        <td align='right'>$contPago</td>  
                        <td align='right'>$totPago</td>  
                    </tr>
                </table>
            </div>
        </div>";
       
        $totCxc = number_format($totCxc, 2, '.', ',');
        $totCxp = number_format($totCxp, 2, '.', ',');

        $contCliente = number_format($contCliente, 0, '.', ',');
        $contProveedor = number_format($contProveedor, 0, '.', ',');
        $contProducto = number_format($contProducto, 0, '.', ',');

        $message .= "
        <CENTER><H3>TABLAS</H3></CENTER>
        <div class='row'>
            <div class='table-responsive'>
                <table border: black 5px solid class='table table-striped table-bordered table-condensed table-hover ' style='width: 100%'>
                    <thead style='background-color: #c3c3c3; color: #000000'>
                        <th align='left' style='width: 30%;'>TABLA</th>
                        <th align='right' style='width: 70%;'>CONTADOR</th>
                    </thead>
                    <tr style='background-color: #f7f7f7; color: black;'>
                        <td>CUENTAS X COBRAR</td>
                        <td align='right'>$totCxc</td> 
                    </tr>
                    <tr <tr style='background-color: #ffffff; color: black;'>
                        <td>CUENTAS X PAGAR</td>
                        <td align='right'>$totCxp</td>  
                    </tr>
                    <tr style='background-color: #f7f7f7; color: black;'>
                        <td>CLIENTES</td>
                        <td align='right'>$contCliente</td>  
                    </tr>
                    <tr <tr style='background-color: #ffffff; color: black;'>
                        <td>PROVEEDORES</td>
                        <td align='right'>$contProveedor</td>  
                    </tr>
                    <tr style='background-color: #f7f7f7; color: black;'>
                        <td>PRODUCTOS</td>
                        <td align='right'>$contProducto</td>  
                    </tr>
                </table><br>
            </div>
        </div>
        <br><br>";
        
        // PIE DEL FORMULARIO
        $message .= "<h4>
            <center>
                ".$cfg->nombre." | RIF: ".$cfg->rif." 
            </center>
        </h4>";

        $message .= "<h5>
            <center>
                ".$cfg->direccion."
            </center>
        </h5>";

        $message .= "<h5>
            <center>
                TELEFONO: ".$cfg->telefono." CONTACTO: ".$cfg->contacto."
            </center>
        </h5>
        </body>
        </html>";
        $separador = '';
        if (strlen(strstr($correo,','))>0) {
            $separador = ',';
        }
        if (strlen(strstr($correo,';'))>0) {
            $separador = ';';
        }
        if ($separador=='') {
            $separador = ';';
            $correo.= $separador;                   
        }
        $listacorreo = explode($separador, $correo);
        for($i=0;$i<count($listacorreo);$i++) {
            if (mail($listacorreo[$i], $subject, $message, $headers)) {
                log::info("RESUMEN mail enviado: ".$listacorreo[$i]);
                break;
            }
        }
        log::info("RESUMEN ************* ENVIO DE RESUMEN DE OPERACIONES ");
    }
}
