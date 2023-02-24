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
  
class AdreclamoController extends Controller
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
            vEliminarReclamoBlanco($codcli);
    		$filtro=trim($request->get('filtro'));
    		$tabla=DB::table('reclamo')
    		->where('codcli','=',$codcli)
            ->where('codisb','=',$sucactiva)
        	->where(function ($q) use ($filtro) {
                $q->where('id','LIKE','%'.$filtro.'%')
                ->orwhere('estado','LIKE','%'.$filtro.'%')
             	->orwhere('fecha','LIKE','%'.$filtro.'%')
				->orwhere('origen','LIKE','%'.$filtro.'%')
                ->orwhere('factnum','LIKE','%'.$filtro.'%')
				->orwhere('fecprocesado','LIKE','%'.$filtro.'%');
	    	})
    		->orderBy('id','desc')
            ->paginate(100);

            $reg = DB::table('reclamo')
            ->selectRaw('count(*) as contador')
            ->where('codcli','=',$codcli)
            ->where('codisb','=',$sucactiva)
            ->first();
            $cont = $reg->contador;
            $subtitulo = "RECLAMOS (".number_format($cont,0, '.', ',').")";

    		return view('seped.reclamo.index' ,["menu"=>"Reclamos",
                                                "tabla" => $tabla, 
    								            "filtro" => $filtro,
                                                "sucactiva" => $sucactiva,
                                                "cfg" => $cfg,
    									        "subtitulo" => $subtitulo]);
    	}
    }

	public function show($id) {
    	$subtitulo = "CONSULTA DE RECLAMO";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
      
   	    // TABLA DE RECLAMOS
        $tabla = $tabla=DB::table('reclamo')
        ->where('id','=',$id)
        ->first();

        // TABLA DE RENGLONES DEL RECLAMO
        $tabla2 = DB::table('recren')
        ->where('id','=',$id)
        ->where('motivo','!=','')
        ->orderBy('item','asc')
        ->get();

        return view('seped.reclamo.show',["menu"=>"Reclamos",
                                          "tabla" => $tabla, 
                                          "tabla2" => $tabla2, 
                                          "subtitulo" => $subtitulo,
                                          "sucactiva" => $sucactiva,
                                          "cfg" => $cfg,
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
		return Redirect::to('/seped/reclamo');
	}

	public function create() {
        $subtitulo = "SELECCIONAR FACTURA";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $codcli = sCodigoClienteActivo();
        $hasta = date('Y-m-d');
        $desde = date('Y-m-d', strtotime('-'.$cfg->diasMaximoReclamo.' day', strtotime($hasta)));
        $desde = $desde.' 00:00:00';
        $hasta = $hasta.' 23:59:00';
        $tabla = DB::table('fact')
        ->where('codcli','=',$codcli)
        ->where('codisb','=',$sucactiva)
        ->whereBetween('fecha', array($desde, $hasta))
        ->orderBy('factnum','desc')
        ->get();
        return view("seped.reclamo.create",["menu"=>"Reclamos",
                                            "tabla" => $tabla,
                                            "sucactiva" => $sucactiva,
                                            "cfg" => $cfg,
                                            "subtitulo" => $subtitulo]);
	}

	public function store(Request $request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
   	    $factnum = $request->get('factnum');
        $codcli = sCodigoClienteActivo();
        $usuario = Auth::user()->email;
        $subtitulo = "RECLAMO NUEVO";
        $fecha = date('Y-m-d H:i:s');

        $tabla = DB::table('fact')
        ->where('codcli','=',$codcli)
        ->where('codisb','=',$sucactiva)
        ->where('factnum','=',$factnum)
        ->first();
        if (empty($tabla)) {
            return Redirect::back()->with('warning', 'Factura '.$factnum.' no se encuentra en la base de datos');
        }

        $fecfact = $tabla->fecha;

        // TABLA DE CLIENTE
        $cliente = DB::table('cliente')
        ->where('codcli','=',$codcli)
        ->where('codisb','=',$sucactiva)
        ->first();
        $codvend = $cliente->zona;

        $id = DB::table('reclamo')->insertGetId([
            'codcli' => $codcli,
            'fecha' => $fecha, 
            'estado' => 'NUEVO', 
            'fecenviado' => $fecha,
            'fecprocesado' => $fecha, 
            'origen' => 'C-WEB', 
            'usuario' => $usuario,
            'factnum' => $factnum,
            'fecfact' => $fecfact,
            'codvend' => $codvend,
            'nomcli' => $cliente->nombre,
            'subrenglon' => '0.00',
            'impuesto' => '0.00',
            'total' => '0.00',
            'totalfactura' => $tabla->total,
            'vence' => $tabla->fechav,
            'codisb' => $cfg->codisb,
            'observacion' => ''
        ]);

        $tabla = DB::table('reclamo')
        ->where('id','=',$id)
        ->first();

        $factren = DB::table('factren')
        ->where('factnum','=',$factnum)
        ->get();

        foreach ($factren as $fr) {
            $indevolutivo = 0;
            $prodcarext = DB::table('prodcarext')
            ->where('codprod','=',$fr->codprod)
            ->first();
            if ($prodcarext) 
                $indevolutivo = $prodcarext->indevolutivo;
            $item = DB::table('recren')->insertGetId([
                'id' => $id,
                'codprod' => $fr->codprod,
                'desprod' => $fr->desprod, 
                'cantidad' => $fr->cantidad,
                'precio' => $fr->precio,
                'cantrec' => '0',
                'codisb' => $cfg->codisb,
                'iva' => $fr->impuesto,
                'motivo' => '',
                'indevolutivo' => $indevolutivo
            ]);
        }
    
        $tabla2 = DB::table('recren')
        ->where('id','=',$id)
        ->get();

        $recmotivo = DB::table('recmotivo')
        ->where('activo','=','1')
        ->get();

        return view("seped.reclamo.edit",["menu"=>"Reclamos",
                                          "id" => $id,
                                          "tabla" => $tabla,
                                          "tabla2" => $tabla2,
                                          "recmotivo" => $recmotivo ,
                                          "subtitulo" => $subtitulo,
                                          "cfg" => DB::table('cfg')->first(),
                                          "filtro" => '']);
	}

	public function edit($id) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();

		$usuario = Auth::user()->email;
  		$subtitulo = "RECLAMO";
		
        $tabla = DB::table('reclamo')
  		->where('id','=',$id)
		->first();
    
        $tabla2 = DB::table('recren')
        ->where('id','=',$id)
        ->get();

        $recmotivo = DB::table('recmotivo')
        ->where('activo','=','1')
        ->get();

        return view("seped.reclamo.edit",["menu"=>"Reclamos",
                                          "id" => $id,
						      	          "tabla" => $tabla,
									      "tabla2" => $tabla2,
                                 	      "subtitulo" => $subtitulo,
                                          "recmotivo" => $recmotivo,
                                          "cfg" => $cfg,
										  "filtro" => '']);
	}

	public function update(Request $request, $id) {
		$regs = Reclamo::findOrFail($id);
		$regs->codcli = $request->get('codcli');
		$regs->update();
		return Redirect::to('/seped/reclamo');
	}

    public function enviar($id) {
        // ENVIAR RECLAMO
        set_time_limit(300);
        try {
            DB::beginTransaction();
            // CUENTA LA CANTIDAD DE ITEM DEL RECLAMO
            $reg = DB::table('recren')
                ->selectRaw('count(*) as contitem')
                ->where('id','=', $id)
                ->where('motivo','!=','')
                ->first();
            if ($reg->contitem > 0) {
                DB::table('reclamo')
                    ->where('id', '=', $id)
                    ->update(array('estado' => 'ENVIADO',
                                   'fecenviado' => date("Y-m-d H:i:s")));
                $regs = DB::table('recren')
                    ->where('id','=',$id)
                    ->where('motivo','=','')
                    ->delete();
                session()->flash('message', 'Reclamo '.$id.' enviado satisfactoriamente');
            } 
            else {
                // RECLAMO EN BLANCO
                $regs = DB::table('reclamo')
                ->where('id','=',$id)
                ->delete();
                $regs = DB::table('recren')
                ->where('id','=',$id)
                ->delete();
                session()->flash('error', 'Reclamo '.$id.' en blanco no enviado');
            }
            CalculaTotalesReclamo($id);
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
            return response()->json(['msg1' => null,
                                     'msg2' => $e]);
        }
        return Redirect::to('/seped/reclamo');
    }

    public function modificar(Request $request) {
        set_time_limit(300);
        
        $item = $request->get('item');
        $cantidad = $request->get('cantidad');
        $precio = $request->get('precio');
        $cantrec = $request->get('cantrec');
        $motivo = $request->get('motivo');
        $idreclamo = $request->get('idreclamo');
        $obs = $request->get('obs');
        $desprod = $request->get('desprod');
        $codprod = $request->get('codprod');
       
        if ($cantrec <= 0) {
            // ELIMINAR EL RENGLON 
            DB::table('recren')
                ->where('id', '=', $idreclamo)
                ->where('item','=',$item)
                ->update(array('cantrec' => '0', 'motivo' => '' ));
            $msg = '-1'; // ITEM ELIMINADO
        } else {
            // VALIDACIONES
            if ($motivo == '') {
                $msg = '-2'; // SIN EFECTO MOTIVO SIN DEFINIR
            }
            else {
                if ($cantrec > $cantidad && $motivo != 'SOBRANTE') {
                    $msg = 0; // SIN EFECTO CANTIDAD RECLAMO MAYOR CANTIDAD FACTURADO
                }
                else {
                    // MODIFICA CANTIDAD DEL PRODUCTO 
                    DB::table('recren')
                        ->where('id', '=', $idreclamo)
                        ->where('item','=',$item)
                        ->update(array('cantrec' => $cantrec, 'motivo' => $motivo ));
                    $msg = $item; // ITEM AGREGADO
                }
            }
        }
        CalculaTotalesReclamo($idreclamo);
        // MODIFICA LA OBSERVACION DEL RECLAMO
        DB::table('reclamo')
            ->where('id', '=', $idreclamo)
            ->update(array('observacion' => $obs));

        return response()->json(['msg' => $msg]);
    }

    public function descargar($id) {
        $titulo = "RECLAMO: ".$id;
        $cfg = DB::table('cfg')->first();
         // TABLA DE RECLAMOS
        $tabla = $tabla=DB::table('reclamo')
                ->where('id','=',$id)
                ->first();
        $subtitulo = $tabla->nomcli;
        // TABLA DE RENGLONES DEL RECLAMO
        $tabla2 = DB::table('recren')
                ->where('id','=',$id)
                ->where('motivo','!=','')
                ->orderBy('item','asc')
                ->get();

        $data = [
            "menu"=>"Reclamos",
            "tabla" => $tabla, 
            "tabla2" => $tabla2, 
            "cfg" => $cfg,
            "titulo" => $titulo,
            "subtitulo" => $subtitulo,
            "id" => $id
        ];

        $formato = $cfg->formatoPersRec;
        if ($formato == "" || $formato == 'rptreclamo') {
             $pdf = PDF::loadView('layouts.rptreclamo', $data);
        } else {
            $pdf = PDF::loadView('layouts.'.$formato, $data);
        }
        return $pdf->download('reclamo'.$id.'.pdf');
    }

}
