<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
 
class AdgrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if ($request)  {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
            $subtitulo = "GRUPOS";
            $filtro = trim($request->get('filtro'));
            $grupo = DB::table('grupo')
            ->where('codisb','=',$sucactiva)
            ->where('nomgrupo','LIKE','%'.$filtro.'%')
            ->orderBy('id','desc')
            ->get();
            return view('seped.grupo.index' ,["menu" => "Grupos",
                                              "grupo" => $grupo,
                                              "subtitulo" => $subtitulo,
                                              "sucactiva" => $sucactiva,
                                              "cfg" => $cfg,
                                              "filtro" => $filtro]);
        }
    }

    public function create(Request $request) {
        $ctipo=trim($request->get('ctipo'));
        $subtitulo = "GRUPO NUEVO";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view("seped.grupo.create",["menu" => "Grupos",
                                          "sucactiva" => $sucactiva,
                                          "cfg" => $cfg,
                                          "subtitulo" => $subtitulo]);
    }

    public function store(Request $request) {
        try {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            DB::table('grupo')->insert([
                'nomgrupo' => $request->get('nomgrupo'),
                'codisb' => $sucactiva
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
        return Redirect::to('/seped/grupo');
    }

    public function show($id) {
        $subtitulo = "CONSULTAR GRUPO";
        $grupo = DB::table('grupo')
        ->where('id','=',$id)
        ->first();
        $gruporen = DB::table('gruporen')
        ->where('id','=',$grupo->id)
        ->get();
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view("seped.grupo.show",["menu" => "Grupos",
                                        "grupo" => $grupo,
                                        "gruporen" => $gruporen,
                                        "sucactiva" => $sucactiva,
                                        "cfg" => $cfg,
                                        "subtitulo" => $subtitulo]);
    }

    public function edit($id) {
        $subtitulo = "EDITAR GRUPO";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $grupo = DB::table('grupo')
        ->where('id','=',$id)
        ->first();
        $gruporen = DB::table('gruporen')
        ->where('id','=',$grupo->id)
        ->get();
        $cliente = DB::table('cliente')
        ->where('codisb','=',$sucactiva)
        ->get();
        return view("seped.grupo.edit",["menu" => "Grupos",
                                        "grupo" => $grupo,
                                        "gruporen" => $gruporen,
                                        "cliente" => $cliente,
                                        "sucactiva" => $sucactiva,
                                        "cfg" => $cfg,
                                        "subtitulo" => $subtitulo]);
    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            $regs = DB::table('grupo')
            ->where('id','=',$id)
            ->delete();
            $gruporen = DB::table('gruporen')
            ->where('id','=',$id)
            ->delete();
            $user = DB::table('users')
            ->where('tipo','=','G')
            ->where('codcli','=',$id)
            ->delete();
            DB::commit();
            session()->flash('message', 'Grupo '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/grupo');
    }

    public function delcli($id) {
        $s1 = explode('_', $id );
        $id = $s1[0];
        $codcli = $s1[1];
        $gruporen = DB::table('gruporen')
        ->where('id','=',$id)
        ->where('codcli','=',$codcli)
        ->delete();
        return Redirect::to('/seped/grupo/'.$id.'/edit');
    }

    public function gruporen(Request $request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $id = trim($request->get('id'));
        $s = $request->get('codcli');
        $s1 = explode('|', $s );
        $codcli = trim($s1[0]);
        $nomcli = trim($s1[1]);
        $reg = DB::table('gruporen')
        ->where('id', $id)
        ->where('codcli', $codcli)
        ->first();
        if (is_null($reg)) {
            DB::table('gruporen')->insert([
                'id' => $id,
                'codcli' => $codcli, 
                'nomcli' => $nomcli,
                'codisb' => $sucactiva
            ]);
        } else {
            session()->flash('error', "cliente ya esta registrado en el grupo");
        }
        return Redirect::to('/seped/grupo/'.$id.'/edit');
    }
}
