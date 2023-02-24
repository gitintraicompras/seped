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
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;

class AdcaracteristicaController extends Controller
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
            $activa=trim($request->get('activa'));
            if ($activa == 1) {

                $tabla = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('prodcarext')
                    ->whereRaw("producto.codprod = prodcarext.codprod");
                })
                ->orderBy('desprod','asc')
                ->paginate(100);
                $cont = $tabla->count();

            } else {
        		$tabla=DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->paginate(100);

                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $cont = $reg->contador;
            }
            $subtitulo = "CARACTERISTICAS EXTENDIDAS (".number_format($cont,0, '.', ',')." productos)";
    		return view('seped.caracteristica.index' ,["menu" => "Caracteristicas",
                                                       "tabla" => $tabla, 
    									               "filtro" => $filtro,
                                                       "activa" => $activa,
                                                       "cfg" => DB::table('cfg')->first(),
    								                   "subtitulo" => $subtitulo]);
    	}
    }

    public function modcaract(Request $request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $codprod = $request->get('codprod');
        $unidades = $request->get('unidades');
        $campo = $request->get('campo');
        $producto = DB::table('producto')
        ->where('codprod', '=', $codprod)
        ->where('codisb','=',$sucactiva)
        ->first();
        if ($producto) {
            if ($campo == 'cantpub') {

                if ($unidades <= 0) {
                    DB::table('producto')
                    ->where('codprod', '=', $codprod)
                    ->where('codisb','=',$sucactiva)
                    ->update(array($campo => $unidades,
                                   'cantidad' => $producto->cantreal));
                } else {
                    DB::table('producto')
                    ->where('codprod', '=', $codprod)
                    ->where('codisb','=',$sucactiva)
                    ->update(array($campo => $unidades,
                                   'cantidad' => $unidades));
                }

            } else {

                log::info("CAMPO ".$campo);
                switch ($campo) {
                    case 'fechafalla':
                        break;
                    case 'cuarentena':
                        $cuarentena = $producto->cuarentena;
                        if ($cuarentena == 1)
                            $unidades = 0;
                        else
                            $unidades = 1;
                        break;
                    case 'psicotropico':
                        $psicotropico = $producto->psicotropico;
                        if ($psicotropico == 1)
                            $unidades = 0;
                        else
                            $unidades = 1;
                        break;
                    case 'indevolutivo':
                        $indevolutivo = $producto->indevolutivo;
                        if ($indevolutivo == 1)
                            $unidades = 0;
                        else
                            $unidades = 1;
                        break;
                    case 'refrigerado':
                        $refrigerado = $producto->refrigerado;
                        if ($refrigerado == 1)
                            $unidades = 0;
                        else
                            $unidades = 1;
                        break;
                    default:
                        break;
                }
                DB::table('producto')
                ->where('codprod', '=', $codprod)
                ->where('codisb','=',$sucactiva)
                ->update(array($campo => $unidades));
            }
 
            $existe = 0;
            $prodcarext = DB::table('prodcarext')
            ->where('codprod', '=', $codprod)
            ->where('codisb','=',$sucactiva)
            ->first();
            if ($prodcarext) 
                $existe = 1;
            
            $prod = DB::table('producto')
            ->where('codprod', '=', $codprod)
            ->where('codisb','=',$sucactiva)
            ->first();
            $aplica = 0;
            if ($prod->undmin != '1') 
                $aplica = 1;
            if ($prod->undmax != '99999999') 
                $aplica = 1;
            if ($prod->undmultiplo != '0') 
                $aplica = 1;
            if ($prod->cantpub != '0') 
                $aplica = 1;
            if ($prod->indevolutivo != '0') 
                $aplica = 1;
            if ($prod->cuarentena != '0') 
                $aplica = 1;
            if ($prod->psicotropico != '0') 
                $aplica = 1;
            if ($prod->refrigerado != '0') 
                $aplica = 1;
            if ($campo == 'fechafalla') {
                $aplica = 1;
                if ($unidades != "2000-01-01") {
                    $aplica = 1;
                }
                //log::info("prod->fechafalla ".$prod->fechafalla);
            }
            if ($prod->clase != 'NORMAL') 
                 $aplica = 1;

            //log::info("APLICA: ".$aplica);                
            if ($aplica == 1) {
                if ($existe == 1) {
                    DB::table('prodcarext')
                    ->where('codprod', '=', $codprod)
                    ->where('codisb','=',$sucactiva)
                    ->update(array('undmin' => $prod->undmin,
                                   'undmax' => $prod->undmax,
                                   'undmultiplo' => $prod->undmultiplo,
                                   'cantpub' => $prod->cantpub,
                                   'cuarentena' => $prod->cuarentena,
                                   'psicotropico' => $prod->psicotropico,
                                   'refrigerado' => $prod->refrigerado,
                                   'clase' => $prod->clase,
                                   'fechafalla' => $prod->fechafalla,
                                   'indevolutivo' => $prod->indevolutivo));   
                } else {
                    DB::table('prodcarext')->insert([
                        'codprod' => $codprod,
                        'undmin' => $prod->undmin,
                        'undmax' => $prod->undmax,
                        'undmultiplo' => $prod->undmultiplo,
                        'cantpub' => $prod->cantpub,
                        'indevolutivo' => $prod->indevolutivo,
                        'psicotropico' => $prod->psicotropico,
                        'refrigerado' => $prod->refrigerado,
                        'clase' => $prod->clase,
                        'fechafalla' => $prod->fechafalla,
                        'cuarentena' => $prod->cuarentena,
                        "codisb" => $sucactiva

                    ]);
                }
            } else {
                if ($existe == 1) {
                    DB::table('prodcarext')
                    ->where('codprod','=',$codprod)
                    ->delete();
                }    
            }
        }
        return response()->json(['msg' => '' ]);
    }

    
}
