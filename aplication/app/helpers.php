<?php
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;

function sRetornaPromDias($codprod, $codisb) {
    if ($codisb == "")
        $codisb = Session::get('sucactiva', sRetornaCodSucursal());
    $dias = 0;
    $fechaHoy = trim(date("Y-m-d"));
    $reg = DB::table('promren as pr')
    ->leftJoin('promdias as p','pr.id','=','p.id')
    ->where('codprod', $codprod)
    ->where('estado', 'ACTIVO')
    ->where('p.codisb', $codisb)
    ->first();
    if ($reg) {

        $desde = trim(date('Y-m-d', strtotime($reg->desde)));
        $hasta = trim(date('Y-m-d', strtotime($reg->hasta)));

        if ($fechaHoy >= $desde && $fechaHoy <= $hasta) {
            $dias = $reg->dias;
        }

    }
    return $dias;
}
function sRetornaCodSucursal() {

    $sucursal = DB::table('cfg')->get();
    if (count($sucursal) == 1) {
        $sucursal = DB::table('cfg')->first();
        return $sucursal->codisb;
    }
    $tipo = 'C';
    if (!isset(Auth::user()->tipo)) {
        $sucursal = DB::table('cfg')->first();
        if ($sucursal)
            $sucactiva = $sucursal->codisb;
    } else {
        $sucursal = DB::table('cfg')->get();
        if (count($sucursal) == 1) {
            $sucursal = DB::table('cfg')->first();
            return $sucursal->codisb;
        }
        $sucursal = DB::table('cfg')->first();
        if ($sucursal) {
            $sucactiva = $sucursal->codisb;
        }
        if ($tipo == 'A') {
             return $sucactiva;
        }
        if ($tipo == 'V' || $tipo == 'S' || $tipo == 'R' || $tipo == 'P') {
            $codisbpredet = Auth::user()->codisbpredet;
            $sucursal = DB::table('cfg')
            ->where('codisb','=',$codisbpredet)
            ->first();
            if ($sucursal)
                $sucactiva = $sucursal->codisb;
        }
        if ($tipo == 'C') {
            $codcli = sCodigoClienteActivo();
            $sucursal = DB::table('cliente')
            ->where('codcli','=',$codcli)
            ->where('codisbactivo','=',1)
            ->get();
            if ($sucursal->count() == 0) {
                $sucursal = DB::table('cliente')
                ->where('codcli','=',$codcli)
                ->first();
                if ($sucursal)
                    $sucactiva = $sucursal->codisb;
            }
        }
    }
    return $sucactiva;
}
function sRetornaSucursal() {
    if (!isset(Auth::user()->tipo)) {
        $sucursal = DB::table('cfg')->first();
        if ($sucursal)
            return $sucursal;
    }
    $tipo = Auth::user()->tipo;
    if ($tipo == 'A') {
        $sucursal = DB::table('cfg')->get();
    }
    if ($tipo == 'V' || $tipo == 'S' || $tipo == 'T' ||
        $tipo == 'R' || $tipo == 'P' || $tipo == 'G') {
        $codisbpredet = Auth::user()->codisbpredet;
        $sucursal = DB::table('cfg')
        ->where('codisb','=',$codisbpredet)
        ->get();
    }
    if ($tipo == 'C') {
        $codcli = sCodigoClienteActivo();
        $sucursal = DB::table('cliente')
        ->where('codcli','=',$codcli)
        ->where('codisbactivo','=',1)
        ->get();
        if ($sucursal->count() == 0) {
            $sucursal = DB::table('cliente')
            ->where('codcli','=',$codcli)
            ->get();
        }
    }
    return $sucursal;
}
function sLeercfg($codisb, $campo) {
    $cfg = DB::table('cfg')
    ->where('codisb','=',$codisb)
    ->first();
    if ($cfg)
        return $cfg->$campo;
    return "";
}
function RetornaFactorCambiario($codprove, $moneda) {
    Config::set('database.default', 'mysql2');
    DB::reconnect('mysql2');
    $cfg = DB::table('maecfg')->first();
    $codprove = mb_strtoupper($codprove);
    $factor = 1.00;
    $factorPRE = 1.00;
    $factorBCV = 1.00;
    $factorTODAY = 1.00;
    $retorno = 1.00;
    $maeprove = DB::table('maeprove')
    ->where('codprove','=',$codprove)
    ->first();
    if ($maeprove) {
        if ($maeprove->factorModo == "PREDETERMINADO" || $maeprove->factorSeleccion == "MANUAL" ) {
            $factor = $maeprove->FactorCambiario;
            $factorPRE = $factor;
        }
        if ($factor <= 1.00) {
            if ($maeprove->factorSeleccion == "BCV") {
                $factor = $cfg->factorBcvUSD;
                $factorBCV = $factor;
            }
            if ($maeprove->factorSeleccion == "TODAY") {
                $factor = $cfg->factorToday;
                $factorTODAY = $factor;
            }
        }
        if ($factor <= 1.00) {
            if ($factorBCV != 0.00 && $factorBCV != 1.00 )
                $factor = $factorBCV;
        }
        if ($factor <= 1.00) {
            if ($factorTODAY != 0.00 && $factorTODAY != 1.00 )
                $factor = $factorTODAY;
        }
        $retorno = $factor;
    } else {
        $factor = $cfg->factorBcvUSD;
        if ($factor <= 0)
            $factor = 1.00;
        $retorno = $factor;
    }
    DB::purge('mysql2');
    Config::set('database.default', 'mysql');
    DB::reconnect('mysql');
    return $retorno;
}
function MesesActivoPreferencial() {
    $fechaHoy = date("Y-m-d H:i:s");
    $mes = date("m", strtotime($fechaHoy));
    $anio = date("Y", strtotime($fechaHoy));
    $idmes = $mes.'/'.$anio;
    $chart_data = "";
    $codcli = sCodigoClienteActivo();
    $cliente = DB::table('cliente')
    ->where('codcli','=',$codcli)
    ->first();
    if ($cliente) {
        $DctoPreferencial = trim($cliente->DctoPreferencial);
        if ($DctoPreferencial != "") {
            $reg = explode(";", $DctoPreferencial);
            if (!empty($reg[0])) {
                $contador = count($reg);
                for ($i = 0; $i < $contador; $i++) {
                    $campo = explode("-", $reg[$i]);
                    $mes = $campo[0];
                    $dcto = $campo[1];
                    $cuota = $campo[2];
                    $acum = $campo[3];
                    $chart_data .= "{ y: '".$mes."', a: ".$cuota.", b: ".$acum."},";
                    if ($idmes == $mes)
                        break;
                }
                $chart_data = substr($chart_data, 0, -1);
            }
        }
    }
    return $chart_data;
}
function MesActivoPreferencial($DctoPreferencial) {
    $fechaHoy = date("Y-m-d H:i:s");
    $mes = date("m", strtotime($fechaHoy));
    $anio = date("Y", strtotime($fechaHoy));
    $idmes = $mes.'/'.$anio;
    $dcto = 0;
    $cuota = 0;
    $acum = 0;
    $reg = explode(";", $DctoPreferencial);
    $contador = count($reg);
    for ($i = 0; $i < $contador; $i++) {
        $campo = explode("-", $reg[$i]);
        $mes = $campo[0];
        if ($idmes == $mes) {
            $dcto = $campo[1];
            $cuota = $campo[2];
            $acum = $campo[3];
            break;
        }
    }
    return ['dcto' => $dcto,
            'cuota' => $cuota,
            'acum' => $acum ];
}
function Minicpcheck($keys) {
    $retorno = 0;
    Config::set('database.default', 'mysql2');
    DB::reconnect('mysql2');
    $maelicencia = DB::table('maelicencias')
    ->where('cod_lic','=',$keys)
    ->first();
    if ($maelicencia) {
        $retorno = 1;
        $status = $maelicencia->status;
        $restandias = $maelicencia->diaLicencia - DiferenciaDias($maelicencia->fec_act);
        if ($restandias <= 0) {
            $status = "INACTIVO";
            $retorno = 0;
        } else {
            $retorno = 1;
        }
        DB::table('maelicencias')
        ->where('cod_lic','=',$keys)
        ->update(array("status" => $status, "ultPing" => date('Y-m-d H:i:s')));
    }
    DB::purge('mysql2');
    Config::set('database.default', 'mysql');
    DB::reconnect('mysql');
    return $retorno;
}
function MinicpV($Keys, $prods, $di, $pp) {
    Config::set('database.default', 'mysql2');
    DB::reconnect('mysql2');
    $retorno[] = null;
    $maelicencia = DB::table('maelicencias')
    ->where('cod_lic','=',$Keys)
    ->first();
    if ($maelicencia) {
        $cadprove = $maelicencia->cadprove;
        if (!empty($cadprove)) {
            $s2 = explode(",", $cadprove);
            for ($i = 0; $i < count($s2); $i++) {
                $arrayCampo[] = trim($s2[$i]);
            }
            for ($i = 0; $i < count($prods); $i++) {
                $barra = $prods[$i];
                $mejorprecio = BuscarMejorPrecio($barra, $arrayCampo, $di, $pp);
                if (!is_null($mejorprecio)) {
                    $retorno[] = $barra;
                    //log::info("CD -> BARRA AGREGADA AL ARREGLO: ".$barra);
                }
            }
        }
    }
    DB::purge('mysql2');
    Config::set('database.default', 'mysql');
    DB::reconnect('mysql');
    return $retorno;
}
function MinicpC($barra, $arrayProve) {
    // CONSULTA DATA DEL PRODUCTO
    Config::set('database.default', 'mysql2');
    DB::reconnect('mysql2');
    $retorno = null;
    $tpmaestra = DB::table('tpmaestra')
    ->select($arrayProve)
    ->where('barra','=',$barra)
    ->first();
    if (!empty($tpmaestra)) {
        $retorno = $tpmaestra;
    }
    DB::purge('mysql2');
    Config::set('database.default', 'mysql');
    DB::reconnect('mysql');
    return $retorno;
}
function MinicpLP($Keys) {
    // LISTA DE PROVEEDORES PARA EL MINCP (SUPEROFERTA)
    Config::set('database.default', 'mysql2');
    DB::reconnect('mysql2');
    $provs = null;
    $maelicencia = DB::table('maelicencias')
    ->where('cod_lic','=',$Keys)
    ->first();
    if ($maelicencia) {
        $retorno = $maelicencia->cadprove;
        $s2 = explode(",", $retorno);
        for ($i = 0; $i < count($s2); $i++) {
            $provs[] = trim($s2[$i]);
        }
    }
    DB::purge('mysql2');
    Config::set('database.default', 'mysql');
    DB::reconnect('mysql');
    return $provs;
}
function MinicpCP($codprove) {
    // CONSULTA DATA DEL PROVEEDOR
    Config::set('database.default', 'mysql2');
    DB::reconnect('mysql2');
    $retorno = null;
    $retornox = DB::table('maeprove')
    ->where('codprove','=',$codprove)
    ->first();
    if (!empty($retornox)) {
        $retorno = $retornox;
    }
    DB::purge('mysql2');
    Config::set('database.default', 'mysql');
    DB::reconnect('mysql');
    return $retorno;
}
function obtenerRanking($precio, $arrayRnk) {
    $ranking = "";
    $cont = count($arrayRnk);
    for ($x=0; $x < $cont; $x++) {
        if ($precio == $arrayRnk[$x]['liquida']) {
            $ranking = ($x+1).'-'.($cont);
            break;
        }
    }
    return $ranking;
}
function sLeerListaLotes($codprod) {
    $resp = "";
    $lotes = DB::table('lotes')
    ->where('codpadre','=',$codprod)
    ->where('cantidad','>',0)
    ->orderBy('id','asc')
    ->get();
    foreach ($lotes as $l) {
        $lote = trim($l->lote);
        $feclote = trim($l->feclote);
        $cantidad = strval($l->cantidad);
        $deposito = trim($l->deposito);
        $codhijo = trim($l->codhijo);
        $resp .= $lote.'_'.$feclote.'_'.$cantidad.'_'.$deposito.'_'.$codhijo.';';
    }
    return $resp;
}
function sCodigoClienteActivo() {
    $tipo = Auth::user()->tipo;
    if (!Session::has('codcli')) {
       if ($tipo == "G" || $tipo == "V") {
            $codcli = Auth::user()->codcliactivo;
        } else {
            $codcli = Auth::user()->codcli;
        }
        Session::put('codcli', $codcli);
    }
    $codcli = Session::get('codcli', "");
    return $codcli;
}
function sVerificarCaractExt($codprod) {
    $resp = "";
    $prod = DB::table('producto')
    ->where('codprod', '=', $codprod)
    ->first();
    if ($prod) {
        if ($prod->undmin != '1') {
            $resp = $resp ."Cantidad minima para pedir: ".$prod->undmin. " \n";
        }
        if ($prod->undmax != '99999999') {
            $resp = $resp ."Cantidad máxima para pedir: ".$prod->undmax. " \n";
        }
        if ($prod->undmultiplo != '0') {
            $resp = $resp ."Cantidad a pedir multiplos de: ".$prod->undmultiplo. " \n";
        }
        if ($resp) {
            $resp = "CARACTERISTICAS EXTENDIDAS\n========================\n".$resp;
        }
    }
    return $resp;
}
function validarCaractExtendidas($pedirTot, $pedirPed, $cantidad, $undmin, $undmax, $undmultiplo, $codprod) {
    if ($undmin == '1' && $undmax == '99999999' && $undmultiplo == '0') {
        // NO POSEE CARACTERISTICAS EXTENDIDAS
        return array('pedir' => $pedirTot, 'msg' => 'OK', 'status' => 0);
    }
    if ($undmin != '1') {
        if ($pedirTot < $undmin ) {
            if ($undmin > $cantidad) {
                // RETORNA LA CANTIDAD Q HAY DEL INVENTARIO
                return array('pedir' => $cantidad, 'msg' => 'Cantidad minima es de '.$undmin.', La Cantidad sera forzada al inventario '.$cantidad, 'status' => 1);

            }
            else {

                // RETORNA LA CANTIDAD SOLICITADA ES MENOR AL MINIMO, SERA FORZADO AL MINIMO
                return array('pedir' => $undmin, 'msg' => 'La cantidad solicitada es menor a la cantidad minima '.$undmin.', La Cantidad sera forzada al minimo', 'status' => 1);
            }
        }
    }
    if ($undmax != '99999999') {
        $codcli = sCodigoClienteActivo();
        $id = iIdUltPedAbierto($codcli);
        $hasta = date('Y-m-d').' 23:59:00';
        $desde = date('Y-m-d').' 00:00:00';
        $pr = DB::table('pedren as pr')
        ->leftJoin('pedido as p','pr.id','=','p.id')
        ->where('p.codcli','=', $codcli)
        ->where('pr.codprod','=', $codprod)
        ->whereBetween('p.fecenviado', array($desde, $hasta))
        ->where(function ($q) {
            $q->where('p.estado','!=','NUEVO')
            ->where('p.estado','!=','ANULADO');
        })
        ->selectRaw('SUM(pr.cantidad) as cantidad')
        ->first();
        $pedirEnv = 0;
        if ($pr->cantidad)
            $pedirEnv = $pr->cantidad;

        $pr = DB::table('pedren as pr')
        ->leftJoin('pedido as p','pr.id','=','p.id')
        ->where('p.codcli','=', $codcli)
        ->where('pr.codprod','=', $codprod)
        ->where('p.id','=', $id)
        ->where('p.estado','=','NUEVO')
        ->selectRaw('SUM(pr.cantidad) as cantidad')
        ->first();
        $pedirAnt = 0;
        if ($pr->cantidad)
            $pedirAnt = $pr->cantidad;
        if (( $pedirTot + $pedirEnv) > $undmax ) {
            $dif = $undmax - $pedirAnt;
            if ($dif <= 0) {
                // RETORNA CERO, NO PUEDE PEDIR MAS, YA LLEGO A LA CUOTA DEL DIA
                return array('pedir' => 0,'msg' => 'No puede perdir más, ya llego a la cuota maxima que es ('.$undmax.')', 'status' => 2);
            }
            else {
                // RETORNA LA DIF SALDO RESTANTE PARA COMPLETAR EL MAXIMO
                return array('pedir' => $undmax, 'msg' => 'La cantidad que puede pedir es: '.$dif.', para llegar al máximo que es: '.$undmax, 'status' => 1);
            }
        } else {
            // RETORNA LA CANTIDAD SOLICITADA, NO LLEGA AL MAXIMO TODAVIA
            return array('pedir' => $pedirTot, 'msg' => 'OK', 'status' => 0);
        }
    }
    if ($undmultiplo != '0') {
        $retorno = 0;
        $i = $pedirTot;
        while ($i > 0) {
            $i = $i - $undmultiplo;
            if ($i == 0) {
                $retorno = $pedirTot;
            }
        }
        //log::info("RETORNO : ".$retorno);
        if ($retorno == 0) {
            $pivote = 0;
            if ($pedirTot < $undmultiplo) {
                $pedirTot = $undmultiplo;
            } else {
                while (true) {
                    $pivote = $pivote + $undmultiplo;
                    if ($pivote > $pedirTot) {
                        $desde = $pivote - $undmultiplo;
                        $hasta = $pivote;
                        $z = $hasta - $desde;
                        $y = $pedirTot - $desde;
                        $x = $y * 100/$z;
                        if ($x >= 50)
                            $pedirTot = $hasta;
                        else
                            $pedirTot = $desde;
                        break;
                    }
                }
            }
            return array('pedir' => $pedirTot, 'msg' => 'Cantidad a pedir ('.$pedirTot.'), multiplos de '.$undmultiplo. ' Se forzo la cantidad', 'status' => 1);
        }
        else
            return array('pedir' => $retorno, 'msg' => 'OK', 'status' => 0);
    }
    return array('pedir' => $pedirTot, 'msg' => 'OK', 'status' => 0);
}
function sidebarModo() {
    if (!Session::has('sidebarModo')) {
        Session::put('sidebarModo', 0);
    }
    return Session::get('sidebarModo', "");
}
function vRegitrarBusquedas($texto, $exitosa) {
    $agregado=0;
    $texto = strtoupper($texto);
    $reg = DB::table('busquedas')
    ->where('texto','=',$texto)
    ->first();
    if ($reg) {
        DB::table('busquedas')
            ->where('id', '=', $reg->id)
            ->update(array('exitosa' => $exitosa,
                           'contador' => $reg->contador + 1,
                           'fecha' => date('Y-m-d H:i:s')
        ));
        $agregado=1;
    }
    if ($agregado==0) {
        $reg = DB::table('busquedas')
        ->where('texto','like', '%'.$texto.'%')
        ->get();
        if ($reg->count() > 0) {
            $id = $reg[0]->id;
            $cont = $reg[0]->contador;
            DB::table('busquedas')
            ->where('id', '=', $id)
            ->update(array('exitosa' => $exitosa,
                           'contador' => $cont + 1,
                           'fecha' => date('Y-m-d H:i:s')
            ));
        }
        else {
            DB::table('busquedas')->insert([
                'texto' => $texto,
                'contador' => 1,
                'exitosa' => $exitosa,
                'fecha' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
function bEnviaCorreo($asunto, $remite, $destino, $contenido) {
    $retorno = FALSE;
    try {
        if (strlen($asunto)==0 ||
            strlen($remite)==0 ||
            strlen($destino)==0 ||
            strlen($contenido)==0  ) {
            return FALSE;
        }
        $fechaHoy = date('j-m-Y');
        $FechaVenta = substr($fechaHoy, 0, 10);
        $cfg = DB::table('cfg')->first();

        // FORMULARIO DEL CORREO
        $subject = $asunto;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= "X-MSMail-Priority: High\r\n";
        $headers .= "From: <".$remite.">\r\n";
        $headers .= "Reply-To: <".$destino.">\r\n";
        $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
        $headers .= "X-originating-IP: \r\n";
        // ENCABEZADO
        $message = "
        <html>
        <head>
        <title>HTML</title>
        </head>
        <body>
        <center><h2>SOPORTE TECNICO</h2></center>
        <center><h2>".$asunto."</h2></center>";

        $message .= "<div><br>";

        $message .= "<center> FECHA: ".$fechaHoy."</center>";
        $message .= "<span>".$contenido."</span>";
        $message .= "</div><br>";

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
        if (mail($destino, $subject, $message, $headers)) {
            log::info("SOPORTE TECNICO CORREO (OK): ".$remite." ASUNTO: ".$subject);
            $retorno = TRUE;
        }
    } catch (Exception $e) {
        log::info("SOPORTE TECNICO CORREO (ERROR): ".$remite." ASUNTO: ".$subject.'\n'.$e);
    }
    return $retorno;
}
function vGeneraTablaMarcas() {
    try {
        DB::beginTransaction();
        DB::table('marca')->delete();
        $prod = DB::table('producto')->get();
        foreach ($prod as $p) {
            $codmarca = trim($p->marcamodelo);
            $codmarca = str_replace(' ', '', $codmarca);
            $marca = DB::table('marca')
            ->where('codmarca', '=', $codmarca)
            ->first();
            if (empty($marca)) {
                DB::table('marca')->insert(['codmarca' => $codmarca]);
            }
        }
        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        log::info("TABLA MARCA -> ERROR: ".$e->getMessage());
    }
}
function vArreglarNombreImagenes() {
    $prod = DB::table('producto')->get();
    foreach ($prod as $p) {
        $barra = $p->barra;
        $desprod = $p->desprod;
        $codprod = $p->codprod;
        $prodimg = DB::table('prodimg')
        ->where('codprod', '=', $codprod)
        ->first();
        if ($prodimg) {
            $nomimagen = $prodimg->nomimagen;
            if (strlen($nomimagen) > 0) {
                $s1 = substr($nomimagen, 6, strlen($nomimagen)-6 );
              //  log::info("s1: ".$s1);
                // $s2 = substr($s1, 0, strlen($s1)-4 );
                $s3 = explode(".", $s1);
                if ( count($s3) > 1) {
                    $archivo = $s3[0];
                    $extencion = $s3[1];

                    //log::info("archivo: ".$archivo);
                    //log::info("extencion: ".$extencion);

                    $mi_imagen = public_path().'/public/storage/'.$nomimagen;
                    if (file_exists($mi_imagen)) {
                        //log::info("mi_imagen: ".$mi_imagen);

                        $rutavieja = public_path().'/public/storage/'.$nomimagen;
                        $rutanueva = public_path().'/public/storage/prod/'.$barra.'.'.$extencion;

                        //log::info("rutavieja: ".$rutavieja);
                        //log::info("rutanueva: ".$rutanueva);

                        if (preg_match('/^[0-9]*$/', $archivo))  {
                            // log::info("correcto:".$archivo);
                        } else {
                            rename($rutavieja, $rutanueva);
                            // log::info("corregido:".$rutanueva);

                            DB::table('prodimg')
                            ->where('codprod', '=', $codprod)
                            ->update(array('nomimagen' => '/prod/'.$barra.'.'.$extencion ));

                        }


                    }
                }
            }
        }
    }
}
function vCargaImagenes() {
    $cfg = DB::table('cfg')->first();
    $prod = DB::table('producto')->get();
    foreach ($prod as $p) {
        $barra = $p->barra;
        $desprod = $p->desprod;
        $codprod = $p->codprod;
        $nomimagen = "";

        DB::table('prodimg')
        ->where('codprod', '=', $codprod)
        ->where('codisb', '=', $cfg->codisb)
        ->update(array('desprod' => $desprod, 'barra' => $barra ));

        $mi_imagen = public_path().'/public/storage/prod/'.$barra.'.jpg';
        if (@getimagesize($mi_imagen)) {
            $nomimagen = '/prod/'.$barra.'.jpg';
        }
        else {
            $mi_imagen = public_path().'/public/storage/prod/'.$barra.'.JPG';
            if (@getimagesize($mi_imagen)) {
                $nomimagen = '/prod/'.$barra.'.JPG';
            } else {
                $mi_imagen = public_path().'/public/storage/prod/'.$barra.'.png';
                if (@getimagesize($mi_imagen)) {
                    $nomimagen = '/prod/'.$barra.'.png';
                } else {
                    $mi_imagen = public_path().'/public/storage/prod/'.$barra.'.PNG';
                    if (@getimagesize($mi_imagen)) {
                        $nomimagen = '/prod/'.$barra.'.PNG';
                    } else {
                        $mi_imagen = public_path().'/public/storage/prod/'.$barra.'.jpeg';
                        if (@getimagesize($mi_imagen)) {
                            $nomimagen = '/prod/'.$barra.'.jpeg';
                        } else {
                            $mi_imagen = public_path().'/public/storage/prod/'.$barra.'.JPEG';
                            if (@getimagesize($mi_imagen))
                                $nomimagen = '/prod/'.$barra.'.JPEG';
                        }
                    }
                }
            }
        }
        if ($nomimagen == "")
            continue;
        $prodimg = DB::table('prodimg')
        ->where('codprod', '=', $codprod)
        ->where('codisb', '=', $cfg->codisb)
        ->first();
        if ($prodimg) {
            DB::table('prodimg')
            ->where('codprod', '=', $codprod)
            ->where('codisb', '=', $cfg->codisb)
            ->update(array('desprod' => $desprod,
                           'nomimagen' => $nomimagen
            ));
        } else {
            DB::table('prodimg')->insert([
                'codprod' => $codprod,
                'desprod' => $desprod,
                'nomimagen' => $nomimagen,
                "codisb" => $cfg->codisb
            ]);
        }
    }
    vArreglarNombreImagenes();
}
function iCrearPedidoNuevo($tipedido) {
    $tipo = Auth::user()->tipo;
    $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
    $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    if ($tipo == 'C' || $tipo == 'G')
        $codvend = $cfg->codvendInternet;
    else {
        $codvend = Auth::user()->codcli;
    }
    $codcli = sCodigoClienteActivo();
    $id = iIdUltPedAbierto($codcli);
    if ( $id < 0) {
        $usuario = Auth::user()->email;
        $subtitulo = "PEDIDO";
        $fecha = date('Y-m-d H:i:s');
        $cliente = DB::table('cliente')
        ->where('codcli','=',$codcli)
        ->first();

        $pedfiscal = 1;
        $cnf = DB::table('clientenofiscal')
        ->where('codcli','=',$codcli)
        ->first();
        if ($cnf) {
            $pedfiscal = 0;
        }

        $id = DB::table('pedido')->insertGetId([
            'codcli' => $codcli,
            'fecha' => $fecha,
            'estado' => 'NUEVO',
            'fecenviado' => $fecha,
            'fecprocesado' => $fecha,
            'origen' => $tipo.'-WEB',
            'codvend' => $codvend,
            'usuario' => $usuario,
            'tipedido' => $tipedido,
            'nomcli' => $cliente->nombre,
            'rif' => $cliente->rif,
            'dcredito' => $cliente->dcredito,
            'di' => $cliente->dinternet,
            'dc' => $cliente->dcomercial,
            'pp' => $cliente->ppago,
            'subrenglon' => 0.00,
            'descuento' => 0.00,
            'subtotal' => 0.00,
            'impuesto' => 0.00,
            'total' => 0.00,
            'numren' => 0,
            'numund' => 0,
            'destino' => $cfg->SedeSucursal,
            'codisb' => $cfg->codisb,
            'ruta' => $cliente->ruta,
            'pedfiscal' => $pedfiscal,
            'documento' => '',
            'entrega' => $cliente->entrega
        ]);
    }
    return $id;
}
function sLeerCategoria($codcat, $campo) {
    // CONFIGURACION
    $reg = DB::table('categoria')
    ->where('codcat','=',$codcat)
    ->first();
    if ($reg)
        return $reg->$campo;
    else
        return "";
}
function sLeerMarca($codmarca, $campo){
    // CONFIGURACION
    $reg = DB::table('marcaimg')
    ->where('codmarca','=',$codmarca)
    ->first();
    if ($reg)
        return $reg->$campo;
    else
        return "";
}
function iContadorPedidos() {
    $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
    $reg = DB::table('pedido')
    ->selectRaw('count(*) as contador')
    ->where('codisb','=',$sucactiva)
    ->where('estado','=','POR-APROBAR')
    ->first();
    return $reg->contador;
}
function dTotalPedido($id) {
    $reg = DB::table('pedido')
    ->where('id','=',$id)
    ->first();
    if ($reg)
        return $reg->total;
    else
        return 0.00;
}
function iContadorRecRecibido() {
    $reg = DB::table('reclamo')
    ->selectRaw('count(*) as contador')
    ->where('estado','=','RECIBIDO')
    ->first();
    return $reg->contador;
}
function iContadorPagRecibido() {
    $reg = DB::table('pago')
    ->selectRaw('count(*) as contador')
    ->where('estado','=','RECIBIDO')
    ->first();
    return $reg->contador;
}
function iIdUltPedAbierto($codcli) {
    $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
    $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    $id = -1;
    $fechaHoy = trim(date("Y-m-d"));
    $reg = DB::table('pedido')
    ->where('estado','=','NUEVO')
    ->where('codcli','=',$codcli)
    ->where('codisb','=',$sucactiva)
    ->orderBy('id','desc')
    ->first();
    if ($reg) {
        $contren = 0;
        $id = $reg->id;
        $fecpedido = trim(date('Y-m-d', strtotime($reg->fecha)));
        if ($fecpedido != $fechaHoy) {
            $pedren = DB::table('pedren')
            ->selectRaw('count(*) as contador')
            ->where('id','=',$id)
            ->first();
            if ($pedren) {
                $contren = $pedren->contador;
            }
            if ($contren == 0) {
                // SI EL PEDIDO ESTA FUERA DE LA FECHA ACTUAL Y NO TIENE RENGLONES
                // ESTA RUTINA ELMINA EL PEDIDO Y RETORNA -1, PARA CREAR UNO
                // NUEVO CON LA FECHA ACTUAL
                DB::table('pedido')
                ->where('id','=',$id)
                ->delete();
                $id = -1;
            } else {
                // EL PEDIDO ESTA FUERA DE FECHA, PERO TIENE RENGLONES
                // ENTONCES SE DEBE BORRAR EL PEDIDO Y CREAR UNO NUEVO
                // Y LUEGO COPIAR LOS DATOS DEL PEDIDO A NUEVO PEDIDO
                // PARA LOS RENGLONES DE DEBE HACER UN UPDATE DEL ID
                // VIEJO POR EL NUEVO ID
                $idnew = DB::table('pedido')->insertGetId([
                    'codcli' => $reg->codcli,
                    'fecha' => date("Y-m-d H:i:s"),
                    'estado' => 'NUEVO',
                    'fecenviado' => date("Y-m-d H:i:s"),
                    'fecprocesado' => date("Y-m-d H:i:s"),
                    'origen' => $reg->origen,
                    'codvend' => $reg->codvend,
                    'usuario' => $reg->usuario,
                    'tipedido' => $reg->tipedido,
                    'nomcli' => $reg->nomcli,
                    'rif' => $reg->rif,
                    'dcredito' => $reg->dcredito,
                    'di' => $reg->di,
                    'dc' => $reg->dc,
                    'pp' => $reg->pp,
                    'subrenglon' => $reg->subrenglon,
                    'descuento' => $reg->descuento,
                    'subtotal' => $reg->subtotal,
                    'impuesto' => $reg->impuesto,
                    'total' => $reg->total,
                    'numren' => $reg->numren,
                    'numund' => $reg->numund,
                    'destino' => $reg->destino,
                    'codisb' => $reg->codisb,
                    'ruta' => $reg->ruta,
                    'pedfiscal' => $reg->pedfiscal,
                    'documento' => $reg->documento
                ]);
                DB::table('pedido')
                ->where('id','=',$id)
                ->delete();
                DB::table('pedren')
                ->where('id', '=', $id)
                ->update(array("id" => $idnew));
                $id = $idnew;
            }
        }

    }
    return $id;
}
function iContRengUltPedAbierto($codcli) {
    $cont = 0;
    $id = iIdUltPedAbierto($codcli);
    if ($id > 0) {
        $reg = DB::table('pedren')
        ->selectRaw('count(*) as contador')
        ->where('id','=',$id)
        ->first();
        $cont = $reg->contador;
    }
    return $cont;
}
function iContRengPedido($id) {
    $cont = 0;
    $reg = DB::table('pedren')
    ->selectRaw('count(*) as contador')
    ->where('id','=',$id)
    ->first();
    if ($reg)
        $cont = $reg->contador;
    return $cont;
}
function vEliminarPedidoBlanco($codcli) {
    // ELIMINA LOS PEDIDOS EN BLANCO
    $idult = iIdUltPedAbierto($codcli);
    $peds = DB::table('pedido')
    ->where('codcli','=', $codcli)
    ->where('estado','=', 'NUEVO')
    ->get();
    foreach ($peds as $p) {
        if ($idult != $p->id) {
            $r = DB::table('pedren')
                ->selectRaw('count(*) as contitem')
                ->where('id','=', $p->id)
                ->first();
            if ($r->contitem == 0) {
                // PEDIDO EN BLANCO
                $regs = DB::table('pedido')
                ->where('id','=',$p->id)
                ->delete();
            }
        }
    }
}
function vEliminarReclamoBlanco($codcli) {
    // ELIMINA LOS RECLAMOS EN BLANCO
    $recs = DB::table('reclamo')
    ->where('codcli','=', $codcli)
    ->where('estado','=', 'NUEVO')
    ->get();
    foreach ($recs as $rec) {
        if (SubtotalReclamo($rec->id) == 0) {
            // RECLAMO EN BLANCO
            $regs = DB::table('reclamo')
            ->where('id','=',$rec->id)
            ->delete();

            $regs = DB::table('recren')
            ->where('id','=',$rec->id)
            ->delete();
        }
    }
}
function vEliminarPagoBlanco($codcli) {
    // ELIMINA LOS PAGOS EN BLANCO
    $recs = DB::table('pago')
    ->where('codcli','=', $codcli)
    ->where('estado','=', 'NUEVO')
    ->get();
    foreach ($recs as $rec) {
        if (SubtotalPago($rec->id) == 0) {
            $regs = DB::table('pago')
            ->where('id','=',$rec->id)
            ->delete();
            $regs = DB::table('pagren')
            ->where('id','=',$rec->id)
            ->delete();
        }
    }
}
function NombreImagen($codprod) {

    $reg = DB::table('producto')
    ->where('codprod','=',$codprod)
    ->first();
    if (empty($reg)) {
        $reg = DB::table('lotes')
        ->where('codhijo','=',$codprod)
        ->first();
        if ($reg)
            $codprod = $reg->codpadre;
    }
    $reg = DB::table('prodimg')
    ->select('nomimagen')
    ->where('codprod','=',$codprod)
    ->first();
    if (empty($reg)) {
        $nombre = "noimagen.png";
    }
    else {
        $nombre = $reg->nomimagen;
        $mi_imagen = public_path().'/public/storage/'.$nombre;
        if (!file_exists($mi_imagen))
            $nombre = "noimagen.png";
    }
    return $nombre;
}
function NombreImagenCat($codcat) {
    $reg = DB::table('catimg')
    ->select('nomimagen')
    ->where('codcat','=',$codcat)
    ->first();
    if (empty($reg)) {
        $nombre = "noimagen.png";
    }
    else {
        $nombre = $reg->nomimagen;
        $mi_imagen = public_path().'/public/storage/'.$nombre;
        if (!file_exists($mi_imagen))
            $nombre = "noimagen.png";
    }
    return $nombre;
}
function NombreImagenMarca($codmarca) {
    $reg = DB::table('marcaimg')
    ->select('nomimagen')
    ->where('codmarca','=',$codmarca)
    ->first();
    if (empty($reg)) {
        $nombre = "noimagen.png";
    }
    else {
        $nombre = $reg->nomimagen;
        $mi_imagen = public_path().'/public/storage/'.$nombre;
        if (!file_exists($mi_imagen))
            $nombre = "noimagen.png";
    }
    return $nombre;
}
function bValida_Preempaque($pedir, $up, $dp) {
    //log::info("PEDIR: ".$pedir." UP: ".$up." DP: ".$dp);
    if ($pedir == 0)
        return FALSE;
    if ($dp == 0)
        return FALSE;
    if ($up == 0)
        return FALSE;
    $aplica = FALSE;
    if ($pedir >= $up) {
        $n = $pedir;
        while ($n > 0)
        {
            $n = $n - $up;
        }
        if ($n == 0)
            $aplica = TRUE;
    }
    //log::info("APLICA: ".$aplica);
    return $aplica;
}
function dBuscar_DctoVolumen($pedir, $dvDetalle) {
    //log::info("PEDIR: ".$pedir." DETALLE: ".$dvDetalle);
    $dv = 0.00;
    if ($pedir == 0)
        return $dv;
    if (is_null($dvDetalle))
        return $dv;

    $separador = ";";
    if (substr($dvDetalle, -1) != $separador)
        $dvDetalle = $dvDetalle.$separador;

    $listaDcto = explode($separador, $dvDetalle);
    for ($i = 0; $i < count($listaDcto); $i++) {
        $s1 = explode("-", $listaDcto[$i]);
        if (count($s1) > 1) {
            $desde = intval($s1[0]);
            $hasta = intval($s1[1]);
            $dcto = floatval($s1[2]);
            if ($i == count($listaDcto)-2)
                $hasta = 1000000.00;
            if (($pedir >= $desde) && ($pedir <= $hasta)) {
                $dv = $dcto;
                break;
            }
        }
    }
    //log::info("DV: ".$dv);
    return $dv;
}
function CalculaPrecioNeto($precio, $da, $di, $dc, $pp, $dp, $dv, $dvp) {
    $base = $precio;
    try {
        if ($base > 0) {
            // DESCUENTO ADICIONAL
            if ($da > 0 ) {
                $base = $base - ($base * ($da / 100.00));
            }
            // DESCEUNTO INTERNET
            if ($di > 0 ) {
                $base = $base - ($base * ($di / 100.00));
            }
            // DESCUENTO COMERCIAL
            if ($dc > 0) {
                $base = $base - ($base * ($dc / 100.00));
            }
            // DESCUENTO PRONTO PAGO
            if ($pp > 0) {
                $base = $base - ($base * ($pp / 100.00));
            }
            // DESCEUNTO PRE-EMPAQUE
            if ($dp > 0) {
                $base = $base - ($base * ($dp / 100.00));
            }
            // DESCUENTO POR VOLUMEN
            if ($dv > 0) {
                $base = $base - ($base * ($dv / 100.00));
            }
            // DESCUENTO PREFERECIAL VIP
            if ($dvp > 0) {
                $base = $base - ($base * ($dvp / 100.00));
            }
        }
    } catch (Exception $e) {
        return $precio;
    }
    return $base;
}
function CalculaTotalesPedido($idpedido) {

    $pedido = DB::table('pedido')
    ->where('id','=',$idpedido)
    ->first();
    if ($pedido) {
        $pedren = DB::table('pedren')
        ->where('id', '=', $idpedido)
        ->get();
        foreach ($pedren as $pr) {
            $neto = CalculaPrecioNeto($pr->precio, $pr->da, $pr->di, $pr->dc, $pr->pp, $pr->dp, $pr->dv, $pr->dvp);
            DB::table('pedren')
            ->where('item', '=', $pr->item)
            ->update(array("neto" => $neto,
                "subtotal" => ($neto * $pr->cantidad)
            ));
        }

        // SUBRENGLON DEL PEDIDO
        $reg = DB::table('pedren')
        ->where('id','=',$idpedido)
        ->selectRaw('SUM(precio * cantidad) as subrenglon')
        ->first();
        $subrenglon = 0;
        if ($reg->subrenglon)
            $subrenglon = $reg->subrenglon;

        // SUBTOTAL NETO DEL PEDIDO
        $reg = DB::table('pedren')
        ->where('id','=',$idpedido)
        ->selectRaw('SUM(subtotal) as subtotal')
        ->first();
        $subtotal = 0;
        if ($reg->subtotal)
            $subtotal = $reg->subtotal;

        // CALCULO DEL IMPUESTO DEL PEDIDO
        $reg = DB::table('pedren')
        ->where('id','=',$idpedido)
        ->where('iva','>','0')
        ->selectRaw('SUM((subtotal * iva)/100) as imp')
        ->first();
        $impuesto = 0;
        if ($reg->imp)
            $impuesto = $reg->imp;

        // CONTADOR DE ITEM DEL PEDIDO
        $reg = DB::table('pedren')
        ->where('id','=',$idpedido)
        ->selectRaw('count(*) as item')
        ->first();
        $item = 0;
        if ($reg->item)
            $item = $reg->item;

        // TOTAL DE UNIDADES
        $reg = DB::table('pedren')
        ->where('id','=',$idpedido)
        ->selectRaw('SUM(cantidad) as und')
        ->first();
        $und = 0;
        if ($reg->und)
            $und = $reg->und;

        $total = $subtotal + $impuesto;

        DB::table('pedido')
        ->where('id', '=', $idpedido)
        ->update(array("numren" => $item,
                       "numund" => $und,
                       "subrenglon" => $subrenglon,
                       "descuento" => $subrenglon - $subtotal,
                       "subtotal" => $subtotal,
                       "impuesto" => $impuesto,
                       "total" => $total
        ));
    }
}
function CalculaTotalesReclamo($id) {

    $subrenglon = SubtotalReclamo($id);
    // CALCULO DEL IMPUESTO DEL RECLAMO
    $reg = DB::table('recren')
        ->where('id','=',$id)
        ->where('iva','>','0')
        ->selectRaw('SUM(( (precio*cantrec) * iva)/100) as imp')
        ->first();
    $impuesto = 0;
    if ($reg->imp)
        $impuesto = $reg->imp;
    $total = $subrenglon + $impuesto;

    DB::table('reclamo')
    ->where('id', '=', $id)
    ->update(array("subrenglon" => $subrenglon,
                   "impuesto" => $impuesto,
                   "total" => $total
    ));
}
function CalculaTotalesPagos($id) {

    $total = SubtotalPago($id);
    DB::table('pago')
    ->where('id', '=', $id)
    ->update(array("total" => $total));
}
function SubtotalReclamo($id) {
    $reg = DB::table('recren')
    ->where('id','=', $id)
    ->where('motivo', '!=', 'SOBRANTE')
    ->selectRaw('SUM(precio * cantrec) as subtotal')
    ->first();
    return $reg->subtotal;
}
function SubtotalPedido($id) {
    $reg = DB::table('pedren')
    ->where('id','=', $id)
    ->selectRaw('SUM(precio * cantidad) as subtotal')
    ->first();
    return $reg->subtotal;
}
function SubtotalPago($id) {
    $reg = DB::table('pagren')
    ->where('id','=', $id)
    ->selectRaw('SUM(monto) as subtotal')
    ->first();
    return $reg->subtotal;
}
function DiferenciaDias($fechav) {
    $fechoy = strtotime(date('d-m-Y'));
    $fecven = strtotime($fechav);
    $dif = $fechoy - $fecven;
    $dias = ((($dif/60)/60)/24);
    if ($dias < 0.00)
        $dias = 0;
    return ceil($dias);
}
function NombreCliente($codcli) {
    $cliente = DB::table('cliente')
    ->select('nombre')
    ->where('codcli','=',$codcli)
    ->first();
    if (empty($cliente)) {
        return "";
    }
    else {
        $nombre = str_replace(',C.A.', '', $cliente->nombre);
        $nombre = str_replace(',CA', '', $nombre);
        $nombre = str_replace(', C.A.', '', $nombre);
        $nombre = str_replace(', CA', '', $nombre);
        $nombre = str_replace(', C.A', '', $nombre);
        $nombre = str_replace(',C.A', '', $nombre);
        $nombre = str_replace(', CA.', '', $nombre);
        $nombre = str_replace(' C.A.', '', $nombre);
    }
    return $nombre;
}
function NombreProveActivo() {
    $nombre = "PROVEEDOR (POR DEFINIR)";
    $codmarca = Auth::user()->codcli;
    $marca = DB::table('marca')
    ->where('codmarca','=',$codmarca)
    ->first();
    if ($marca) {
        $nombre = "PROVEEDOR (".$marca->codmarca.")";
    }
    return $nombre;
}
function CampoVendedor($id, $campo) {
    $reg = DB::table('vendedor')
    ->select($campo)
    ->where('codigo','=',$id)
    ->first();
    if (empty($reg)) {
        return "";
    }
    else {
        if ($campo == 'supervisor') {
            if (strlen($reg->$campo) > 0)
                $nombre = 'SUPERVISOR';
            else
                $nombre = 'NORMAL';
        } else {
            $nombre = $reg->$campo;
        }
    }
    return $nombre;
}
function NombreVendedor($id) {
    $reg = DB::table('vendedor')
    ->select('nombre')
    ->where('codigo','=',$id)
    ->first();
    if (empty($reg)) {
        return "";
    }
    else {
        $nombre = $reg->nombre;
    }
    return $nombre;
}
function VerificaTabla($tabla) {
    $retorno = FALSE;
    $tables_in_db = DB::select('SHOW TABLES');
    $tables = array_map('current',$tables_in_db);
    foreach ($tables as $table)
    {
        if (strtoupper($table) == strtoupper($tabla))
        {
            $retorno = TRUE;
            break;
        }
    }
    return $retorno;
}
function RetornaRengPedido($idpedido) {
    $user = Auth::user();
    $codisb = $user->codisb;
    $reg = DB::table('PEDREN_'.$codisb)
    ->where('id','=',$idpedido)
    ->get();
    return $reg;
}
function ContadorVisitas() {
    // CONFIGURACION
    $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
    $cfg = DB::table('cfg')
    ->where('codisb','=',$sucactiva)
    ->first();
    if ($cfg) {
        $cntvisitas = $cfg->cntvisitas + 1;
        DB::table('cfg')
        ->where('codisb','=',$sucactiva)
        ->update(array('cntvisitas' => $cntvisitas));
        return $cntvisitas;
    }
}
function Getfloat($str) {
    $num = '0.00';
    if ($str=='' || $str=='0'){
        return floatval($num);
    }
    if(strstr($str, ",")) {
        $str = str_replace(",", "", $str);
    }
    if(preg_match("#([0-9\.]+)#", $str, $match)) {
        return floatval($match[0]);
    } else {
        return floatval($str);
    }
}
// FUNCIONES DE SINCRONIZACION DE DATA
function CapturaSeped() {
    // /home/deznjdq920u6/public_ftp/intranet.dromarko.com/data/seped
    $BASE_PATH = env('INTRANET_RUTA_CAPTURA_SEPED', base_path());
    $contador = 0;
    set_time_limit(1000);
    try {
        $directorio = opendir($BASE_PATH);
        while ($filename = readdir($directorio)) {
            if (!is_dir($filename)) {
                $archivo = explode("-", $filename);
                $valores = explode(".", $filename);
                $tipo = $archivo[0];
                $codcli = $archivo[1];
                $idlocal = $archivo[2];
                $extencion = $valores[1];
                $primero = 0;
                if ($extencion == 'txt') {
                    if (is_readable($filename)) {
                        switch ($tipo) {
                            case 'PED':
                                $lines = file($filename);
                                foreach($lines as $line) {
                                    $s1 = explode("|", $line);
                                    if ($primero==0) {
                                        $primero++;
                                        $id = DB::table('pedido')->insertGetId([
                                            'codcli' => $s1[1],
                                            'fecha' => $s1[2],
                                            'estado' => $s1[3],
                                            'fecenviado' => $s1[4],
                                            'fecprocesado' => $s1[5],
                                            'origen' => $s1[6],
                                            'usuario' => $s1[7],
                                            'codvend' => $s1[8],
                                            'tipedido' => $s1[9],
                                            'nomcli' => $s1[10],
                                            'rif' => $s1[11],
                                            'dcredito' => $s1[12],
                                            'di' => $s1[13],
                                            'dc' => $s1[14],
                                            'pp' => $s1[15],
                                            'subrenglon' => $s1[16],
                                            'descuento' => $s1[17],
                                            'subtotal' => $s1[18],
                                            'impuesto' => $s1[19],
                                            'total' => $s1[20],
                                            'numren' => $s1[21],
                                            'numund' => $s1[22],
                                            'destino' => $s1[23],
                                            'documento' => 'IDLOCAL: '.$s1[0],
                                            'codisb' => $s1[25]

                                        ]);
                                    } else {
                                        DB::table('pedren')->insert([
                                            'id' => $id,
                                            'codprod' => $s1[2],
                                            'desprod' => $s1[3],
                                            'cantidad' => $s1[4],
                                            'precio' => $s1[5],
                                            'barra' => $s1[6],
                                            'tipocatalogo' => $s1[7],
                                            'regulado' => $s1[8],
                                            'tipo' => $s1[9],
                                            'pvp' => $s1[10],
                                            'iva' => $s1[11],
                                            'da' => $s1[12],
                                            'di' => $s1[13],
                                            'dc' => $s1[14],
                                            'pp' => $s1[15],
                                            'neto' => $s1[16],
                                            'subtotal' => $s1[17],
                                            'codisb' => $s1[18],
                                            'codcli' => $s1[1]
                                        ]);
                                    }
                                }
                                break;
                            case 'REC':
                                $lines = file($filename);
                                foreach($lines as $line) {
                                    $s1 = explode("|", $line);
                                    if ($primero==0) {
                                        $primero++;
                                        $id = DB::table('reclamo')->insertGetId([
                                            'codcli' => $s1[1],
                                            'fecha' => $s1[2],
                                            'estado' => $s1[3],
                                            'fecenviado' => $s1[4],
                                            'fecprocesado' => $s1[5],
                                            'origen' => $s1[6],
                                            'usuario' => $s1[7],
                                            'factnum' => $s1[8],
                                            'fecfact' => $s1[9],
                                            'observacion' => $s1[10]." IDLOCAL: ".$s1[0],
                                            'codvend' => $s1[11],
                                            'nomcli' => $s1[12],
                                            'subrenglon' => $s1[13],
                                            'impuesto' => $s1[14],
                                            'total' => $s1[15],
                                            'totalfactura' => $s1[16],
                                            'vence' => $s1[17],
                                            'codisb' => $s1[18]
                                        ]);
                                    } else {
                                        DB::table('recren')->insertGetId([
                                            'id' => $id,
                                            'codprod' => $s1[2],
                                            'desprod' => $s1[3],
                                            'cantidad' => $s1[4],
                                            'precio' => $s1[5],
                                            'cantrec' => $s1[6],
                                            'motivo' => $s1[7],
                                            'codisb' => $s1[8]
                                        ]);
                                    }
                                }
                                break;
                            case 'PAG':
                                $lines = file($filename);
                                foreach($lines as $line) {
                                    $s1 = explode("|", $line);
                                    if ($primero==0) {
                                        $primero++;
                                        $id = DB::table('pago')->insertGetId([
                                            'codcli' => $s1[1],
                                            'fecha' => $s1[2],
                                            'estado' => $s1[3],
                                            'fecenviado' => $s1[4],
                                            'fecprocesado' => $s1[5],
                                            'origen' => $s1[6],
                                            'usuario' => $s1[7],
                                            'observacion' => $s1[8],
                                            'codvend' => $s1[9],
                                            'nomcli' => $s1[10],
                                            'total' => $s1[11],
                                            'codisb' => $s1[12]
                                        ]);
                                    } else {
                                        $subtipo=$s1[0];
                                        switch ($subtipo) {
                                            case 'PR':
                                                DB::table('pagren')->insert([
                                                    'id' => $id,
                                                    'referencia' => $s1[3],
                                                    'cuenta' => $s1[4],
                                                    'fecha' => $s1[5],
                                                    'monto' => $s1[6],
                                                    'modo' => $s1[7],
                                                    'cheque' => $s1[8],
                                                    'banco' => $s1[9],
                                                    'codisb' => $s1[10]
                                                ]);
                                                break;
                                            case 'PD':
                                                DB::table('pagdoc')->insert([
                                                    'id' => $id,
                                                    'coddoc' => $s1[3],
                                                    'tipo' => $s1[4],
                                                    'fecha' => $s1[5],
                                                    'vence' => $s1[6],
                                                    'monto' => $s1[7],
                                                    'saldo' => $s1[8],
                                                    'codisb' => $s1[9]
                                                ]);
                                                break;
                                        }
                                    }
                                }
                                break;
                        }
                        $archivo = $filename.'.aprob';
                        $rutaarc = $BASE_PATH."/".$archivo;
                        $fs = fopen($rutaarc,"w");
                        fwrite($fs,$id.PHP_EOL);
                        fclose($fs);
                        @unlink($filename);
                    }
                }
            }
        }
    } catch (Exception $e){
        log::info("CS -> Error: ".$e->getMessage());
    }
}
function Sincronizar() {
    //INTRANET_RUTA_SINCRONIZAR=/home/deznjdq920u6/public_ftp/intranet.dromarko.com/data
    $BASE_PATH_DATA = env('INTRANET_RUTA_SINCRONIZAR', base_path());
    date_default_timezone_set("America/Caracas");
    set_time_limit(1000);
    //ini_set('memory_limit', '2048M');
    $cfgs = DB::table('cfg')->get();
    foreach($cfgs as $cfg) {
        try {
            $contador = 0;
            $codisb = trim($cfg->codisb);
            $BASE_PATH = $BASE_PATH_DATA.'/'.$codisb;
            $directorio = opendir($BASE_PATH);
            while ($filename = readdir($directorio)) {
                if (!is_dir($filename)) {
                    $archivo = explode("_", $filename);
                    $valores = explode(".", $filename);
                    $bandera = $archivo[0];
                    if ($bandera == 'ventares.txt') {
                        try {
                            eliminarPedidosBlanco();
                            log::info("");
                            log::info("CD -> ********* CAPTURA DE DATOS (CODISB: ".$codisb." INICIO) *********");
                            cargarVentaRes($BASE_PATH, $codisb);
                            cargarProducto($BASE_PATH, $codisb);
                            cargarCliente($BASE_PATH, $codisb);
                            cargarProveedor($BASE_PATH, $codisb);
                            cargarFact($BASE_PATH, $codisb);
                            cargarFactRen($BASE_PATH, $codisb);
                            cargarCxc($BASE_PATH, $codisb);
                            cargarCxp($BASE_PATH, $codisb);
                            cargarCtabanco($BASE_PATH, $codisb);
                            cargarVendedor($BASE_PATH, $codisb);
                            cargarCategoria($BASE_PATH, $codisb);
                            cargarLotes($BASE_PATH, $codisb);
                            cargarMonedas($BASE_PATH, $codisb);
                            cargarProdFalla($BASE_PATH, $codisb);
                            cargarCestas($BASE_PATH, $codisb);
                            cargarChoferes($BASE_PATH, $codisb);
                            vGeneraTablaMarcas();
                            $contador++;
                            break;
                        } catch (Exception $e){
                            log::info("CD -> ERROR GENERAL UPLOAD: ".$e->getMessage());
                        }
                    }
                }
            }
            if ($contador>0) {
                log::info("");
                date_default_timezone_set("America/Caracas");
                $fechaHoy = date('Y-m-j');
                $hora = date("H:i:s");
                $fechaHoy = date('Y-m-j H:i:s');
                DB::table('cfg')
                ->where('codisb','=',$codisb)
                ->update(array('fecha' => $fechaHoy));
                // GENERA TABLAS PARA COMPATIBILIDAD CON TERCERO
                GenerarTablas($codisb);
                GenerarNotiProdFalla($codisb);
                log::info("CD -> ********* CAPTURA DE DATOS (CODISB: ".$codisb." FINAL)  *********");
            }
        } catch (Exception $e) {
            log::info("CD -> CODISB: ".$codisb." ERROR SINC.: ".$e->getMessage());
        }
    }
}
function GenerarNotiProdFalla($codisb) {
    log::info("SEPED -> ********* Genera Notificacion productos en Fallas (".$codisb.") *********");
    $cfg = DB::table('cfg')
    ->where('codisb','=',$codisb)
    ->first();
    if ($cfg->mostrarModNotificacion <= 0)
        return;
    log::info("NOTI (PFA) -> ********* INICIO *********");
    $producto = DB::table('producto')
    ->where('codisb','=',$codisb)
    ->get();
    foreach($producto as $prod) {
        $codprod = $prod->codprod;

        $producto = DB::table('producto')
        ->where('codisb','=',$codisb)
        ->where('codprod','=', $codprod)
        ->first();
        if ($producto) {

            $prodfallaalerta = DB::table('prodfallaalerta')
            ->where('codisb','=',$codisb)
            ->where('codprod','=', $codprod)
            ->where('activo','=', 1)
            ->get();
            if ($prodfallaalerta->count() <= 0)
                continue;
            $loop = 1;
            foreach($prodfallaalerta as $pfa) {
                $codcli = $pfa->codcli;
                if ($loop == 1) {
                    // YA NO ESTA EN FALLA, SE DEBE CREAR LA NOTIFICACION DE ALERTA
                    $asunto = "ALERTA AUTOMATICA (CANTIDAD: ".$producto->cantidad.") -> ".$prod->desprod;
                    $id = DB::table('notisalidas')->insertGetId([
                    'tipo' => 'PFA',
                    'asunto' => $asunto,
                    'remite' => $cfg->codisb,
                    'fecha' => date('Y-m-d H:i:s') ]);
                    $loop = $loop + 1;
                }
                // SE DEBE INACTIVAR LA ALERTA, PARA QUE NO VUELVA A NOTIFICAR
                $item = DB::table('notientradas')->insertGetId([
                'id' => $id,
                'remite' => $cfg->codisb,
                'destino' => $codcli,
                'tipo' => 'PFA',
                'asunto' => $asunto,
                'leido' => 0,
                'envio' => 1,
                'fechaenvio' => date('Y-m-d H:i:s') ]);

				// SE DEBE INACTIVAR LA ALERTA, PARA QUE NO VUELVA A NOTIFICAR
				DB::table('prodfallaalerta')
				->where('codcli','=', $codcli)
				->where('codprod','=', $codprod)
				->update(array('activo' => 0));

                log::info("NOTI (PFA) -> ID: ".$id." ITEM: ".$item." DESTINO: ".$codcli." ASUNTO: ".$asunto);
            }
        }
    }
    // REACTIVACION DE ALERTAS DE PRODUCTOS QUE ENTRARON NUEVAMENTE EN FALLAS
    $prodfallaalerta = DB::table('prodfallaalerta')
    ->where('codisb','=',$codisb)
    ->where('activo','=', 0)
    ->get();
    foreach($prodfallaalerta as $pfa) {
        $codcli = $pfa->codcli;
        $codprod = $pfa->codprod;

        $prodfalla = DB::table('prodfalla')
        ->where('codprod','=', $codprod)
        ->first();
        if ($prodfalla) {

            $producto = DB::table('producto')
            ->where('codprod','=', $codprod)
            ->first();
            if ($producto)
                continue;

            // ESTA NUEVAMENTE EN FALLA
            // SE DEBE ACTIVAR LA ALERTA, PARA QUE VUELVA A NOTIFICAR
            DB::table('prodfallaalerta')
            ->where('codcli','=', $codcli)
            ->where('codprod','=', $codprod)
            ->update(array('activo' => 1));

        }
    }
    log::info("NOTI (PFA) -> ********* FINAL *********");
}
function eliminarPedidosBlanco() {
    $cont = 0;
    $peds = DB::table('pedido')
    ->whereDate('fecha', '!=', Carbon::now()->format('Y-m-d'))
    ->where('estado','=', 'NUEVO')
    ->get();
    foreach ($peds as $p) {
        $r = DB::table('pedren')
        ->selectRaw('count(*) as contitem')
        ->where('id','=', $p->id)
        ->first();
        if ($r->contitem == 0) {
            DB::table('pedido')
            ->where('id','=',$p->id)
            ->delete();
            log::info("PEDIDO BLANCO -> ID: ".$p->id." FECHA: ".$p->fecha." ITEM: ".$r->contitem." ELIMINADO");
        }
    }
    if ($cont == 0)
        log::info("LIMPIEZA -> NO EXISTEN PEDIDO BLANCO");
}
function GenerarTablas($codisb) {
    log::info("SEPED -> ********* Tablas generadas para el Seped (".$codisb.") *********");
    //INTRANET_RUTA_SINCRONIZAR=/home/deznjdq920u6/public_ftp/intranet.dromarko.com/data
    $BASE_SEPED = env('INTRANET_RUTA_SINCRONIZAR', base_path());
    $BASE_PATH = $BASE_SEPED.'/'.$codisb.'/seped';

    // 1.- PRODUCTO
    $existe = 0;
    $archivo = 'producto.txt';
    $archivo = 'producto.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('producto')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            //$codprod = $fila->codprod;
            //$dias = sRetornaPromDias($codprod, $codisb);
            $traza="";
            foreach($fila as $columna) {
                $traza .= $columna."|";
                $existe = 1;
            }
            //$traza .= $dias."|".PHP_EOL;
            $traza .= "|".PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 2.- CLIENTE
    $existe = 0;
    $archivo = 'cliente.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('cliente')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            $traza="";
            foreach($fila as $columna) {
                $traza .= $columna."|";
                $existe = 1;
            }
            $traza .= PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 3.- PROVEEDOR
    $existe = 0;
    $filas = DB::table('proveedor')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $archivo = 'proveedor.txt';
        $rutaarc = $BASE_PATH."/".$archivo;
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            $traza="";
            foreach($fila as $columna) {
                $traza .= $columna."|";
                $existe = 1;
            }
            $traza .= PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 4.- CTABANCO
    $existe = 0;
    $archivo = 'ctabanco.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('ctabanco')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            $traza="";
            foreach($fila as $columna) {
                $traza .= $columna."|";
                $existe = 1;
            }
            $traza .= PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 5.- USERS
    $existe = 0;
    $archivo = 'users.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('users')
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            $traza="";
            foreach($fila as $columna) {
                $traza .= $columna."|";
                $existe = 1;
            }
            $traza .= PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 6.- CFG
    $existe = 0;
    $archivo = 'cfg.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('cfg')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            try {
                $traza="";
                foreach($fila as $columna) {
                    $traza .= $columna."|";
                    $existe = 1;
                }
                $traza .= PHP_EOL;
                fwrite($fs,$traza);
            } catch (Exception $e) {
                log::info("GT -> CODISB: ".$codisb." ERROR: ".$e);
            }
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
           log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 7.- FACT
    $existe = 0;
    $archivo = 'fact.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('fact')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            try {
                $traza="";
                foreach($fila as $columna) {
                    $traza .= $columna."|";
                    $existe = 1;
                }
                $traza .= PHP_EOL;
                fwrite($fs,$traza);
            } catch (Exception $e) {
                log::info("GT -> CODISB: ".$codisb." ERROR: ".$e);
            }
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
           log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 8.- FACTREN
    $existe = 0;
    $archivo = 'factren.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('factren')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            try {
                $traza="";
                foreach($fila as $columna) {
                    $traza .= $columna."|";
                }
                $traza .= PHP_EOL;
                fwrite($fs,$traza);
                $existe = 1;
            } catch (Exception $e) {
            }
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
           log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 9.- CXC
    $existe = 0;
    $archivo = 'cxc.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('cxc')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            $traza="";
            foreach($fila as $columna) {
                $traza .= $columna."|";
                $existe = 1;
            }
            $traza .= PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
           log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }

    // 10.- vendedor
    $existe = 0;
    $archivo = 'vendedor.txt';
    $rutaarc = $BASE_PATH."/".$archivo;
    $filas = DB::table('vendedor')
    ->where('codisb','=',$codisb)
    ->get();
    if (empty($filas)) {
        log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
    } else {
        $fs = fopen($rutaarc,"w");
        foreach($filas as $fila) {
            $traza="";
            foreach($fila as $columna) {
                $traza .= $columna."|";
                $existe = 1;
            }
            $traza .= PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);
        if ($existe > 0) {
            Comprimir($rutaarc, $rutaarc.".zip");
            log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc);
        } else {
           log::info("GT -> CODISB: ".$codisb." TABLA: ".$rutaarc.' (VACIO)');
        }
    }
}
function cargarVentaRes($BASE_PATH, $codisb) {
    $tabla = 'ventares';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    if (is_readable($destino)) {
        log::info("");
        log::info("CD -> Tabla: ".$tabla.' ***************************************');
        try {
            date_default_timezone_set("America/Caracas");
            DB::raw('lock tables '.$tabla.' write');
            $schecksum = '';
            $checksum = file($destino);
            if ($checksum) {

                $s1 = explode("=", $checksum[0]);
                //$codisb = $s1[1];

                $s1 = explode("=", $checksum[1]);
                $fecsinc = trim($s1[1]);

                $s1 = explode("=", $checksum[2]);
                $numfact = trim($s1[1]);

                $s1 = explode("=", $checksum[3]);
                $totfact = trim($s1[1]);

                $s1 = explode("=", $checksum[4]);
                $numdevol = trim($s1[1]);

                $s1 = explode("=", $checksum[5]);
                $totdevol = trim($s1[1]);

                $s1 = explode("=", $checksum[6]);
                $totventa = trim($s1[1]);

                $s1 = explode("=", $checksum[7]);
                $factorcambiario = trim($s1[1]);

                @unlink($destino);
                $id = trim(substr($fecsinc,0,4).substr($fecsinc,5,2).substr($fecsinc,8,2));

                DB::table('ventares')->insert([
                'id' => $id,
                'codisb' => $codisb,
                'fecha' => $fecsinc,
                'numfact' => $numfact,
                'totfact' => $totfact,
                'numdevol' => $numdevol,
                'totdevol' => $totdevol,
                'totventa' => $totventa ]);
                DB::table('cfg')
                ->where('codisb','=',$codisb)
                ->update(array('tasacambiaria' => $factorcambiario));
                log::info("CD -> CODISB: ".$codisb." - TASA: ".$factorcambiario);
            }
            DB::raw('unlock tables');
            log::info("CD -> Finalizo OK (".$tabla.") ");
            log::info("");
        } catch (Exception $e) {
            log::info("CD -> ERROR (ventares): ".$e->getMessage());
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarProducto($BASE_PATH, $codisb) {
    $cfg = DB::table('cfg')
    ->where('codisb','=', $codisb)
    ->first();
    $tabla = 'producto';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                //$reg = DB::table($tabla)->delete();
                DB::table($tabla)
                ->where('codisb','=', $codisb)
                ->update(array('nuevo' => '3'));
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $prods = [];
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $s1 = explode("|", $line);
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> barra: ".$s1[0]);
                        log::info("CD -> codprod: ".$s1[1]);
                        log::info("CD -> desprod: ".$s1[2]);
                        log::info("CD -> tipo: ".$s1[3]);
                        log::info("CD -> iva: ".$s1[4]);
                        log::info("CD -> regulado: ".$s1[5]);
                        log::info("CD -> codprov: ".$s1[6]);
                        log::info("CD -> precio1: ".$s1[7]);
                        log::info("CD -> cantidad: ".$s1[8]);
                        log::info("CD -> original: ".$s1[9]);
                        log::info("CD -> da: ".$s1[10]);
                        log::info("CD -> oferta: ".$s1[11]);
                        log::info("CD -> upre: ".$s1[12]);
                        log::info("CD -> ppre: ".$s1[13]);
                        log::info("CD -> psugerido: ".$s1[14]);
                        log::info("CD -> pgris: ".$s1[15]);
                        log::info("CD -> nuevo: ".$s1[16]);
                        log::info("CD -> fechafalla: ".$s1[17]);
                        log::info("CD -> tipocatalogo: ".$s1[18]);
                        log::info("CD -> cuarentena: ".$s1[19]);
                        log::info("CD -> dctoneto: ".$s1[20]);
                        log::info("CD -> lote: ".$s1[21]);
                        log::info("CD -> fecvence: ".$s1[22]);
                        log::info("CD -> marcamodelo: ".$s1[23]);
                        log::info("CD -> pactivo: ".$s1[24]);
                        log::info("CD -> costo: ".$s1[25]);
                        log::info("CD -> ubicacion: ".$s1[26]);
                        log::info("CD -> descorta: ".$s1[27]);
                        log::info("CD -> codisb: ".$s1[28]);
                        log::info("CD -> feccatalogo: ".$s1[29]);
                        log::info("CD -> departamento: ".$s1[30]);
                        log::info("CD -> grupo: ".$s1[31]);
                        log::info("CD -> subgrupo: ".$s1[32]);
                        log::info("CD -> opc1: ".$s1[33]);
                        log::info("CD -> opc2: ".$s1[34]);
                        log::info("CD -> opc3: ".$s1[35]);
                        log::info("CD -> precio2: ".$s1[36]);
                        log::info("CD -> precio3: ".$s1[37]);
                        log::info("CD -> precio4: ".$s1[38]);
                        log::info("CD -> precio5: ".$s1[39]);
                        log::info("CD -> precio6: ".$s1[40]);
                        log::info("CD -> undmin: ".$s1[41]);
                        log::info("CD -> undmax: ".$s1[42]);
                        log::info("CD -> undmultiplo: ".$s1[43]);
                        log::info("CD -> cantpub: ".$s1[44]);
                        log::info("CD -> cantreal: ".$s1[45]);
                        log::info("CD -> manejalote: ".$s1[46]);
                        log::info("CD -> indevolutivo: ".$s1[47]);
                        log::info("CD -> codcolor: ".$s1[48]);
                        log::info("CD -> codtalla: ".$s1[49]);
                        log::info("CD -> psicotropico: ".$s1[50]);
                        log::info("CD -> clase: ".$s1[51]);
                        log::info("CD -> moneda: ".$s1[52]);
                        log::info("CD -> factorcambiario: ".$s1[53]);
                        log::info("CD -> refrigerado: ".$s1[54]);
                        log::info("CD -> FlagFactOM: ".$s1[55]);
                        log::info("CD -> dv: ".$s1[56]);
                        log::info("CD -> dvDetalle: ".$s1[57]);
                        $primero++;
                    }
                    $fechafalla = $s1[17];
                    if (strlen($fechafalla)<=10) {
                        $fechafalla = date("Y-m-d");
                    }
                    //log::info("fECHA FALLA: ".$fechafalla);
                    $barra = trim($s1[0]);
                    $prods[] = $barra;
                    $desprod = QuitarCaracteres($s1[2]);
                    $codprod = trim($s1[1]);
                    $precio1 = trim($s1[7]);
                    $precio2 = trim($s1[36]);
                    $precio3 = trim($s1[37]);
                    $precio4 = trim($s1[38]);
                    $precio5 = trim($s1[39]);
                    $precio6 = trim($s1[40]);
                    $dcredito = sRetornaPromDias($codprod, $codisb);
                    $da = trim($s1[10]);
                    $upre = trim($s1[13]);
                    $ppre = trim($s1[13]);
                    if (!is_numeric($upre)) {
                        $upre = 0;
                    }
                    if (!is_numeric($ppre)) {
                        $ppre = 0.00;
                    }
                    $undmin = "1";
                    $undmax = "99999999";
                    $undmultiplo = "0";
                    $cantpub = "0";
                    $indevolutivo = "0";
                    $psicotropico = "0";
                    $refrigerado = trim($s1[54]);
                    $clase = 'NORMAL';
                    $cuarentena = "0";
                    $SuperOFertaMincp = 0;

                    $prodcarext = DB::table('prodcarext')
                    ->where('codprod','=', $codprod)
                    ->where('codisb','=', $codisb)
                    ->first();
                    if ($prodcarext) {
                        $cuarentena = $prodcarext->cuarentena;
                        $undmin = $prodcarext->undmin;
                        $undmax = $prodcarext->undmax;
                        $undmultiplo = $prodcarext->undmultiplo;
                        $cantpub = $prodcarext->cantpub;
                        $indevolutivo = $prodcarext->indevolutivo;
                        $psicotropico = $prodcarext->psicotropico;
                        if ($refrigerado == 0)
                            $refrigerado = $prodcarext->refrigerado;
                        $clase = $prodcarext->clase;
                        $fechafalla_pce = $prodcarext->fechafalla;

                        if ($fechafalla_pce != "2000-01-01") {
                            // ANALIZA LA FECHAFALLA, PARA DETECTAR SI SALE DEL RANGO
                            // PARA SEGUIR SIENDO UNA ENTRADA RECIENTE
                            $fechax = strtotime('-'.$cfg->diasMaximoEntradas.' day', strtotime(date('Y-m-d')));
                            $desde = date('Y-m-d', $fechax);
                            if ($fechafalla_pce >= $desde) {
                                $fechafalla = $fechafalla_pce;
                                log::info("entro a entradas");
                            } else {
                                log::info("salio de entradas");
                            }
                        }
                    }
                    $prod = DB::table($tabla)
                    ->where('codprod','=', $codprod)
                    ->where('codisb','=', $codisb)
                    ->first();
                    if ($prod) {
                        try {
                            $cantidad = $s1[8];
                            $cantpub = $prod->cantpub;
                            if ($cantpub > 0) {
                                $cantidad = $cantpub;
                            }
                            DB::table($tabla)
                            ->where('codprod', '=', $codprod)
                            ->where('codisb', '=', $codisb)
                            ->update(array('barra' => trim($s1[0]),
                                           'desprod' => trim($desprod),
                                           'tipo' => trim($s1[3]),
                                           'iva' => trim($s1[4]),
                                           'regulado' => trim($s1[5]),
                                           'codprov' => trim($s1[6]),
                                           'precio1' => trim($precio1),
                                           'cantidad' => trim($cantidad),
                                           'original' => trim($s1[9]),
                                           'da' => trim($s1[10]),
                                           'oferta' => trim($s1[11]),
                                           'upre' => $upre,
                                           'ppre' => $ppre,
                                           'psugerido' => trim($s1[14]),
                                           'pgris' => trim($s1[15]),
                                           'nuevo' => "2",
                                           'fechafalla' => trim($fechafalla),
                                           'tipocatalogo' => trim($s1[18]),
                                           'cuarentena' => trim($cuarentena),
                                           'dctoneto' => trim($s1[20]),
                                           'lote' => trim($s1[21]),
                                           'fecvence' => trim($s1[22]),
                                           'marcamodelo' => QuitarCaracteres(trim($s1[23])),
                                           'pactivo' => QuitarCaracteres(trim($s1[24])),
                                           'costo' => trim($s1[25]),
                                           'ubicacion' => QuitarCaracteres(trim($s1[26])),
                                           'descorta' => QuitarCaracteres(trim($s1[27])),
                                           //'codisb' => $s1[28],
                                           'feccatalogo' => trim($s1[29]),
                                           'departamento' => trim($s1[30]),
                                           'grupo' => trim($s1[31]),
                                           'subgrupo' => trim($s1[32]),
                                           'opc1' => trim($s1[33]),
                                           'opc2' => trim($s1[34]),
                                           'opc3' => trim($s1[35]),
                                           'precio2' => trim($precio2),
                                           'precio3' => trim($precio3),
                                           'precio4' => trim($precio4),
                                           'precio5' => trim($precio5),
                                           'precio6' => trim($precio6),
                                           'undmin' => trim($undmin),
                                           'undmax' => trim($undmax),
                                           'undmultiplo' => trim($undmultiplo),
                                           'cantpub' => trim($cantpub),
                                           'cantreal' => trim($s1[45]),
                                           'manejalote' => trim($s1[46]),
                                           'indevolutivo' => trim($indevolutivo),
                                           'codcolor' => trim($s1[48]),
                                           'codtalla' => trim($s1[49]),
                                           'psicotropico' => trim($psicotropico),
                                           'clase' => trim($clase),
                                           'moneda' => trim($s1[52]),
                                           'factorcambiario' => trim($s1[53]),
                                           'refrigerado' => trim($refrigerado),
                                           'FlagFactOM' => trim($s1[55]),
                                           'dv' => trim($s1[56]),
                                           'dvDetalle' => trim($s1[57]),
                                           'SuperOFertaMincp' => trim($SuperOFertaMincp),
                                           'dcredito' => $dcredito
                                        ));
                        } catch (Exception $e) {
                            log::info("CD -> ERROR EN UPDATE CODPROD: ".$codprod. " - ".$e->getMessage());
                        }
                    } else {
                        try {
                            DB::table($tabla)->insert([
                                'barra' => trim($s1[0]),
                                'codprod' => trim($s1[1]),
                                'desprod' => trim($desprod),
                                'tipo' => trim($s1[3]),
                                'iva' => trim($s1[4]),
                                'regulado' => trim($s1[5]),
                                'codprov' => trim($s1[6]),
                                'precio1' => trim($precio1),
                                'cantidad' => trim($s1[8]),
                                'original' => trim($s1[9]),
                                'da' => trim($s1[10]),
                                'oferta' => trim($s1[11]),
                                'upre' => $upre,
                                'ppre' => $ppre,
                                'psugerido' => trim($s1[14]),
                                'pgris' => trim($s1[15]),
                                'nuevo' => "1",
                                'fechafalla' => trim($fechafalla),
                                'tipocatalogo' => trim($s1[18]),
                                'cuarentena' => trim($cuarentena),
                                'dctoneto' => trim($s1[20]),
                                'lote' => trim($s1[21]),
                                'fecvence' => trim($s1[22]),
                                'marcamodelo' => QuitarCaracteres(trim($s1[23])),
                                'pactivo' => QuitarCaracteres(trim($s1[24])),
                                'costo' => trim($s1[25]),
                                'ubicacion' => QuitarCaracteres(trim($s1[26])),
                                'descorta' => QuitarCaracteres(trim($s1[27])),
                                'codisb' => trim($codisb),
                                'feccatalogo' => trim($s1[29]),
                                'departamento' => trim($s1[30]),
                                'grupo' => trim($s1[31]),
                                'subgrupo' => trim($s1[32]),
                                'opc1' => trim($s1[33]),
                                'opc2' => trim($s1[34]),
                                'opc3' => trim($s1[35]),
                                'precio2' => trim($precio2),
                                'precio3' => trim($precio3),
                                'precio4' => trim($precio4),
                                'precio5' => trim($precio5),
                                'precio6' => trim($precio6),
                                'undmin' => trim($undmin),
                                'undmax' => trim($undmax),
                                'undmultiplo' => trim($undmultiplo),
                                'cantpub' => trim($cantpub),
                                'cantreal' => trim($s1[8]),
                                'manejalote' => trim($s1[46]),
                                'indevolutivo' => trim($indevolutivo),
                                'codcolor' => trim($s1[48]),
                                'codtalla' => trim($s1[49]),
                                'psicotropico' => trim($psicotropico),
                                'clase' => trim($clase),
                                'moneda' => trim($s1[52]),
                                'factorcambiario' => trim($s1[53]),
                                'refrigerado' => trim($refrigerado),
                                'FlagFactOM' => trim($s1[55]),
                                'dv' => trim($s1[56]),
                                'dvDetalle' => trim($s1[57]),
                                'SuperOFertaMincp' => trim($SuperOFertaMincp),
                                'dcredito' => $dcredito
                            ]);
                        } catch (Exception $e) {
                            log::info("CD -> ERROR EN INSERT CODPROD: ".$codprod. " - ".$e->getMessage());
                        }
                    }
                }
                @unlink($origen);
                @unlink($destino);
                DB::table($tabla)
                ->where('codisb','=', $codisb)
                ->where('nuevo','=','3')
                ->delete();
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
                ProcesarSuperOfertas($prods, $codisb);
            } catch (Exception $e) {
                log::info("CD -> ERROR (producto): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function ProcesarSuperOfertas($prods, $codisb) {
    if (count($prods) <= 0)
        return;
    $contador = 0;
    $cfg = DB::table('cfg')
    ->where('codisb','=', $codisb)
    ->first();
    if (empty($cfg->KeyMincp)  || $cfg->ActivarMincp == 0)
        return;
    $resp = Minicpcheck($cfg->KeyMincp);
    if ($resp == 1) {
        log::info("CD -> ACTIVO EL MINCP: ".$resp);
        if ($resp > 0 && $cfg->ActivarMincp > 0) {
            $retorno = MinicpV($cfg->KeyMincp, $prods, $cfg->diMincp, $cfg->ppMincp);
            if (is_null($retorno)) {
                $SuperOFertaMincp = 0;
                $msg = "disable";
            }
            else {
                $SuperOFertaMincp = 1;
                $msg = "enable";
            }
            for ($i = 0; $i < count($retorno); $i++) {
                $barra = $retorno[$i];
                if ($barra != "") {
                    DB::table('producto')
                    ->where('barra','=',$barra)
                    ->where('codisb','=', $codisb)
                    ->update(array('SuperOFertaMincp' => $SuperOFertaMincp));
                    $contador++;
                }
            }
            if ($contador > 0) {
                log::info("CD -> TOTAL SUPEROFERTA: ".$contador." -> ".$msg);
            }
        }
    } else {
        log::info("CD -> INACTIVO EL MINCP: ".$resp);
        DB::table('producto')->update(array('SuperOFertaMincp' => '0'));
    }
}
function cargarCliente($BASE_PATH, $codisb) {
    $tabla = 'cliente';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                DB::table($tabla)
                ->where('codisb','=', $codisb)
                ->update(array('nuevo' => '3'));
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    try {
                        $cont++;
                        $s1 = explode("|", $line);
                        if (count($s1) < 38) {
                            log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                            continue;
                        }
                        $usaprecio = $s1[30];
                        $canal = QuitarCaracteres($s1[13]);
                        $direccion = QuitarCaracteres($s1[3]);
                        $nombre = QuitarCaracteres($s1[1]);
                        $entrega = QuitarCaracteres($s1[4]);
                        $telefono = QuitarCaracteres($s1[5]);
                        $contacto = QuitarCaracteres($s1[6]);
                        $zona = QuitarCaracteres($s1[7]);
                        $rif = QuitarCaracteres($s1[2]);
                        $codcli = QuitarCaracteres($s1[0]);
                        $cadena = QuitarCaracteres($s1[18]);
                        $agenda = QuitarCaracteres($s1[19]);
                        $ruta = QuitarCaracteres($s1[21]);
                        $cb = QuitarCaracteres($s1[22]);
                        if ($usaprecio=="0")
                            $usaprecio="1";
                        if ($primero==0) {
                            log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                            log::info("CD -> codcli: ".$codcli);
                            log::info("CD -> nombre: ".$nombre);
                            log::info("CD -> rif: ".$rif);
                            log::info("CD -> direccion: ".$direccion);
                            log::info("CD -> entrega: ".$entrega);
                            log::info("CD -> telefono: ".$telefono);
                            log::info("CD -> contacto: ".$contacto);
                            log::info("CD -> zona: ".$zona);
                            log::info("CD -> usuario: ".$s1[8]);
                            log::info("CD -> clave: ".$s1[9]);
                            log::info("CD -> ppago: ".$s1[10]);
                            log::info("CD -> dcredito: ".$s1[11]);
                            log::info("CD -> estado: ".$s1[12]);
                            log::info("CD -> canal: ".$canal);
                            log::info("CD -> limite: ".$s1[14]);
                            log::info("CD -> tipo: ".$s1[15]);
                            log::info("CD -> dcorte: ".$s1[16]);
                            log::info("CD -> dcomercial: ".$s1[17]);
                            log::info("CD -> cadena: ".$cadena);
                            log::info("CD -> agenda: ".$agenda);
                            log::info("CD -> dinternet: ".$s1[20]);
                            log::info("CD -> ruta: ".$ruta);
                            log::info("CD -> cb: ".$cb);
                            log::info("CD -> especial: ".$s1[23]);
                            log::info("CD -> mpermiso: ".$s1[24]);
                            log::info("CD -> dotro: ".$s1[25]);
                            log::info("CD -> saldo: ".$s1[26]);
                            log::info("CD -> email: ".$s1[27]);
                            log::info("CD -> tipocatalogo: ".$s1[28]);
                            log::info("CD -> codisb: ".$s1[29]);
                            log::info("CD -> usaprecio: ".$usaprecio);
                            log::info("CD -> nuevo: ".$s1[31]);
                            log::info("CD -> vencido: ".$s1[32]);
                            log::info("CD -> saldoDs: ".$s1[33]);
                            log::info("CD -> vencidoDs: ".$s1[34]);
                            log::info("CD -> limiteDs: ".$s1[35]);
                            log::info("CD -> critSepMoneda: ".$s1[36]);
                            log::info("CD -> DctoPreferencial: ".$s1[37]);
                            log::info("CD -> codisbactivo: ".$s1[38]);
                            $primero++;
                        }
                        $reg = DB::table($tabla)
                        ->where('codcli','=', $codcli)
                        ->where('codisb','=', $codisb)
                        ->first();
                        if ($reg) {
                            DB::table($tabla)
                            ->where('codcli', '=', $codcli)
                            ->where('codisb','=', $codisb)
                            ->update(array('nombre' => $nombre,
                                           'rif' => $rif,
                                           'direccion' => $direccion,
                                           'entrega' => $entrega,
                                           'telefono' => $telefono,
                                           'contacto' => $contacto,
                                           'zona' => $zona,
                                           'usuario' => trim($s1[8]),
                                           'clave' => trim($s1[9]),
                                           'ppago' => trim($s1[10]),
                                           'dcredito' => trim($s1[11]),
                                           //'estado' => $s1[12],
                                           'canal' => $canal,
                                           'limite' => trim($s1[14]),
                                           'tipo' => trim($s1[15]),
                                           'dcorte' => trim($s1[16]),
                                           'dcomercial' => trim($s1[17]),
                                           'cadena' => $cadena,
                                           'agenda' => $agenda,
                                           'dinternet' => trim($s1[20]),
                                           'ruta' => $ruta,
                                           'cb' => $cb,
                                           'especial' => trim($s1[23]),
                                           'mpermiso' => trim($s1[24]),
                                           'dotro' => trim($s1[25]),
                                           'saldo' => trim($s1[26]),
                                           'email' => trim($s1[27]),
                                           'tipocatalogo' => trim($s1[28]),
                                           //'codisb' => $s1[29],
                                           'usaprecio' => $usaprecio,
                                           'nuevo' => '2',
                                           'vencido' => trim($s1[32]),
                                           'saldoDs' => trim($s1[33]),
                                           'vencidoDs' => trim($s1[34]),
                                           'limiteDs' => trim($s1[35]),
                                           //'critSepMoneda' => $s1[36],
                                           'DctoPreferencial' => trim($s1[37])
                            ));
                        } else {
                            DB::table($tabla)->insert([
                                'codcli' => $codcli,
                                'nombre' => $nombre,
                                'rif' => $rif,
                                'direccion' => $direccion,
                                'entrega' => $entrega,
                                'telefono' => $telefono,
                                'contacto' => $contacto,
                                'zona' => $zona,
                                'usuario' => trim($s1[8]),
                                'clave' => trim($s1[9]),
                                'ppago' => trim($s1[10]),
                                'dcredito' => trim($s1[11]),
                                'estado' => 'ACTIVO',
                                'canal' => $canal,
                                'limite' => trim($s1[14]),
                                'tipo' => trim($s1[15]),
                                'dcorte' => trim($s1[16]),
                                'dcomercial' => trim($s1[17]),
                                'cadena' => $cadena,
                                'agenda' => $agenda,
                                'dinternet' => trim($s1[20]),
                                'ruta' => $ruta,
                                'cb' => $cb,
                                'especial' => trim($s1[23]),
                                'mpermiso' => trim($s1[24]),
                                'dotro' => trim($s1[25]),
                                'saldo' => trim($s1[26]),
                                'email' => trim($s1[27]),
                                'tipocatalogo' => trim($s1[28]),
                                'codisb' => $codisb,
                                'usaprecio' => $usaprecio,
                                'nuevo' => '1',
                                'vencido' => trim($s1[32]),
                                'saldoDs' => trim($s1[33]),
                                'vencidoDs' => trim($s1[34]),
                                'limiteDs' => trim($s1[35]),
                                'critSepMoneda' => trim($s1[36]),
                                'DctoPreferencial' => trim($s1[37]),
                                'codisbactivo' => 1
                            ]);
                        }
                    } catch (Exception $e) {
                        log::info("CD -> CODCLI: ".$codcli." - ".$e->getMessage());
                    }
                }
                DB::table($tabla)
                ->where('codisb','=', $codisb)
                ->where('nuevo','=','3')
                ->delete();
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (cliente): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarProveedor($BASE_PATH, $codisb) {
    $tabla = 'proveedor';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                DB::raw('lock tables '.$tabla.' write');
                // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();

                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $s1 = explode("|", $line);
                    if (count($s1) <> 15) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    $codprov = $s1[0];
                    if ($primero==0) {

                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        //0     1                     2 3 4 5 6      7 8 9    10        11   12
                        //_0000|PROVEEDOR POR DEFINIR|0| | | |ACTIVO| |0|0.00|293936411|0.00|0.00|
                        log::info("CD -> codprov: ".$codprov);
                        log::info("CD -> nombre: ".$s1[1]);
                        log::info("CD -> rif: ".$s1[2]);
                        log::info("CD -> direccion: ".$s1[3]);
                        log::info("CD -> telefono: ".$s1[4]);
                        log::info("CD -> contacto: ".$s1[5]);
                        log::info("CD -> estado: ".$s1[6]);
                        log::info("CD -> email: ".$s1[7]);
                        log::info("CD -> diascred: ".$s1[8]);
                        log::info("CD -> saldo: ".$s1[9]);
                        log::info("CD -> codisb: ".$s1[10]);
                        log::info("CD -> vencido: ".$s1[11]);
                        log::info("CD -> saldoDs: ".$s1[12]);
                        log::info("CD -> vencidoDs: ".$s1[13]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                        'codprov' => QuitarCaracteres(trim($s1[0])),
                        'nombre' => QuitarCaracteres(trim($s1[1])),
                        'rif' => trim($s1[2]),
                        'direccion' => QuitarCaracteres(trim($s1[3])),
                        'telefono' => QuitarCaracteres(trim($s1[4])),
                        'contacto' => QuitarCaracteres(trim($s1[5])),
                        'estado' => QuitarCaracteres(trim($s1[6])),
                        'email' => trim($s1[7]),
                        'diascred' => QuitarCaracteres(trim($s1[8])),
                        'saldo' => trim($s1[9]),
                        'codisb' => $codisb,
                        'vencido' => trim($s1[11]),
                        'saldoDs' => trim($s1[12]),
                        'vencidoDs' => trim($s1[13])
                    ]);
                }
                DB::raw('unlock tables');
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (proveedor): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarFact($BASE_PATH, $codisb) {
    $tabla = 'fact';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                $modo = "INICIAL";
                $lines = file($destino);
                foreach($lines as $line) {
                    if ($line == "UPDATE") {
                        $modo = trim($line);
                        break;
                    }
                }
                if ($modo == "INICIAL") {
                    // DELETE DE LOS REGISTRO
                    $reg = DB::table($tabla)
                    ->where('codisb', '=', $codisb)
                    ->delete();
                    log::info("CD -> TABLA FACT: DELETE ALL (".$modo.")");
                }
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                log::info("CD -> MODO: ".$modo);
                $cont = 0;
                foreach($lines as $line) {
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 22) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    $factnum = trim($s1[0]);
                    $descrip = QuitarCaracteres($s1[3]);
                    $observacion = QuitarCaracteres($s1[17]);
                    $cont++;
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> factnum: ".$s1[0]);
                        log::info("CD -> fecha: ".$s1[1]);
                        log::info("CD -> codcli: ".$s1[2]);
                        log::info("CD -> descrip: ".$descrip);
                        log::info("CD -> monto: ".$s1[4]);
                        log::info("CD -> iva: ".$s1[5]);
                        log::info("CD -> gravable: ".$s1[6]);
                        log::info("CD -> descuento: ".$s1[7]);
                        log::info("CD -> total: ".$s1[8]);
                        log::info("CD -> tipofac: ".$s1[9]);
                        log::info("CD -> codesta: ".$s1[10]);
                        log::info("CD -> codusua: ".$s1[11]);
                        log::info("CD -> codvend: ".$s1[12]);
                        log::info("CD -> fechav: ".$s1[13]);
                        log::info("CD -> nroctrol: ".$s1[14]);
                        log::info("CD -> rif: ".$s1[15]);
                        log::info("CD -> codisb: ".$s1[16]);
                        log::info("CD -> observacion: ".$observacion);
                        log::info("CD -> codmoneda: ".$s1[18]);
                        log::info("CD -> factorcambiario: ".$s1[19]);
                        log::info("CD -> origen: ".$s1[20]);
                        $primero++;
                    }
                    if ($modo == "INICIAL") {
                        DB::table($tabla)->insert([
                            'factnum' => $factnum,
                            'fecha' => trim($s1[1]),
                            'codcli' => trim($s1[2]),
                            'descrip' => $descrip,
                            'monto' => trim($s1[4]),
                            'iva' => trim($s1[5]),
                            'gravable' => trim($s1[6]),
                            'descuento' => trim($s1[7]),
                            'total' => trim($s1[8]),
                            'tipofac' => trim($s1[9]),
                            'codesta' => trim($s1[10]),
                            'codusua' => trim($s1[11]),
                            'codvend' => trim($s1[12]),
                            'fechav' => trim($s1[13]),
                            'nroctrol' => trim($s1[14]),
                            'rif' => trim($s1[15]),
                            'codisb' => $codisb,
                            'observacion' => $observacion,
                            'codmoneda' => trim($s1[18]),
                            'factorcambiario' => trim($s1[19]),
                            'origen' => trim($s1[20])
                        ]);
                    } else {
                        $fact = DB::table($tabla)
                        ->where('factnum','=', $factnum)
                        ->where('codisb','=', $codisb)
                        ->first();
                        if ($fact) {
                            DB::table($tabla)
                            ->where('factnum', '=', $factnum)
                            ->where('codisb', '=', $codisb)
                            ->update(array("fecha" => $fecha,
                                'codcli' => trim($s1[2]),
                                'descrip' => $descrip,
                                'monto' => trim($s1[4]),
                                'iva' => trim($s1[5]),
                                'gravable' => trim($s1[6]),
                                'descuento' => trim($s1[7]),
                                'total' => trim($s1[8]),
                                'tipofac' => trim($s1[9]),
                                'codesta' => trim($s1[10]),
                                'codusua' => trim($s1[11]),
                                'codvend' => trim($s1[12]),
                                'fechav' => trim($s1[13]),
                                'nroctrol' => trim($s1[14]),
                                'rif' => trim($s1[15]),
                                'observacion' => $observacion,
                                'codmoneda' => trim($s1[18]),
                                'factorcambiario' => trim($s1[19]),
                                'origen' => trim($s1[20])
                            ));
                        } else {
                            DB::table($tabla)->insert([
                                'factnum' => $factnum,
                                'fecha' => trim($s1[1]),
                                'codcli' => trim($s1[2]),
                                'descrip' => $descrip,
                                'monto' => trim($s1[4]),
                                'iva' => trim($s1[5]),
                                'gravable' => trim($s1[6]),
                                'descuento' => trim($s1[7]),
                                'total' => trim($s1[8]),
                                'tipofac' => trim($s1[9]),
                                'codesta' => trim($s1[10]),
                                'codusua' => trim($s1[11]),
                                'codvend' => trim($s1[12]),
                                'fechav' => trim($s1[13]),
                                'nroctrol' => trim($s1[14]),
                                'rif' => trim($s1[15]),
                                'codisb' => $codisb,
                                'observacion' => $observacion,
                                'codmoneda' => trim($s1[18]),
                                'factorcambiario' => trim($s1[19]),
                                'origen' => trim($s1[20])
                            ]);
                        }
                    }
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (fact): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarFactRen($BASE_PATH, $codisb) {
    $tabla = 'factren';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                $lines = file($destino);
                $modo = "INICIAL";
                $lines = file($destino);
                foreach($lines as $line) {
                    if ($line == "UPDATE") {
                        $modo = trim($line);
                        break;
                    }
                }
                if ($modo == "INICIAL") {
                    // DELETE DE LOS REGISTRO
                    $reg = DB::table($tabla)
                    ->where('codisb', '=', $codisb)
                    ->delete();
                    log::info("CD -> TABLA FACTREN: DELETE ALL (".$modo.")");
                }
                log::info("CD -> MODO: ".$modo);
                $cont = 0;
                foreach($lines as $line) {
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 17) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    $factnum = trim($s1[0]);
                    $desprod = QuitarCaracteres($s1[3]);
                    $cont++;
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> factnum: ".$factnum);
                        log::info("CD -> codprod: ".$s1[1]);
                        log::info("CD -> renglon: ".$s1[2]);
                        log::info("CD -> desprod: ".$desprod);
                        log::info("CD -> referencia: ".$s1[4]);
                        log::info("CD -> cantidad: ".$s1[5]);
                        log::info("CD -> precio: ".$s1[6]);
                        log::info("CD -> subtotal: ".$s1[7]);
                        log::info("CD -> impuesto: ".$s1[8]);
                        log::info("CD -> descto: ".$s1[9]);
                        log::info("CD -> nrolote: ".$s1[10]);
                        log::info("CD -> fechal: ".$s1[11]);
                        log::info("CD -> fecfactura: ".$s1[12]);
                        log::info("CD -> codisb: ".$s1[13]);
                        log::info("CD -> codprov: ".$s1[14]);
                        log::info("CD -> marca: ".$s1[15]);
                        $primero++;
                    }
                    if ($modo == "INICIAL") {
                        DB::table($tabla)->insert([
                            'factnum' => $factnum,
                            'codprod' => trim($s1[1]),
                            'renglon' => trim($s1[2]),
                            'desprod' => $desprod,
                            'referencia' => trim($s1[4]),
                            'cantidad' => trim($s1[5]),
                            'precio' => trim($s1[6]),
                            'subtotal' => trim($s1[7]),
                            'impuesto' => trim($s1[8]),
                            'descto' => trim($s1[9]),
                            'nrolote' => trim($s1[10]),
                            'fechal' => trim($s1[11]),
                            'fecfactura' => trim($s1[12]),
                            'codisb' => $codisb,
                            'codprov' => trim($s1[14]),
                            'marca' => trim($s1[15])
                        ]);
                    } else {
                        $codprod = trim($s1[1]);
                        $renglon = trim($s1[2]);
                        $factren = DB::table($tabla)
                        ->where('factnum','=', $factnum)
                        ->where('codprod','=', $codprod)
                        ->where('renglon','=', $renglon)
                        ->where('codisb','=', $codisb)
                        ->first();
                        if ($factren) {
                            DB::table($tabla)
                            ->where('factnum','=', $factnum)
                            ->where('codprod','=', $codprod)
                            ->where('renglon','=', $renglon)
                            ->where('codisb','=', $codisb)
                            ->update(array('desprod' => $desprod,
                                'referencia' => trim($s1[4]),
                                'cantidad' => trim($s1[5]),
                                'precio' => trim($s1[6]),
                                'subtotal' => trim($s1[7]),
                                'impuesto' => trim($s1[8]),
                                'descto' => trim($s1[9]),
                                'nrolote' => trim($s1[10]),
                                'fechal' => trim($s1[11]),
                                'fecfactura' => trim($s1[12]),
                                'codprov' => trim($s1[14]),
                                'marca' => trim($s1[15])
                            ));
                        } else {
                            DB::table($tabla)->insert([
                                'factnum' => $factnum,
                                'codprod' => $codprod,
                                'renglon' => $renglon,
                                'desprod' => $desprod,
                                'referencia' => trim($s1[4]),
                                'cantidad' => trim($s1[5]),
                                'precio' => trim($s1[6]),
                                'subtotal' => trim($s1[7]),
                                'impuesto' => trim($s1[8]),
                                'descto' => trim($s1[9]),
                                'nrolote' => trim($s1[10]),
                                'fechal' => trim($s1[11]),
                                'fecfactura' => trim($s1[12]),
                                'codisb' => $codisb,
                                'codprov' => trim($s1[14]),
                                'marca' => trim($s1[15])
                            ]);
                        }

                    }
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (factren): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarCxc($BASE_PATH, $codisb) {
    $tabla = 'cxc';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 20) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    $numerod = trim($s1[4]);
                    $numerod = str_replace( '-', '', $numerod);
                    $numerod = str_replace( '/', '', $numerod);
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> codcli: ".$s1[0]);
                        log::info("CD -> fechai: ".$s1[1]);
                        log::info("CD -> codesta: ".$s1[2]);
                        log::info("CD -> codusua: ".$s1[3]);
                        log::info("CD -> numerod: ".$numerod);
                        log::info("CD -> tipocxc: ".$s1[5]);
                        log::info("CD -> monto: ".$s1[6]);
                        log::info("CD -> montoneto: ".$s1[7]);
                        log::info("CD -> mtotax: ".$s1[8]);
                        log::info("CD -> saldo: ".$s1[9]);
                        log::info("CD -> nroctrol: ".$s1[10]);
                        log::info("CD -> notas1: ".$s1[11]);
                        log::info("CD -> descrip: ".$s1[12]);
                        log::info("CD -> codisb: ".$s1[13]);
                        log::info("CD -> codmoneda: ".$s1[14]);
                        log::info("CD -> factorcambiario: ".$s1[15]);
                        log::info("CD -> fecha: ".$s1[16]);
                        log::info("CD -> saldoDs: ".$s1[17]);
                        log::info("CD -> id: ".$s1[18]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                         'codcli' => trim($s1[0]),
                         'fechai' => trim($s1[1]),
                         'codesta' => trim($s1[2]),
                         'codusua' => trim($s1[3]),
                         'numerod' => $numerod,
                         'tipocxc' => trim($s1[5]),
                         'monto' => trim($s1[6]),
                         'montoneto' => trim($s1[7]),
                         'mtotax' => trim($s1[8]),
                         'saldo' => trim($s1[9]),
                         'nroctrol' => QuitarCaracteres(trim($s1[10])),
                         'notas1' => QuitarCaracteres(trim($s1[11])),
                         'descrip' => QuitarCaracteres(trim($s1[12])),
                         'codisb' => $codisb,
                         'codmoneda' => trim($s1[14]),
                         'factorcambiario' => trim($s1[15]),
                         'fecha' => trim($s1[16]),
                         'saldoDs' => trim($s1[17]),
                         'id' => trim($s1[18])
                    ]);
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (cxc): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarCxp($BASE_PATH, $codisb) {
    $tabla = 'cxp';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 20) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    $numerod = trim($s1[4]);
                    $numerod = str_replace( '-', '', $numerod);
                    $numerod = str_replace( '/', '', $numerod);
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> codprov: ".$s1[0]);
                        log::info("CD -> fechai: ".$s1[1]);
                        log::info("CD -> codesta: ".$s1[2]);
                        log::info("CD -> codusua: ".$s1[3]);
                        log::info("CD -> numerod: ".$numerod);
                        log::info("CD -> tipocxp: ".$s1[5]);
                        log::info("CD -> monto: ".$s1[6]);
                        log::info("CD -> montoneto: ".$s1[7]);
                        log::info("CD -> mtotax: ".$s1[8]);
                        log::info("CD -> saldo: ".$s1[9]);
                        log::info("CD -> nroctrol: ".$s1[10]);
                        log::info("CD -> notas1: ".$s1[11]);
                        log::info("CD -> descrip: ".$s1[12]);
                        log::info("CD -> codisb: ".$s1[13]);
                        log::info("CD -> codmoneda: ".$s1[14]);
                        log::info("CD -> factorcambiario: ".$s1[15]);
                        log::info("CD -> fecha: ".$s1[16]);
                        log::info("CD -> saldoDs: ".$s1[17]);
                        log::info("CD -> id: ".$s1[18]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                        'codprov' => trim($s1[0]),
                        'fechai' => trim($s1[1]),
                        'codesta' => trim($s1[2]),
                        'codusua' => trim($s1[3]),
                        'numerod' => $numerod,
                        'tipocxp' => trim($s1[5]),
                        'monto' => trim($s1[6]),
                        'montoneto' => trim($s1[7]),
                        'mtotax' => trim($s1[8]),
                        'saldo' => trim($s1[9]),
                        'nroctrol' => QuitarCaracteres(trim($s1[10])),
                        'notas1' => QuitarCaracteres(trim($s1[11])),
                        'descrip' => QuitarCaracteres(trim($s1[12])),
                        'codisb' =>  $codisb,
                        'codmoneda' => trim($s1[14]),
                        'factorcambiario' => trim($s1[15]),
                        'fecha' => trim($s1[16]),
                        'saldoDs' => trim($s1[17]),
                        'id' => trim($s1[18])
                    ]);
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (cxp): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarCtabanco($BASE_PATH, $codisb) {
    $tabla = 'ctabanco';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                $modo = "INICIAL";
                $lines = file($destino);
                foreach($lines as $line) {
                    if ($line == "UPDATE") {
                        $modo = trim($line);
                        break;
                    }
                }
                if ($modo == "INICIAL") {
                    // DELETE DE LOS REGISTRO
                    $reg = DB::table($tabla)
                    ->where('codisb', '=', $codisb)
                    ->delete();
                    log::info("CD -> TABLA CTABANCO: DELETE ALL (".$modo.")");
                } else {
                    DB::table($tabla)
                    ->where('codisb', '=', $codisb)
                    ->update(array('nuevo' => '3'));
                }
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> co_cta: ".$s1[0]);
                        log::info("CD -> co_banco: ".$s1[1]);
                        log::info("CD -> num_cuenta: ".$s1[2]);
                        log::info("CD -> codisb: ".$s1[3]);
                        $primero++;
                    }
                    $co_cta = trim($s1[0]);
                    $reg = DB::table($tabla)
                    ->where('co_cta','=', $co_cta)
                    ->where('codisb', '=', $codisb)
                    ->first();
                    if ($reg) {
                        DB::table($tabla)
                        ->where('co_cta', '=', $co_cta)
                        ->where('codisb', '=', $codisb)
                        ->update(array('co_banco' => $s1[1],
                                       'num_cuenta' => $s1[2],
                                       'nuevo' => '2'
                        ));
                    } else {
                        DB::table($tabla)->insert([
                            'co_cta' => trim($s1[0]),
                            'co_banco' => trim($s1[1]),
                            'num_cuenta' => trim($s1[2]),
                            'codisb' => $codisb,
                            'nuevo' => '1'
                        ]);
                    }
                }
                if ($modo == "UPDATE") {
                    DB::table($tabla)
                    ->where('codisb', '=', $codisb)
                    ->where('nuevo','=','3')
                    ->delete();
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (ctabanco): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarVendedor($BASE_PATH, $codisb) {
    $tabla = 'vendedor';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $line = trim($line);
                    $cont++;
                    $s1 = explode("|", $line);
                    if (count($s1) <> 6) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> codigo: ".$s1[0]);
                        log::info("CD -> nombre: ".$s1[1]);
                        log::info("CD -> tipo: ".$s1[2]);
                        log::info("CD -> supervisor: ".$s1[3]);
                        log::info("CD -> codisb: ".$s1[4]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                        'codigo' => trim($s1[0]),
                        'nombre' => QuitarCaracteres(trim($s1[1])),
                        'tipo' => trim($s1[2]),
                        'supervisor' => trim($s1[3]),
                        'codisb' => $codisb
                    ]);
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (vendedor): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarCategoria($BASE_PATH, $codisb) {
    $tabla = 'categoria';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $line = trim($line);
                    $cont++;
                    $s1 = explode("|", $line);
                    if (count($s1) <> 4) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> codigo: ".$s1[0]);
                        log::info("CD -> nombre: ".$s1[1]);
                        log::info("CD -> codisb: ".$s1[2]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                        'codcat' => trim($s1[0]),
                        'nomcat' => QuitarCaracteres(trim($s1[1])),
                        'codisb' => $codisb
                    ]);
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (categoria): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarLotes($BASE_PATH, $codisb) {
    $tabla = 'lotes';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                // DELETE DE LOS REGISTRO
                //$reg = DB::table($tabla)->delete();
                DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->update(array('nuevo' => '3'));
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 11) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    $cantidad = $s1[6];
                    if (str_contains($cantidad, '.')) {
                        $s2 = explode(".", $cantidad);
                        $cantidad = $s2[0];
                    }
                    if ($cantidad<=0) {
                        continue;
                    }
                    $feclote = str_replace('12:00:00 AM', '', $s1[4]);
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> codpadre: ".$s1[0]);
                        log::info("CD -> codhijo: ".$s1[1]);
                        log::info("CD -> desprod: ".$s1[2]);
                        log::info("CD -> lote: ".$s1[3]);
                        log::info("CD -> feclote: ".$feclote);
                        log::info("CD -> deposito: ".$s1[5]);
                        log::info("CD -> cantidad: ".$cantidad);
                        log::info("CD -> codisb: ".$s1[7]);
                        log::info("CD -> nuevo: ".$s1[8]);
                        log::info("CD -> id: ".$s1[9]);
                        $primero++;
                    }
                    $codpadre = trim($s1[0]);
                    $codhijo = trim($s1[1]);
                    $lote = trim($s1[3]);
                    $reg = DB::table($tabla)
                    ->where('codpadre','=', $codpadre)
                    ->where('codhijo','=', $codhijo)
                    ->where('lote','=', $lote)
                    ->where('codisb', '=', $codisb)
                    ->first();
                    if ($reg) {
                        DB::table($tabla)
                        ->where('codpadre','=', $codpadre)
                        ->where('codhijo','=', $codhijo)
                        ->where('lote','=', $lote)
                        ->where('codisb', '=', $codisb)
                        ->update(array('desprod' => QuitarCaracteres(trim($s1[2])),
                                       'feclote' => $feclote,
                                       'deposito' => QuitarCaracteres(trim($s1[5])),
                                       'cantidad' => $cantidad,
                                       'id' => trim($s1[9]),
                                       'nuevo'  => '2'
                        ));
                    } else {
                        DB::table($tabla)->insert([
                            'codpadre' => trim($s1[0]),
                            'codhijo'  => trim($s1[1]),
                            'desprod'  => QuitarCaracteres(trim($s1[2])),
                            'lote'  => trim($s1[3]),
                            'feclote'  => $feclote,
                            'deposito'  => QuitarCaracteres(trim($s1[5])),
                            'cantidad'  => $cantidad,
                            'codisb'  => $codisb,
                            'id' => trim($s1[8]),
                            'nuevo'  => '1'
                        ]);
                    }
                }
                @unlink($origen);
                @unlink($destino);
                DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->where('nuevo','=','3')
                ->delete();
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (lotes): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarMonedas($BASE_PATH, $codisb) {
    $tabla = 'monedas';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 7) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> codigo: ".$s1[0]);
                        log::info("CD -> descrip: ".$s1[1]);
                        log::info("CD -> factor: ".$s1[2]);
                        log::info("CD -> pref: ".$s1[3]);
                        log::info("CD -> simbolo: ".$s1[4]);
                        log::info("CD -> codisb: ".$s1[5]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                        'codigo' => trim($s1[0]),
                        'descrip' => QuitarCaracteres(trim($s1[1])),
                        'factor' => trim($s1[2]),
                        'pref' => trim($s1[3]),
                        'simbolo' => trim($s1[4]),
                        'codisb' => $codisb
                    ]);
                }
                DB::raw('unlock tables');
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (monedas): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarProdFalla($BASE_PATH, $codisb) {
    $tabla = 'prodfalla';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $line = trim($line);
                    $cont++;
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 7) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    if ($primero==0) {
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> barra: ".$s1[0]);
                        log::info("CD -> codprod: ".$s1[1]);
                        log::info("CD -> desprod: ".$s1[2]);
                        log::info("CD -> marcamodelo: ".$s1[3]);
                        log::info("CD -> pactivo: ".$s1[4]);
                        log::info("CD -> codisb: ".$s1[5]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                        'barra' => trim($s1[0]),
                        'codprod' => trim($s1[1]),
                        'desprod' => QuitarCaracteres(trim($s1[2])),
                        'marcamodelo' => QuitarCaracteres(trim($s1[3])),
                        'pactivo' => QuitarCaracteres(trim($s1[4])),
                        'codisb' => $codisb
                    ]);
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (prodfallas): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarCestas($BASE_PATH, $codisb) {
    $tabla = 'cestas';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
               // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 13) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    $revisada_fa = $s1[2];
                    if ($revisada_fa == "T")
                        $revisada_fa = "1";
                    else
                        $revisada_fa = "0";
                    $despachada = $s1[3];
                    if ($despachada == "T")
                        $despachada = "1";
                    else
                        $despachada = "0";
                    $devuelta = $s1[5];
                    if ($devuelta == "T")
                        $devuelta = "1";
                    else
                        $devuelta = "0";

                    $fecha_dev = trim($s1[6]);
                    if ($fecha_dev || $fecha_dev = '/  /')
                        $fecha_dev = date('Y-m-d',strtotime('01/01/1999'));
                    $fecha_rec = trim($s1[9]);
                    if ($fecha_rec || $fecha_rec = '/  /')
                        $fecha_rec = date('Y-m-d',strtotime('01/01/1999'));
                    if ($primero==0) {
                        // PEDIDO_NUM, CESTA_CO, REVISADA_FA, DESPACHADA, GUIA_NRO
                        // DEVUELTA, FECHA_DEV, NOTAEN_NUM, RECIDE_NUM, FECHA_REC
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> pedido_num: ".$s1[0]);
                        log::info("CD -> cesta_co: ".$s1[1]);
                        log::info("CD -> revisada_fa: ".$revisada_fa);
                        log::info("CD -> despachada: ".$despachada);
                        log::info("CD -> guia_nro: ".$s1[4]);
                        log::info("CD -> devuelta: ".$devuelta);
                        log::info("CD -> fecha_dev: ".$fecha_dev);
                        log::info("CD -> notaen_num: ".$s1[7]);
                        log::info("CD -> recibe_num: ".$s1[8]);
                        log::info("CD -> fecha_rec: ".$fecha_rec);
                        log::info("CD -> co_cli: ".$s1[10]);
                        log::info("CD -> codisb: ".$s1[11]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                        'pedido_num' => trim($s1[0]),
                        'cesta_co' => trim($s1[1]),
                        'revisada_fa' => $revisada_fa,
                        'despachada' => $despachada,
                        'guia_nro' => trim($s1[4]),
                        'devuelta' => $devuelta,
                        'fecha_dev' => $fecha_dev,
                        'notaen_num' => trim($s1[7]),
                        'recibe_num' => trim($s1[8]),
                        'fecha_rec' => $fecha_rec,
                        'co_cli' => trim($s1[10]),
                        'codisb' => $codisb
                    ]);
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (cestas): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function cargarChoferes($BASE_PATH, $codisb) {
    $tabla = 'choferes';
    $origen = $BASE_PATH.'/'.$tabla.'.txt.zip';
    $destino = $BASE_PATH.'/'.$tabla.'.txt';
    $primero = 0;
    if (is_readable($origen)) {
        if (Descomprimir($origen, $destino)) {
            log::info("");
            log::info("CD -> Tabla: ".$tabla.' ***************************************');
            try {
                // DELETE DE LOS REGISTRO
                $reg = DB::table($tabla)
                ->where('codisb', '=', $codisb)
                ->delete();
                // CARGO EL ARCHIVO TXT EN UN ARREGLO
                $cont = 0;
                $lines = file($destino);
                foreach($lines as $line) {
                    $cont++;
                    $line = trim($line);
                    $s1 = explode("|", $line);
                    if (count($s1) == 1)
                        continue;
                    if (count($s1) <> 6) {
                        log::info("CD -> ERROR: s1(".$tabla."): ".count($s1).' line: '.$line);
                        continue;
                    }
                    if ($primero==0) {
                        //empresa_co, chof_co, chof_nom, chof_ced, chof_tipo  CHOFERES
                        log::info("CD -> s1(".$tabla."): ".count($s1).' line: '.$line);
                        log::info("CD -> chof_co: ".$s1[0]);
                        log::info("CD -> chof_nom: ".$s1[1]);
                        log::info("CD -> chof_ced: ".$s1[2]);
                        log::info("CD -> chof_tipo: ".$s1[3]);
                        log::info("CD -> codisb: ".$s1[4]);
                        $primero++;
                    }
                    DB::table($tabla)->insert([
                        'chof_co' => trim($s1[0]),
                        'chof_nom' => trim($s1[1]),
                        'chof_ced' => trim($s1[2]),
                        'chof_tipo' => trim($s1[3]),
                        'codisb' => $codisb
                    ]);
                }
                @unlink($origen);
                @unlink($destino);
                log::info("CD -> Finalizo OK (".$tabla."), ".$cont." registros");
            } catch (Exception $e) {
                log::info("CD -> ERROR (Choferes): ".$e->getMessage());
            }
        } else {
            log::info("CD -> ERROR AL DESCOMPRIMIR: ".$tabla);
        }
    } else {
        log::info("CD -> NO ENCONTRADO: ".$tabla);
    }
}
function Descomprimir($origen, $destino) {
    $resp = FALSE;
    $x = 0;
    while ($x < 3) {
        if ( function_exists('gzwrite') ) {
            if (file_exists($origen)) {
                try {
                    $string = implode("", gzfile($origen));
                    $fp = fopen($destino, "w");
                    fwrite($fp, $string, strlen($string));
                    fclose($fp);
                    $resp = TRUE;
                    break;
                }  catch (Exception $e) {
                    log::info("CD -> ERROR (Descomprimir): ".$e->getMessage());
                }
            }
            $x++;
        }
    }
    return $resp;
}
function Comprimir($origen, $destino) {
    $resp = FALSE;
    $x = 0;
    while ($x < 3) {
        if (file_exists($origen)) {
            try {
                $fp = fopen($origen, "r");
                $data = fread ($fp, filesize($origen));
                fclose($fp);
                $zp = gzopen($destino, "w9");
                gzwrite($zp, $data);
                gzclose($zp);
                $resp = TRUE;
                break;
            }  catch (Exception $e) {
                log::info("CD -> ERROR (Comprimir): ".$e->getMessage());
            }
        }
        $x++;
    }
    return $resp;
}
function VerificarCarrito($codprod) {
    $resp = FALSE;
    $codcli = sCodigoClienteActivo();
    $id = iIdUltPedAbierto($codcli);
    if ( $id > 0) {
        $pr = DB::table('pedren')
        ->where('id','=', $id)
        ->where('codprod','=', $codprod)
        ->first();
        if ($pr) {
            $resp = TRUE;
        }
    }
    return $resp;
}
function VerificarProdFallaAlerta($codprod) {
    $resp = FALSE;
    $codcli = sCodigoClienteActivo();
    //log::info("CAMPO ".$codprod);
    $reg = DB::table('prodfallaalerta')
    ->where('codcli','=', $codcli)
    ->where('codprod','=', $codprod)
    ->first();
    if ($reg)
        $resp = TRUE;
    //log::info("CAMPO ".$resp);
    return $resp;
}
function iContadorNotiCliente() {
    $resp = 0;
    $codcli = sCodigoClienteActivo();
    $reg = DB::table('notientradas')
    ->selectRaw('count(*) as contador')
    ->where('destino','=', $codcli)
    ->where('envio','=', 1)
    ->where('leido','=', 0)
    ->first();
    if ($reg)
        $resp = $reg->contador;
    return $resp;
}
function iContadorNotiServidor() {
    $resp = 0;
    $cfg = DB::table('cfg')->first();
    $reg = DB::table('notientradas')
    ->selectRaw('count(*) as contador')
    ->where('destino','=', $cfg->codisb)
    ->where('envio','=', 1)
    ->where('leido','=', 0)
    ->first();
    if ($reg)
        $resp = $reg->contador;
    return $resp;
}
function BuscarMejorPrecio($barra, $provs, $dinternet, $ppago) {
    set_time_limit(500);
    $retorno = null;
    $contren = 0;
    $tpmaestra = DB::table('tpmaestra')
    ->where('barra','=',$barra)
    ->first();
    if (!empty($tpmaestra)) {
        for ($i = 0; $i < count($provs); $i++) {
            $codprove = strtolower($provs[$i]);
            if ($i == 0)
                $codprove1 = $codprove;
            $data = $tpmaestra->$codprove;
            $campo = explode("|", $data);
            $cantidad = floatval($campo[1]);
            $da = floatval($campo[2]);
            $precio = floatval($campo[0]);
            if ( $cantidad <= 0 && $precio <= 0.00 && $i <= 0) {
                // EN EL CASO DE QUE EL PROVEEDOR Q SE ESTA COMPARANDO NO TIENE EL PRODUCTO
                break;
            }
            if ($cantidad > 0 && $precio > 0.00) {
                // PRECIO1 + CANTIDAD + DA + CODIGO + FECHAFALLA + PRECIO2 + PRECIO3 + LOTE +FECVENCE + DESPROD
                $dc = 0.00;
                $di = 0.00;
                $pp = 0.00;
                $dp = 0.00;
                $dv = 0.00;
                $dvp = 0.00;
                if ($i==0) {
                    $di = $dinternet;
                    $pp = $ppago;
                }
                //log::info("CD -> cantidad: ".$cantidad);
                $neto = CalculaPrecioNeto($precio, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                $liquida = $neto + (($neto * $tpmaestra->iva)/100);
                //log::info("CD -> liquida: ".$liquida);
                $arrayProv[] = array("codprove" => $codprove,
                                     "cantidad" => $cantidad,
                                     "liquida" => $liquida );
                $retorno = 1;
                $contren++;
            }
        }
        if ($contren == 0) {
            return null;
        }
        $contProv = 0;
        foreach ($arrayProv as $key => $row) {
            $aux[$key] = $row['liquida'];
            if ($aux[$key] > 0) {
                $contProv++;
            }
        }
        if ($contProv == 0) {
            // NO HAY UN SOLO PROVEEDOR CON EL PRODUCTO
            return null;
        }
        array_multisort($aux, SORT_ASC, $arrayProv);
        if ($codprove1 == $arrayProv[0]["codprove"] && $contProv == 1) {
            // SOLO LO TIENE EL PROVEEDOR PRINCIPAL
            return null;
        }
        if ($codprove1 != $arrayProv[0]["codprove"]) {
            // NO ES UNA SUPER OFERTA
            //dd('barra: '.$barra.' = '.$codprove1 .' - '. $arrayProv[0]["codprove"] );
            return null;
        }
        //log::info("CD -> PASO6");
    }
    return $retorno;
}
function QuitarCaracteres($str) {
    $retorno = str_replace("\xB0", "", $str);
    $retorno = str_replace("\x9A", "", $retorno);
    $retorno = str_replace("\xD1", "", $retorno);
    $retorno = str_replace("\xD0", "", $retorno);
    $retorno = str_replace("\xDF", "", $retorno);
    $retorno = str_replace("\xED", "", $retorno);
    $retorno = str_replace("\xDF", "", $retorno);
    $retorno = str_replace("\xC9", "", $retorno);
    $retorno = str_replace("\\", "", $retorno);
    $retorno = str_replace("\n", " ", $retorno);
    $retorno = str_replace("\t", " ", $retorno);
    $retorno = str_replace("\xEF\xBB\xBF", "", $retorno);
    $retorno = str_replace("\xEF", "", $retorno);
    $retorno = str_replace("\xBF", "", $retorno);
    $retorno = str_replace("\xBB", "", $retorno);
    $retorno = str_replace("\xC2", "", $retorno);
    $retorno = str_replace("\xB4", "", $retorno);
    $retorno = str_replace("\xA0", "", $retorno);
    $retorno = str_replace("\xBA", "", $retorno);
    $retorno = str_replace("\xA8", "", $retorno);
    $retorno = str_replace("\xAA", "", $retorno);
    $retorno = str_replace("\xA7", "", $retorno);
    $retorno = str_replace("\xAE", "", $retorno);
    $retorno = str_replace("\xBE", "", $retorno);
    $retorno = str_replace("\x81", "", $retorno);
    $retorno = str_replace("\xE2", "", $retorno);
    $retorno = str_replace("\x80", "", $retorno);
    $retorno = str_replace("\x9C", "", $retorno);
    $retorno = str_replace("\xA3", "", $retorno);
    $retorno = str_replace("\xBD", "", $retorno);
    $retorno = str_replace("\x81", "", $retorno);
    $retorno = str_replace("\xB9", "", $retorno);
    $retorno = str_replace("\xC3", "", $retorno);
    $retorno = str_replace("\xC6", "", $retorno);
    $retorno = str_replace("\x8D", "", $retorno);
    $retorno = str_replace("\x92", "", $retorno);
    $retorno = str_replace("\x84", "", $retorno);
    $retorno = str_replace("\xA2", "", $retorno);
    $retorno = str_replace("\x91", "", $retorno);
    $retorno = str_replace("\xAF", "", $retorno);
    $retorno = str_replace("\xB1", "", $retorno);
    $retorno = str_replace("\x93", "", $retorno);
    $retorno = str_replace("\x93", "", $retorno);
    $retorno = str_replace("\xCD", "", $retorno);
    $retorno = str_replace("\xC1", "", $retorno);
    $retorno = str_replace("\xE1", "", $retorno);
    $retorno = str_replace("\xDC", "", $retorno);
    $retorno = str_replace("\xCD", "", $retorno);
    $retorno = str_replace("\xD3", "", $retorno);
    $retorno = str_replace("\x88", "", $retorno);
    $retorno = str_replace("\xA1", "", $retorno);
    $retorno = str_replace("\xAD", "", $retorno);
    $retorno = str_replace("\x89", "", $retorno);
    $retorno = str_replace("\x93", "", $retorno);
    $retorno = str_replace("\xB3", "", $retorno);
    $retorno = str_replace("\x87", "", $retorno);
    $retorno = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $retorno
    );
    $retorno = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $retorno );
    $retorno = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $retorno );
    $retorno = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $retorno );
    $retorno = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $retorno );
    $retorno = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $retorno
    );
    return $retorno;
}
?>
