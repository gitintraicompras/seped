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
  
class CestasEntregarController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
 
    public function index(Request $request) {
        if ($request) {
            $nomcli = "";
            $subtitulo = "CESTAS POR DEVOLVER";
            $cfg = DB::table('cfg')->first();
            $tipo = Auth::user()->tipo;
            if ($tipo == 'A') {
                $cestas = DB::table('cestas')
                ->orderBy('cesta_co','desc')
                ->get();
            } else {
                $codcli = sCodigoClienteActivo();
                $cestas = DB::table('cestas')
                ->where('co_cli','=',$codcli)
                ->orderBy('cesta_co','desc')
                ->get();
                if ($codcli) {
                    $cli = DB::table('cliente')
                    ->where('codcli','=',$codcli)
                    ->first();
                    if ($cli) {
                        $nomcli = $cli->nombre; 
                    }
                }
            }
            return view('seped.cestasentregar.index' ,["menu" => "Reportes",
                                                       "cestas" => $cestas, 
                                                       "cfg" => DB::table('cfg')->first(),
                                                       "subtitulo" => $subtitulo]);
        }
    }

}
