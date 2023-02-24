<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\user;
use DB;
use Illuminate\Support\Facades\Log;
use Session;
 
class AdreportController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function producto($codprod) {
        $subtitulo = "CONSULTA DE PRODUCTO";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $tabla = DB::table('producto')
        ->where('codisb','=',$sucactiva)
        ->where('codprod','=',$codprod)
        ->first();
        if (empty($tabla)) {
             return Redirect::back()->with('error', 'Codprod '.$codprod.' no tiene información en este momento');
        }
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view('seped.report.prodver',["menu" => "Reportes",
                                            "sucactiva" => $sucactiva,
                                            "tabla" => $tabla, 
                                            "subtitulo" => $subtitulo,
                                            "cfg" => $cfg,
                                            "codprod" => $codprod]);
    }

    public function proveedores(Request $request){

        set_time_limit(300);
        $filtro=trim($request->get('filtro'));

        $subtitulo = "PROVEEDORES";

        // FECHA Y HORA DEL INVEMNTARIO
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        // TABLA DE CLIENTES
        $tabla = DB::table('proveedor')
        ->where('codisb','=',$sucactiva)
        ->where(function ($q) use ($filtro) {
            $q->where('nombre','LIKE','%'.$filtro.'%')
            ->Orwhere('codprov','LIKE','%'.$filtro.'%')
            ->Orwhere('rif','LIKE','%'.$filtro.'%');
        })
        ->orderBy('nombre','asc')
        ->paginate(200);
   
        return view('seped.report.proveedores',["menu" => "Reportes",
                                                "sucactiva" => $sucactiva,
                                                "tabla" => $tabla, 
                                                "subtitulo" => $subtitulo,
                                                "cfg" => $cfg,
                                                "filtro" => $filtro]);
    }

    public function proveedor($codprov) {
        $subtitulo = "CONSULTA DE PROVEEDOR";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        // TABLA DE CLIENTE
        $tabla = DB::table('proveedor')
        ->where('codisb','=',$sucactiva)
        ->where('codprov','=',$codprov)
        ->first();
        return view('seped.report.provver',["menu" => "Reportes",
                                            "tabla" => $tabla, 
                                            "subtitulo" => $subtitulo,
                                            "cfg" => $cfg,
                                            "codprov" => $codprov]);
    }
    
    public function facturas(Request $request){

        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $subtitulo = "FACTURAS DE VENTAS";
        $desde=trim($request->get('desde'));
        $hasta=trim($request->get('hasta'));
        $filtro=trim($request->get('filtro'));
        if ($desde=='' || $hasta=='') {
            $hasta = date('Y-m-d');
            $desde = date('Y-m-d', strtotime('-7 day', strtotime($hasta)));
        }
        $desde = $desde.' 00:00:00';
        $hasta = $hasta.' 23:59:00';
        
        // TABLA DE FACTURAS
        $tabla = DB::table('fact')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecha', array($desde, $hasta))
        ->where('descrip','LIKE','%'.$filtro.'%')
        ->orderBy('factnum','desc')
        ->get();
   
        return view('seped.report.facturas',["menu" => "Reportes",
                                             "sucactiva" => $sucactiva,
                                             "tabla" => $tabla, 
                                             "subtitulo" => $subtitulo,
                                             "filtro" => $filtro,
                                             "desde" => $desde,
                                             "cfg" => $cfg,
                                             "hasta" => $hasta ]);
    }

    public function factura($factnum) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $subtitulo = "CONSULTA DE FACTURA";

        // TABLA DE FACTURAS
        $tabla = DB::table('fact')
        ->where('codisb','=',$sucactiva)
        ->where('factnum','=',$factnum)
        ->first();

        // TABLA DE RENGLONES DE FACTURAS
        $tabla2 = DB::table('factren')
        ->where('codisb','=',$sucactiva)
        ->where('factnum','=',$factnum)
        ->orderBy('renglon','asc')
        ->get();

        return view('seped.report.factver',["menu" => "Reportes",
                                            "sucactiva" => $sucactiva,
                                            "tabla" => $tabla, 
                                            "tabla2" => $tabla2, 
                                            "subtitulo" => $subtitulo,
                                            "cfg" => $cfg,
                                            "factnum" => $factnum]);
    }

    public function cxps(Request $request){

        $filtro=trim($request->get('filtro'));
        $subtitulo = "CUENTAS POR PAGAR";

        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

        // TABLA DE CUENTAS POR PAGAR
        $tabla = DB::table('cxp as cp')
        ->join('proveedor as pr', 'cp.codprov' ,'=', 'pr.codprov')
        ->select('*', 'cp.saldo as saldo', 'cp.saldoDs as saldoDs', 'cp.factorcambiario as factorcambiario')
        ->where('cp.codisb','=',$sucactiva)
            ->where(function ($q) use ($filtro) {
                $q->orwhere('pr.nombre','LIKE','%'.$filtro.'%')
                ->orwhere('cp.numerod','LIKE','%'.$filtro.'%')
                ->orwhere('cp.codprov','LIKE','%'.$filtro.'%');
            })
        ->orderBy('fechai','asc')
        ->get();

        return view('seped.report.cxps',["menu" => "Reportes",
                                         "tabla" => $tabla,
                                         "subtitulo" => $subtitulo,
                                         "sucactiva" => $sucactiva,
                                         "cfg" => $cfg,
                                         "filtro" => $filtro ]);
    }

    public function cxp($id) {
        $s1 = explode('-', $id );
        $tipocxp = $s1[0];
        $numerod = $s1[1];
        $subtitulo = "CONSULTA DE CUENTA POR PAGAR";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

        // TABLA DE CXP
        $tabla = DB::table('cxp')
        ->where('codisb','=',$sucactiva)
        ->where('numerod','=',$numerod)
        ->where('tipocxp','=',$tipocxp)
        ->first();

        // TABLA DE PROVEEDOR
        $tabla2 = DB::table('proveedor')
        ->where('codisb','=',$sucactiva)
        ->where('codprov','=',$tabla->codprov)
        ->first();

        return view('seped.report.cxpver',["menu" => "Reportes",
                                           "tabla" => $tabla,
                                           "tabla2" => $tabla2, 
                                           "sucactiva" => $sucactiva,
                                           "cfg" => $cfg,
                                           "subtitulo" => $subtitulo]);
    }

    public function vendedores(Request $request) {

        $filtro=trim($request->get('filtro'));
        $subtitulo = "VENDEDORES";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

        // TABLA DE CUENTAS POR PAGAR
        $tabla = DB::table('vendedor')
        ->where('codisb','=',$sucactiva)
        ->where(function ($q) use ($filtro) {
          $q->Orwhere('codigo','LIKE','%'.$filtro.'%')
          ->Orwhere('nombre','LIKE','%'.$filtro.'%');
        })
        ->orderBy('nombre','asc')
        ->paginate(200);

        return view('seped.report.vendedores',["menu" => "Reportes",
                                               "tabla" => $tabla,
                                               "subtitulo" => $subtitulo,
                                               "sucactiva" => $sucactiva,
                                               "cfg" => $cfg,
                                               "filtro" => $filtro ]);
    }

    public function ctabancos(Request $request) {

        $filtro=trim($request->get('filtro'));
        $subtitulo = "CUENTA BANCOS";

        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

        // TABLA DE CUENTAS BANCO
        $tabla = DB::table('ctabanco')
        ->where('codisb','=',$sucactiva)
        ->where(function ($q) use ($filtro) {
            $q->where('num_cuenta','LIKE','%'.$filtro.'%')
            ->Orwhere('co_banco','LIKE','%'.$filtro.'%');
        })
        ->orderBy('co_cta','asc')
        ->paginate(200);

        return view('seped.report.ctabancos',["menu" => "Reportes",
                                              "tabla" => $tabla, 
                                              "subtitulo" => $subtitulo,
                                              "sucactiva" => $sucactiva,
                                              "cfg" => $cfg,
                                              "filtro" => $filtro ]);
    }

    public function monedas(Request $request){

        $filtro=trim($request->get('filtro'));
        $subtitulo = "MONEDAS";

        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

        // FECHA Y HORA DEL INVEMNTARIO
        $cfg = DB::table('cfg')->first();
        $date1 = $cfg->fecha;
        $fecha = date('d-m-Y H:i:s', strtotime($date1));

        // TABLA DE CUENTAS BANCO
        $tabla = DB::table('monedas')
        ->where('codisb','=',$sucactiva)
        ->where(function ($q) use ($filtro) {
            $q->where('descrip','LIKE','%'.$filtro.'%')
            ->Orwhere('codigo','LIKE','%'.$filtro.'%');
        })
        ->orderBy('codigo','asc')
        ->paginate(200);

        return view('seped.report.monedas',["menu" => "Reportes",
                                            "tabla" => $tabla, 
                                            "subtitulo" => $subtitulo,
                                            "sucactiva" => $sucactiva,
                                            "cfg" => $cfg,
                                            "filtro" => $filtro ]);
    }

    public function resumen(Request $request) {

        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $subtitulo = "RESUMEN DE OPERACIONES";

        $desde=trim($request->get('desde'));
        $hasta=trim($request->get('hasta'));

        if ($desde=='' || $hasta=='') {
            $hasta = date('Y-m-d');
            $desde = date('Y-m-d');
        }
        $desde = $desde.' 00:00:00';
        $hasta = $hasta.' 23:59:00';

        $fecha = date('Y-m-d');

        // TOTAL DE VENTAS
        $reg = DB::table('fact')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecha', array($desde, $hasta))
        ->first();
        $totVentas = $reg->contador;
        $reg = DB::table('fact')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecha', array($desde, $hasta))
        ->first();
        $contFact = $reg->contador;

        // CONTADOR PEDIDO ENVIADOS
        $reg = DB::table('pedido')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->where('estado','=','  ENVIADO')
        ->first();
        $totPedEnviado = $reg->contador;
        $reg = DB::table('pedido')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->where('estado','=','ENVIADO')
        ->first();
        $contPedEnviado = $reg->contador;

        // CONTADOR PEDIDO APROBADOS
        $reg = DB::table('pedido')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','RECIBIDO')
        ->first();
        $totPedAprobado = $reg->contador;
        $reg = DB::table('pedido')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','RECIBIDO')
        ->first();
        $contPedAprobado = $reg->contador;

        // CONTADOR PEDIDO ANULADOS
        $reg = DB::table('pedido')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','ANULADO')
        ->first();
        $totPedAnulado = $reg->contador;
        $reg = DB::table('pedido')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','ANULADO')
        ->first();
        $contPedAnulado = $reg->contador;

        // CONTADOR PEDIDO PICKIN
        $reg = DB::table('pedido')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','PICKING')
        ->first();
        $totPedPicking = $reg->contador;
        $reg = DB::table('pedido')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','PICKING')
        ->first();
        $contPedPicking = $reg->contador;
 
        // CONTADOR PEDIDO PACKING
        $reg = DB::table('pedido')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','PACKING')
        ->first();
        $totPedPacking = $reg->contador;
        $reg = DB::table('pedido')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','PACKING')
        ->first();
        $contPedPacking = $reg->contador;

        // CONTADOR PEDIDO PEND-FACTURA o FACTURANDO
        $reg = DB::table('pedido')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','FACTURANDO')
        ->first();
        $totPedFacturando = $reg->contador;
        $reg = DB::table('pedido')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','FACTURANDO')
        ->first();
        $contPedFacturando = $reg->contador;

        // CONTADOR PEDIDO FACTURADO
        $reg = DB::table('pedido')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','FACTURADO')
        ->first();
        $totPedFacturado = $reg->contador;
        $reg = DB::table('pedido')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecprocesado', array($desde, $hasta))
        ->where('estado','=','FACTURADO')
        ->first();
        $contPedFacturado = $reg->contador;


        // CONTADOR RECLAMO
        $reg = DB::table('reclamo')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecenviado', array($desde, $hasta))
        ->first();
        $totReclamo = $reg->contador;
        $reg = DB::table('reclamo')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecenviado', array($desde, $hasta))
        ->first();
        $contReclamo = $reg->contador;

        // CONTADOR DE PAGO
        $reg = DB::table('pago')
        ->selectRaw('sum(total) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecenviado', array($desde, $hasta))
        ->first();
        $totPago = $reg->contador;
        $reg = DB::table('pago')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecenviado', array($desde, $hasta))
        ->first();
        $contPago = $reg->contador;

        // MONTO CUENTA POR COBRAR
        $reg = DB::table('cxc')
        ->selectRaw('sum(saldo) as contador')
        ->where('codisb','=',$sucactiva)
        ->where('saldo','>','0')
        ->first();
        $totCxc = $reg->contador;

        // MONTO CUENTA POR PAGAR
        $reg = DB::table('cxp')
        ->selectRaw('sum(saldo) as contador')
        ->where('codisb','=',$sucactiva)
        ->where('saldo','>','0')
        ->first();
        $totCxp = $reg->contador;

        // CONTADOR DE PROVEEDORES 
        $reg = DB::table('proveedor')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->first();
        $contProveedor = $reg->contador;

        // CONTADOR DE CLIENTES 
        $reg = DB::table('cliente')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->first();
        $contCliente = $reg->contador;

        // CONTADOR DE PRODUCTO
        $reg = DB::table('producto')
        ->selectRaw('count(*) as contador')
        ->where('codisb','=',$sucactiva)
        ->first();
        $contProducto = $reg->contador;

        return view('seped.report.resumen',["menu" => "Reportes", 
                                            "subtitulo" => $subtitulo,
                                            "fecha" => $fecha,
                                            "desde"=>$desde,
                                            "hasta"=>$hasta,
                                            "totVentas"=>$totVentas,
                                            "contFact"=>$contFact,
                                            "totPedEnviado"=>$totPedEnviado, 
                                            "contPedEnviado"=>$contPedEnviado,
                                            "totPedAprobado"=>$totPedAprobado, 
                                            "contPedAprobado"=>$contPedAprobado,
                                            "totPedAnulado"=>$totPedAnulado, 
                                            "contPedAnulado"=>$contPedAnulado,
                                            "totReclamo"=>$totReclamo,
                                            "contReclamo"=>$contReclamo,
                                            "totPago"=>$totPago,
                                            "contPago"=>$contPago,
                                            "contCliente"=>$contCliente,
                                            "contProveedor"=>$contProveedor,
                                            "totCxp"=>$totCxp,
                                            "totCxc"=>$totCxc,
                                            "contProducto"=>$contProducto,
                                            "totPedPicking" => $totPedPicking,
                                            "contPedPicking" => $contPedPicking,
                                            "totPedPacking" => $totPedPacking,
                                            "contPedPacking" => $contPedPacking,
                                            "totPedFacturando" => $totPedFacturando,
                                            "contPedFacturando" => $contPedFacturando,
                                            "totPedFacturado" => $totPedFacturado,
                                            "contPedFacturado" => $contPedFacturado,
                                            "sucactiva" => $sucactiva,
                                            "cfg" => $cfg
                                         ]);
    }

    public function superoferta($id) {
        $subtitulo = "CONSULTA DE PRODUCTO";
        $tabla = DB::table('producto')
                ->where('codprod','=',$id)
                ->first();
        if (empty($tabla)) {
             return Redirect::back()->with('error', 'Codprod '.$id.' no tiene información en este momento');
        }
        return view('seped.report.prodver',["menu" => "Reportes",
                                            "tabla" => $tabla, 
                                            "subtitulo" => $subtitulo,
                                            "cfg" => DB::table('cfg')->first(),
                                            "codprod" => $id]);
    }
   
}