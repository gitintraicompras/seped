<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
 
class AdpagoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request) {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    		$codcli = sCodigoClienteActivo();
            // ELIMINA LOS PAGOS EN BLANCO
            vEliminarPagoBlanco($codcli);
       	    $filtro=trim($request->get('filtro'));
    		$tabla=DB::table('pago')
    		->where('codcli','=',$codcli)
            ->where('codisb','=',$sucactiva)
        	->where(function ($q) use ($filtro) {
                $q->where('id','LIKE','%'.$filtro.'%')
                ->orwhere('estado','LIKE','%'.$filtro.'%')
             	->orwhere('fecha','LIKE','%'.$filtro.'%')
				->orwhere('origen','LIKE','%'.$filtro.'%')
				->orwhere('fecprocesado','LIKE','%'.$filtro.'%');
	    	})
    		->orderBy('id','desc')
            ->paginate(100);

            $reg = DB::table('pago')
            ->selectRaw('count(*) as contador')
            ->where('codcli','=',$codcli)
            ->where('codisb','=',$sucactiva)
            ->first();
            $cont = $reg->contador;
            $subtitulo = "PAGOS (".number_format($cont,0, '.', ',').")";

    		return view('seped.pago.index' ,["menu"=>"Pagos",
                                             "tabla" => $tabla, 
    						                 "filtro" => $filtro,
                                             "sucactiva" => $sucactiva,
                                             "cfg" => $cfg,
    							             "subtitulo" => $subtitulo]);
    	}
    }

	public function show($id) {
        $subtitulo = "CONSULTA DE PAGO";
        $codcli = sCodigoClienteActivo();
        $cxc=DB::table('cxc')
        ->where('codcli','=',$codcli)
        ->where('saldo','>','0.00')
        ->get();

        // TABLA DE PAGO
        $pago = DB::table('pago')
        ->where('id','=',$id)
        ->first();

        // TABLA DE RENGLONES DEL PAGO
        $pagren = DB::table('pagren')
        ->where('id','=',$id)
        ->orderBy('item','asc')
        ->get();

        // TABLA DE PAGO DOCUMENTOS
        $pagdoc = DB::table('pagdoc')
        ->where('id','=',$id)
        ->orderBy('item','asc')
        ->get();

        // TABLA CUENTA BANCO
        $ctabanco = DB::table('ctabanco')
        ->where('activo','=','1')
        ->get();
        return view("seped.pago.show",["menu"=>"Pagos",
                                       "cxc" => $cxc,
                                       "pago" => $pago,
                                       "pagren" => $pagren,
                                       "pagdoc" => $pagdoc,
                                       "ctabanco" => $ctabanco,
                                       "cfg" => DB::table('cfg')->first(),
                                       "subtitulo" => $subtitulo]);
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
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/pago');
	}

	public function create() {
        $codcli = sCodigoClienteActivo();
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

        $usuario = Auth::user()->email;
        $fecha = date('Y-m-d H:i:s');
        $subtitulo = "PAGO";

        // TABLA DE CLIENTE
        $cliente = DB::table('cliente')
        ->where('codcli','=',$codcli)
        ->where('codisb','=',$sucactiva)
        ->first();
        if (empty($cliente)) 
            return back()->with('warning', 'CODIGO CLIENTE NO ENCONTRADO PARA ESTA SUCURSAL!!');                  
        $codvend = $cliente->zona;

        $cxc=DB::table('cxc')
        ->where('codcli','=',$codcli)
        ->where('codisb','=',$sucactiva)
        ->where('saldo','>','0.00')
        ->get();

        $id = DB::table('pago')->insertGetId([
            'codcli' => $codcli,
            'fecha' => $fecha, 
            'estado' => 'NUEVO', 
            'fecenviado' => $fecha,
            'fecprocesado' => $fecha, 
            'origen' => 'C-WEB', 
            'usuario' => $usuario,
            'observacion' => '', 
            'nomcli' => $cliente->nombre,
            'total' => '0.00',
            'codisb' => $cfg->codisb,
            'codvend' => $codvend
        ]);

        // TABLA DE PAGOS
        $pago = DB::table('pago')
        ->where('id','=',$id)
        ->first();

        // TABLA DE RENGLONES
        $pagren = DB::table('pagren')
        ->where('id','=',$id)
        ->orderBy('item','asc')
        ->get();

        // TABLA DE PAGO DOCUMENTOS
        $pagdoc = DB::table('pagdoc')
        ->where('id','=',$id)
        ->orderBy('item','asc')
        ->get();

        // TABLA CUENTA BANCO
        $ctabanco = DB::table('ctabanco')
        ->where('activo','=','1')
        ->where('codisb','=',$sucactiva)
        ->get();

        return view("seped.pago.create",["menu"=>"Pagos",
                                         "forma" => "N",
                                         "cxc" => $cxc,
                                         "pago" => $pago,
                                         "pagren" => $pagren,
                                         "pagdoc" => $pagdoc,
                                         "ctabanco" => $ctabanco,
                                         "sucactiva" => $sucactiva,
                                         "cfg" => $cfg,
                                         "subtitulo" => $subtitulo]);
	}

 	public function edit($id) {
        $subtitulo = "PAGO";
        $codcli = sCodigoClienteActivo();
        $cxc=DB::table('cxc')
            ->where('codcli','=',$codcli)
            ->where('saldo','>','0.00')
            ->get();
        // TABLA DE PAGOS
        $pago = DB::table('pago')
            ->where('id','=',$id)
            ->first();

        // TABLA DE RENGLONES DE PEDIDO
        $pagren = DB::table('pagren')
            ->where('id','=',$id)
            ->orderBy('item','asc')
            ->get();

        // TABLA DE PAGO DOCUMENTOS
        $pagdoc = DB::table('pagdoc')
            ->where('id','=',$id)
            ->orderBy('item','asc')
            ->get();

        // TABLA CUENTA BANCO
        $ctabanco = DB::table('ctabanco')
        ->where('activo','=','1')
        ->get();

        return view("seped.pago.create",["menu"=>"Pagos",
                                         "forma" => "M",
                                         "cxc" => $cxc,
                                         "pago" => $pago,
                                         "pagren" => $pagren,
                                         "pagdoc" => $pagdoc,
                                         "ctabanco" => $ctabanco,
                                         "cfg" => DB::table('cfg')->first(),
                                         "subtitulo" => $subtitulo]);
	}

    public function enviar($id) {
        // ENVIAR RECLAMO
        set_time_limit(300);
        try {
            DB::beginTransaction();
            // CUENTA LA CANTIDAD DE ITEM DEL PAGO
            $reg = DB::table('pagren')
                ->selectRaw('count(*) as contitem')
                ->where('id','=', $id)
                ->first();
            if ($reg->contitem > 0) {
                DB::table('pago')
                    ->where('id', '=', $id)
                    ->update(array('estado' => 'ENVIADO',
                                   'fecenviado' => date("Y-m-d H:i:s")));
                session()->flash('message', 'Pago '.$id.' enviado satisfactoriamente');
            } 
            else {
                // PAGO EN BLANCO
                $regs = DB::table('pago')
                ->where('id','=',$id)
                ->delete();
                $regs = DB::table('pagren')
                ->where('id','=',$id)
                ->delete();
                $regs = DB::table('pagdoc')
                ->where('id','=',$id)
                ->delete();
                session()->flash('error', 'Pago '.$id.' en blanco no enviado');
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
            return response()->json(['msg1' => null,
                                     'msg2' => $e]);
        }
        return Redirect::to('/seped/pago');
    }

    public function limpiarpagdoc(Request $request) {
        $id = $request->get('id');
        try {
            DB::beginTransaction();
            $reg = DB::table('pagdoc')
                ->where('id','=',$id)
                ->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'ERROR']);
        }
        return response()->json(['msg' => 'OK']);
    }

    public function insertpagdoc(Request $request) {
        $cfg = DB::table('cfg')->first();
        $id = $request->get('id');
        $coddoc = $request->get('coddoc');
        $tipo = $request->get('tipo');
        $fecha = $request->get('fecha');
        $vence = $request->get('vence');
        $monto = $request->get('monto');
        $saldo = $request->get('saldo');
        try {
            DB::table('pagdoc')->insert([
                'id' => $id, 
                'coddoc' => $coddoc, 
                'tipo' => $tipo, 
                'fecha' => date('Y-m-d', strtotime($fecha)),
                'vence' => date('Y-m-d', strtotime($vence)),
                'monto' => $monto, 
                'codisb' => $cfg->codisb,
                'saldo' => $saldo
            ]);
        } catch (Exception $e) {
            return response()->json(['msg' => 'ERROR']);
        }
        return response()->json(['msg' => 'OK']);
    }

    public function updateobs(Request $request) {
        $id = $request->get('id');
        $obs = $request->get('obs');
        try {
            DB::beginTransaction();
            DB::table('pago')
            ->where('id','=',$id)
            ->update(array('observacion' => $obs));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['msg' => 'ERROR']);
        }
        return response()->json(['msg' => 'OK']);
    }

    public function pagren(Request $request) {
        $subtitulo = "PAGO";
        $codcli = sCodigoClienteActivo();
        $cfg = DB::table('cfg')->first();
        $forma = $request->get('forma'); 
        $id = $request->get('id');
        $referencia = $request->get('referencia');
        $cuenta = $request->get('cuenta');
        $fecha = $request->get('fecha');
        $monto = $request->get('monto');
        $modo = $request->get('modo');
        $cheque = $request->get('cheque');
        $banco = $request->get('banco');
        try {
            DB::beginTransaction();
            DB::table('pagren')->insert([
                'id' => $id, 
                'referencia' => $referencia, 
                'cuenta' => $cuenta, 
                'fecha' => date('Y-m-d', strtotime($fecha)),
                'monto' => Getfloat($monto), 
                'modo' => $modo,
                'cheque' => $cheque,
                'codisb' => $cfg->codisb,
                'banco' => $banco
            ]);
            DB::commit();
        } catch (Exception $e) {
        }
  
        $cxc=DB::table('cxc')
            ->where('codcli','=',$codcli)
            ->where('saldo','>','0.00')
            ->get();

        // TABLA DE PAGO
        $pago = DB::table('pago')
        ->where('id','=',$id)
        ->first();

        // TABLA DE RENGLONES DEL PAGO
        $pagren = DB::table('pagren')
            ->where('id','=',$id)
            ->orderBy('item','asc')
            ->get();

        // TABLA DE PAGO DOCUMENTOS
        $pagdoc = DB::table('pagdoc')
            ->where('id','=',$id)
            ->orderBy('item','asc')
            ->get();

        // TABLA CUENTA BANCO
        $ctabanco = DB::table('ctabanco')
        ->where('activo','=','1')
        ->get();

        return view("seped.pago.create",["menu"=>"Pagos",
                                         "forma" => $forma,
                                         "cxc" => $cxc,
                                         "pago" => $pago,
                                         "pagren" => $pagren,
                                         "pagdoc" => $pagdoc,
                                         "ctabanco" => $ctabanco,
                                         "cfg" => DB::table('cfg')->first(),
                                         "subtitulo" => $subtitulo]);
    }

    public function delpagren($id) {
        $s1 = explode('-', $id );
        $id = $s1[0];
        $item = $s1[1];
        $forma= $s1[2];
        $codcli = sCodigoClienteActivo();
        $subtitulo = "PAGO";
        $regs = DB::table('pagren')
        ->where('item','=',$item)
        ->delete();

        $cxc=DB::table('cxc')
            ->where('codcli','=',$codcli)
            ->where('saldo','>','0.00')
            ->get();

        // TABLA DE PAGO
        $pago = DB::table('pago')
        ->where('id','=',$id)
        ->first();

        // TABLA DE RENGLONES DEL PAGO
        $pagren = DB::table('pagren')
            ->where('id','=',$id)
            ->orderBy('item','asc')
            ->get();

        // TABLA DE PAGO DOCUMENTOS
        $pagdoc = DB::table('pagdoc')
            ->where('id','=',$id)
            ->orderBy('item','asc')
            ->get();

        // TABLA CUENTA BANCO
        $ctabanco = DB::table('ctabanco')
        ->where('activo','=','1')
        ->get();
  
        return view("seped.pago.create",["menu"=>"Pagos",
                                         "forma" => $forma,
                                         "cxc" => $cxc,
                                         "pago" => $pago,
                                         "pagren" => $pagren,
                                         "pagdoc" => $pagdoc,
                                         "ctabanco" => $ctabanco,
                                         "cfg" => DB::table('cfg')->first(),
                                         "subtitulo" => $subtitulo]);
    }

    public function descargar($id) {
        $titulo = "PAGO: ".$id;
        $codcli = sCodigoClienteActivo();
        $cfg = DB::table('cfg')->first();
        $cxc=DB::table('cxc')
            ->where('codcli','=',$codcli)
            ->where('saldo','>','0.00')
            ->get();

        // TABLA DE PAGO
        $pago = DB::table('pago')
        ->where('id','=',$id)
        ->first();
        $subtitulo = $pago->nomcli;

        // TABLA DE RENGLONES DEL PAGO
        $pagren = DB::table('pagren')
            ->where('id','=',$id)
            ->orderBy('item','asc')
            ->get();

        // TABLA DE PAGO DOCUMENTOS
        $pagdoc = DB::table('pagdoc')
            ->where('id','=',$id)
            ->orderBy('item','asc')
            ->get();

        // TABLA CUENTA BANCO
        $ctabanco = DB::table('ctabanco')
        ->where('activo','=','1')
        ->get();

        $data = [
            "menu"=>"Pagos",
            "cxc" => $cxc,
            "pago" => $pago,
            "pagren" => $pagren,
            "pagdoc" => $pagdoc,
            "ctabanco" => $ctabanco,
            "cfg" => $cfg,
            "titulo" => $titulo,
            "subtitulo" => $subtitulo
        ];

        $formato = $cfg->formatoPersPag;
        if ($formato == "" || $formato == 'rptpago') {
             $pdf = PDF::loadView('layouts.rptpago', $data);
        } else {
            $pdf = PDF::loadView('layouts.'.$formato, $data);
        }
        return $pdf->download('pago'.$id.'.pdf');
    }

}
