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

class AdprovcataController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }  

    public function index(Request $request) {
    	if ($request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

    		$subtitulo = "CATALOGO";
    		$filtro=trim($request->get('filtro'));
   		  $tipo = Auth::user()->tipo;
   		  if ($tipo != 'P')
   		  		return back()->with('error', 'Código proveedor no encontrado!');  

  	  	$codmarca = Auth::user()->codcli;
        $proveedor = DB::table('marca')
        ->where('codmarca','=',$codmarca)
        ->first();
        if (empty($proveedor)) 
				  return back()->with('error', 'Código proveedor no encontrado!');              	
        
    		$producto = DB::table('producto')
        ->where('codisb','=',$sucactiva)
    		->where('marcamodelo','LIKE','%'.$codmarca.'%')
    		->where(function ($q) use ($filtro) {
          $q->where('desprod','LIKE','%'.$filtro.'%')
          ->orwhere('codprod','LIKE','%'.$filtro.'%')
          ->orwhere('barra','LIKE','%'.$filtro.'%')
          ->orwhere('pactivo','LIKE','%'.$filtro.'%');
        })
    		->orderBy('desprod','desc')
        ->get();
        $cont =  number_format($producto->count(), 0, '.', ',');
        $subtitulo = "CATALOGO (".$cont.")";
     		return view('seped.provcata.index' ,["menu" => "Catalogo",
                                                        "producto" => $producto,
                                                        "subtitulo" => $subtitulo,
                                                        "sucactiva" => $sucactiva,
                                                        "cfg" => $cfg,
                                                        "filtro" => $filtro]);
    	}
    }

}
