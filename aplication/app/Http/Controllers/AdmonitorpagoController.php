<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PagoFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Session;
use DB;

class AdmonitorpagoController extends Controller
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
    		$regs=DB::table('pago as p')
    		->leftJoin('cliente as c','p.codcli','=','c.codcli')
    		->select('p.id','p.codisb','p.codcli','c.nombre as cliente', 'p.fecha', 'p.fecprocesado', 'p.fecenviado', 'p.estado','p.origen')
            ->where('p.codisb','=',$sucactiva)
            ->where('p.estado','!=','NUEVO')
        	->where(function ($q) use ($filtro) {
                $q->where('p.id','LIKE','%'.$filtro.'%')
                ->orwhere('p.codcli','LIKE','%'.$filtro.'%')
                ->orwhere('c.nombre','LIKE','%'.$filtro.'%')
				->orwhere('p.fecha','LIKE','%'.$filtro.'%')
				->orwhere('p.origen','LIKE','%'.$filtro.'%')
				->orwhere('p.fecprocesado','LIKE','%'.$filtro.'%');
	    	})
		    ->orderBy('id','desc')
            ->paginate(100);
            $subtitulo = "PAGOS (".$regs->count().")";
            return view('seped.monitorpago.index' ,["menu" => "Pagos",
                                                    "pago" => $regs, 
    				  			                    "filtro" => $filtro,
                                                    "sucactiva" => $sucactiva,
                                                    "cfg" => $cfg,
    								 	            "subtitulo" => $subtitulo]);
    	}
    }

	public function show($id) {
        $pago = DB::table('pago')
            ->where('id','=',$id)
            ->first();

        $codcli = $pago->codcli;
        $subtitulo = "PAGO  - ".nombrecliente($codcli);

        $cxc = DB::table('cxc')
            ->where('codcli','=',$codcli)
            ->where('saldo','>','0.00')
            ->get();
    
         // TABLA DE PAGOS
        $pago = DB::table('pago as p')
                ->leftJoin('cliente as c','p.codcli','=','c.codcli')
                ->select('p.id','p.codcli','c.nombre as cliente', 'p.fecha', 'p.fecenviado', 'p.fecprocesado','p.estado','p.origen', 'p.usuario', 'p.observacion')
                ->where('id','=',$id)
                ->first();

        // TABLA DE RENGLONES DEL PAGO
        $pagren = DB::table('pagren')
                ->where('id','=',$id)
                ->orderBy('item','asc')
                ->get();
    
        // TABLA DE DOCUMENTOS DEL PAGO
        $pagdoc = DB::table('pagdoc')
                ->where('id','=',$id)
                ->orderBy('item','asc')
                ->get();
        return view('seped.monitorpago.show',["menu" => "Pagos",
                                              "pago" => $pago, 
                                              "pagren" => $pagren, 
                                              "pagdoc" => $pagdoc, 
                                              "subtitulo" => $subtitulo,
                                              "cxc" => $cxc,
                                              "cfg" => DB::table('cfg')->first(),
                                              "id" => $id]);
    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            $regs = DB::table('pago')
            ->where('id','=',$id)
            ->delete();
            $regs = DB::table('pagren')
            ->where('id','=',$id)
            ->delete();
            $regs = DB::table('pagdoc')
            ->where('id','=',$id)
            ->delete();
            DB::commit();
            session()->flash('message', 'Pago '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/monitorpago');
    }

    public function procesar(Request $request) {
        try {
            DB::beginTransaction();
            $id = $request->get('id');
            $nota = $request->get('nota');
            $status = $request->get('status'); 
            DB::table('pago')
            ->where('id', '=', $id)
            ->update(array("estado" => $status,
                           "nota" => $nota,
                           "fecprocesado" => date('Y-m-j H:i:s')
            ));
            DB::commit();
            session()->flash('message', 'Pago '.$id.' procesado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/monitorpago');
    }
   
}
