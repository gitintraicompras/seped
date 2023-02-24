<?php

/**************************************************************
* Programa   : EnviarCorreoRecPag.php
* Detalles   : Revisa tabla de reclamos y los envia 
*            : por correos  
* Proyecto   : SEPED
***************************************************************
* Realizado  : Ing. Mauricio Blanco
* Empresa    : ISB SISTEMAS, C.A.
* Fecha      : 22-06-2020
* Modificado : 23-02-2021
***************************************************************/

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;


class EnviarCorreoReclamo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  
    protected $signature = 'EnviarCorreoReclamo:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa tabla de reclamos los envia por correos ';

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
        $correo = $cfg->correoReclamo;
        $correoRemitente = $cfg->correoRemitente;
        if (empty($correoRemitente) || empty($correo) ) 
            return;

        $reclamo = DB::table('reclamo')
        ->where('estado','=','ENVIADO')
        ->get();

        $contador = 0;
        foreach($reclamo as $r) {
            if ($contador == 0)
            {
                 log::info("ECR ********* INICIO ENVIO DE CORREO DE RECLAMOS WEB ".$FechaVenta);
            }
            $contador++;
            // TABLA DE CLIENTE
            $cliente = DB::table('cliente')
                    ->where('codcli','=', $r->codcli)
                    ->first();
            $correoCliente = $cliente->email;
           
            // TABLA DE RECLAMO ETALLE
            $recren = DB::table('recren')
                    ->where('id','=', $r->id)
                    ->get();

            $total = 0;
            foreach ($recren as $rc) {
                if ($rc->motivo != 'SOBRANTE') {
                    $total +=  ($rc->cantrec * $rc->precio) * (-1);
                }
            }
            $total = number_format($total, 2, '.', ',');
      
            // FORMULARIO DEL CORREO
            $subject = "RECLAMO (".$FechaVenta.") - ".$cliente->nombre;
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
            <center><h2>RECLAMO: $r->id</h2></center>
            <center><h1>$cliente->nombre</h1></center>";

            $message .= "
            <div id='page-wrapper'>
                <div class='form-group'>
                    <div style='margin-top: 4px;' class='input-group input-group-sm'>
                        <span class='input-group-addon'>Código:</span>
                        <input readonly type='text' class='form-control' value='$r->codcli' style='color: #000000'>";
                        
                        $message .= "
                        <span class='input-group-addon' style='border:0px; '></span>     
                        <span class='input-group-addon'>Estado:</span>
                        <input readonly type='text' class='form-control' value='$r->estado' style='color: #000000'>
                        </div>";

                        $message .= "
                        <span class='input-group-addon' style='border:0px; '></span>
                        <span class='input-group-addon'>Fecha:</span>
                        <input readonly type='text' class='form-control' value='$r->fecha' style='color: #000000'>";

                        $message .= "
                        <span class='input-group-addon' style='border:0px; '></span>
                        <span class='input-group-addon'>Procesado:</span>
                        <input readonly type='text' class='form-control' value='$r->fecprocesado' style='color: #000000'>
                    </div>";

                    $message .= "
                    <div style='margin-top: 4px;' class='input-group input-group-sm'>
                        <span class='input-group-addon'>Origen:</span>
                        <input readonly type='text' class='form-control' value='$r->origen' style='color: #000000'>";

                        $message .= "
                        <span class='input-group-addon' style='border:0px; '></span>
                        <span class='input-group-addon'>Usuario:</span>
                        <input readonly type='text' class='form-control' value='$r->usuario' style='color: #000000'>";

                        $message .= "
                        <span class='input-group-addon' style='border:0px; '></span>
                        <span class='input-group-addon'>Factura:</span>
                        <input readonly type='text' class='form-control' value='$r->factnum' style='color: #000000'>";

                        $message .= "
                        <span class='input-group-addon' style='border:0px; '></span>
                        <span class='input-group-addon'>Monto Total:</span>
                        <input readonly type='text' class='form-control' value='$total}'  style='color: #000000; text-align: right;'>
                    </div>";

                    $message .= "
                    <div style='margin-top: 4px;' class='input-group input-group-sm'>
                        <span class='input-group-addon'>Observación:</span>
                        <input readonly type='text' class='form-control' value='$r->observacion' style='color: #000000'>
                    </div>
                </div>";

                $message .= "
                <div class='table-responsive'>
                    <table class='table table-striped table-bordered table-condensed table-hover' style='width: 100%'>
                        <thead style='background-color: #c3c3c3; color: #000000'>
                            <th>#</th>
                            <th>DESCRIPCION</th>
                            <th>CODIGO</th>
                            <th>MOTIVO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>SUBTOTAL</th>
                        </thead>";
                        $int = 0;
                        foreach ($recren as $rr) {
                            $int++;
                            $cantrec = number_format($rr->cantrec, 0, '.', ',');
                            $precio = number_format($rr->precio, 2, '.', ',');
                            $subtotal = number_format($rr->cantrec * $rr->precio , 2, '.', ',');
                            $message .= "
                            <tr>
                                <td>$int</td>
                                <td>$rr->desprod</td>
                                <td>$rr->codprod</td>
                                <td>$rr->motivo</td>
                                <td align='right'>$cantrec</td>
                                <td align='right'>$precio</td>
                                <td align='right'>$subtotal</td>
                            </tr>";
                        }
                    $message .= "  
                    </table>
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
                log::info("correo: ".$correo.' separador: '.$separador.' codcli: '.$r->codcli);
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
                // ACTUALIZA ESTADO DEL RECLAMO
                DB::table('reclamo')
                ->where('id', '=', $r->id)
                ->update(array('estado' => 'RECIBIDO'));
            } catch (Exception $e) {
                log::info("Error mail no enviado: ".$correo);
                log::info($e);
            }
        } 
        if ($contador > 0) {
            log::info("ECR ********* FINAL CORREO DE RECLAMOS AUTOMATICO *******************");
        }
    }
}
