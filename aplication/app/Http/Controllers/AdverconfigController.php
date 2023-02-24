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
use App\Cliente;
use App\user;
use Session;
use DB;


class AdverconfigController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        // CODIGO ISB
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $codcli = sCodigoClienteActivo();
        $subtitulo = "INFORMACIÓN";
        $cli = DB::table('cliente')
        ->where('codcli','=',$codcli)
        ->where('codisb','=',$sucactiva)
        ->first();
        if (empty($cli)) {
            return Redirect::back()->with('error', 'Cliente '.$codcli.' no se encuentra en la base de datos');
        }

        $ctabanco = DB::table('ctabanco')
        ->where('activo','=','1')
        ->where('codisb','=',$sucactiva)
        ->get();
        return view('seped.verconfig.index', ["menu" => "Configuracion",
                                              "cli" => $cli, 
                                              "subtitulo" => $subtitulo,
                                              "sucactiva" => $sucactiva,
                                              "cfg" => $cfg,
                                              "ctabanco" => $ctabanco]);
    }

}