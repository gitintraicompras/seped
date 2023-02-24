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
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Session;   
     
      
class AdcatalogoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request) {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $codcli = sCodigoClienteActivo();
            $tipo = Auth::user()->tipo;
            // ELIMINA LOS PEDIDOS EN BLANCO
            vEliminarPedidoBlanco($codcli);
            $tipedido = '';
            $idpedido = iIdUltPedAbierto($codcli);
            if ( $idpedido > 0) {
                $pedido = DB::table('pedido')
                ->where('id','=',$idpedido)
                ->first();
                if (empty($pedido))
                    return Redirect::back()->with('error', 'Pedido '.$idpedido.' no existe');
                $tipedido = $pedido->tipedido; 
            }
     		$filtro = $request->get('filtro');
            if ($tipo == 'V') {
        		$tabla=DB::table('pedido')
        		->where('codcli','=',$codcli)
            	->where(function ($q) use ($filtro) {
	                $q->where('id','LIKE','%'.$filtro.'%')
	                ->orwhere('estado','LIKE','%'.$filtro.'%')
    				->orwhere('origen','LIKE','%'.$filtro.'%')
                    ->orwhere('fecha','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
                    ->orwhere('fecenviado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
    				->orwhere('fecprocesado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%');
    	    	})
        		->orderBy('id','desc')
                ->paginate(25); 
            } else {
                $tabla=DB::table('pedido')
                ->where('codcli','=',$codcli)
                ->where('tipedido','=','N')
                    ->where(function ($q) use ($filtro) {
                        $q->where('id','LIKE','%'.$filtro.'%')
                        ->orwhere('estado','LIKE','%'.$filtro.'%')
                        ->orwhere('origen','LIKE','%'.$filtro.'%')
                        ->orwhere('fecha','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
                        ->orwhere('fecenviado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%')
                        ->orwhere('fecprocesado','LIKE','%'.date('Y-m-d', strtotime($filtro)).'%');
                    })
                ->orderBy('id','desc')
                ->paginate(25);
            }
            $reg = DB::table('pedido')
            ->selectRaw('count(*) as contador')
            ->where('codcli','=',$codcli)
            ->first();
            $cont = $reg->contador;
            $subtitulo = "PEDIDOS (".number_format($cont,0, '.', ',').")";
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    		return view('seped.catalogo.index' ,["menu" => "Catalogo",
                                                 "tabla" => $tabla, 
        					 	                 "filtro" => $filtro,
                                                 "tipedido" => $tipedido,
                                                 "cfg" => $cfg,
    									         "subtitulo" => $subtitulo]);
    	}
    }

	public function edit($id) {
        // EDITAR CARRITO
  	 	$usuario = Auth::user()->name;
		$subtitulo = "CARRITO";
   	
        $tabla = DB::table('pedido')
		->where('id','=',$id)
		->first();

        $codcli = $tabla->codcli;
        $cliente = DB::table('cliente')
        ->where('codcli','=', $codcli)
        ->first();

        $tipo = 'C';
        if ($tabla->tipedido == 'P') {
            $tipo = $tabla->tipedido;
        }

        // TABLA DE RENGLONES DE PEDIDO
        $transplit = DB::table('transplit')
        ->orderBy('id','asc')
        ->get();

	    // TABLA DE RENGLONES DE PEDIDO
        $tabla2 = DB::table('pedren')
        ->where('id','=',$id)
        ->orderBy('item','asc')
        ->get();

        // CUENTA LA CANTIAD DE ITEM DEL PEDIDO ABIERTO
        $reg = DB::table('pedren')
        ->where('id','=', $id)
        ->selectRaw('count(*) as contitem')
        ->first();
        $contItem = $reg->contitem;
		return view("seped.catalogo.edit",["menu"=>"Catalogo",
                                           "id" => $id,
                                           "cliente" => $cliente,
                                           "transplit" => $transplit,
			   			  		           "tabla" => $tabla,
									       "tabla2" => $tabla2,
                         				   "subtitulo" => $subtitulo,
										   "filtro" => '',
                                           "forma" => "E",
                                           "tipo" => $tipo,
                                           "cfg" => DB::table('cfg')->first(),
                                           "contItem" => $contItem ]);
	}

    public function agregar(Request $request) {
        // AGREGA EL PRODUCTO AL PEDIDO
        set_time_limit(300);
        $cfg = DB::table('cfg')->first();

        $codprod = $request->get('codprod');
        $pedir = Getfloat($request->get('pedir'));

        $msg = ""; 
        $total = 0.00;
        $item = 0;

        $codcli = sCodigoClienteActivo();
        $idpedido = iIdUltPedAbierto($codcli);
        if ( $idpedido < 0) 
            $idpedido = iCrearPedidoNuevo('N');

        $cliente = DB::table('cliente')
        ->where('codcli','=',$codcli)
        ->first();
        if ($cliente) {
            $dc =  0.00;
            if ($cfg->mostrarDc)
                $dc = $cliente->dcomercial;
            $di =  0.00;
            if ($cfg->mostrarDi)
                $di = $cliente->dinternet;
            $pp =  0.00;
            if ($cfg->mostrarPp)
                $pp = $cliente->ppago;
            $dvp = 0.00;
            if (!empty($cliente->DctoPreferencial)) {
                $datadvp = MesActivoPreferencial($cliente->DctoPreferencial);
                $dvp = $datadvp['dcto'];
            }

            // BUSCAR DATOS DEL PRODUCTO A AGREGAR
            $prod = DB::table('producto')
            ->where('codprod','=',$codprod)
            ->first();
            if ($prod) {
                $inventario = intval($prod->cantidad);
                $costo = floatval($prod->costo); 
                $undmin = $prod->undmin;
                $undmax = $prod->undmax;
                $undmultiplo = $prod->undmultiplo;
                $dp = 0.00;
                $up = 0;
                if ($cfg->mostrarDp) {
                    if (bValida_Preempaque($pedir, $prod->upre, $prod->ppre)) {
                        $dp = $prod->ppre;
                        $up = $prod->upre;    
                    }
                }
                $dv = 0.00;
                $dvDetalle = "";
                if ($cfg->mostrarDv) {
                    $dv = $prod->dv;
                    $dvDetalle = $prod->dvDetalle;
                }
                $da = 0.00;
                if ($cfg->mostrarDa) 
                    $da = $prod->da;

                if ($cfg->aplicarDaPrecio != $cliente->usaprecio) {
                    $da = 0.00;
                    $dv = 0.00;
                    $dp = 0.00;
                    $dvp = 0.00;
                }
                $dn = $prod->dctoneto;  // DESCUENTO NETO
                if (strlen(trim($dn)) == 0 || $dn == 'N/A')
                    $dn = 0.00;
                else 
                    $dn = floatval($dn);

                $bulto = $prod->original;  
                if (strlen(trim($bulto)) == 0 || $bulto == 'N/A')
                    $bulto = 1;
                else 
                    $bulto = intval($bulto);

                // PRECIO 
                $precioActivo = $prod->precio1;
                switch ($cliente->usaprecio) {
                    case 1:
                        $precioActivo = $prod->precio1;
                        break;
                    case 2:
                        $precioActivo = $prod->precio2;
                        break;
                    case 3:
                        $precioActivo = $prod->precio3;
                        break;
                    case 4:
                        $precioActivo = $prod->precio4;
                        break;
                    case 5:
                        $precioActivo = $prod->precio5;
                    case 6:
                        $precioActivo = $prod->precio6;
                        break;
                }
                $precio = $precioActivo - ( $precioActivo * ( $dn / 100.00));
                // $neto = CalculaPrecioNeto($precio, $da, $di, $dc, $pp);
                $item = -1;
                if ($cfg->unirRengRepetido == 1) {
                    $pedren = DB::table('pedren')
                    ->where('id','=',$idpedido)
                    ->where('codprod','=',$codprod)
                    ->first();
                    if ($pedren) {
                        $item = $pedren->item;
                        $cantAnt = $pedren->cantidad;
                    }
                }
                if ($cfg->unirRengRepetido == 0 || $item < 0) {
                    $resp = collect(validarCaractExtendidas($pedir, $pedir, $inventario, $undmin, $undmax, $undmultiplo, $codprod));

                    if ($resp->get('status') == 2) {
                        // ERROR
                        $msg = "CARACTERISTICAS EXTENDIDAS".PHP_EOL."==============================================".PHP_EOL;
                        $msg .= $prod->desprod.PHP_EOL.' - '.$resp->get('msg');
                    } else {
                        $pedir = $resp->get('pedir');
                        if ($pedir > 0) {
                            if ($resp->get('status') == 1) {
                                // WARNING
                                $msg = "CARACTERISTICAS EXTENDIDAS".PHP_EOL."==============================================".PHP_EOL;
                                $msg .= $prod->desprod.PHP_EOL.' - '.$resp->get('msg');
                            }
                            $dp = 0.00;
                            $up = 0;
                            if ($cfg->mostrarDp) {
                                if (bValida_Preempaque($pedir, $prod->upre, $prod->ppre)) {
                                    if ($cfg->aplicarDaPrecio != $cliente->usaprecio) {
                                        $dp = 0.00;
                                        $up = 0;
                                    } else {
                                        $dp = $prod->ppre;
                                        $up = $prod->upre;
                                    }    
                                }
                            }
                            $dv = 0.00;
                            if ($cfg->mostrarDv) {
                                $dv = dBuscar_DctoVolumen($pedir, $dvDetalle);
                                if ($cfg->aplicarDaPrecio != $cliente->usaprecio) {
                                    $dv = 0.00;
                                } 
                            }
                            $dcredito = sRetornaPromDias($codprod, "");
                            $neto = CalculaPrecioNeto($precio, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                            $subtotal = floatval($neto) * intval($pedir);
                            // DEBO AGREGAR EL RENGLON AL PEDREN
                            DB::table('pedren')->insert([
                                'id' => $idpedido, 
                                'codprod' => $codprod, 
                                'desprod' => $prod->desprod, 
                                'cantidad' => $pedir, 
                                'precio' => $precio, 
                                'barra' => $prod->barra,
                                'tipocatalogo' => $prod->tipocatalogo,
                                'regulado' => $prod->regulado,
                                'tipo' => $prod->tipo,
                                'pvp' => $prod->psugerido,
                                'iva' => $prod->iva,
                                'da' => $da,
                                'di' => $di,
                                'dc' => $dc,
                                'pp' => $pp,
                                'dvp' => $dvp,
                                'neto' => $neto,
                                'subtotal' => $subtotal,
                                'codisb' => $cfg->codisb,
                                'cantdesp' => "0",
                                'bulto' => $bulto,
                                'ubicacion' => $prod->ubicacion,
                                'packing' => "0",
                                'costo' => $costo,
                                'lote' => $prod->lote,
                                'feclote' => $prod->fecvence,
                                'manejalote' => $prod->manejalote,
                                'marcamodelo' => $prod->marcamodelo,
                                'deposito' => "", 
                                'coddpto' => $prod->opc1,
                                'codgrupo' => $prod->opc2,
                                'codsubgrupo' => $prod->opc3,
                                'psicotropico' => $prod->psicotropico,
                                'listalote' => "",
                                'refrigerado' => $prod->refrigerado,
                                'FlagFactOM' => $prod->FlagFactOM,
                                "dp" => $dp,
                                "dv" => $dv,
                                'codcli' => $codcli,
                                'dcredito' => $dcredito
                            ]);
                        }
                    }
                } else {
                    $pedirTot = $cantAnt + $pedir;
                    if (intval($pedirTot) > intval($inventario)) {
                        $msg = "La cantidad a pedir (".$pedirTot.") es mayor > al inventario (".$inventario.")\nde $prod->desprod"; 
                    } else {
                        $resp = collect(validarCaractExtendidas($pedirTot, $pedir, $inventario, $undmin, $undmax, $undmultiplo, $codprod));
                        if ($resp->get('status') == 2) {
                            $msg = "CARACTERISTICAS EXTENDIDAS".PHP_EOL."==============================================".PHP_EOL;
                            $msg .= $prod->desprod.PHP_EOL.' - '.$resp->get('msg');
                        } else {
                            $pedir = $resp->get('pedir');
                            if ($pedir > 0) {
                                if ($resp->get('status') == 1) {
                                    $msg = "CARACTERISTICAS EXTENDIDAS".PHP_EOL."==============================================".PHP_EOL;
                                    $msg .= $prod->desprod.PHP_EOL.' - '.$resp->get('msg');
                                }
                                $dp = 0.00;
                                $up = 0;
                                if ($cfg->mostrarDp) {
                                    if (bValida_Preempaque($pedir, $prod->upre, $prod->ppre)) {
                                        if ($cfg->aplicarDaPrecio != $cliente->usaprecio) {
                                            $dp = 0.00;
                                            $up = 0;
                                        } else {
                                            $dp = $prod->ppre;
                                            $up = $prod->upre;
                                        }    
                                    }
                                }
                                $dv = 0.00;
                                if ($cfg->mostrarDv) {
                                    $dv = dBuscar_DctoVolumen($pedir, $dvDetalle);
                                    if ($cfg->aplicarDaPrecio != $cliente->usaprecio) {
                                        $dv = 0.00;
                                    }
                                }
                                $neto = CalculaPrecioNeto($precio, $da, $di, $dc, $pp, $dp, $dv, $dvp);
                                $subtotal = floatval($neto) * intval($pedir);
                                DB::table('pedren')
                                ->where('item', '=', $item)
                                ->update(array('cantidad' => $pedir,
                                               'neto' => $neto,
                                               'subtotal' => $subtotal ));
                            }
                        }
                    }
                }
                CalculaTotalesPedido($idpedido);
                $ped = DB::table('pedido')
                ->where('id','=',$idpedido)
                ->first();
                $total= $ped->total;
                $item = $ped->numren;
            }
        }
        return response()->json(['msg' => $msg, 
                                 'total' => $total,
                                 'item' => $item]);
    }

    public function modificar(Request $request) {
        try {
            // MODIFICA CANTIDAD DEL PRODUCTO DEL PEDIDO
            set_time_limit(300);
            $cfg = DB::table('cfg')->first();
            $item = $request->get('item');
            $pedir = Getfloat($request->get('pedir'));
            $idpedido = $request->get('idpedido');
            $codprod = $request->get('codprod');
            $subrenglon = 0.00;
            $descuento = 0.00;
            $subtotal = 0.00;
            $impuesto = 0.00;
            $total = 0.00;
            $neto = 0.00;
            $dp = 0.00;
            $dv = 0.00;
            $msg = "";

   
            // BUSCAR DATOS DEL PRODUCTO A AGREGAR
            $prod = DB::table('producto')
            ->where('codprod','=',$codprod)
            ->first();
            if ($prod) {
                $inventario = number_format($prod->cantidad, 0, '.', ','); 
                $undmin = $prod->undmin;
                $undmax = $prod->undmax;
                $undmultiplo = $prod->undmultiplo;
                if ($pedir <=  0) {
                    $msg = "La cantidad a pedir no puede ser menor o igual a cero"; 
                } else {
                    if ($pedir > $prod->cantidad) {
                        $n1 = number_format($pedir, 0, '.', ','); 
                        $msg = "La cantidad a pedir (".$n1.") es mayor > al inventario (".$inventario.")"; 
                    } else {
                        $resp = collect(validarCaractExtendidas($pedir, $pedir, $prod->cantidad, $undmin, $undmax, $undmultiplo, $codprod));

                        //log::info("RESP: ".$resp);

                        if ($resp->get('status') == 2) {
                            $msg = "CARACTERISTICAS EXTENDIDAS".PHP_EOL."==============================================".PHP_EOL;
                            $msg .= $prod->desprod.PHP_EOL.' - '.$resp->get('msg');
                        } else {

                            $pedir = $resp->get('pedir');
                            if ($resp->get('status') == 1) {
                                $msg = "CARACTERISTICAS EXTENDIDAS".PHP_EOL."==============================================".PHP_EOL;
                                $msg .= $prod->desprod.PHP_EOL.' - '.$resp->get('msg');
                            }
                            $dp = 0.00;
                            if ($cfg->mostrarDp) {
                                if (bValida_Preempaque($pedir, $prod->upre, $prod->ppre)) 
                                    $dp = $prod->ppre;
                            }
                            $dv = 0.00;
                            if ($cfg->mostrarDv) 
                                $dv = dBuscar_DctoVolumen($pedir, $prod->dvDetalle);

                            DB::table('pedren')
                                ->where('item', '=', $item)
                                ->update(array('cantidad' => $pedir, 'dp' => $dp, 'dv' => $dv ));
                            CalculaTotalesPedido($idpedido);
                            $pedren = DB::table('pedren')
                                        ->where('item', '=', $item)
                                        ->first();
                            if ($pedren) 
                                $neto = $pedren->neto;
                            $pedido = DB::table('pedido')
                                ->where('id','=',$idpedido)
                                ->first();
                            if ($pedido) {
                                $subrenglon = $pedido->subrenglon;
                                $descuento = $pedido->descuento;
                                $subtotal = $pedido->subtotal;
                                $impuesto = $pedido->impuesto;
                                $total = $pedido->total;
                            }
                        }
                    }
                }
            }
        } catch(Exception $e) {
            log::info("ERROR: ".$e." - Linea: ".$e->getLine());
        }
        //log::info("PASO2: ".$dp);
        return response()->json(['msg' => $msg,
                                 'subrenglon' => $subrenglon,
                                 'descuento' => $descuento,
                                 'subtotal' => $subtotal,
                                 'impuesto' => $impuesto,
                                 'total' => $total,
                                 'dp' => $dp,
                                 'dv' => $dv,
                                 'neto' => $neto,
                                 'pedir' => $pedir ]);
    }
 
    public function deleprod(Request $request, $item) {
        $regs = DB::table('pedren')
        ->where('item','=',$item)
        ->delete();
        $id=trim($request->get('id'));
        CalculaTotalesPedido($id);
        return Redirect::to('/seped/catalogo/'.$id.'/edit');
    }

    public function enviar(Request $request, $id) {
        // ENVIAR CARRITO
        set_time_limit(300);
        try {
            DB::beginTransaction();

            $observ = $request->get('observ'); 
            $codtransp = $request->get('codtransp'); 
            IF (strlen($codtransp)==0)
                $codtransp = "PRIORIDAD NORMAL";
    
            $pedido = DB::table('pedido')
            ->where('id','=',$id)
            ->first();
            if ($pedido) {
                $estadoCliente = "ACTIVO";
                $codcli = $pedido->codcli;
                $cliente = DB::table('cliente')
                ->where('codcli','=',$codcli)
                ->first();
                if ($cliente) 
                    $estadoCliente = $cliente->estado;
               
                // CUENTA LA CANTIDAD DE ITEM DEL PEDIDO
                $cfg = DB::table('cfg')->first();
                $reg = DB::table('pedren')
                    ->selectRaw('count(*) as contitem')
                    ->where('id','=', $id)
                    ->first();
                if ($reg->contitem > 0) {
                    // CAMBIAR ESTADO
                    DB::table('pedido')
                    ->where('id', '=', $id)
                    ->update(array('estado' => 'ENVIADO',
                                   'factorcambiario' => $cfg->tasacambiaria,
                                   'observacion' => $observ,
                                   'codtransp' => $codtransp,
                                   'fecenviado' => date("Y-m-d H:i:s")));
                    if ($estadoCliente == "INACTIVO")
                        session()->flash('warning', 'Pedido '.$id.' enviado satisfactoriamente, Pero su despacho quedará condicionado. Por favor comuniquese con el Dpto. de Credito y Cobranza');
                    else
                        session()->flash('message', 'Pedido '.$id.' enviado satisfactoriamente');
                }
                else {
                    // PEDIDO EN BLANCO
                    $regs = DB::table('pedido')
                    ->where('id','=',$id)
                    ->delete();
                    session()->flash('error', 'Pedido '.$id.' en blanco no enviado');
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/pedido');
    }

    public function descargar(Request $request) {
        //set_time_limit(1000); 
        ini_set('memory_limit', '-1');
        $codcli = sCodigoClienteActivo();
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $tipo = Auth::user()->tipo;
        $tipoprecio = 1;
        if (Auth::user()->tipo == 'C') {
            $cliente = DB::table('cliente')
            ->where('codcli','=',$codcli)
            ->first();
            $tipoprecio = $cliente->usaprecio;
        } else {
            $tipoprecio = $request->get('tipoprecio');
        }
        $cate = null;
        $id = $request->get('id');
        $orden = $request->get('orden');
        $formato = $request->get('formato');
        $codigo2 = $request->get('codigo2');
        $cfg = DB::table('cfg')
        ->where('codisb','=',$sucactiva)
        ->first();
        $filtro = $request->get('filtro');
        $mostrarCantidad = ($request->get('mostrarCantidad') == 'on' ? '1' : '0');
        $mostrarInvMayor = $request->get('mostrarInvMayor');
        $fecha = date('d-m-Y');

        $dc = 0.00;
        $di = 0.00;
        $pp = 0.00;
        $dvp = 0.00;
        $cliente = DB::table('cliente')
        ->where('codisb','=',$sucactiva)
        ->where('codcli','=',$codcli)
        ->first();
        if ($cliente) {
            $dc = $cliente->dcomercial;
            $di = $cliente->dinternet;
            $pp = $cliente->ppago;
            if ($cliente->DctoPreferencial) {
                $datadvp = MesActivoPreferencial($cliente->DctoPreferencial);
                $dvp = $datadvp['dcto'];
            }
        }

        //log::info("CD -> FORMATO: ".$formato);
        switch ($id) {
            case 'P':
                $orden = "ALFABETICO";
                $subtitulo = "PRODUCTOS PSICOTROPICOS";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,'>','0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','1')
                ->where('cuarentena','=','0')
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->get();
                break;
            case 'D':
                $orden = "ALFABETICO";
                $subtitulo = "PRODUCTOS DESTACADOS";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>',$mostrarInvMayor)
                ->where('cuarentena','=','0')
                ->where(function ($q1) {
                    $q1->where('clase','=','NUEVO')
                    ->Orwhere('clase','=','DESTACADO');
                })
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->get();
                break;
            case 'E':
                $orden = "ALFABETICO";
                $fechaHoy = date('Y-m-d');
                $fechax = strtotime('-'.$cfg->diasMaximoEntradas.' day', strtotime($fechaHoy));
                $desde = date('Y-m-d', $fechax).' 00:00:00';
                $hasta = $fechaHoy.' 23:59:00';
                $subtitulo = "ENTRADAS DE PRODUCTOS";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>',$mostrarInvMayor)
                ->where('precio'.$tipoprecio,'>','0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->whereBetween('fechafalla', array($desde, $hasta))
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('fechafalla','desc')
                ->get();
                break;
            case 'O':
                $orden = "ALFABETICO";
                $subtitulo = "OFERTAS DE PRODUCTOS";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>',$mostrarInvMayor)
                ->where('precio'.$tipoprecio,'>','0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where('da','>','0')
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('da','desc')
                ->get();
                break;
            case 'G':
                $orden = "ALFABETICO";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,'>','0')
                ->where('opc1','=',$codigo2)
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where(function ($q) use ($codigo2) {
                    $q->Orwhere('opc1','=',$codigo2)
                    ->Orwhere('opc2','=',$codigo2)
                    ->Orwhere('opc3','=',$codigo2);
                })
                ->orderBy('desprod','asc')
                ->get();
                $cont =  number_format($catalogo->count(), 0, '.', ',');
                $subtitulo= "PRODUCTOS POR CATEGORIAS (".sLeerCategoria($codigo2, 'nomcat').", $cont)";
                break;
            case 'M':
                $orden = "ALFABETICO";
                $subtitulo = "PRODUCTOS POR MARCAS (".sLeerMarca($codigo2, 'desmarca').")";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>',$mostrarInvMayor)
                ->where('precio'.$tipoprecio,'>','0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where('marcamodelo','=',$codigo2)
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->get();
                break;    
            case 'C':
                if ($formato == "EXCEL") {
                    $archivo = 'catalogo.csv';

                    $tasacambiaria = ($cfg->tasacambiaria > 0) ? $cfg->tasacambiaria:1;

                    $tasa1 = number_format($tasacambiaria, 2, '.', '');
                    $tasa1 = str_replace(".", ",", $tasa1);

                    $variable = 'precio'.$tipoprecio;

                    $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
                    $rutaarc = $BASE_PATH.'/public/storage/'.$archivo;

                    //$rutaarc = $archivo;
                    $fs = fopen($rutaarc,"w");
                    $catalogo = DB::table('producto')
                    ->where('codisb','=',$sucactiva)
                    ->where('cantidad','>',$mostrarInvMayor)
                    ->where('precio'.$tipoprecio,'>','0')
                    ->where('clase','!=','INTERNO')
                    ->where('psicotropico','=','0')
                    ->where('cuarentena','=','0')
                    ->where(function ($q) use ($filtro) {
                        $q->where('desprod','LIKE','%'.$filtro.'%')
                        ->Orwhere('barra','LIKE','%'.$filtro.'%')
                        ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                        ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                        ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                    })
                    ->orderBy('desprod','asc')
                    ->get();
                    $traza = "DESCRIPCION; MARCA; CODIGO; EXISTENCIA; IVA; PRECIO(".$cfg->simboloOM."); PRECIO; DA(%); NETO(".$cfg->simboloOM."); NETO; BARRA; TASA; ".PHP_EOL;
                    fwrite($fs,$traza);
                    foreach ($catalogo as $c) {

                        $dp = $c->ppre;
                        $dv = $c->dv;
                        if ($tipo == 'A') {
                            $dp = 0.00;
                            $dv = 0.00;
                        }
                        $precio = CalculaPrecioNeto($c->$variable, $c->da, $di, $dc, $pp, $dp, $dv, $dvp);

                        $precioBS =  number_format($c->$variable, 2, '.', ',');
                        $precioOM =  number_format($c->$variable/$tasacambiaria, 2, '.', ',');

                        $precioBS = str_replace(".", ",", $precioBS);
                        $precioOM = str_replace(".", ",", $precioOM);

                        $netoOM = number_format($precio/$tasacambiaria, 2, '.', ',');
                        $netoBS = number_format($precio, 2, '.', ',');

                        $cantidad = str_replace(".00", "", $c->cantidad);
                        $iva = str_replace(".", ",", $c->iva);
                        $da = str_replace(".", ",", $c->da);
                        $netoOM = str_replace(".", ",", $netoOM);
                        $netoBS = str_replace(".", ",", $netoBS);


                        $traza = 
                         $c->desprod.";"
                        .$c->marcamodelo.";"
                        .$c->codprod.";"
                        .$cantidad.";"
                        .$iva.";"
                        .$precioOM.";"
                        .$precioBS.";"
                        .$da.";"
                        .$netoOM.";"
                        .$netoBS.";"
                        .$c->barra.";"
                        .$tasa1.";"
                        .PHP_EOL;
                        fwrite($fs,$traza);
                    }
                    fclose($fs);
                    $headers = ['Content-type'=>'text/plain', 'test'=>'YoYo', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $archivo),'X-BooYAH'=>'WorkyWorky'];
                    return response()->download($rutaarc);
                }
                else {
                    if ($orden == "ALFABETICO") {
                        $subtitulo = "CATALOGO DE PRODUCTOS";
                        $catalogo = DB::table('producto')
                        ->where('cantidad','>',$mostrarInvMayor)
                        ->where('precio'.$tipoprecio,'>','0')
                        ->where('clase','!=','INTERNO')
                        ->where('psicotropico','=','0')
                        ->where('cuarentena','=','0')
                        ->where(function ($q) use ($filtro) {
                            $q->where('desprod','LIKE','%'.$filtro.'%')
                            ->Orwhere('barra','LIKE','%'.$filtro.'%')
                            ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                            ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                            ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                        })
                        ->orderBy('desprod','asc')
                        ->get();
                    } else {
                        $subtitulo = "CATALOGO DE PRODUCTOS POR CATEGORIAS";
                        $cate = DB::table('categoria')
                        ->orderBy('nomcat','asc')
                        ->get();
                      
                        $catalogo = DB::table('producto')
                        ->where('cantidad','>',$mostrarInvMayor)
                        ->where('precio'.$tipoprecio,'>','0')
                        ->where('clase','!=','INTERNO')
                        ->where('psicotropico','=','0')
                        ->where('cuarentena','=','0')
                        ->where(function ($q) use ($filtro) {
                            $q->where('desprod','LIKE','%'.$filtro.'%')
                            ->Orwhere('barra','LIKE','%'.$filtro.'%')
                            ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                            ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                            ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                        })
                        ->orderBy('desprod','asc')
                        ->get();
                    }
                }
                break;
            case 'F':
                $orden = "ALFABETICO";
                $subtitulo = "CATALOGO DE PRODUCTOS EN FALLAS";
                $catalogo=DB::table('prodfalla')
                ->where('codisb','=',$sucactiva)
                ->where(function ($q) use ($filtro) {
                    $q->where('barra','LIKE','%'.$filtro.'%')
                    ->orwhere('codprod','LIKE','%'.$filtro.'%')
                    ->orwhere('desprod','LIKE','%'.$filtro.'%')
                    ->orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->orwhere('pactivo','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->get();
        }

        $data = [
            "menu" => "Pedidos",
            "catalogo" => $catalogo, 
            "codcli" => $codcli,
            "sucactiva" => $sucactiva,
            "tipo" => $tipo,
            "codigo2" => $codigo2,
            "filtro" => $filtro,
            "orden" => $orden,
            "cate" => $cate,
            "id" => $id,
            "cfg" => $cfg,
            "tipoprecio" => $tipoprecio,
            "fecha" => $fecha,
            "mostrarCantidad" => $mostrarCantidad,
            "subtitulo" => $subtitulo,
            "dc" => $dc, 
            "di" => $di, 
            "pp" => $pp,  
            "dvp" => $dvp  
        ];

        $formato = $cfg->formatoPersCat;
        if ($formato == "" || $formato == 'rptcatalogo') {
             $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 
            'isRemoteEnabled' => true])
             ->loadView('layouts.rptcatalogo', $data);

        } else {
            $pdf = PDF::loadView('layouts.'.$formato, $data);
        }
        return $pdf->download('catalogo.pdf');
    }

	public function listado(Request $request, $id) {
        $s1 = explode('_', $id );
        $tipo = $s1[0];
        $modovisual = "T"; // TABLA
        $montoTotal = 0;
        $contItem = 0;
        $tipoprecio = 1;
        $codigo2 = "";
        $cliente = "";
        $filtro = $request->get('filtro');
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());

        //log::info("FILTRO: ".$filtro);
        $user = Auth::user();
        $tipouser = Auth::user()->tipo;
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $mincpProv[] = '';
        $arrayProve[] = '';
        if ($cfg->ActivarMincp > 0) {
            // LISTA DE PROVEEDORES PARA EL MINCP (SUPEROFERTA)
            $provs = MinicpLP($cfg->KeyMincp);
            if (is_null($provs)) {
                DB::table('cfg')->update(array('ActivarMincp' => 0));
            } else {
                if (count($provs) > 0) {
                    unset($mincpProv);
                    unset($arrayProve);
                    for ($i = 0; $i < count($provs); $i++) {
                        $codprove =  mb_strtoupper($provs[$i]);
                        $arrayProve[] = $codprove;
                        // CONSULTA DATA DEL PROVEEDOR PARA EL MINCP (SUPEROFERTA)
                        $confprov = MinicpCP($codprove);
                        if (is_null($confprov))
                            continue;
                        $mincpProv[] = $confprov;
                    }
                }
            }
        } 
        //log::info($mincpProv);
        $dc = 0.00;
        $di = 0.00;
        $pp = 0.00;
        $dvp = 0.00;
        $codcli = sCodigoClienteActivo();
        $cliente = DB::table('cliente')
        ->where('codcli','=',$codcli)
        ->first();
        if ($cliente) {
            $dc = $cliente->dcomercial;
            $di = $cliente->dinternet;
            $pp = $cliente->ppago;
            if ($cliente->DctoPreferencial) {
                $datadvp = MesActivoPreferencial($cliente->DctoPreferencial);
                $dvp = $datadvp['dcto'];
            }
        }
        $subtitulo = "CARRITO";
        // TABLA DE CATEGORIA
        $categoria = DB::table('catimg')
        ->orderBy('nomcat','asc')
        ->get();
        if ($tipo == 'G') {
            foreach ($categoria as $c) {
                $codigo2 = $c->codcat;
                break;
            }
        }
        // TABLA DE MARCAS
        $marca = DB::table('marcaimg')
        ->orderBy('desmarca','asc')
        ->get();
        if ($tipo == 'M') {
            foreach ($marca as $m) {
                $codigo2 = $m->codmarca;
                break;
            }
        }
        if ( count($s1) > 1) {
            $codigo2 = $s1[1];
        } 
        $menu = "Catalogo";
        $buscarenCatalogo = 0;
        $comparador = '>=';
        if ($tipouser != 'A' && $tipouser != 'S') {
            //$menu = "Pedidos";
            $comparador = '>';
            $codcli = sCodigoClienteActivo();
            $cliente = DB::table('cliente')
            ->where('codcli','=',$codcli)
            ->first();
            if (empty($cliente)) {
                return Redirect::back()->with('error', 'Cliente '.$codcli.' no se encuentra en la base de datos');
            } 
            $tipoprecio = $cliente->usaprecio;
            $idpedido = iIdUltPedAbierto($codcli); 

            //dd($tipoprecio.' - '.$idpedido.' - '.$codcli);

            // MONTO TOTAL DEL PEDIDO
            $reg1 = DB::table('pedren')
            ->where('id','=', $idpedido)
            ->selectRaw('SUM(cantidad * precio) as subtotal')
            ->first();
            $montoTotal = $reg1->subtotal;

    		// CUENTA LA CANTIAD DE ITEM DEL PEDIDO ABIERTO
            $reg2 = DB::table('pedren')
            ->where('id','=', $idpedido)
            ->selectRaw('count(*) as contitem')
            ->first();
            $contItem = $reg2->contitem;
        }  
        switch ($tipo) {
            case 'P':
                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','1')
                ->where('cuarentena','=','0')
                ->first();
                $cont =  number_format($reg->contador, 0, '.', ',');

                $subtitulo = "PRODUCTOS PSICOTROPICOS (".$cont.")";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','1')
                ->where('cuarentena','=','0')
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->paginate(25);
                if ($catalogo->count() == 0 && $filtro ) {
                    $buscarenCatalogo = 1;
                }
                break;
            case 'D':
                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('cuarentena','=','0')
                ->where(function ($q) {
                    $q->where('clase','=','NUEVO')
                    ->Orwhere('clase','=','DESTACADO');
                })
                ->first();
                $cont = number_format($reg->contador, 0, '.', ',');

                $subtitulo = "PRODUCTOS DESTACADOS (".$cont.")";
                $modovisual = "I"; //IMAGEN
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('cuarentena','=','0')
                ->where(function ($q) {
                    $q->where('clase','=','NUEVO')
                    ->Orwhere('clase','=','DESTACADO');
                })
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->get();
                if ($catalogo->count() == 0 && $filtro) {
                    $buscarenCatalogo = 1;
                }
                break;
            case 'E':
                $fechaHoy = date('Y-m-d');
                $fechax = strtotime('-'.$cfg->diasMaximoEntradas.' day', strtotime($fechaHoy));
                $desde = date('Y-m-d', $fechax).' 00:00:00';
                $hasta = $fechaHoy.' 23:59:00';

                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->whereBetween('fechafalla', array($desde, $hasta))
                ->first();
                $cont = number_format($reg->contador, 0, '.', ',');
                $subtitulo = "ENTRADAS DE PRODUCTOS (".$cont.")";
              
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->whereBetween('fechafalla', array($desde, $hasta))
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('fechafalla','desc')
                ->paginate(25);
                if ($catalogo->count() == 0 && $filtro) {
                    $buscarenCatalogo = 1;
                }
                break;
            case 'O':
                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where(function ($q) {
                    $q->where('da','>','0')
                    ->Orwhere('ppre','>','0')
                    ->Orwhere('dv','>','0');
                })
                ->first();
                $cont =  number_format($reg->contador, 0, '.', ',');

                $subtitulo = "OFERTAS DE PRODUCTOS (".$cont.")";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where(function ($q) {
                    $q->where('da','>','0')
                    ->Orwhere('ppre','>','0')
                    ->Orwhere('dv','>','0');
                })
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('da','desc')
                ->paginate(25);
                if ($catalogo->count() == 0 && $filtro) {
                    $buscarenCatalogo = 1;
                }
                break;
            case 'M':
                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio ,$comparador,'0')
                ->where('marcamodelo','=',$codigo2)
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->first();

                $cont =  number_format($reg->contador, 0, '.', ',');
                $subtitulo = "PRODUCTOS POR MARCAS (".sLeerMarca($codigo2, 'desmarca').", $cont)";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio ,$comparador,'0')
                ->where('marcamodelo','=',$codigo2)
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->paginate(25);
                if ($catalogo->count() == 0 && $filtro) {
                    $buscarenCatalogo = 1;
                }
                break;
            case 'G':
                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('opc1','=',$codigo2)
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where(function ($q) use ($codigo2) {
                    $q->Orwhere('opc1','=',$codigo2)
                    ->Orwhere('opc2','=',$codigo2)
                    ->Orwhere('opc3','=',$codigo2);
                })
                ->first();
                $cont =  number_format($reg->contador, 0, '.', ',');
                $subtitulo = "PRODUCTOS POR CATEGORIAS (".sLeerCategoria($codigo2, 'nomcat').", $cont)";
                $catalogo = DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('opc1','=',$codigo2)
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->paginate(25);
                if ($catalogo->count() == 0 && $filtro) {
                    $buscarenCatalogo = 1;
                }
                break;
            case 'C':
                $reg = DB::table('producto')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->first();
                $cont =  number_format($reg->contador, 0, '.', ',');
                $subtitulo = "CATALOGO DE PRODUCTOS (".$cont.")";
                $catalogo =  DB::table('producto')
                ->where('codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio,$comparador,'0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where(function ($q) use ($filtro) {
                    $q->where('desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->paginate(25);
                break;
            case 'F':
                $reg = DB::table('prodfalla')
                ->selectRaw('count(*) as contador')
                ->where('codisb','=',$sucactiva)
                ->first();
                $cont =  number_format($reg->contador, 0, '.', ',');
                $subtitulo = "FALLAS (".$cont.")";
                
                $catalogo=DB::table('prodfalla')
                ->where('codisb','=',$sucactiva)
                ->where(function ($q) use ($filtro) {
                    $q->where('barra','LIKE','%'.$filtro.'%')
                    ->orwhere('codprod','LIKE','%'.$filtro.'%')
                    ->orwhere('desprod','LIKE','%'.$filtro.'%')
                    ->orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->orwhere('pactivo','LIKE','%'.$filtro.'%');
                })
                ->orderBy('desprod','asc')
                ->paginate(25);
            case 'I':

                DB::table('promdias')
                ->update(array("fechahoy" => date('Y-m-d')));

                $fechaHoy = trim(date("Y-m-d"));
                $subtitulo = "PRODUCTOS POR DIAS DE CREDITO ";
                $catalogo = DB::table('producto as p')
                ->leftJoin('promren as pr','pr.codprod','=','p.codprod')
                ->leftJoin(DB::raw('(select * from promdias where promdias.estado="ACTIVO" 
                    and ( promdias.fechahoy BETWEEN promdias.desde AND promdias.hasta )
                    ) as pd') ,function ($q2) {
                        $q2->on('pr.id','=','pd.id');
                })
                ->where('p.codisb','=',$sucactiva)
                ->where('pr.codisb','=',$sucactiva)
                ->where('pd.codisb','=',$sucactiva)
                ->where('cantidad','>','0')
                ->where('precio'.$tipoprecio ,$comparador,'0')
                ->where('clase','!=','INTERNO')
                ->where('psicotropico','=','0')
                ->where('cuarentena','=','0')
                ->where(function ($q) use ($filtro) {
                    $q->where('p.desprod','LIKE','%'.$filtro.'%')
                    ->Orwhere('barra','LIKE','%'.$filtro.'%')
                    ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                    ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                    ->Orwhere('p.codprod','LIKE','%'.$filtro.'%');
                })
                ->orderBy('pd.dias','desc')
                ->paginate(50);

                if ($catalogo->count() == 0 && $filtro) {
                    $buscarenCatalogo = 1;
                }
                break;
        }
        if (strlen($filtro) > 0) {
            $exitosa = 0;
            if ($catalogo->count() > 0)
                $exitosa = 1;
            vRegitrarBusquedas($filtro, $exitosa);
        }
        if ($buscarenCatalogo == 1) {
            $reg = DB::table('producto')
            ->selectRaw('count(*) as contador')
            ->where('codisb','=',$sucactiva)
            ->where('cantidad','>','0')
            ->where('precio'.$tipoprecio,$comparador,'0')
            ->where('clase','!=','INTERNO')
            ->where('psicotropico','=','0')
            ->where('cuarentena','=','0')
            ->first();
            $cont =  number_format($reg->contador, 0, '.', ',');
            $subtitulo = "CATALOGO DE PRODUCTOS (".$cont.")";
            $catalogo =  DB::table('producto')
            ->where('codisb','=',$sucactiva)
            ->where('cantidad','>','0')
            ->where('precio'.$tipoprecio,$comparador,'0')
            ->where('clase','!=','INTERNO')
            ->where('psicotropico','=','0')
            ->where('cuarentena','=','0')
            ->where(function ($q) use ($filtro) {
                $q->where('desprod','LIKE','%'.$filtro.'%')
                ->Orwhere('barra','LIKE','%'.$filtro.'%')
                ->Orwhere('marcamodelo','LIKE','%'.$filtro.'%')
                ->Orwhere('pactivo','LIKE','%'.$filtro.'%')
                ->Orwhere('codprod','LIKE','%'.$filtro.'%');
            })
            ->orderBy('desprod','asc')
            ->paginate(25);
            $tipo = "C";
            $modovisual = "T"; // TABLA 
        } 
        return view("seped.catalogo.listado",["menu" => $menu,
                                              "sucactiva" => $sucactiva,
                                              "arrayProve" => $arrayProve,
                                              "catalogo" => $catalogo, 
                                              "mincpProv" => $mincpProv,
                                              "codigo2" => $codigo2,
                                              "categoria" => $categoria,
                                              "marca" => $marca,
                                       	      "filtro" => $filtro,
                                              "tipo" => $tipo,
                                       	      "subtitulo" => $subtitulo,
                                       	      "contItem" => $contItem,
                                              "tipoprecio" => $tipoprecio,
                                              "forma" => "E",
                                              "modovisual" => $modovisual,
                                              "cliente" => $cliente,
                                              "cfg" => $cfg,
                                              "dc" => $dc,
                                              "di" => $di,
                                              "pp" => $pp,
                                              "dvp" => $dvp,
                                       	   	  "montoTotal" => $montoTotal]);
    }

    public function modalerta(Request $request) {
        $codprod = $request->get('codprod');
        $codcli = sCodigoClienteActivo();

        $prod = DB::table('prodfalla')
        ->where('codprod', '=', $codprod)
        ->first();
        if ($prod) {
            //log::info("CAMPO ".$codprod);
            $reg = DB::table('prodfallaalerta')
            ->where('codcli', '=', $codcli)
            ->where('codprod', '=', $codprod)
            ->first();
            if ($reg) {
                DB::table('prodfallaalerta')
                ->where('codcli', '=', $codcli)
                ->where('codprod', '=', $codprod)
                ->delete();
            } else {
                DB::table('prodfallaalerta')->insert([
                'codcli' => $codcli,
                'desprod' => $prod->desprod,
                'codprod' => $codprod ]);
            }
        }
        return response()->json(['msg' => '' ]);
    }
 
    public function borrar(Request $request) {
        $codcli = sCodigoClienteActivo();
        DB::table('prodfallaalerta')
        ->where('codcli', '=', $codcli)
        ->delete();
        return Redirect::back();
    }
}
