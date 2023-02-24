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

class AdclientenofiscalController extends Controller
{
  public function __construct()
  {
  	$this->middleware('auth');
  }

  public function index(Request $request) {
  	if ($request) {
     	$subtitulo = "CLIENTES NO FISCALES";
  		$filtro=trim($request->get('filtro'));
  		$tabla = DB::table('clientenofiscal')
      ->where('nombre','LIKE','%'.$filtro.'%')
      ->Orwhere('nombre','LIKE','%'.$filtro.'%')
  		->orderBy('nombre','asc')
      ->paginate(100);
  		return view('seped.clientenofiscal.index' ,["menu" => "ClienteNofical",
                                                  "tabla" => $tabla, 
  									                              "filtro" => $filtro,
                                                  "cfg" => DB::table('cfg')->first(),
  									                              "subtitulo" => $subtitulo]);
  	}
  }

    public function create() {
    $subtitulo = "AGREGAR CLIENTE NO FISCAL";
    $tabla = DB::table('cliente')
    ->whereNotExists(function($query) {
        $query->select(DB::raw(1))
        ->from('clientenofiscal')
        ->whereRaw("clientenofiscal.codcli = cliente.codcli");
    })
    ->orderBy('nombre','asc')
    ->get();
    return view('seped.clientenofiscal.create' ,["menu" => "ClienteNofical",
                                                 "tabla" => $tabla,
                                                 "cfg" => DB::table('cfg')->first(),
                                                 "subtitulo" => $subtitulo]);
  }

  public function store(Request $request) {
        $mensaje = "";
        $codcli = $request->get('codcli');
        $reg = DB::table('clientenofiscal')
        ->where('codcli','=',$codcli)
        ->first();
        if ($reg) {
            session()->flash('error', "Este cliente ya existe en la lista");
        }
        else {
            $cliente = DB::table('cliente')
            ->where('codcli','=',$codcli)
            ->first();
            $nombre = $cliente->nombre;
            DB::table('clientenofiscal')->insert([
                'codcli' => $codcli,
                'nombre' => $nombre 
            ]);
            session()->flash('message','Cliente '.$codcli.' agregado satisfactoriamente a la lista fiscal, a partir de este momento');
        }
        return Redirect::to('/seped/clientenofiscal');
  }
 
	public function destroy($id) {
    try {
      DB::beginTransaction();
      DB::table('clientenofiscal')
      ->where('codcli','=',$id)
      ->delete();
      DB::commit();
      session()->flash('message', 'Código '.$id.' será desde este momento tratado como cliente fiscal');
    } catch (Exception $e) {
        DB::rollBack();
        session()->flash('error', $e);
    }
    return Redirect::to('/seped/clientenofiscal');
	}

}
