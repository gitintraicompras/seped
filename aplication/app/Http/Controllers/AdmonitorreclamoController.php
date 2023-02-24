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
 
class AdmonitorreclamoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request) {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    		$filtro=trim($request->get('filtro'));
    		$regs=DB::table('reclamo as r')
    		->leftJoin('cliente as c','r.codcli','=','c.codcli')
    		->select('*', 'r.id','r.codcli','c.nombre as cliente', 'r.fecha', 'r.fecprocesado','r.estado','r.origen', 'r.factnum')
            ->where('r.estado','!=','NUEVO')
            ->where('r.codisb','=',$sucactiva)
			->where(function ($q) use ($filtro) {
                $q->where('r.id','LIKE','%'.$filtro.'%')
                ->orwhere('r.codcli','LIKE','%'.$filtro.'%')
                ->orwhere('c.nombre','LIKE','%'.$filtro.'%')
				->orwhere('r.fecha','LIKE','%'.$filtro.'%')
				->orwhere('r.origen','LIKE','%'.$filtro.'%')
				->orwhere('r.fecprocesado','LIKE','%'.$filtro.'%');
	    	})
    		->orderBy('id','desc')
            ->paginate(100);
            $subtitulo = "RECLAMOS (".$regs->count().")";
        	return view('seped.monitorreclamo.index' ,["menu" => "Reclamos",
                                                       "tabla" => $regs, 
    									               "filtro" => $filtro,
                                                       "sucactiva" => $sucactiva,
                                                       "cfg" => $cfg,
    								             	   "subtitulo" => $subtitulo]);
    	}
    }

    public function show($id) {
        $tabla = $tabla=DB::table('reclamo as r')
                ->leftJoin('cliente as c','r.codcli','=','c.codcli')
                ->select('*','r.id','r.codcli','c.nombre as cliente', 'r.fecha', 'r.fecprocesado','r.estado','r.origen','r.fecenviado','r.factnum','r.fecfact', 'r.usuario', 'r.observacion')
                ->where('id','=',$id)
                ->first();
    
        $subtitulo = "RECLAMO - ".$tabla->cliente;
    
        // TABLA DE RENGLONES DEL RECLAMO
        $tabla2 = DB::table('recren')
                ->where('id','=',$id)
                ->where('motivo','!=','')
                ->orderBy('item','asc')
                ->get();

        return view('seped.monitorreclamo.show',["menu" => "Reclamos",
                                                 "tabla" => $tabla, 
                                                 "tabla2" => $tabla2, 
                                                 "subtitulo" => $subtitulo,
                                                 "cfg" => DB::table('cfg')->first(),
                                                 "id" => $id]);
    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            $regs = DB::table('reclamo')
            ->where('id','=',$id)
            ->delete();
            $regs = DB::table('recren')
            ->where('id','=',$id)
            ->delete();
            DB::commit();
            session()->flash('message', 'Reclamo '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/monitorreclamo');
    }

    public function procesar(Request $request) {
        try {
            DB::beginTransaction();
            $id = $request->get('id');
            $nota = $request->get('nota');
            $status = $request->get('status'); 
            DB::table('reclamo')
            ->where('id', '=', $id)
            ->update(array("estado" => $status,
                           "nota" => $nota,
                           "fecprocesado" => date('Y-m-j H:i:s')
            ));
            DB::commit();
            session()->flash('message', 'Reclamo '.$id.' procesado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/monitorreclamo');
    }
    
}
