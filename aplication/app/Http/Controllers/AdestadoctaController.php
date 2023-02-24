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
use App\user;
use Session;
use DB;

 
class AdestadoctaController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if (Auth::user()->tipo == "C" ) {
            $subtitulo = "CUENTAS POR PAGAR";
            $menu = "Cxp"; 
        } else {
            $subtitulo = "CUENTAS POR COBRAR";
            $menu = "Cxc";
        }
        $filtro=trim($request->get('filtro'));
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        if (Auth::user()->tipo == "A" || Auth::user()->tipo == "R") {

            $tabla = DB::table('cxc as cc')
            ->join('cliente as cl', 'cc.codcli' ,'=', 'cl.codcli')
            ->select('*', 'cc.saldo as ccsaldo', 'cc.saldoDs as ccsaldoDs', 'cc.factorcambiario as factorcambiario')
            ->where('cl.codisb','=',$sucactiva)
            ->where(function ($q) use ($filtro) {
                $q->orwhere('cl.nombre','LIKE','%'.$filtro.'%')
                ->orwhere('cc.numerod','LIKE','%'.$filtro.'%')
                ->orwhere('cc.codcli','LIKE','%'.$filtro.'%');
            })
            ->orderBy('fecha','asc')
            ->get();

            $reg = DB::table('cxc')
            ->selectRaw('count(*) as contador')
            ->where('codisb','=',$sucactiva)
            ->where('saldo','>','0')
            ->first();
            $cont = $reg->contador;
            $subtitulo = $subtitulo." (".number_format($cont,0, '.', ',').")";


        } else {
            $codcli = sCodigoClienteActivo();
            $tabla = DB::table('cxc as cc')
            ->join('cliente as cl', 'cc.codcli' ,'=', 'cl.codcli')
            ->select('*', 'cc.saldo as ccsaldo', 'cc.saldoDs as ccsaldoDs', 'cc.factorcambiario as factorcambiario')
            ->where('cl.codisb','=',$sucactiva)
            ->where('cc.codcli','=',$codcli)
                ->where(function ($q) use ($filtro) {
                    $q->orwhere('cc.numerod','LIKE','%'.$filtro.'%')
                    ->orwhere('cc.fechai','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%');
                })
            ->orderBy('fecha','asc')
            ->get();

            $reg = DB::table('cxc')
            ->selectRaw('count(*) as contador')
            ->where('codisb','=',$sucactiva)
            ->where('saldo','>','0')
            ->where('codcli','=',$codcli)
            ->first();
            $cont = $reg->contador;
            $subtitulo = $subtitulo." (".number_format($cont,0, '.', ',').")";
        }

        return view('seped.estadocta.index',["menu" => $menu,
                                             "tabla" => $tabla, 
                                             "subtitulo" => $subtitulo,
                                             "sucactiva" => $sucactiva,
                                             "cfg" => $cfg,
                                             "filtro" => $filtro ]);
    }

    public function show($id) {
        $s1 = explode('-', $id );
        $tipocxc = $s1[0];
        $numerod = $s1[1];
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        if (Auth::user()->tipo == "C") {
            $subtitulo = "CONSULTA DE CUENTA POR PAGAR";
            $menu = "Cxp";
            
        } else {
            $subtitulo = "CONSULTA DE CUENTA POR COBRAR";
            $menu = "Cxc";
        }
        // TABLA DE CXP
        $tabla = DB::table('cxc')
        ->where('codisb','=',$sucactiva)
        ->where('numerod','=',$numerod)
        ->where('tipocxc','=',$tipocxc)
        ->first();

        // TABLA DE CLIENTE
        $tabla2 = DB::table('cliente')
        ->where('codisb','=',$sucactiva)
        ->where('codcli','=',$tabla->codcli)
        ->first();

        return view('seped.estadocta.show',["menu" => $menu,
                                            "tabla" => $tabla,
                                            "tabla2" => $tabla2, 
                                            "sucactiva" => $sucactiva,
                                            "cfg" => $cfg,
                                            "subtitulo" => $subtitulo]);
    }

}