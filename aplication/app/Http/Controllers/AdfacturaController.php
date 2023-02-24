<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Session;
use DB;
use Barryvdh\DomPDF\Facade as PDF; 

class AdfacturaController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request) {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
            $codcli = sCodigoClienteActivo();
            $desde=trim($request->get('desde'));
            $hasta=trim($request->get('hasta'));

            if ($desde=='' || $hasta=='') {
                $hasta = date('Y-m-d');
                $desde = date('Y-m-d', strtotime('-7 day', strtotime($hasta)));
            }
            $desde = $desde.' 00:00:00';
            $hasta = $hasta.' 23:59:00';
	        if ($cfg) {
	            $date1 = $cfg->fecha;
	            $fecha = date('d-m-Y H:i:s', strtotime($date1));
	        }
	        // TABLA DE FACTURAS
	        $tabla = DB::table('fact')
            ->where('codcli','=',$codcli)
            ->where('codisb','=',$sucactiva)
            ->whereBetween('fecha', array($desde, $hasta))
            ->orderBy('factnum','desc')
            ->get();

            $reg = DB::table('fact')
            ->selectRaw('count(*) as contador')
            ->where('codcli','=',$codcli)
            ->where('codisb','=',$sucactiva)
            ->first();
            $cont = $reg->contador;
            $subtitulo = "FACTURAS (".number_format($cont,0, '.', ',').")";

	        return view('seped.factura.index',["menu"=>"Facturas",
                                               "tabla" => $tabla, 
                                               "subtitulo" => $subtitulo,
	                                           "desde"=>$desde,
                                               "hasta"=>$hasta,
                                               "cfg" => $cfg,
	                                           "$codcli"=>$codcli]);
    	}
    }
	
	public function show($id) {
    	$subtitulo = "CONSULTA DE FACTURA";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        // TABLA DE FACTURAS
        $tabla = DB::table('fact')
        ->where('factnum','=',$id)
        ->where('codisb','=',$sucactiva)
        ->first();

        // TABLA DE RENGLONES DE FACTURAS
        $tabla2 = DB::table('factren')
        ->where('factnum','=',$id)
        ->where('codisb','=',$sucactiva)
        ->orderBy('renglon','asc')
        ->get();
       
        return view('seped.factura.show',["menu"=>"Facturas",
                                          "tabla" => $tabla, 
                                          "tabla2" => $tabla2, 
                                          "subtitulo" => $subtitulo,
                                          "cfg" => $cfg,
                                          "factnum" => $id]);
    }

	public function descargartxt($id) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $archivo = 'FACT'.$id.'.txt';
        $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
        $rutaarc = $BASE_PATH.'/public/storage/'.$archivo;
        $fs = fopen($rutaarc,"w");
        $unidades = 0;
        $renglones = 0;
        $bultos = 1;
        $factren = DB::table('factren')
        ->where('factnum','=',$id)
        ->where('codisb','=',$sucactiva)
        ->get();
        foreach ($factren as $fr) {
            $unidades = $unidades + $fr->cantidad;
            $renglones++;
        }

        $f = DB::table('fact')
        ->where('factnum','=',$id)
        ->where('codisb','=',$sucactiva)
        ->first();
        $PPP = "0.00"; $MPP = "0.00";
        $PDI = "0.00"; $MDI = "0.00";
        $PDO = "0.00"; $MDO = "0.00";
        $SICM = "";
        $fechafact = strtotime($f->fecha);
        $fechafact = date('d/m/Y', $fechafact);
        $fechafact =  substr($fechafact, 0, 10);

        $vence = strtotime($f->fechav);
        $vence = date('d/m/Y', $vence);
        $vence =  substr($vence, 0, 10);
        $ORIGEN = "WEB";

        $fileText = "02|".$id."|".$unidades."|".$f->monto."|".$f->iva."|".$f->total."|".$PPP."|".$PDI."|".$PDO."|".$MPP."|".$MDI."|".$MDO."|".$fechafact."|".$renglones."|".$bultos."|".$vence."|".$f->nroctrol."|".$SICM."|".$f->rif."|".$f->codvend."|".$ORIGEN."|".PHP_EOL;
        fwrite($fs,$fileText);
        foreach ($factren as $fr) {
            $TIPO = ($fr->impuesto == 0) ? 'M' : 'C';
            $IVA = $fr->impuesto;
            $DCTOS = $fr->descto;
            $LOTE = $fr->nrolote;
            $VENCE = strtotime($fr->fechal);
            $VENCE = date('d/m/Y', $VENCE);
            $VENCE =  substr($VENCE, 0, 10);
            $PROV = "";
            $REGULADO = "0";
            $traza = "01|".$id."|".$fr->codprod."|".$TIPO."|".$REGULADO."|".$fr->desprod."|".$fr->cantidad."|".$fr->subtotal."|".$fr->precio."|".$fr->subtotal."|".$IVA."|".$DCTOS."|".$fr->referencia."|".$LOTE."|".$VENCE."|".$PROV."|".$fr->precio."|||".PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);
        $headers = ['Content-type'=>'text/plain', 'test'=>'YoYo', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $archivo),'X-BooYAH'=>'WorkyWorky'];
        return response()->download($rutaarc);
    }

    public function descargarpdf($id) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

        $titulo = "FACTURA: ".$id;
        // TABLA DE FACTURAS
        $tabla = DB::table('fact')
        ->where('factnum','=',$id)
        ->where('codisb','=',$sucactiva)
        ->first();
        $subtitulo = $tabla->descrip;
        $codcli = $tabla->codcli;
        // TABLA DE CLIENTE
        $cliente = DB::table('cliente')
        ->where('codcli','=',$codcli)
        ->where('codisb','=',$sucactiva)
        ->first();

        // TABLA DE RENGLONES DE FACTURAS
        $tabla2 = DB::table('factren')
        ->where('factnum','=',$id)
        ->where('codisb','=',$sucactiva)
        ->orderBy('renglon','asc')
        ->get();

        $numreng = 0;
        $numund = 0;
        foreach ($tabla2 as $t) {
            $numund += $t->cantidad;
            $numreng++;
        }

        $data = [
            "menu"=>"Facturas",
            "tabla" => $tabla, 
            "tabla2" => $tabla2, 
            "titulo" => $titulo,
            "subtitulo" => $subtitulo,
            "cfg" => $cfg,
            "cliente" => $cliente,
            "numreng" => $numreng,
            "numund" => $numund,
            "factnum" => $id
        ];

        $formato = $cfg->formatoPersFac;
        if ($formato == "" || $formato == 'rptfactura') {
             $pdf = PDF::loadView('layouts.rptfactura', $data);
        } else {
            $pdf = PDF::loadView('layouts.'.$formato, $data)->setPaper('a4', 'landscape');
        }
        return $pdf->download('factura'.$id.'.pdf');
    }
    
}
