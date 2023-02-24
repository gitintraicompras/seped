<?php

/**************************************************************
* Programa   : ProcesarAlcabala.php
* Detalles   : Procesa los pedidos Enviados y verifica segun
*            : la configuracion del la alcabala
*            : 1-> MANUAL, 2->SEMANUAL Y 3->SIN ALACABA
* Proyecto   : SEPED
***************************************************************
* Realizado  : Ing. Mauricio Blanco
* Empresa    : ISB SISTEMAS, C.A.
* Fecha      : 24-01-2021
* Modificado : 27-11-2022
***************************************************************/

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use App\User;
use DB;


class ProcesarAlcabala extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
  
    protected $signature = 'ProcesarAlcabala:pedidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'FASE 1: procesa todos los pedidos ENVIADO y procesa segun configuracion de la ALCABALA. FASE 2: rutina de patir los pedidos segun la cantidad de renglones por factura';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $cfg = DB::table('cfg')->first();
        $numRengPedido = $cfg->numRengPedido;
        $modoAlcabala = $cfg->modoAlcabala;
        $ordenPedSides = $cfg->ordenPedSides;
        $formulaDobleLinea = $cfg->formulaProdDobleLinea;
        if ($cfg->modoAlcabala == 'INACTIVA')
            return;



        // FASE 1: RUTINA DE VERIFICACION DE PEDIDO SEGUN LA ALCABALA (PRE-APROBAR)
        //         EN ESTA FASE TAMBIEN CORRIGE CUALQUIER CAMPO QUE ESTE VACIO
        //         PARA EL CASO DE PEDIDOS QUE VENGAN DE DIFERENTES PORTALES TAL COMO ICOMPRAS
        $ped = DB::table('pedido')
        ->where('estado','=','ENVIADO')
        ->get();
        foreach ($ped as $p) {
            $id = $p->id;
            $codcli = $p->codcli;
            $pedtotal = $p->total;
            $codvend = $p->codvend;
            if ($codvend == "" || is_null($codvend))
                $codvend = $cfg->codvendInternet;

            $cliente = DB::table('cliente')
            ->where('codcli','=',$codcli)
            ->first();
            if ($cliente) {
                $nomcli = $cliente->nombre;
                $limite = $cliente->limite;
                $saldo = $cliente->saldo;
                $monto = $saldo + $pedtotal;
                $di = $cliente->dinternet;
                $dc = $cliente->dcomercial;
                $pp = $cliente->ppago;
                $dcredito = $cliente->dcredito;
                $ruta = $cliente->ruta;
                $entrega = $cliente->entrega;
            } else {
                log::info("ALCABALA PEDIDO: ".$id. " CLIENTE NO EXISTE: ".$codcli);
                continue; // CLIENTE NO EXISTE, LO SALTA
            }

            $pedfiscal = 1;
            $cnf = DB::table('clientenofiscal')
            ->where('codcli','=',$codcli)
            ->first();
            if ($cnf) {
                $pedfiscal = 0;
            }

            switch ($modoAlcabala) {
                case 1:
                    // MANUAL
                    $estadopedido = "POR-APROBAR";
                    log::info("FASE1-ALCABALA(".$modoAlcabala.") ID: ".$id." POR-APROBAR");
                    break;
                case 2:
                    // SEMI-MANUAL
                    if ($monto <= $limite) {
                        // SIN ALCABALA (DIRECTO)
                        $estadopedido = "PRE-APROBADO"; 
                        log::info("FASE1-ALCABALA(".$modoAlcabala.") ID: ".$id." PRE-APROBAR");
                    } else {
                        $estadopedido = "POR-APROBAR"; 
                        log::info("FASE1-ALCABALA(".$modoAlcabala.") ID: ".$id." POR-APROBAR");
                    }
                    break;
                case 3:
                    // SIN ALCABALA (DIRECTO)
                    $estadopedido = "PRE-APROBADO"; 
                    log::info("FASE1-ALCABALA(".$modoAlcabala.") ID: ".$id." PRE-APROBAR");
                    break;
            }
            DB::table('pedido')
            ->where('id', '=', $id)
            ->update(array("estado" => $estadopedido, 
                "fecprocesado" => date('Y-m-j H:i:s'),
                "factorcambiario" => $cfg->tasacambiaria,
                "ruta" => $ruta,
                "nomcli" => $nomcli,
                "di" => $di,
                "dc" => $dc,
                "pp" => $pp,
                "dcredito" => $dcredito,
                "codvend" => $codvend,
                "entrega" => $entrega,
                "pedfiscal" => $pedfiscal ));

            $pedren = DB::table('pedren')
            ->where('id','=',$id)
            ->get();
            foreach ($pedren as $pr) {
                $codprod = $pr->codprod; 
                $item = $pr->item;
                $producto = DB::table('producto')
                ->where('codprod','=',$codprod)
                ->first();
                if ($producto) {
                    $coddpto = $producto->opc1;
                    $codgrupo = $producto->opc2;
                    $codsubgrupo = $producto->opc3;
                    $psicotropico = $producto->psicotropico;
                    $marcamodelo = $producto->marcamodelo;
                    $costo = $producto->costo;
                    $bulto = $producto->original;
                    $manejalote = $producto->manejalote;
                    $FlagFactOM = $producto->FlagFactOM;
                    $refrigerado = $producto->refrigerado;
                    $ubicacion = $producto->ubicacion;
                    DB::table('pedren')
                    ->where('item', '=', $item)
                    ->update(array("coddpto" => $coddpto, 
                        "codgrupo" => $codgrupo,
                        "codsubgrupo" => $codsubgrupo,
                        "marcamodelo" => $marcamodelo,
                        "costo" => $costo,
                        "bulto" => $bulto,
                        "manejalote" => $manejalote,
                        'FlagFactOM' => $FlagFactOM,
                        'refrigerado' => $refrigerado,
                        "psicotropico" => $psicotropico,
                        'ubicacion' => $ubicacion,
                        'codcli' => $codcli ));
                }
            }
        }    




        // FASE 2: RUTINA DE SEPARACION DE PEDIDOS (OM)
        //         SEGUN MONEDA DEL PRODUCTO 
        //         SOLO PARA CLIENTES DONDE (critSepMoneda = 1)
        $pedido = DB::table('pedido')
        ->where('estado','=','PRE-APROBADO')
        ->get();
        foreach ($pedido as $p) {
            $id = $p->id;
            $codcli = $p->codcli;
            $cliente = DB::table('cliente')
            ->where('codcli','=',$codcli)
            ->first();
            if ($cliente) {
                if ($cliente->critSepMoneda == '0') {
                    continue;
                }
            } else {
                continue;
            }
            $descripcriterio = "SEPARADO, MONEDA (OM)";
            $pedren = DB::table('pedren')
            ->where('id','=',$id)
            ->get();
            $crearpedido = 0;
            foreach ($pedren as $pr) {
                if ( $pr->FlagFactOM != "0" ) {
                    if ($crearpedido == 0) {
                        try {
                            $observacion = $p->observacion.' - '.$descripcriterio;
                            if (strlen($observacion)>500)
                                $observacion = substr($observacion,0,500);  
                            $idx = DB::table('pedido')->insertGetId([
                                'codcli' => $p->codcli,
                                'fecha' => $p->fecha, 
                                'estado' => 'SEPARANDO', 
                                'fecenviado' => $p->fecenviado,
                                'fecprocesado' => $p->fecprocesado, 
                                'origen' => $p->origen, 
                                'usuario' => $p->usuario,
                                'codvend' => $p->codvend,
                                'tipedido' => $p->tipedido,
                                'nomcli' => $p->nomcli,
                                'rif' => $p->rif,
                                'dcredito' => $p->dcredito,
                                'di' => $p->di,
                                'dc' => $p->dc,
                                'pp' => $p->pp,
                                'subrenglon' => 0.00,
                                'descuento' => 0.00,
                                'subtotal' => 0.00,
                                'impuesto' => 0.00,
                                'total' => 0.00,
                                'numren' => 0,
                                'numund' => 0,
                                'destino' => $p->destino,
                                'documento' => $p->documento,
                                'codisb' => $p->codisb,
                                'ruta' => $p->ruta,
                                'fecpicking' => $p->fecpicking,
                                'fecpicking' => $p->fecpicking,
                                'feccompletado' => $p->feccompletado,
                                'recipiente' => $p->recipiente,
                                'despachador' => $p->despachador,
                                'observacion' => $observacion,
                                'fecrecibido' => $p->fecrecibido,
                                'embalador' => $p->embalador,
                                'fecfacturado' => $p->fecfacturado,
                                'mantenerNegociacion' => $p->mantenerNegociacion,
                                'sincronizado' => $p->sincronizado,
                                'pedfiscal' => $p->pedfiscal,
                                'factorcambiario' => $p->factorcambiario,
                                'codtransp' => $p->codtransp,
                                'cantBultos' => $p->cantBultos, 
                                'entrega' => $p->entrega 
                            ]);
                            $crearpedido = 1;
                        } catch (Exception $e) {
                            log::info("ALCABALA -> ERROR INSERT PEDIDO CRITERIO (ESPECIAL): ".$e->getMessage());
                        }
                    }
                    try {
                        DB::table('pedren')->insert([
                            'id' => $idx, 
                            'codprod' => $pr->codprod, 
                            'desprod' => $pr->desprod, 
                            'cantidad' => $pr->cantidad,  
                            'precio' => $pr->precio, 
                            'barra' => $pr->barra,
                            'tipocatalogo' => $pr->tipocatalogo,
                            'regulado' => $pr->regulado,
                            'tipo' => $pr->tipo,
                            'pvp' => $pr->pvp,
                            'iva' => $pr->iva,
                            'da' => $pr->da,
                            'di' => $pr->di,
                            'dc' => $pr->dc,
                            'pp' => $pr->pp,
                            'neto' => $pr->neto,
                            'subtotal' => $pr->subtotal,
                            'codisb' => $pr->codisb,
                            'cantdesp' => $pr->cantdesp,
                            'bulto' => $pr->bulto,
                            'ubicacion' => $pr->ubicacion,
                            'packing' => $pr->packing,
                            'costo' => $pr->costo,
                            'lote' => $pr->lote,
                            'feclote' => $pr->feclote,
                            'manejalote' => $pr->manejalote,
                            'marcamodelo' => $pr->marcamodelo,
                            'deposito' => $pr->deposito,
                            'coddpto' => $pr->coddpto,
                            'codgrupo' => $pr->codgrupo,
                            'codsubgrupo' => $pr->codsubgrupo,
                            'psicotropico' => $pr->psicotropico,
                            'listalote' => $pr->listalote,
                            'alertalote' => $pr->alertalote,
                            'refrigerado' => $pr->refrigerado,
                            'FlagFactOM' => $pr->FlagFactOM,
                            'dp' => $pr->dp,
                            'dv' => $pr->dv,
                            'codcli' => $pr->codcli,
                            'dcredito' => $pr->dcredito
                        ]);
                        log::info("PEDIDO: ".$id." CODPROD: ".$pr->codprod." CRITERIO MONEDA APLICA ");
                        DB::table('pedren')->where('item','=',$pr->item)->delete();
                    } catch (Exception $e) {
                        log::info("ALCABALA -> ERROR INSERT PEDREN CRITERIO MONEDA: ".$e->getMessage());
                    }
                } else {
                    log::info("PEDIDO: ".$id." CODPROD: ".$pr->codprod." CRITERIO MONEDA NO APLICA");
                }
            }
            $pr = DB::table('pedren')
            ->selectRaw('count(*) as contitem')
            ->where('id','=', $id)
            ->first();
            if ($pr->contitem == 0) 
                DB::table('pedido')->where('id','=',$id)->delete();
            $pedx = DB::table('pedido')
            ->where('estado','=','SEPARANDO')
            ->get();
            foreach ($pedx as $px) {
                CalculaTotalesPedido($px->id);
                DB::table('pedido')
                ->where('id', '=', $px->id)
                ->update(array("estado" => "PRE-APROBADO"));
            }
        }





        // FASE 3: RUTINA DE SEPARACION DE PEDIDOS 
        //         SEGUN TABLA DE CRITERIOS DE SEPARACION
        //         LOS CRITERIOS SE APLICAN EN CASCADA
        $pedido = DB::table('pedido')
        ->where('estado','=','PRE-APROBADO')
        ->get();
        $pedcrisep = DB::table('pedcrisep')
        ->where('estado','=','ACTIVO')
        ->where('criterio','!=','')
        ->get();
        if ($pedcrisep->count() > 0 && $pedido->count() > 0) {
            foreach ($pedido as $p) {
         
                DB::table('pedido')
                ->where('id','=',$p->id)
                ->update(array("estado" => "SEPARANDO"));

                $contCriterio = 0;
                $arrayNew = array($p->id);
                $array = array($p->id);
                foreach ($pedcrisep as $pc) {
                    if ($contCriterio == 0) {
                        $contCriterio++;
                    } else {
                        $array = $arrayNew;
                    }
                    $dcredito = $p->dcredito;
                    if ($pc->diasCredito > 0)
                        $dcredito = $pc->diasCredito;
                    $criterio = $pc->criterio;
                    $descripcriterio = "SEPARADO (".$pc->descrip.")";
                    log::info("CONTADOR: ".count($array)); 
                    $i = 0;
                    for ($i = 0; $i < count($array); $i++) {
                        $id = $array[$i];
                        $pedren = DB::table('pedren')
                        ->where('id','=',$id)
                        ->get();
                        $crearpedido = 0;
                        foreach ($pedren as $pr) {
                            eval("\$criterio2=$criterio;");
                            if ($criterio2) {
                                if ($crearpedido == 0) {
                                    
                                    try {
                                        $observacion = $p->observacion.' - '.$descripcriterio;
                                        if (strlen($observacion)>500)
                                            $observacion = substr($observacion,0,500);  
                                        $idx = DB::table('pedido')->insertGetId([
                                            'codcli' => $p->codcli,
                                            'fecha' => $p->fecha, 
                                            'estado' => 'SEPARANDO', 
                                            'fecenviado' => $p->fecenviado,
                                            'fecprocesado' => $p->fecprocesado, 
                                            'origen' => $p->origen, 
                                            'usuario' => $p->usuario,
                                            'codvend' => $p->codvend,
                                            'tipedido' => $p->tipedido,
                                            'nomcli' => $p->nomcli,
                                            'rif' => $p->rif,
                                            'dcredito' => $dcredito,
                                            'di' => $p->di,
                                            'dc' => $p->dc,
                                            'pp' => $p->pp,
                                            'subrenglon' => 0.00,
                                            'descuento' => 0.00,
                                            'subtotal' => 0.00,
                                            'impuesto' => 0.00,
                                            'total' => 0.00,
                                            'numren' => 0,
                                            'numund' => 0,
                                            'destino' => $p->destino,
                                            'documento' => $p->documento,
                                            'codisb' => $p->codisb,
                                            'ruta' => $p->ruta,
                                            'fecpicking' => $p->fecpicking,
                                            'fecpicking' => $p->fecpicking,
                                            'feccompletado' => $p->feccompletado,
                                            'recipiente' => $p->recipiente,
                                            'despachador' => $p->despachador,
                                            'observacion' => $observacion,
                                            'fecrecibido' => $p->fecrecibido,
                                            'embalador' => $p->embalador,
                                            'fecfacturado' => $p->fecfacturado,
                                            'mantenerNegociacion' => $p->mantenerNegociacion,
                                            'sincronizado' => $p->sincronizado,
                                            'pedfiscal' => $p->pedfiscal,
                                            'factorcambiario' => $p->factorcambiario,
                                            'codtransp' => $p->codtransp,
                                            'cantBultos' => $p->cantBultos,
                                            'entrega' => $p->entrega
                                        ]);
                                        $arrayNew[] = $idx; 
                                        $crearpedido = 1;
                                    } catch (Exception $e) {
                                        log::info("ALCABALA -> ERROR INSERT PEDIDO CRITERIO: ".$e->getMessage());
                                    }
                                }
                                try {
                                    DB::table('pedren')->insert([
                                        'id' => $idx, 
                                        'codprod' => $pr->codprod, 
                                        'desprod' => $pr->desprod, 
                                        'cantidad' => $pr->cantidad,  
                                        'precio' => $pr->precio, 
                                        'barra' => $pr->barra,
                                        'tipocatalogo' => $pr->tipocatalogo,
                                        'regulado' => $pr->regulado,
                                        'tipo' => $pr->tipo,
                                        'pvp' => $pr->pvp,
                                        'iva' => $pr->iva,
                                        'da' => $pr->da,
                                        'di' => $pr->di,
                                        'dc' => $pr->dc,
                                        'pp' => $pr->pp,
                                        'neto' => $pr->neto,
                                        'subtotal' => $pr->subtotal,
                                        'codisb' => $pr->codisb,
                                        'cantdesp' => $pr->cantdesp,
                                        'bulto' => $pr->bulto,
                                        'ubicacion' => $pr->ubicacion,
                                        'packing' => $pr->packing,
                                        'costo' => $pr->costo,
                                        'lote' => $pr->lote,
                                        'feclote' => $pr->feclote,
                                        'manejalote' => $pr->manejalote,
                                        'marcamodelo' => $pr->marcamodelo,
                                        'deposito' => $pr->deposito,
                                        'coddpto' => $pr->coddpto,
                                        'codgrupo' => $pr->codgrupo,
                                        'codsubgrupo' => $pr->codsubgrupo,
                                        'psicotropico' => $pr->psicotropico,
                                        'listalote' => $pr->listalote,
                                        'alertalote' => $pr->alertalote,
                                        'refrigerado' => $pr->refrigerado,
                                        'FlagFactOM' => $pr->FlagFactOM,
                                        'dp' => $pr->dp,
                                        'dv' => $pr->dv,
                                        'codcli' => $pr->codcli,
                                        'dcredito' => $pc->diasCredito
                                    ]);
                                    log::info("PEDIDO: ".$id." CODPROD: ".$pr->codprod." CRITERIO: ".$criterio." APLICA CRITERIO - DIAS: ".$pc->diasCredito);
                                    DB::table('pedren')->where('item','=',$pr->item)->delete();
                                } catch (Exception $e) {
                                    log::info("ALCABALA -> ERROR INSERT PEDREN CRITERIO: ".$e->getMessage());
                                }
                            } else {
                                log::info("PEDIDO: ".$id." CODPROD: ".$pr->codprod." CRITERIO: ".$criterio);
                            }
                        }
                    }
                }

                $pr = DB::table('pedren')
                ->selectRaw('count(*) as contitem')
                ->where('id','=', $p->id)
                ->first();
                if ($pr->contitem == 0) 
                    DB::table('pedido')->where('id','=',$p->id)->delete();
            
                $pedx = DB::table('pedido')
                ->where('estado','=','SEPARANDO')
                ->get();
                foreach ($pedx as $px) {
                    CalculaTotalesPedido($px->id);
                    DB::table('pedido')
                    ->where('id', '=', $px->id)
                    ->update(array("estado" => "PRE-APROBADO"));
                }
            }
        }




 
    
        // FASE 4: - REORDENA EL PEDIDO 
        //         - ASIGNA EL LOTE
        //         = PARTE EL PEDIDO SEGUN CANTIDAD DE RENGLONES POR FACTURA
        $ped = DB::table('pedido')
        ->where('estado','=','PRE-APROBADO')
        ->get();
        foreach ($ped as $p) {
            $id = $p->id;
            $codcli = $p->codcli;
            switch ($ordenPedSides) {
                case 'ORIGINAL':
                    $pedren = DB::table('pedren')
                    ->where('id','=', $id)
                    ->get();
                    break;
                case 'DESCRIPCION':
                    $pedren = DB::table('pedren')
                    ->where('id','=', $id)
                    ->orderBy('desprod','asc')
                    ->get();
                    break;
                case 'UBICACION':
                    $pedren = DB::table('pedren')
                    ->where('id','=', $id)
                    ->orderBy('ubicacion','asc')
                    ->get();
                    break;
                case 'MARCA':
                    $pedren = DB::table('pedren')
                    ->where('id','=', $id)
                    ->orderBy('marcamodelo','asc')
                    ->get();
                    break;
            }
            $renglon = 0;
            $crearpedido = 0;
            $primero = 0;
            DB::table('pedren')->where('id','=',$id)->delete();
            foreach ($pedren as $pr) {
                if ($crearpedido == 0) {
                    if ($primero == 0) {
                        // INSERT DEL NUEVO PEDIDO A RAIZ DEL ORIGINAL
                        $primero = 1;
                        $idx = $id; 
                        DB::table('pedido')
                        ->where('id', '=', $idx)
                        ->update(array('estado' => "PARCIAL", 
                                       'subrenglon' => 0.00,
                                       'descuento' => 0.00,
                                       'subtotal' => 0.00,
                                       'impuesto' => 0.00,
                                       'total' => 0.00,
                                       'numren' => 0,
                                       'numund' => 0,
                                       'fecprocesado' => date('Y-m-j H:i:s')));
                    } else {
                        try {
                            $idx = DB::table('pedido')->insertGetId([
                                'codcli' => $codcli,
                                'fecha' => $p->fecha, 
                                'estado' => 'PARCIAL', 
                                'fecenviado' => $p->fecenviado,
                                'fecprocesado' => $p->fecprocesado, 
                                'origen' => $p->origen, 
                                'usuario' => $p->usuario,
                                'codvend' => $p->codvend,
                                'tipedido' => $p->tipedido,
                                'nomcli' => $p->nomcli,
                                'rif' => $p->rif,
                                'dcredito' => $p->dcredito,
                                'di' => $p->di,
                                'dc' => $p->dc,
                                'pp' => $p->pp,
                                'subrenglon' => 0.00,
                                'descuento' => 0.00,
                                'subtotal' => 0.00,
                                'impuesto' => 0.00,
                                'total' => 0.00,
                                'numren' => 0,
                                'numund' => 0,
                                'destino' => $p->destino,
                                'documento' => $p->documento,
                                'codisb' => $p->codisb,
                                'ruta' => $p->ruta,
                                'fecpicking' => $p->fecpicking,
                                'fecpicking' => $p->fecpicking,
                                'feccompletado' => $p->feccompletado,
                                'recipiente' => $p->recipiente,
                                'despachador' => $p->despachador,
                                'observacion' => $p->observacion,
                                'fecrecibido' => $p->fecrecibido,
                                'embalador' => $p->embalador,
                                'fecfacturado' => $p->fecfacturado,
                                'mantenerNegociacion' => $p->mantenerNegociacion,
                                'sincronizado' => $p->sincronizado,
                                'pedfiscal' => $p->pedfiscal,
                                'factorcambiario' => $p->factorcambiario,
                                'codtransp' => $p->codtransp,
                                'cantBultos' => $p->cantBultos,
                                'entrega' => $p->entrega
                            ]);
                        } catch (Exception $e) {
                            log::info("ALCABALA -> ERROR INSERT ASIGNACION LOTE: ".$e->getMessage());
                        }
                    }
                    $crearpedido = 1;
                }

                $contlote = 0;
                $reg = DB::table('lotes')
                ->selectRaw('count(*) as contlote')
                ->where('codpadre','=',$pr->codprod)
                ->first();
                if ($reg) 
                    $contlote = $reg->contlote;

                if ($pr->manejalote == '3' && $contlote > 0) {
                    // CON LOTE
                    $cantori = $pr->cantidad;
                    $cantren = 0;
                    $lotes = DB::table('lotes')
                    ->where('codpadre','=',$pr->codprod)
                    ->where('cantidad','>',0)
                    ->orderBy('id','asc')
                    ->get(); 
                    foreach ($lotes as $l) {
                        if ($cantori == 0) 
                            break;

                        if ($cantori <= $l->cantidad) 
                            $cantren = $cantori;
                        else 
                            $cantren = $l->cantidad;
                      
                        if ($crearpedido == 0) {
                            try {
                                // INSERT DEL NUEVO PEDIDO A RAIZ DEL ORIGINAL
                                $idx = DB::table('pedido')->insertGetId([
                                    'codcli' => $codcli,
                                    'fecha' => $p->fecha, 
                                    'estado' => 'PARCIAL', 
                                    'fecenviado' => $p->fecenviado,
                                    'fecprocesado' => $p->fecprocesado, 
                                    'origen' => $p->origen, 
                                    'usuario' => $p->usuario,
                                    'codvend' => $p->codvend,
                                    'tipedido' => $p->tipedido,
                                    'nomcli' => $p->nomcli,
                                    'rif' => $p->rif,
                                    'dcredito' => $p->dcredito,
                                    'di' => $p->di,
                                    'dc' => $p->dc,
                                    'pp' => $p->pp,
                                    'subrenglon' => 0.00,
                                    'descuento' => 0.00,
                                    'subtotal' => 0.00,
                                    'impuesto' => 0.00,
                                    'total' => 0.00,
                                    'numren' => 0,
                                    'numund' => 0,
                                    'destino' => $p->destino,
                                    'documento' => $p->documento,
                                    'codisb' => $p->codisb,
                                    'ruta' => $p->ruta,
                                    'fecpicking' => $p->fecpicking,
                                    'fecpicking' => $p->fecpicking,
                                    'feccompletado' => $p->feccompletado,
                                    'recipiente' => $p->recipiente,
                                    'despachador' => $p->despachador,
                                    'observacion' => $p->observacion,
                                    'fecrecibido' => $p->fecrecibido,
                                    'embalador' => $p->embalador,
                                    'fecfacturado' => $p->fecfacturado,
                                    'mantenerNegociacion' => $p->mantenerNegociacion,
                                    'sincronizado' => $p->sincronizado,
                                    'pedfiscal' => $p->pedfiscal,
                                    'factorcambiario' => $p->factorcambiario,
                                    'codtransp' => $p->codtransp,
                                    'cantBultos' => $p->cantBultos,
                                    'entrega' => $p->entrega
                                ]);
                                $crearpedido = 1;
                            } catch (Exception $e) {
                                log::info("ALCABALA -> ERROR INSERT PEDIDO ASIGNACION: ".$e->getMessage());
                            }
                        }

                        $ubicacion = $pr->ubicacion;
                        if (strlen($ubicacion)==0)
                            $ubicacion = $l->deposito;

                        $listalote = sLeerListaLotes($pr->codprod);
                        try {
                            DB::table('pedren')->insert([
                                'id' => $idx, 
                                'codprod' => $l->codhijo, 
                                'desprod' => $pr->desprod, 
                                'cantidad' => $cantren, 
                                'precio' => $pr->precio, 
                                'barra' => $pr->barra,
                                'tipocatalogo' => $pr->tipocatalogo,
                                'regulado' => $pr->regulado,
                                'tipo' => $pr->tipo,
                                'pvp' => $pr->pvp,
                                'iva' => $pr->iva,
                                'da' => $pr->da,
                                'di' => $pr->di,
                                'dc' => $pr->dc,
                                'pp' => $pr->pp,
                                'neto' => $pr->neto,
                                'subtotal' => $pr->subtotal,
                                'codisb' => $pr->codisb,
                                'cantdesp' => $pr->cantdesp,
                                'bulto' => $pr->bulto,
                                'ubicacion' => $ubicacion,
                                'packing' => $pr->packing,
                                'costo' => $pr->costo,
                                'lote' => $l->lote,
                                'feclote' => $l->feclote,
                                'manejalote' => $pr->manejalote,
                                'marcamodelo' => $pr->marcamodelo,
                                'deposito' => $l->deposito,
                                'coddpto' => $pr->coddpto,
                                'codgrupo' => $pr->codgrupo,
                                'codsubgrupo' => $pr->codsubgrupo,
                                'psicotropico' => $pr->psicotropico,
                                'listalote' => $listalote,
                                'alertalote' => $pr->alertalote,
                                'refrigerado' => $pr->refrigerado,
                                'FlagFactOM' => $pr->FlagFactOM,
                                'dp' => $pr->dp,
                                'dv' => $pr->dv,
                                'codcli' => $pr->codcli,
                                'dcredito' => $pr->dcredito
                            ]);
                        } catch (Exception $e) {
                            log::info("ALCABALA -> ERROR INSERT ASIGNACION LOTE: ".$e->getMessage());
                        }

                        $cantori = $cantori - $cantren;
                        $renglon++;    
                        if ($formulaDobleLinea != '0' && strlen(trim($formulaDobleLinea)) > 0 ) {
                            $valor="";     
                            eval("\$valor=$formulaDobleLinea;");
                            if ($valor) 
                                $renglon++;    
                        }
                        // VALIDA EL CASO DE QUE EL PEDIDO SE PARTA CUANDO
                        // HAYA BUSCADO LOS LOTES 
                        if ($renglon >= $numRengPedido)  {
                            log::info("FASE4-ALCABALA(".$modoAlcabala.") ORI: ".$id." RENG(".$p->numren.") PARCIAL: ".$idx. " RENG(".$renglon.")"); 
                            $renglon = 0;
                            $crearpedido = 0;
                        }
                    }
                } else {
                    // NORMAL
                    $ubicacion = $pr->ubicacion;
                    if (strlen($ubicacion)==0)
                        $ubicacion = $pr->deposito;
                                      
                    DB::table('pedren')->insert([
                        'id' => $idx, 
                        'codprod' => $pr->codprod, 
                        'desprod' => $pr->desprod, 
                        'cantidad' => $pr->cantidad, 
                        'precio' => $pr->precio, 
                        'barra' => $pr->barra,
                        'tipocatalogo' => $pr->tipocatalogo,
                        'regulado' => $pr->regulado,
                        'tipo' => $pr->tipo,
                        'pvp' => $pr->pvp,
                        'iva' => $pr->iva,
                        'da' => $pr->da,
                        'di' => $pr->di,
                        'dc' => $pr->dc,
                        'pp' => $pr->pp,
                        'neto' => $pr->neto,
                        'subtotal' => $pr->subtotal,
                        'codisb' => $pr->codisb,
                        'cantdesp' => $pr->cantdesp,
                        'bulto' => $pr->bulto,
                        'ubicacion' => $pr->ubicacion,
                        'packing' => $pr->packing,
                        'costo' => $pr->costo,
                        'lote' => $pr->lote,
                        'feclote' => $pr->feclote,
                        'manejalote' => $pr->manejalote,
                        'marcamodelo' => $pr->marcamodelo,
                        'deposito' => $pr->deposito,
                        'coddpto' => $pr->coddpto,
                        'codgrupo' => $pr->codgrupo,
                        'codsubgrupo' => $pr->codsubgrupo,
                        'psicotropico' => $pr->psicotropico,
                        'listalote' => "", 
                        'alertalote' => $pr->alertalote,
                        'refrigerado' => $pr->refrigerado,
                        'FlagFactOM' => $pr->FlagFactOM,
                        'dp' => $pr->dp,
                        'dv' => $pr->dv,
                        'codcli' => $pr->codcli,
                        'dcredito' => $pr->dcredito                      
                    ]);
                    $renglon++;
                    if ($formulaDobleLinea != '0' && strlen(trim($formulaDobleLinea)) > 0 ) {
                        $valor="";     
                        eval("\$valor=$formulaDobleLinea;");
                        if ($valor) 
                            $renglon++;    
                    }   
                }
                if ($renglon >= $numRengPedido)  {
                    log::info("FASE4-ALCABALA(".$modoAlcabala.") ORI: ".$id." RENG(".$p->numren.") PARCIAL: ".$idx. " RENG(".$renglon.")"); 
                    $renglon = 0;
                    $crearpedido = 0;
                }
            }
        }
   



        // FASE 5: ACTUALIZO EN UNA SOLA CORRIDA TODOS LOS PEDIDOS DE PARCIAL -> APROBADO
        $ped = DB::table('pedido')
        ->where('estado','=','PARCIAL')
        ->get();
        foreach ($ped as $p) {
            $idx = $p->id;
            CalculaTotalesPedido($idx);
            DB::table('pedido')
            ->where('id', '=', $idx)
            ->update(array("estado" => "APROBADO", "fecprocesado" => date('Y-m-j H:i:s')));
            log::info("FASE5-ALCABALA(".$modoAlcabala.") ID: ".$idx." APROBADO"); 
        }
        
    }
}



