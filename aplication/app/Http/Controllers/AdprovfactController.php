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
 
class AdprovfactController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    		$filtro=trim($request->get('filtro'));
        $desde=trim($request->get('desde'));
        $hasta=trim($request->get('hasta'));
        if ($desde=='' || $hasta=='') {
            $hasta = date('Y-m-d');
            $desde = date('Y-m-d', strtotime('-7 day', strtotime($hasta)));
        }
        $desde = $desde.' 00:00:00';
        $hasta = $hasta.' 23:59:00';
         
 		  	$tipo = Auth::user()->tipo;
 		  	if ($tipo != 'P')
   		  		return back()->with('error', 'Código proveedor no encontrado!');  

		  	$codmarca = Auth::user()->codcli;
        $proveedor = DB::table('marca')
        ->where('codmarca','=',$codmarca)
        ->first();
        if (empty($proveedor)) 
  				return back()->with('error', 'Código proveedor no encontrado!');              	
        
        $fact = DB::table('fact')
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecha', array($desde, $hasta))
        ->where(function ($q) use ($filtro) {
              $q->where('codcli','LIKE','%'.$filtro.'%')
              ->orwhere('descrip','LIKE','%'.$filtro.'%');
        })
        ->whereExists(function ($query) use ($codmarca) {
        $query->select(DB::raw(1))
            ->from('factren')
            ->whereRaw("fact.factnum = factren.factnum")
            ->whereRaw("factren.marca LIKE '%".$codmarca."%'");
        })
        ->orderBy('factnum', 'desc')
        ->get();

        $cont =  number_format($fact->count(), 0, '.', ',');
        $subtitulo = "FACTURAS (".$cont.")";
   		  return view('seped.provfact.index' ,["menu" => "Facturas",
       									   	                 "fact" => $fact,
                                             "desde" => $desde,
                                             "hasta" => $hasta,
                                             "codmarca" => $codmarca,
       									    	               "subtitulo" => $subtitulo,
       											                 "sucactiva" => $sucactiva,
                                             "cfg" => $cfg,
    											                   "filtro" => $filtro]);
    	}
    }

    public function show($id) {
        $codmarca = Auth::user()->codcli;
     
        // TABLA DE FACTURAS
        $fact = DB::table('fact')
                ->where('factnum','=',$id)
                ->first();

        $subtitulo = $fact->descrip;
     
        // TABLA DE RENGLONES DE FACTURAS
        $factren = DB::table('factren')
                ->where('factnum','=',$id)
                ->where('marca','LIKE','%'.$codmarca.'%')
                ->orderBy('renglon','asc')
                ->get();
       
        return view('seped.provfact.show',["menu" => "Facturas",
                                           "fact" => $fact, 
                                           "factren" => $factren, 
                                           "subtitulo" => $subtitulo,
                                           "cfg" => DB::table('cfg')->first(),
                                           "codmarca" => $codmarca,
                                           "factnum" => $id]);
    }

}
