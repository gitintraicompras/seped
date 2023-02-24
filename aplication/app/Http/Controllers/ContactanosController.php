<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;

class ContactanosController extends Controller
{
    public function __construct()
    {
    	//$this->middleware('auth');
    }

    public function index(Request $request) {
    }

    public function store(Request $request) {
        $fecha = date('Y-m-d H:i:s');
        $cfg = DB::table('cfg')->first();
        $nombre = $request->get('nombre');
        $correo = $request->get('correo');
        $telefono = $request->get('telefono');
        $ciudad = $request->get('ciudad');
        $mensaje = $request->get('mensaje');
        $id = DB::table('contactanos')->insertGetId([
            'nombre' => $nombre,
            'fecha' => $fecha,
            'correo' => $correo,
            'telefono' => $telefono,
            'ciudad' => $ciudad,
            'mensaje' => $mensaje
        ]);
        // FORMULARIO DEL CONTACTOEO
        $subject = "CONTACTANOS (".$fecha.") - ".$cfg->nombre;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= "X-MSMail-Priority: High\r\n";
        $headers .= "From: <contacto@droguesur.com>\r\n";
        $headers .= "Reply-To: <contacto@droguesur.com>\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
        $headers .= "X-originating-IP: \r\n";
         
        // ENCABEZADO
        $message = "
        <html>
        <head>
        <title>HTML</title>
        </head>
        <body>
        <center><h1> $nombre </h1></center>
        <center><h4>$fecha</h4></center>";
        $message .= "<center><h3> CONTACTANOS </h3></center>";
        $message .= "<p> ID      : $id </p> <br>";
        $message .= "<p> CORREO  : $correo </p> <br>";
        $message .= "<p> TELEFONO: $telefono </p> <br>";
        $message .= "<p> CIUDAD  : $ciudad </p> <br>";
        $message .= "<p> MENSAJE : $mensaje </p> <br>";
        $message .= "
        <div>
            <center>
            <p>© <script>document.write(new Date().getFullYear());</script> Droguesur</p>
            </center>
        /div>";
        $message .= "</body></html>";
        try {
            if (mail($cfg->correo, $subject, $message, $headers)) {
                log::info("ECC->mail enviado: ".$correo);
            }
            else
                log::info("ECC->mail no enviado: ".$correo);
        } catch (Exception $e) {
            log::info("ECC->Error mail no enviado: ".$correo);
            log::info($e);
        }
        return Redirect::to('/contacto');
    }

    
}


