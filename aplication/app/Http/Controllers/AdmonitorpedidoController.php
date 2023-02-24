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
use Session;

class AdmonitorpedidoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
        if ($request) {
            $filtro=trim($request->get('filtro'));
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $tabla = DB::table('pedido')
            ->where('codisb','=',$sucactiva)
            ->where(function ($q) use ($filtro) {
                $q->where('estado','LIKE','%'.$filtro.'%')
                ->orwhere('nomcli','LIKE','%'.$filtro.'%')
                ->orwhere('estado','LIKE','%'.$filtro.'%')
                ->orwhere('codcli','LIKE','%'.$filtro.'%')
                ->orwhere('fecha','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
                ->orwhere('fecenviado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
                ->orwhere('fecprocesado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%');
            })
            ->orderBy('id','desc')
            ->paginate(100);

            $reg = DB::table('pedido')
            ->where('codisb','=',$sucactiva)
            ->selectRaw('count(*) as contador')
            ->first();
            $cont = $reg->contador;
            $subtitulo = "PEDIDOS (".number_format($cont,0, '.', ',').")";
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
            return view('seped.monitorpedido.index' ,["menu" => "Pedidos",
                                                      "sucactiva" => $sucactiva,
                                                      "tabla" => $tabla, 
                                                      "filtro" => $filtro,
                                                      "cfg" => $cfg,
                                                      "subtitulo" => $subtitulo]);
        }
    }

    public function show($id) {
        $subtitulo = "PEDIDO";
    
        // TABLA DE PEDIDO
        $tabla = DB::table('pedido')
        ->where('id','=',$id)
        ->first();

        // TABLA DE RENGLONES DE PEDIDO
        $tabla2 = DB::table('pedren')
        ->where('id','=',$id)
        ->get();

        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view('seped.monitorpedido.show',["menu" => "Pedidos",
                                                "sucactiva" => $sucactiva,
                                                "tabla" => $tabla, 
                                                "tabla2" => $tabla2, 
                                                "subtitulo" => $subtitulo,
                                                "cfg" => $cfg,
                                                "id" => $id]);
    }

    public function destroy($id) {
        $reg = DB::table('pedido')
        ->where('id','=',$id)
        ->delete();

        $reg = DB::table('pedren')
        ->where('id','=',$id)
        ->delete();

        return Redirect::to('/seped/monitorpedido');
    }

    public function edit($id) {
        $subtitulo = "MODIFICAR ESTATUS DEL PEDIDO";
        $tabla = DB::table('pedido')
        ->where('id','=',$id)
        ->first();
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view("seped.monitorpedido.edit",["menu" => "Pedidos",
                                                "sucactiva" => $sucactiva,
                                                "tabla" => $tabla, 
                                                "cfg" => $cfg,
                                                "subtitulo"=>$subtitulo]);
    }

    public function update(Request $request, $id) {
        $estado = $request->get('estado');
        DB::table('pedido')
        ->where('id','=',$id)
        ->update(array("estado" => $estado));
        return Redirect::to('/seped/monitorpedido');
    }
}
