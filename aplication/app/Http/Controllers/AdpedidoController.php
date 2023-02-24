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
use Carbon\Carbon;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;
use Session; 

   
class AdpedidoController extends Controller
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
            $tipo = Auth::user()->tipo;
            // ELIMINA LOS PEDIDOS EN BLANCO
            vEliminarPedidoBlanco($codcli);
            $tipedido = '';
            $idpedido = iIdUltPedAbierto($codcli);
            if ( $idpedido > 0) {
                $pedido = DB::table('pedido')
                ->where('id','=',$idpedido)
                ->where('codisb','=',$sucactiva)
                ->first();
                $tipedido = $pedido->tipedido; 
            }
     		$filtro=trim($request->get('filtro'));
            if ($tipo == 'V') {
        		$tabla=DB::table('pedido')
        		->where('codcli','=',$codcli)
                ->where('codisb','=',$sucactiva)
            	->where(function ($q) use ($filtro) {
	                $q->where('id','LIKE','%'.$filtro.'%')
	                ->orwhere('estado','LIKE','%'.$filtro.'%')
    				->orwhere('origen','LIKE','%'.$filtro.'%')
                    ->orwhere('fecha','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
                    ->orwhere('fecenviado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
    				->orwhere('fecprocesado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%');
    	    	})
        		->orderBy('id','desc')
                ->paginate(100);
            } else {
                $tabla=DB::table('pedido')
                ->where('codcli','=',$codcli)
                ->where('codisb','=',$sucactiva)
                ->where(function ($q) use ($filtro) {
                    $q->where('id','LIKE','%'.$filtro.'%')
                    ->orwhere('estado','LIKE','%'.$filtro.'%')
                    ->orwhere('origen','LIKE','%'.$filtro.'%')
                    ->orwhere('fecha','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
                    ->orwhere('fecenviado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
                    ->orwhere('fecprocesado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%');
                })
                ->orderBy('id','desc')
                ->paginate(100);
            }
            $reg = DB::table('pedido')
            ->selectRaw('count(*) as contador')
            ->where('codcli','=',$codcli)
            ->where('codisb','=',$sucactiva)
            ->first();
            $cont = $reg->contador;
            $subtitulo = "PEDIDOS (".number_format($cont,0, '.', ',').")";
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
    		return view('seped.pedido.index' ,["menu" => "Pedidos",
                                               "sucactiva" => $sucactiva,
                                               "tabla" => $tabla, 
    						 	               "filtro" => $filtro,
                                               "tipedido" => $tipedido,
                                               "cfg" => DB::table('cfg')->first(),
    									       "subtitulo" => $subtitulo]);
    	}
    }

	public function show($id) {
	   $subtitulo = "CONSULTA DE PEDIDO";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

    	// TABLA DE PEDIDO
        $tabla = DB::table('pedido')
	    ->where('id','=',$id)
        ->first();

        // TABLA DE RENGLONES DE PEDIDO
        $tabla2 = DB::table('pedren')
        ->where('id','=',$id)
        ->orderBy('item','asc')
        ->get();

        return view('seped.pedido.show',["menu" => "Pedidos",
                                         "tabla" => $tabla, 
                                         "tabla2" => $tabla2, 
                                         "subtitulo" => $subtitulo,
                                         "sucactiva" => $sucactiva,
                                         "cfg" => $cfg,
                                         "id" => $id]);
    }

	public function destroy($id) {
        try {
            DB::beginTransaction();
    		$regs = DB::table('pedido')
    		->where('id','=',$id)
      		->delete();
            $regs = DB::table('pedren')
            ->where('id','=',$id)
            ->delete();
            DB::commit();
            session()->flash('message', 'Pedido '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
		return Redirect::to('/seped/pedido');
	}

    public function descargar($id) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    
        // TABLA DE PEDIDO
        $tabla = DB::table('pedido')
        ->where('id','=',$id)
        ->first();

        $titulo = "PEDIDO: ".$id.'-'.$tabla->tipedido;
        $subtitulo = $tabla->nomcli;

        // TABLA DE RENGLONES DE PEDIDO
        $tabla2 = DB::table('pedren')
        ->where('id','=',$id)
        ->orderBy('item','asc')
        ->get();

        $data = [
            "titulo" => $titulo,
            "subtitulo" => $subtitulo,
            "tabla" => $tabla, 
            "tabla2" => $tabla2, 
            "cfg" => $cfg,
            "sucactiva" => $sucactiva,
            "id" => $id
        ];

        $formato = $cfg->formatoPersPed;
        if ($formato == "" || $formato == 'rptpedido') {
             $pdf = PDF::loadView('layouts.rptpedido', $data);
        } else {
            $pdf = PDF::loadView('layouts.'.$formato, $data);
        }
        return $pdf->download('pedido'.$id.'.pdf');
    }

}
