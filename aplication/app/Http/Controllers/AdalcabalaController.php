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
use Session;
use DB;
 
class AdalcabalaController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)  {
    	if ($request) 	{
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    		$filtro = trim($request->get('filtro'));
    		$tabla=DB::table('pedido as p')
    		->leftJoin('cliente as c','p.codcli','=','c.codcli')
    		->select('*', 'p.id','p.codcli','p.nomcli as cliente', 'p.fecha', 'p.fecprocesado', 'p.fecenviado', 'p.estado','p.origen', 'c.limite as limite', 'c.saldo as saldo', 'c.dcredito as dcredito', 'c.vencido as vencido', 'p.total as total', 'c.estado as estadocliente', 'p.pedfiscal as pedfiscal' )
            ->where('p.codisb','=',$sucactiva)
            ->where('c.codisb','=',$sucactiva)
            ->where('p.estado','!=','NUEVO')
            ->where('p.estado','!=','FACTURADO')
            ->where('p.estado','!=','FACTURANDO')
            ->where('p.estado','!=','PICKING')
            ->where('p.estado','!=','PACKING')
            ->where('p.estado','!=','CERRADO')
            ->where('p.estado','!=','PROCESADO')
            ->where('p.estado','!=','ANULADO')
            ->where('p.estado','!=','RECIBIDO')
            ->where('p.estado','!=','EMBALANDO')
            ->where('p.estado','!=','DESPACHANDO')
        	->where(function ($q) use ($filtro) {
                $q->where('p.id','LIKE','%'.$filtro.'%')
                ->orwhere('p.codcli','LIKE','%'.$filtro.'%')
                ->orwhere('c.nombre','LIKE','%'.$filtro.'%')
				->orwhere('p.fecha','LIKE','%'.$filtro.'%')
				->orwhere('p.origen','LIKE','%'.$filtro.'%')
				->orwhere('p.fecprocesado','LIKE','%'.$filtro.'%');
	    	})
            ->orderBy('p.estado','desc')
    		->orderBy('p.fecenviado','asc')
            ->paginate(100);

            $subtitulo = "ALCABALA DE PEDIDOS  (".$tabla->count()." pedidos)";
            if (Auth::user()->tipo == 'V')
                $subtitulo = "SEGUIMIENTO DE PEDIDOS  (".$tabla->count()." pedidos)";

         	return view('seped.alcabala.index' ,["menu" => "Alcabala",
                                                 "tabla" => $tabla,
                               		             "filtro" => $filtro,
                                                 "sucactiva" => $sucactiva,
                                                 "cfg" => $cfg,
                                                 "subtitulo" => $subtitulo]);
    	}
    }

    public function show($id) {
        // TABLA DE PEDIDO
        $tabla = DB::table('pedido as p')
                ->leftJoin('cliente as c',DB::raw('trim(p.codcli)'),'=',DB::raw('trim(c.codcli)'))
                ->select('*','p.id','p.codcli','c.nombre as cliente', 'p.fecha', 'p.fecprocesado','p.estado','p.origen', 'p.usuario')
                ->where('id','=',$id)
                ->first();

        if ($tabla) {
            $subtitulo = "PEDIDO - ".$tabla->cliente;
            // TABLA DE RENGLONES DE PEDIDO
            $tabla2 = DB::table('pedren')
                    ->where('id','=',$id)
                    ->orderBy('item','asc')
                    ->get();
            return view('seped.alcabala.show',["menu"=>"Alcabala",
                                               "tabla" => $tabla, 
                                               "tabla2" => $tabla2, 
                                               "subtitulo" => $subtitulo,
                                               "cfg" => DB::table('cfg')->first(),
                                               "id" => $id]);
        } else {
            session()->flash('warning', 'Cliente no encontrado');
            return Redirect::to('/seped/alcabala');
        }
    }

    public function descargarTxt($id) {

        $archivo = 'PEDIDOWEB-'.$id.'.txt';
        $rutaarc = $archivo;

        $fs = fopen($rutaarc,"w");

        $pedren = DB::table('pedren')
        ->where('id','=',$id)
        ->get();
     
        $ped = DB::table('pedido')
        ->where('id','=',$id)
        ->first();

        $fileText =  $ped->id."|".$ped->codcli."|".$ped->fecha."|".$ped->estado."|".$ped->fecenviado."|".$ped->fecprocesado."|".$ped->origen."|".$ped->usuario."|".$ped->codvend."|".$ped->tipedido."|".$ped->nomcli."|".$ped->rif."|".$ped->dcredito."|".$ped->di."|".$ped->dc."|".$ped->pp."|".$ped->subrenglon."|".$ped->descuento."|".$ped->subtotal."|".$ped->impuesto."|".$ped->total."|".$ped->numren."|".$ped->numund."|".$ped->destino."|".$ped->documento."|".$ped->codisb."|".PHP_EOL;
        fwrite($fs,$fileText);

        foreach ($pedren as $pr) {
            $traza = $pr->id."|".$pr->item."|".$pr->codprod."|".$pr->desprod."|".$pr->cantidad."|".$pr->precio."|".$pr->barra."|".$pr->tipocatalogo."|".$pr->regulado."|".$pr->tipo."|".$pr->pvp."|".$pr->iva."|".$pr->da."|".$pr->di."|".$pr->dc."|".$pr->pp."|".$pr->neto."|".$pr->subtotal."|".$pr->codisb."|".PHP_EOL;
            fwrite($fs,$traza);
        }
        fclose($fs);

        $headers = ['Content-type'=>'text/plain', 'test'=>'YoYo', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $archivo),'X-BooYAH'=>'WorkyWorky','Content-Length'=>sizeof($rutaarc)];

        return response()->download($rutaarc);
    }

    public function edit($id) {
        $subtitulo = "PRE-APROBAR PEDIDO";
        if (Auth::user()->tipo == 'V')
            $subtitulo = "ESTADO CREDITICIO";

        $tabla=DB::table('pedido as p')
        ->leftJoin('cliente as c','p.codcli','=','c.codcli')
        ->select('*', 'p.id','p.codcli','p.nomcli as cliente', 'p.fecha', 'p.fecprocesado', 'p.fecenviado', 'p.estado','p.origen', 'c.limite as limite', 'c.saldo as saldo', 'c.dcredito as dcredito', 'c.vencido as vencido', 'p.total as total', 'c.estado as estadocliente')
        ->where('p.id','=',$id)
        ->first();
        return view("seped.alcabala.edit",["menu" => "Alcabala",
                                           "tabla" => $tabla, 
                                           "cfg" => DB::table('cfg')->first(),
                                           "subtitulo" => $subtitulo]);
    }

    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();
            $observacion = $request->get('observacion');
            $codtransp = $request->get('codtransp');
            $status = $request->get('status'); 
            DB::table('pedido')
            ->where('id', '=', $id)
            ->update(array("estado" => $status,
                           "observacion" => $observacion,
                           "codtransp" => $codtransp,
                           "fecprocesado" => date('Y-m-j H:i:s')
            ));
            DB::commit();
            session()->flash('message', 'Pedido '.$id.' procesado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/alcabala');
    }

 

}
