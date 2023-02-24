<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\user;
use Session;
use DB;
use Http;  
 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        if ($request) {

            // FECHA Y HORA DEL INVENTARIO
            $fecha = date('d-m-Y');
            $cfg = DB::table('cfg')->first();
            if ($cfg) {
                $date1 = $cfg->fecha;
                $fecha = date('d-m-Y H:i:s', strtotime($date1));
            }
            $sucursal = DB::table('cfg')->get();
            if (!Session::has('sidebarMode')) {
                Session::put('sidebarMode', '1');
            }

            if (!Session::has('modoInfo')) {
                Session::put('modoInfo', '1');
            }
       
            // CODIGO ISB
            //$codcli = Auth::user()->codcli;
            $codcli = sCodigoClienteActivo();
            $tipo = Auth::user()->tipo;

            $reg = DB::table('producto')
            ->selectRaw('count(*) as contador')
            ->first();
            $contCatalogo = $reg->contador;
 
            $sucursal = sRetornaSucursal();
            if ($tipo == 'A' ) {
                if (!Session::has('sucactiva')) {
                    Session::put('sucactiva', $cfg->codisb);
                }
                $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());

                // MODULO CPANEL
                $subtitulo = "PANEL DE CONTROL";
                // 1.- CONTADOR DE PEDIDOS ENVIADOS
                $contPedido = iContadorPedidos();

                // 4.- CONTADOR DE CLIENTES 
                $reg = DB::table('cliente')
                ->selectRaw('count(*) as contador')
                ->first();
                $contCliente = $reg->contador;

                // 5.- CONTADOR DE FACTURAS
                $reg = DB::table('fact')
                ->selectRaw('count(*) as contador')
                ->first();
                $contFactura = $reg->contador;

                // 6.- MONTO CUENTA POR COBRAR
                $reg = DB::table('cxc')
                ->selectRaw('sum(saldo) as saldobs')
                ->where('saldo','>','0')
                ->first();
                $totCxcBs = $reg->saldobs;
            
                $reg = DB::table('cxc')
                ->selectRaw('sum(saldods) as saldods' )
                ->where('saldods','>','0')
                ->first();
                $totCxcDs = $reg->saldods;

                // 7.- MONTO CUENTA POR PAGAR
                $reg = DB::table('cxp')
                ->selectRaw('sum(saldo) as saldobs' )
                ->where('saldo','>','0')
                ->first();
                $totCxpBs = $reg->saldobs;
            
                $reg = DB::table('cxp')
                ->selectRaw('sum(saldods) as saldods' )
                ->where('saldods','>','0')
                ->first();
                $totCxpDs = $reg->saldods;


                // 8.- CONTADOR DE PROVEEDORES 
                $reg = DB::table('proveedor')
                ->selectRaw('count(*) as contador')
                ->first();
                $contProveedor = $reg->contador;

           
                // 9.- SUMA TOTAL DE FACTURAS 
                $hasta = date('Y-m-d').' 23:59:00';
                $desde = date('Y-m-d').' 00:00:00';
                $reg = DB::table('fact')
                ->selectRaw('sum(total) as contador')
                ->whereBetween('fecha', array($desde, $hasta))
                ->first();
                $totVentas = $reg->contador;

                $final = date('d-m-Y');
                $Fechax = strtotime('-30 day', strtotime($final));
                $fechax = date('d-m-Y', $Fechax);
                $comienzo = substr($fechax, 0, 10);

                $fechaInicio=strtotime($comienzo);
                $fechaFin=strtotime($final);

                $chart_data = '';
                for($i=$fechaInicio; $i<=$fechaFin; $i+=86400) {
                    $fechai = date("Y-m-d", $i);
                    $desde = $fechai.' 00:00:00';
                    $hasta = $fechai.' 23:59:00';
                   
                    $reg = DB::table('pedido')
                    ->whereBetween('fecha', array($desde, $hasta))
                    ->selectRaw('sum(total) as total')
                    ->first();
                    $pedtotal = 0;
                    if ($reg->total)
                        $pedtotal = $reg->total;
                  
                    $reg = DB::table('fact')
                    ->whereBetween('fecha', array($desde, $hasta))
                    ->selectRaw('sum(total) as total')
                    ->first();
                    $ventotal = 0;
                    if ($reg->total)
                        $ventotal = $reg->total;
                    $chart_data .= "{periodo:'".$fechai."',pedidos:".$pedtotal.",ventas:".$ventotal."},";
                }
                $chart_data = substr($chart_data, 0, -1);
                return view('seped.indexAdmin', ["menu" => "Inicio",
                                                 "sucursal" => $sucursal,
                                                 "sucactiva" => $sucactiva,
                                                 "chart_data" => $chart_data,
                                                 "fecha" => $fecha, 
                                                 "codcli" => $codcli,
                                                 "contPedido" => $contPedido,
                                                 "contCliente" => $contCliente,
                                                 "contFactura" => $contFactura,
                                                 "totCxcBs" => $totCxcBs,
                                                 "totCxcDs" => $totCxcDs,
                                                 "totCxpBs" => $totCxpBs,
                                                 "totCxpDs" => $totCxpDs,
                                                 "contProveedor" => $contProveedor,
                                                 "totVentas" => $totVentas,
                                                 "subtitulo" => $subtitulo,
                                                 "contCatalogo" => $contCatalogo,
                                                 "cfg" => $cfg ]);
            }
            if ($tipo == 'S' ) {
                // MODULO CPANEL
                $sucactiva = Auth::user()->codisbpredet;
                Session::put('sucactiva', $sucactiva);
                $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
                $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
 
                $subtitulo = "PANEL DE CONTROL DE SUPERVISOR";
                $reg = DB::table('pedido')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $contPedido = $reg->contador;

                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $contCatalogo = $reg->contador;

                $reg = DB::table('prodimg')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $contImg = $reg->contador;
         
                $reg = DB::table('carga')
                ->selectRaw('count(*) as contador')
                ->first();
                $contCarga= $reg->contador;
         
                $reg = DB::table('grupo')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $contGrupo = $reg->contador;
         
                $reg = DB::table('clientenofiscal')
                ->selectRaw('count(*) as contador')
                ->first();
                $contNofiscal = $reg->contador;

                return view('seped.indexSuper', ["menu" => "Inicio",
                                                 "sucursal" => $sucursal,
                                                 "sucactiva" => $sucactiva,
                                                 "fecha" => $fecha, 
                                                 "codcli" => $codcli,
                                                 "contPedido" => $contPedido,
                                                 "subtitulo" => $subtitulo,
                                                 "contCatalogo" => $contCatalogo,
                                                 "contImg" => $contImg,
                                                 "contCarga" => $contCarga,
                                                 "contGrupo" => $contGrupo,
                                                 "contNofiscal" => $contNofiscal,
                                                 "cfg" => $cfg ]);
            }
            if ($tipo == 'R' ) {
                $sucactiva = Auth::user()->codisbpredet;
                Session::put('sucactiva', $sucactiva);
                $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
                $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
 
                // MODULO CREDITO Y COBRANZA
                $subtitulo = "PANEL DE CONTROL DE CREDITO Y COBRANZA";
                // 1.- CONTADOR DE PEDIDOS ENVIADOS
                $contPedido = iContadorPedidos();

                // 4.- CONTADOR DE CLIENTES 
                $reg = DB::table('cliente')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $contCliente = $reg->contador;

                // 5.- CONTADOR DE FACTURAS
                $reg = DB::table('fact')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $contFactura = $reg->contador;

                // 6.- MONTO CUENTA POR COBRAR
                $reg = DB::table('cxc')
                ->selectRaw('sum(saldo) as saldobs')
                ->where('codisb','=',$sucactiva)
                ->where('saldo','>','0')
                ->first();
                $totCxcBs = $reg->saldobs;
           
                $reg = DB::table('cxc')
                ->selectRaw('sum(saldods) as saldods' )
                ->where('codisb','=',$sucactiva)
                ->where('saldods','>','0')
                ->first();
                $totCxcDs = $reg->saldods;

                // 7.- MONTO CUENTA POR PAGAR
                $reg = DB::table('cxp')
                ->selectRaw('sum(saldo) as saldobs' )
                ->where('codisb','=',$sucactiva)
                ->where('saldo','>','0')
                ->first();
                $totCxpBs = $reg->saldobs;
            
                $reg = DB::table('cxp')
                ->selectRaw('sum(saldods) as saldods' )
                ->where('codisb','=',$sucactiva)
                ->where('saldods','>','0')
                ->first();
                $totCxpDs = $reg->saldods;

                // 8.- CONTADOR DE PROVEEDORES 
                $reg = DB::table('proveedor')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $contProveedor = $reg->contador;

                // 9.- SUMA TOTAL DE FACTURAS 
                $hasta = date('Y-m-d').' 23:59:00';
                $desde = date('Y-m-d').' 00:00:00';
                $reg = DB::table('fact')
                ->selectRaw('sum(total) as contador')
                ->whereBetween('fecha', array($desde, $hasta))
                ->where('codisb','=',$sucactiva)
                ->first();
                $totVentas = $reg->contador;

                $final = date('d-m-Y');
                $Fechax = strtotime('-30 day', strtotime($final));
                $fechax = date('d-m-Y', $Fechax);
                $comienzo = substr($fechax, 0, 10);

                $fechaInicio=strtotime($comienzo);
                $fechaFin=strtotime($final);

                $chart_data = '';
                for($i=$fechaInicio; $i<=$fechaFin; $i+=86400) {
                    $fechai = date("Y-m-d", $i);
                    $desde = $fechai.' 00:00:00';
                    $hasta = $fechai.' 23:59:00';
                   
                    $reg = DB::table('pedido')
                    ->whereBetween('fecha', array($desde, $hasta))
                    ->selectRaw('sum(total) as total')
                    ->first();
                    $pedtotal = 0;
                    if ($reg->total)
                        $pedtotal = $reg->total;
                  
                    $reg = DB::table('fact')
                    ->whereBetween('fecha', array($desde, $hasta))
                    ->where('codisb','=',$sucactiva)
                    ->selectRaw('sum(total) as total')
                    ->first();
                    $ventotal = 0;
                    if ($reg->total)
                        $ventotal = $reg->total;
                    $chart_data .= "{periodo:'".$fechai."',pedidos:".$pedtotal.",ventas:".$ventotal."},";
                }
                $chart_data = substr($chart_data, 0, -1);
                return view('seped.indexCredito', ["menu" => "Inicio",
                                                   "sucursal" => $sucursal,
                                                   "sucactiva" => $sucactiva,
                                                   "chart_data" => $chart_data,
                                                   "fecha" => $fecha,
                                                   "codcli" => $codcli, 
                                                   "contPedido" => $contPedido,
                                                   "contCliente" => $contCliente,
                                                   "contFactura" => $contFactura,
                                                   "totCxcBs" => $totCxcBs,
                                                   "totCxcDs" => $totCxcDs,
                                                   "totCxpBs" => $totCxpBs,
                                                   "totCxpDs" => $totCxpDs,
                                                   "contPedido" => $contPedido,
                                                   "totVentas" => $totVentas,
                                                   "subtitulo" => $subtitulo,
                                                   "contCatalogo" => $contCatalogo,
                                                   "cfg" => $cfg ]);
            }
            if ($tipo == 'C') {

                if ($cfg->modoMant == 1) {
                    Auth::logout();
                    session()->flash('message', $cfg->msgMant);
                    return redirect()->route('login');
                }

                if (!Session::has('sucactiva')) {
                    Session::put('sucactiva', Auth::user()->codisbpredet);
                }
                $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());

                // MODULO CLIENTE
                $cliente = DB::table('cliente')
                ->where('codcli','=',$codcli)
                ->where('codisb','=',$sucactiva)
                ->where('codisbactivo','=','1')
                ->first();
                if (empty($cliente)) {
                    Auth::logout();
                    session()->flash('error', 'Cliente '.$codcli.' no se encuentra en la base de datos');
                    return redirect()->route('login');
                }
                $subtitulo = $cliente->nombre;
                // 1.- CONTADOR DE PEDIDOS ENVIADOS
                $reg = DB::table('pedido')
                ->selectRaw('count(*) as contador')
                ->where('estado','=','ENVIADO')
                ->where('codcli','=',$codcli)
                ->first();
                $contPedido = $reg->contador;

                // 2.- CONTADOR DE RECLAMOS ENVIADOS
                $reg = DB::table('reclamo')
                ->selectRaw('count(*) as contador')
                ->where('estado','=','ENVIADO')
                ->where('codcli','=',$codcli)
                ->first();
                $contReclamo = $reg->contador;

                // 3.- CONTADOR DE PAGOS
                $reg = DB::table('pago')
                ->selectRaw('count(*) as contador')
                ->where('estado','=','ENVIADO')
                ->where('codcli','=',$codcli)
                ->first();
                $contPago = $reg->contador;

                $tipoClient = "FISCAL";
                $reg = DB::table('clientenofiscal')
                ->where('codcli','=',$codcli)
                ->first();
                if ($reg)
                    $tipoClient = "NOFISCAL";

                return view('seped.indexCliente', ["menu" => "Inicio",
                                                   "sucursal" => $sucursal,
                                                   "sucactiva" => $sucactiva,
                                                   "fecha" => $fecha,
                                                   "codcli" => $codcli,
                                                   "contPedido" => $contPedido,
                                                   "contReclamo" => $contReclamo,
                                                   "contPago" => $contPago,
                                                   "contCatalogo" => $contCatalogo,
                                                   "subtitulo" => $subtitulo,
                                                   "tipoClient" => $tipoClient,
                                                   "cfg" => $cfg,
                                                   "cliente" => $cliente ]);
            }
            if ($tipo == 'T' ) {
                $subtitulo = "PANEL DE CONTROL DE CHOFER";
                $cestasxEntregar = 0;
                $cestas = DB::table('cestas')
                ->selectRaw('count(*) as contador')
                ->where('devuelta','=','0')
                ->first();
                if ($cestas) {
                    $cestasxEntregar = $cestas->contador;
                }
                $sucactiva = Auth::user()->codisbpredet;
                Session::put('sucactiva', $sucactiva);
                $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
                return view('seped.indexChofer', ["menu" => "Inicio",
                                                  "sucursal" => $sucursal,
                                                  "sucactiva" => $sucactiva,
                                                  "fecha" => $fecha, 
                                                  "codcli" => $codcli,
                                                  "subtitulo" => $subtitulo,
                                                  "cestasxEntregar" => $cestasxEntregar,
                                                  "cfg" => $cfg ]);
            }
            if ($tipo == 'P' ) {
                $sucactiva = Auth::user()->codisbpredet;
                Session::put('sucactiva', $sucactiva);
                $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
                $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
 
                $subtitulo = "PANEL DE CONTROL DE PROVEEDORES";
                $codmarca = Auth::user()->codcli;
                $producto = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('marcamodelo','LIKE','%'.$codmarca.'%')
                ->get();
                $contCata = $producto->count();

                $hasta = date('Y-m-d').' 23:59:00';
                $Fechax = date('Y-m-d');
                $Fechax = strtotime('-7 day', strtotime($Fechax));
                $fechax = date('Y-m-d', $Fechax);
                $desde = substr($fechax, 0, 10).' 00:00:00';
              
                $fact = DB::table('fact')
                ->where('codisb','=',$sucactiva)
                ->whereBetween('fecha', array($desde, $hasta))
                ->whereExists(function ($query) use ($codmarca) {
                $query->select(DB::raw(1))
                    ->from('factren')
                    ->whereRaw("fact.factnum = factren.factnum")
                    ->whereRaw("factren.marca LIKE '%".$codmarca."%'");
                })
                ->get();
                $contFact = $fact->count();

                return view('seped.indexProveedor', ["menu" => "Inicio",
                                                     "sucursal" => $sucursal,
                                                     "sucactiva" => $sucactiva,
                                                     "contCata" => $contCata,
                                                     "codcli" => $codcli,
                                                     "contFact" => $contFact,
                                                     "fecha" => $fecha, 
                                                     "subtitulo" => $subtitulo,
                                                     "cfg" => $cfg ]);
            }
            if ($tipo == "V" || $tipo == "G" ) {
                // MODULO VENDEDOR
                $codvend = Auth::user()->codcli;
                //$codcli = Auth::user()->codcliactivo;
                $vendedor = '';
                if ($tipo == "V") {
                    $tipovend = Auth::user()->vendsuper;
                    $sucactiva = Auth::user()->codisbpredet;
                    $vendedor = DB::table('vendedor')
                    ->where('codigo','=',$codvend)
                    ->where('codisb','=',$sucactiva)
                    ->first();
                    if ($tipovend == '1') {
                        $clientes = DB::table('cliente')
                        ->where('codisb','=',$sucactiva)
                        ->get();
                    } else {
                        $clientes = DB::table('cliente')
                        ->where('zona','=',$codvend)
                        ->where('codisb','=',$sucactiva)
                        ->get();
                        if ($clientes->count() == 0) {
                            Auth::logout();
                            session()->flash('message', 'ESTE VENDEDOR, NO TIENE CLIENTES ASIGNADOS');
                            return redirect()->route('login');
                        }
                    }
                } else {
                    $codgrupo = trim(Auth::user()->codcli);
                    $grupo = DB::table('grupo')
                    ->where('id','=',$codgrupo)
                    ->first();
                    if (empty($grupo)) {
                        Auth::logout();
                        session()->flash('message', "CODIGO DEL GRUPO NO ENCONTRADO!!!");
                        return redirect()->route('login');
                    }
                    $sucactiva = trim($grupo->codisb);

                    $clientex = DB::table('gruporen')
                    ->where('id','=',$codgrupo)
                    ->get();
                    $clientes = array();
                    foreach ($clientex as $cli) { 
                        $cliente = DB::table('cliente')
                        ->where('codcli','=',$cli->codcli)
                        ->first();
                        if ($cliente) {
                            $clientes[] = $cliente;
                        }
                    }
                }

                if ($cfg->modoMant == 1) {
                    if (Auth::user()->name != "VENDEDOR1") {
                        Auth::logout();
                        session()->flash('message', $cfg->msgMant);
                        return redirect()->route('login');
                    }
                }

                $codcli = trim($request->get('codcli'));
                if ($codcli) {

                    if (Session::has('codcli')) {
                        Session::forget('codcli');
                    }
                    Session::put('codcli', $codcli);
                       
                }

                if ($request->codcli) {
                    $regUser = User::find(Auth::user()->id);
                    $regUser->codcliactivo = $request->codcli;
                    $regUser->update();
                    if (Session::has('codcli')) {
                        Session::forget('codcli');
                    }
                }  else {
                    $entro = 0;
                    $codcliactivo = Auth::user()->codcliactivo;
                    foreach($clientes as $cli) {
                        if ($cli->codcli==$codcliactivo) {
                            $entro = 1;
                            break;
                        }
                    }
                    if ($entro==0) {
                        $codcliactivo = $clientes[0]->codcli;
                        $regUser = User::find(Auth::user()->id);
                        $regUser->codcliactivo = $codcliactivo;
                        $regUser->update();
                    }
                }
                Auth::setUser(Auth::user()->fresh());
                $codcli = Auth::user()->codcliactivo;
                Session::put('codcli', $codcli);
                Session::put('sucactiva', $sucactiva);
                $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
              
                $cliente = DB::table('cliente')
                ->where('codcli','=',$codcli)
                ->where('codisb','=',$sucactiva)
                ->first();
                if (empty($cliente)) {
                    Auth::logout();
                    session()->flash('error', 'Cliente '.$codcli.' no se encuentra en la base de datos');
                    return redirect()->route('login');
                }
                
                $subtitulo = $cliente->nombre;

                // 2.- CONTADOR DE PEDIDOS ENVIADOS
                $reg = DB::table('pedido')
                ->selectRaw('count(*) as contador')
                ->where('estado','=','ENVIADO')
                ->where('codcli','=',$codcli)
                ->where('codisb','=',$sucactiva)
                ->first();
                $contPedido = $reg->contador;
                // 3.- CONTADOR DE RECLAMOS ENVIADOS
                $reg = DB::table('reclamo')
                ->selectRaw('count(*) as contador')
                ->where('estado','=','ENVIADO')
                ->where('codcli','=',$codcli)
                ->where('codisb','=',$sucactiva)
                ->first();
                $contReclamo = $reg->contador;
                // 4.- CONTADOR DE PAGOS
                $reg = DB::table('pago')
                ->selectRaw('count(*) as contador')
                ->where('estado','=','ENVIADO')
                ->where('codcli','=',$codcli)
                ->where('codisb','=',$sucactiva)
                ->first();
                $contPago = $reg->contador;
                // 6.- CONTADOR POR COBRAR
                $cxc = DB::table('cxc as cc')
                ->where('cc.codcli','=',$codcli)
                ->where('codisb','=',$sucactiva)
                ->select(DB::raw('sum(cc.saldo) AS totSaldo'))
                ->first();
                $totSaldo = $cxc->totSaldo;

                $tipoClient = "FISCAL";
                $reg = DB::table('clientenofiscal')
                ->where('codcli','=',$codcli)
                ->first();
                if ($reg)
                    $tipoClient = "NOFISCAL";

                return view('seped.indexVendedor', ["menu" => "Inicio",
                                                    "fecha" => $fecha,
                                                    "codcli" => $codcli,
                                                    "sucactiva" => $sucactiva,
                                                    "clientes" => $clientes,
                                                    "cliente" => $cliente,
                                                    "subtitulo" => $subtitulo,
                                                    "users" => Auth::user(),
                                                    "contCatalogo" => $contCatalogo,
                                                    "contPedido" => $contPedido,
                                                    "contReclamo" => $contReclamo,
                                                    "contPago" => $contPago,
                                                    "vendedor" => $vendedor,
                                                    "tipoClient" => $tipoClient,
                                                    "cfg" => $cfg,
                                                    "totSaldo" => $totSaldo]);
            }

        }
    }
    public function modmenu() {
        if (!Session::has('sidebarMode')) {
            Session::put('sidebarMode', '1');
        } else  {
            $sidebarMode = Session::get('sidebarMode', "");
            if ($sidebarMode == '1') 
                Session::put('sidebarMode', '2');
            else 
                Session::put('sidebarMode', '1');
        }
        return response()->json(['msg' => "" ]);
    }

    public function modoInfo(Request $request) {
        Session::put('modoInfo', '0');
        $modoInfo = Session::get('modoInfo', '0');
        return response()->json(['msg' => "" ]);
    }

    public function cambiarsucursal(Request $request) {
        $sucactiva = $request->get('sucactiva');
        if (Session::has('sucactiva')) 
            Session::forget('sucactiva');
        Session::put('sucactiva', $sucactiva);
        $sucactiva = Session::get('sucactiva', $sucactiva);
        //return redirect()->back()->with('result');
        return Redirect::to('/home');
    }

    public function prueba() {
        $cfg = DB::table('cfg')->first();
        $resp = Minicpcheck($cfg->KeyMincp);
        log::info('resp3: '.$resp);
        return redirect()->back()->with('result');
    }
 
}