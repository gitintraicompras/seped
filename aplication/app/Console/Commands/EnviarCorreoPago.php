<?php

/**************************************************************
* Programa   : EnviarCorreoPago.php
* Detalles   : Revisa tabla de pago y los envia 
*            : por correos  
* Proyecto   : SEPED
***************************************************************
* Realizado  : Ing. Mauricio Blanco
* Empresa    : ISB SISTEMAS, C.A.
* Fecha      : 22-06-2020
* Modificado : 22-06-2020
***************************************************************/

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;


class EnviarCorreoPago extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  
    protected $signature = 'EnviarCorreoPago:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa tabla de pago los envia por correos ';

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
        $FechaVenta = substr($fechaHoy, 0, 10);
       
        $cfg = DB::table('cfg')->first();
        $correo = $cfg->correoPago;
        $correoRemitente = $cfg->correoRemitente;
        if (empty($correoRemitente)) 
            return;

        $pago = DB::table('pago')
        ->where('estado','=','ENVIADO')
        ->get();

        $contador = 0;
        foreach($pago as $p) {
            if ($contador == 0)
            {
                 log::info("ECP ********* INICIO ENVIO DE CORREO DE PAGOS AUTOMATICO: ".$FechaVenta);
            }
            $contador++;
            // TABLA DE CLIENTE
            $cliente = DB::table('cliente')
                    ->where('codcli','=', $p->codcli)
                    ->first();

            $correoCliente = $cliente->email;

            // TABLA DE PAGO DETALLE
            $pagren = DB::table('pagren')
                    ->where('id','=', $p->id)
                    ->get();

            // TABLA DE PAGO DOCUMENTO
            $pagdoc = DB::table('pagdoc')
                    ->where('id','=', $p->id)
                    ->get();

            $total = SubtotalPago($p->id);
            $total = number_format($total, 2, '.', ',');
            
            // FORMULARIO DEL CORREO
            $subject = "PAGO (".$FechaVenta.") - ".$cliente->nombre;
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
            <center><h2>PAGO: $p->id</h2></center>
            <center><h1>$cliente->nombre</h1></center>";

            $message .= "
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                <div class='input-group mb-3'>
                    <div class='row'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm'>
                            <span class='input-group-addon'>Código:</span>
                            <input readonly type='text' class='form-control' value='$p->codcli' style='color: #000000'>
                            <span class='input-group-addon' style='border:0px; '></span>
                            <span class='input-group-addon'>Cliente:</span>
                            <input readonly type='text' class='form-control' value='$cliente->nombre' style='color: #000000'>
                        </div>
                    </div>

                    <div class='row' style='margin-top: 4px;'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm'>
                            
                            <span class='input-group-addon'>Estado:</span>
                            <input readonly type='text' class='form-control' value='$p->estado' style='color: #000000'>

                            <span class='input-group-addon' style='border:0px; '></span>
                            <span class='input-group-addon'>Fecha:</span>
                            <input readonly type='text' class='form-control' value='$p->fecha' style='color: #000000'>

                            <span class='input-group-addon' style='border:0px; '></span>
                            <span class='input-group-addon'>Enviado:</span>
                            <input readonly type='text' class='form-control' value='$p->fecenviado' style='color:#000000'>                  
                        </div>

                    <div class='row' style='margin-top: 4px;'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm'>
                            
                            <span class='input-group-addon'>Procesado:</span>
                            <input readonly type='text' class='form-control' value='$p->fecprocesado' style='color: #000000'>

                            <span class='input-group-addon' style='border:0px; '></span>
                            <span class='input-group-addon'>Origen:</span>
                            <input readonly type='text' class='form-control' value='$p->origen' style='color: #000000'>

                            <span class='input-group-addon' style='border:0px; '></span>
                            <span class='input-group-addon'>Usuario:</span>
                            <input readonly type='text' class='form-control' value='$p->usuario' style='color: #000000'>

                            <span class='input-group-addon' style='border:0px; '></span>
                            <span class='input-group-addon'>Total:</span>
                            <input readonly type='text' class='form-control' value='$total' style='color:#000000; text-align: right;' >                   

                        </div>
                    </div>

                    <div class='row' style='margin-top: 4px;'>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group input-group-sm'>
                            <span class='input-group-addon'>Observacion:</span>
                            <input readonly type='text' class='form-control' value='$p->observacion' style='color: #000000'>
                        </div>
                    </div>
                </div>
            </div>

            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class='table-responsive'>
                    <table class='table table-striped table-bordered table-condensed table-hover' style='width: 100%'>
                        <thead style='background-color: #c3c3c3; color: #000000'>
                            <th style='width: 10%'>ITEM</th>
                            <th style='width: 10%'>DOCUMENTO</th>
                            <th style='width: 10%'>TIPO</th>
                            <th style='width: 15%'>FECHA</th>
                            <th style='width: 15%'>VENCE</th>
                            <th style='width: 20%'>MONTO</th>
                            <th style='width: 20%'>SALDO</th>
                        </thead>
                        <center><h2>DOCUMENTOS RELACIONADOS</h2></center>";

                        $int = 0;
                        foreach ($pagdoc as $pd) {
                            $int++;
                            $monto = number_format($pd->monto, 2, '.', ',');
                            $saldo = number_format($pd->saldo, 2, '.', ',');
                            $message .= "
                            <tr>
                                <td>$int</td>
                                <td>$pd->coddoc</td>
                                <td>$pd->tipo</td>
                                <td>$pd->fecha</td>
                                <td>$pd->vence</td>
                                <td align='right'>$monto</td>
                                <td align='right'>$saldo</td>
                            </tr>";
                        }
                    $message .= "
                    </table>
                </div>
            </div>";

            $message .= "
            <div class='row'>
                <center><h2>PAGOS REALIZADOS</h2></center>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='table-responsive'>
                        <table class='table table-striped table-bordered table-condensed table-hover' style='width: 100%'>
                            <thead style='background-color: #c3c3c3; color: #000000'>
                                <th style='width: 10%'>ITEM</th>
                                <th style='width: 10%'>REFERENCIA</th>
                                <th style='width: 15%'>CUENTA</th>
                                <th style='width: 10%'>FECHA</th>
                                <th style='width: 15%'>MONTO</th>
                                <th style='width: 10%'>MODO</th>
                                <th style='width: 15%'>CHEQUE</th>
                                <th style='width: 15%'>BANCO</th>
                            </thead>";
                            $int = 0;
                            foreach ($pagren as $pr) {
                                $int++;
                                $monto = number_format($pr->monto, 2, '.', ',');
                                $message .= "
                                <tr>
                                    <td>$int</td>
                                    <td>$pr->referencia</td>
                                    <td>$pr->cuenta</td>
                                    <td>$pr->fecha</td>
                                    <td align='right'>$monto</td>
                                    <td>$pr->modo</td>
                                    <td>$pr->cheque</td>
                                    <td>$pr->banco</td>
                                </tr>";
                            }
                        $message .= "    
                        </table><br>
                    </div>
                </div>
            </div>";

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
            </h6>
            </body>
            </html>";

            try {
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
                if (strlen($correoCliente) > 0 )
                {
                    $correo.=$correoCliente.$separador;     
                }
                log::info("correo: ".$correo.' separador: '.$separador.' codcli: '.$p->codcli);
                $listacorreo = explode($separador, $correo);
                for($i=0;$i<count($listacorreo);$i++) {
                    $intento = 5;
                    while ( $intento > 0) {
                        if (mail($listacorreo[$i], $subject, $message, $headers)) {
                            log::info("mail enviado: ".$listacorreo[$i]);
                            $contador++;
                            break;
                        }
                        $intento--;
                    }
                    
                }
                // ACTUALIZA ESTADO 
                DB::table('pago')
                ->where('id', '=', $p->id)
                ->update(array('estado' => 'RECIBIDO'));
            } catch (Exception $e) {
                log::info("Error mail no enviado: ".$correo);
                log::info($e);
            }
        } 
        if ($contador > 0) {
            log::info("ECP ********* FINAL CORREO DE PAGOS AUTOMATICO *******************");
        }
    }
}
