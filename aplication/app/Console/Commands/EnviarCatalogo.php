<?php

/**************************************************************
* Programa   : EnviarCatalogo.php
* Detalles   : Envia catalogo de Productos a todos los clientes 
* Proyecto   : INTRANET (SEPED)
***************************************************************
* Realizado  : Ing. Mauricio Blanco
* Empresa    : ISB SISTEMAS, C.A.
* Fecha      : 18-08-2020
* Modificado : 22-02-2021
***************************************************************/

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;


class EnviarCatalogo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  
    protected $signature = 'EnviarCatalogo:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar mail con el Catalogo de Productos a todos los clientes que tengan la activada la casilla de boletin de catalogo';

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
 
    public function handle() {
        $fechaHoy = date('j-m-Y');
        $FechaVenta = substr($fechaHoy, 0, 10);
        $cfg = DB::table('cfg')->first();
        $nomdominio = $cfg->nomdominio;
        $correoRemitente = $cfg->correoRemitente;
        if (empty($correoRemitente)) 
            return;
        if ($cfg->activarCorreoCatalogo == 0) {
            log::info("ECA ************* ENVIO DESACTIVADO DE CATALOGO AUTOMATICO: ".$FechaVenta);    
        } else {
            log::info("ECA ************* INICIO DE ENVIO DE CATALOGO AUTOMATICO: ".$FechaVenta);
            $cliente = DB::table('cliente')->get();
            $contador = 0;
            foreach($cliente as $cli) {
                // CLIENTE ACTIVO
                $codcli = $cli->codcli;
                $nombre = $cli->nombre;

                $users = DB::table('users')
                ->where('codcli','=',$codcli)
                ->where('tipo','=','C')
                ->first();

                if ($users) {
                    $correo = $users->email;
                    // TABLA DE PRODUCTOS
                    $tabla = DB::table('producto')
                            ->orderBy('desprod','asc')
                            ->get();

                    // FORMULARIO DEL CORREO
                    $subject = "CATALOGO (".$FechaVenta.") - ".$cfg->nombre;
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
                    <center><h1>$nombre</h1></center>";

                    $message .= "<h5><center>
                    <strong>Ingresar para realizar su pedido: 
                        <a href='http://".$cfg->nomsubdominio."/'>http://"
                        .$cfg->nomsubdominio."
                        </a>
                    </strong></center></h5>";


                    // CATALOGO
                    $message .= "
                    <center><h3>CATALOGO DE PRODUCTOS</h3></center>
                    <center><h3>$cfg->nombre</h3></center>
                    <center><h4>$FechaVenta</h4></center>
                    <div class='row'>
                    <center>
                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class='table-responsive'>
                    <table border: black 5px solid class='table table-striped table-bordered table-condensed table-hover'>
                    <thead style='background-color: #c3c3c3; color: #000000'>
                            <th align='left' style='width: 5%;'>#</th>
                            <th align='left' style='width: 40;'>DESCRIPCION</th>
                            <th align='left' style='width: 15%;'>CODIGO</th>
                            <th align='right' style='width: 10%;'>CANTIDAD</th>";

                    if ($cli->usaprecio == 1) {
                        $message .= "<th align='right' style='width: 10%;'>PRECIO1</th>";
                    }
                    elseif ($cli->usaprecio == 2) {
                        $message .= "<th align='right' style='width: 10%;'>PRECIO2</th>";
                    }
                    elseif ($cli->usaprecio == 3) {
                        $message .= "<th align='right' style='width: 10%;'>PRECIO3</th>";
                    }
                    elseif ($cli->usaprecio == 4) {
                        $message .= "<th align='right' style='width: 10%;'>PRECIO4</th>";
                    }
                    elseif ($cli->usaprecio == 5) {
                        $message .= "<th align='right' style='width: 10%;'>PRECIO5</th>";
                    }
         
                    $message .= "<th align='right' style='width: 10%;'>DCTO</th>
                            <th align='right' style='width: 10%;'>IVA</th>
                    </thead>";
                    $loop = 0;
                    $num = 0;
                    foreach ($tabla as $t) {
                        $cantidad = number_format($t->cantidad, 0, '.', ',');
                        if ($cli->usaprecio == 1) {
                            $precio = number_format($t->precio1, 2, '.', ',');
                        }
                        elseif ($cli->usaprecio == 2) {
                            $precio = number_format($t->precio2, 2, '.', ',');
                        }
                        elseif ($cli->usaprecio == 3) {
                            $precio = number_format($t->precio3, 2, '.', ',');
                        }
                        elseif ($cli->usaprecio == 4) {
                            $precio = number_format($t->precio3, 2, '.', ',');
                        }
                        elseif ($cli->usaprecio == 5) {
                            $precio = number_format($t->precio5, 2, '.', ',');
                        }
                        $iva = number_format($t->iva, 2, '.', ',');
                        $da = number_format($t->da, 2, '.', ',');
                        $num = $num + 1;
                        if ($loop%2==0) {
                            $message .= "<tr style='background-color: #f7f7f7; color: black;' >";
                        } else {
                            $message .= "<tr style='background-color: #ffffff; color: black;' >";
                        }
                        $message .= "
                            <td>$num</td>
                            <td>$t->desprod</td>
                            <td>$t->codprod</td>
                            <td align='right'>$cantidad</td>
                            <td align='right'>$precio</td>
                            <td align='right'>$da</td>
                            <td align='right'>$iva</td>
                        </tr>";
                        $loop++;
                    }
                    $message .= "
                    </table>
                    </div>
                    </div>
                    </center>
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
                        log::info("ECA correo: ".$correo.' separador: '.$separador.' codcli: '.$codcli);
                        $listacorreo = explode($separador, $correo);
                        for($i=0;$i<count($listacorreo);$i++) {
                            $intento = 5;
                            while ( $intento > 0) {
                                if (mail($listacorreo[$i], $subject, $message, $headers)) {
                                    log::info("ECA mail enviado: ".$listacorreo[$i]);
                                    $contador++;
                                    break;
                                }
                                $intento--;
                            }
                            
                        }

                    } catch (Exception $e) {
                        log::info("ECA ************* Error mail no enviado: ".$correo);
                    }
                }
            } 
            log::info("ECA ************* FINAL DE ENVIO DE CATALOGO AUTOMATICO: ".$contador);
        }
    }
}
