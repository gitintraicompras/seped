<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;
     
class AdnotiServidorController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request) {

            $cfg = DB::table('cfg')->first();
            $codcli = sCodigoClienteActivo();
        	$tab = $request->get('tab');
            if ($tab=="")
                $tab=1;
            
            $notientradas = DB::table('notientradas')
            ->select('*', 'notientradas.tipo AS tiponoti')
            ->join('cliente', 'notientradas.remite', '=', 'cliente.codcli')
            ->where('notientradas.destino', $cfg->codisb)
            ->orderBy('id','desc')
            ->get();
            $contEntradas = $notientradas->count();

            $notisalidas = DB::table('notisalidas')
            ->where('remite', '=', $cfg->codisb)
            ->orderBy('id','desc')
            ->get();
            $contSalidas = $notisalidas->count();

            $subtitulo = "SERVIDOR DE NOTIFICACIONES";

    		return view('seped.notiservidor.index' ,["menu" => "Notificacion",
                                                     "notientradas" => $notientradas, 
                                                     "notisalidas" => $notisalidas, 
                                                     "contEntradas" => $contEntradas,
                                                     "contSalidas" => $contSalidas,
    						 	                     "cfg" => $cfg,
                                                     "tab" => $tab,
    								                 "subtitulo" => $subtitulo]);
    	}
    }

    public function show($id) {
        $subtitulo = "CONSULTAR NOTIFICACION";

        $reg = DB::table('notisalidas')
        ->where('id','=',$id)
        ->first();

        $tabla = DB::table('notientradas')
        ->join('cliente', 'notientradas.destino', '=', 'cliente.codcli')
        ->where('notientradas.id', $id)
        ->get();

        return view("seped.notiservidor.show",["menu" => "Notificacion",
                                               "reg" => $reg,
                                               "tabla" => $tabla,
                                               "cfg" => DB::table('cfg')->first(),
                                               "subtitulo"=>$subtitulo]);
    }

    public function show2($item) {
        $subtitulo = "CONSULTAR NOTIFICACION (ENTRADAS)";
        $reg = DB::table('notientradas')
        ->select('*', 'notientradas.tipo AS tiponoti')
        ->join('cliente', 'notientradas.remite', '=', 'cliente.codcli')
        ->where('notientradas.item', $item)
        ->first();
        return view("seped.notiservidor.show2",["menu" => "Notificacion",
                                                "reg" => $reg,
                                                "cfg" => DB::table('cfg')->first(),
                                                "subtitulo"=>$subtitulo]);
    }

    public function create(Request $request) {
        $subtitulo = "NOTIFICACION NUEVA";
        $cliente = DB::table('cliente')->get();

        $tabla = DB::table('cliente')
        ->join('users', 'cliente.codcli', '=', 'users.codcli')
        ->where('users.tipo', 'C')
        ->where('users.estado', 'ACTIVO')
        ->get();

        return view("seped.notiservidor.create",["menu" => "Notificacion",
                                                 "tabla" => $tabla,
                                                 "cfg" => DB::table('cfg')->first(),
                                                 "subtitulo" => $subtitulo]);
    }

    public function store(Request $request) {
        try {
            $tipo = $request->get('tipo');
            $asunto = $request->get('asunto');
            $remite = $request->get('remite');
            $destino = $request->get('destino');
            if (is_null($destino)) {
                session()->flash('error', 'Notificación no enviado, debe seleccionar un destino');
                return Redirect::to('/seped/notiservidor');
            }
            $asunto = trim($request->get('asunto'));
            if ($asunto == "") {
                session()->flash('error', 'Notificación no enviado, el asunto no puede ir en blanco');
            } else {
                if (strlen($asunto)>500)
                    $asunto = substr($asunto,0,500);
                // BANDEJA DE SALIDA
                $id = DB::table('notisalidas')->insertGetId([
                    'tipo' => $tipo,
                    'asunto' => $asunto,
                    'remite' => $remite,
                    'fecha' => date('Y-m-d H:i:s')
                ]);
                // BANDEJA DE ENTRADAS
                foreach ($destino as $d) { 
                    DB::table('notientradas')->insert([
                        'id' => $id,
                        'remite' => $remite,
                        'destino' => $d,
                        'asunto' => $asunto,
                        'tipo' => $tipo,
                        'envio' => 1,
                        'leido' => 0,
                        'fechaenvio' => date('Y-m-d H:i:s')
                    ]);
                }
                session()->flash('message', 'Notificación '.$id.' enviado satisfactoriamente');
            }
        } catch (Exception $e) {
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/notiservidor');
    }

    public function destroy($id) {
        try {
            DB::table('notisalidas')
            ->where('id','=',$id)
            ->delete();
            session()->flash('message', 'Notificaciún '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/notiservidor?tab=1');
    }
  
    public function destroy2($item) {
        try {
            DB::table('notientradas')
            ->where('item','=',$item)
            ->delete();
            session()->flash('message', 'Notificaciún item '.$item.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/notiservidor?tab=2');
    }

    public function modleido(Request $request) {
        $item = $request->get('item');
        DB::table('notientradas')
            ->where('item', '=', $item)
            ->update(array('leido' => 1,
                           'envio' => 0,
                           'fechaleido' => date('Y-m-d H:i:s')
        ));
        return response()->json(['msg' => '' ]);
    }

    public function leido(Request $request) {
        $cfg = DB::table('cfg')->first();
        DB::table('notientradas')
        ->where('destino', '=', $cfg->codisb)
        ->update(array('leido' => 1,
                       'envio' => 0,
                       'fechaleido' => date('Y-m-d H:i:s')
        ));
        return Redirect::to('/seped/notiservidor?tab=2');
    }

    public function borrar2(Request $request) {
        $cfg = DB::table('cfg')->first();
        DB::table('notientradas')
        ->where('destino', '=', $cfg->codisb)
        ->delete();
        return Redirect::to('/seped/notiservidor?tab=2');
    }

    public function borrar(Request $request) {
        $cfg = DB::table('cfg')->first();
        DB::table('notisalidas')
        ->where('remite', '=', $cfg->codisb)
        ->delete();
        return Redirect::to('/seped/notiservidor?tab=1');
    }

}
