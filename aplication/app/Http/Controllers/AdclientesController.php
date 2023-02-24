<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Session;
use DB; 
 
class AdclientesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request)
    	{
            $filtro=trim($request->get('filtro'));
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
	        // TABLA DE CLIENTES
	        $tabla = DB::table('cliente')
         	->where('codisb','=',$sucactiva)
            ->where(function ($q) use ($filtro) {
                $q->where('nombre','LIKE','%'.$filtro.'%')
                ->Orwhere('codcli','LIKE','%'.$filtro.'%')
                ->Orwhere('rif','LIKE','%'.$filtro.'%')
                ->Orwhere('estado','LIKE','%'.$filtro.'%')
                ->Orwhere('contacto','LIKE','%'.$filtro.'%');
            })
            ->orderBy('nombre','asc')
            ->paginate(100);

            $reg = DB::table('cliente')
            ->where('codisb','=',$sucactiva)
            ->selectRaw('count(*) as contador')
            ->first();
            $cont = $reg->contador;
   	        $subtitulo = "CLIENTES (".number_format($cont,0, '.', ',').")";
   	        return view('seped.clientes.index',["menu" => "Clientes",
	        									"sucactiva" => $sucactiva,
	                                      	    "tabla" => $tabla, 
	                                            "subtitulo" => $subtitulo,
	                                            "cfg" => DB::table('cfg')->first(),
	                                            "filtro"=>$filtro]);
    	}
    }

	public function show($id) {
   	 	$subtitulo = "CONSULTA DE CLIENTE";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $tabla = DB::table('cliente')
        ->where('codcli','=',$id)
        ->where('codisb','=',$sucactiva)
        ->first();
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view('seped.clientes.show',["menu" => "Clientes",
        								   "sucactiva" => $sucactiva,
                                           "tabla" => $tabla, 
                                           "subtitulo" => $subtitulo,
                                           "cfg" => $cfg,
                                           "codcli" => $id]);
    }

	public function edit($id) {
		$subtitulo = "EDITAR CLIENTE";
    	$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
		$cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
		$tabla = DB::table('cliente')
        ->where('codcli','=',$id)
        ->where('codisb','=',$sucactiva)
        ->first();
		return view("seped.clientes.edit",["menu" => "Clientes",
										   "sucactiva" => $sucactiva,
				 						   "tabla" => $tabla, 
				 						   "cfg" => $cfg,
    			 						   "subtitulo"=>$subtitulo]);
	}

	public function update(Request $request, $codcli) {
		$estado = $request->get('estado');
		$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
		$critSepMoneda = ($request->get('critSepMoneda') == 'on' ? '1' : '0');
        $codisbactivo = ($request->get('codisbactivo') == 'on' ? '1' : '0');
		DB::table('cliente')
		->where('codcli','=',$codcli)
		->where('codisb','=',$sucactiva)
    	->update(array("estado" => $estado, 
                       "codisbactivo" => $codisbactivo, 
                       'critSepMoneda' => $critSepMoneda));
		return Redirect::to('/seped/clientes');
	}
}
