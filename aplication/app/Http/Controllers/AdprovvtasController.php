<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class AdprovvtasController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $codmarca = Auth::user()->codcli;
        $filtro=trim($request->get('filtro'));
        $desde=trim($request->get('desde'));
        $hasta=trim($request->get('hasta'));
        if ($desde=='' || $hasta=='') {
            $hasta = date('Y-m-d');
            $desde = date('Y-m-d', strtotime('-7 day', strtotime($hasta)));
        }
        $desde = $desde.' 00:00:00';
        $hasta = $hasta.' 23:59:00';
        $subtitulo = "PRODUCTOS MAS VENDIDOS";
      	$tipo = Auth::user()->tipo;
        if ($tipo == 'A') {
          $factren = DB::table('factren')
          ->select('codprod as codprod', 'desprod as desprod','referencia as referencia', 'marca as marca', DB::raw('SUM(cantidad) as cantidad'))
          ->where('codisb','=',$sucactiva)
          ->whereBetween('fecfactura', array($desde, $hasta))
          ->where(function ($q) use ($filtro) {
            $q->where('desprod','LIKE','%'.$filtro.'%')
            ->orwhere('codprod','LIKE','%'.$filtro.'%')
            ->orwhere('referencia','LIKE','%'.$filtro.'%');
          })
          ->groupBy('codprod', 'desprod', 'referencia', 'marca')
          ->orderBy('cantidad','desc')
          ->get();
        } else {
   		  	if ($tipo != 'P')
     		  		return back()->with('error', 'Código proveedor no encontrado!');  
  		
          $marca = DB::table('marca')
          ->where('codmarca','=',$codmarca)
          ->first();
          if (empty($marca)) 
    				return back()->with('error', 'Código proveedor no encontrado!');              	
          $factren = DB::table('factren')
          ->select('codprod as codprod', 'desprod as desprod','referencia as referencia', 'marca as marca', DB::raw('SUM(cantidad) as cantidad'))
          ->where('codisb','=',$sucactiva)
          ->where('marca','LIKE','%'.$codmarca.'%')
          ->whereBetween('fecfactura', array($desde, $hasta))
          ->where(function ($q) use ($filtro) {
            $q->where('desprod','LIKE','%'.$filtro.'%')
            ->orwhere('codprod','LIKE','%'.$filtro.'%')
            ->orwhere('referencia','LIKE','%'.$filtro.'%');
          })
          ->groupBy('codprod', 'desprod', 'referencia', 'marca')
          ->orderBy('cantidad','desc')
          ->get();
        }      
     	  return view('seped.provvtas.index' ,["menu" => "Reportes",
       									   	                 "factren" => $factren,
                                             "desde" => $desde,
                                             "hasta" => $hasta,
                                             "filtro" => $filtro,
                                             "codmarca" => $codmarca,
       									    	               "subtitulo" => $subtitulo,
                                             "sucactiva" => $sucactiva,
                                             "cfg" => $cfg ]);
    	}
    }

}
