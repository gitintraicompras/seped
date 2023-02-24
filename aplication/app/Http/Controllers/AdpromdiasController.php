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
 
class AdpromdiasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if ($request)  {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
            $subtitulo = "PROMOCION X DIAS";
            $filtro = trim($request->get('filtro'));
            $promdias = DB::table('promdias')
            ->where('codisb','=',$sucactiva)
            ->where('descrip','LIKE','%'.$filtro.'%')
            ->orderBy('id','desc')
            ->get();
            return view('seped.promdias.index' ,["menu" => "Promdias",
                                                 "promdias" => $promdias,
                                                 "subtitulo" => $subtitulo,
                                                 "sucactiva" => $sucactiva,
                                                 "cfg" => $cfg,
                                                 "filtro" => $filtro]);
        }
    }

    public function create(Request $request) {
        $ctipo=trim($request->get('ctipo'));
        $subtitulo = "PROMOCION NUEVA";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view("seped.promdias.create",["menu" => "Promdias",
                                             "sucactiva" => $sucactiva,
                                             "cfg" => $cfg,
                                             "subtitulo" => $subtitulo]);
    }

    public function store(Request $request) {
        try {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());

            $idx = DB::table('promdias')->insertGetId([
                'descrip' => $request->get('descrip'),
                'dias' => $request->get('dias'),
                'desde' => date("Y-m-d", strtotime($request->get('desde'))),
                'hasta' => date("Y-m-d", strtotime($request->get('hasta'))),
                'codisb' => $sucactiva
            ]);

            $criterio = '$pr->dcredito == '.$request->get('dias');
            DB::table('pedcrisep')->insert([
                'descrip' => $request->get('descrip'),
                'criterio' => $criterio,
                'diasCredito' => $request->get('dias'),
                'estado' => "ACTIVO",
                'codisb' => $sucactiva,
                "origenPromDias" => $idx
            ]);


        } catch (\Exception $e) {
            dd($e);
        }
        return Redirect::to('/seped/promdias');
    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            $regs = DB::table('promdias')
            ->where('id','=',$id)
            ->delete();
            $promren = DB::table('promren')
            ->where('id','=',$id)
            ->delete();

            $pedcrisep = DB::table('pedcrisep')
            ->where('origenPromDias','=',$id)
            ->delete();

            DB::commit();
            session()->flash('message', 'Promoción '.$id.' eliminada satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/promdias');
    }

    public function edit($id) {
        $subtitulo = "EDITAR PROMOCION";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $promdias = DB::table('promdias')
        ->where('id','=',$id)
        ->first();
        $promren = DB::table('promren')
        ->where('id','=',$promdias->id)
        ->get();
        $producto = DB::table('producto')
        ->where('codisb','=',$sucactiva)
        ->get();
        $filtro = "";
        return view("seped.promdias.edit",["menu" => "Promdias",
                                           "promdias" => $promdias,
                                           "promren" => $promren,
                                           "producto" => $producto,
                                           "sucactiva" => $sucactiva,
                                           "cfg" => $cfg,
                                           "id" => $id,
                                           "filtro" => $filtro,
                                           "subtitulo" => $subtitulo]);
    }
   
    public function delprod($id) {
        //$pr->id.'_'.$pr->codprod.'_'.$pr->codcli
        $s1 = explode('_', $id );
        $id = $s1[0];
        $codprod = $s1[1];
        $codisb = $s1[2];
        $promren = DB::table('promren')
        ->where('id','=',$id)
        ->where('codprod','=',$codprod)
        ->where('codisb','=',$codisb)
        ->delete();
        return Redirect::to('/seped/promdias/'.$id.'/edit');
    }

    public function grabar(Request $request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $id = trim($request->get('id'));
        $descrip = trim($request->get('descrip'));
        $dias = trim($request->get('dias'));
        $desde = trim($request->get('desde'));
        $hasta = trim($request->get('hasta'));
        $estado = trim($request->get('estado'));

        DB::table('promdias')
        ->where('id','=',$id)
        ->update(array("descrip" => $descrip,
                       "dias" => $dias,
                       "desde" => $desde,
                       "hasta" => $hasta,
                       "estado" => $estado
        ));
        
        return Redirect::to('/seped/promdias/'.$id.'/edit');
    }

    public function agregarprod(Request $request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $id = trim($request->get('id'));
        $tdcheck = $request->get('tdcheck');
        if (!is_null($tdcheck)) {
            foreach ($tdcheck as $posicion => $nombre) {
                $codprod = $posicion;

                $producto = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('codprod','=',$codprod)
                ->first();
                if (is_null($producto))
                    continue;
             
                $reg = DB::table('promren')
                ->where('codprod', $codprod)
                ->where('codisb', $sucactiva)
                ->first();
                if (is_null($reg)) {
                    DB::table('promren')->insert([
                        'id' => $id,
                        'codprod' => $codprod, 
                        'desprod' => $producto->desprod,
                        'marca' => $producto->marcamodelo,
                        'codisb' => $sucactiva
                    ]);
                } 
            }
        }
        return Redirect::to('/seped/promdias/'.$id.'/edit');
    }

    public function cargarprod(Request $request) {
        $filtro = $request->get('filtro');
        $resp = "";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $tabla = DB::table('producto')
        ->select('desprod', "codprod", 'barra', 'marcamodelo')
        ->where('codisb','=',$sucactiva)
        ->where(function ($q) use ($filtro) {
              $q->where('barra','LIKE','%'.$filtro.'%')
              ->orwhere('desprod','LIKE','%'.$filtro.'%')
              ->orwhere('codprod','LIKE','%'.$filtro.'%')
              ->orwhere('marcamodelo','LIKE','%'.$filtro.'%');
        })
        ->orderBy("desprod","asc")
        ->get();
        if ($tabla) {
            $resp = $tabla;  
        } 
        return response()->json(['resp' => $resp ]);
    }

}
