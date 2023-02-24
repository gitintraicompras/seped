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
        
class AdconfigController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $subtitulo = "MODULO DE CONFIGURACION'";
        return view('seped.config.index' ,["menu" => "Configuracion",
                                           "sucactiva" => $sucactiva,
                                           "subtitulo" => $subtitulo,
                                           "cfg" => $cfg ]);
    }
 
 	public function edit($id) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
    	$subtitulo = "CONFIGURACION";
        $recmotivo = DB::table('recmotivo')
        ->orderBy("id","asc")
        ->get(); 
        $ctabanco = DB::table('ctabanco')
        ->orderBy("co_cta","asc")
        ->get(); 
		return view("seped.config.edit",["menu" => "Configuracion",
                                         "recmotivo" => $recmotivo,
                                         "ctabanco" => $ctabanco,
                                         "sucactiva" => $sucactiva,
                                         "cfg" => $cfg,
    								     "subtitulo" => $subtitulo]);
    }

    public function update(Request $request, $id) {
        try {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
            $nombre = $request->get('nombre');
            $nomcorto = $request->get('nomcorto');
            $rif = $request->get('rif');
            $direccion  = $request->get('direccion');
            $localidad  = $request->get('localidad');
            $contacto  = $request->get('contacto');
            $telefono = $request->get('telefono');
            $fax = $request->get('fax');
            $correo = $request->get('correo');
            $facebook = $request->get('facebook');
            $twitter = $request->get('twitter');
            $instagram = $request->get('instagram');
            $cntvisitas = $request->get('cntvisitas');
            $valorIva = $request->get('valorIva');
            $correoPago = $request->get('correoPago');
            $correoReclamo = $request->get('correoReclamo');
            $correoResumen = $request->get('correoResumen');
            $correoRemitente = $request->get('correoRemitente');
            $diasMaximoReclamo = $request->get('diasMaximoReclamo');
            $diasMaximoEntradas = $request->get('diasMaximoEntradas');
            $activarCorreoCatalogo = ($request->get('activarCorreoCatalogo') == 'on' ? '1' : '0');
            $mision = $request->get('mision');
            $valores = $request->get('valores');
            $vision = $request->get('vision');
            $antecedentes = $request->get('antecedentes');
            $nuestraempresa = $request->get('nuestraempresa');          
            $mostrarImagen = ($request->get('mostrarImagen') == 'on' ? '1' : '0');
            $mostrarMarca = ($request->get('mostrarMarca') == 'on' ? '1' : '0');
            $mostrarBarra = ($request->get('mostrarBarra') == 'on' ? '1' : '0');
            $mostrarBulto = ($request->get('mostrarBulto') == 'on' ? '1' : '0');
            $mostrarModBlog = ($request->get('mostrarModBlog') == 'on' ? '1' : '0');
            $mostrarModDescarga = ($request->get('mostrarModDescarga') == 'on' ? '1' : '0');
            $mostrarComponente = ($request->get('mostrarComponente') == 'on' ? '1' : '0');
            $mostrarImagenPedido = ($request->get('mostrarImagenPedido') == 'on' ? '1' : '0');
            $activarDestacadoProducto = ($request->get('activarDestacadoProducto') == 'on' ? '1' : '0');
            $activarMarcaProducto = ($request->get('activarMarcaProducto') == 'on' ? '1' : '0');
            $simboloMoneda = $request->get('simboloMoneda');
            $simboloOM = $request->get('simboloOM');
            $numRengPedido = $request->get('numRengPedido');
            $mostrarDa = ($request->get('mostrarDa') == 'on' ? '1' : '0');
            $mostrarDi = ($request->get('mostrarDi') == 'on' ? '1' : '0');
            $mostrarDc = ($request->get('mostrarDc') == 'on' ? '1' : '0');
            $mostrarPp = ($request->get('mostrarPp') == 'on' ? '1' : '0');
            $mostrarDp = ($request->get('mostrarDp') == 'on' ? '1' : '0');
            $mostrarDv = ($request->get('mostrarDv') == 'on' ? '1' : '0');
            $mostrarCodigo = ($request->get('mostrarCodigo') == 'on' ? '1' : '0');
            $mostrarLote = ($request->get('mostrarLote') == 'on' ? '1' : '0');
            $mostrarLoteCliente = ($request->get('mostrarLoteCliente') == 'on' ? '1' : '0');
            $modoVisual = $request->get('modoVisual');
            $ordenPedSides = $request->get('ordenPedSides');
            $sincronizar = $request->get('sincronizar');
            $procAlcabala = $request->get('procAlcabala');
            $modoAlcabala = $request->get('modoAlcabala');
            $activarEntradasProducto = ($request->get('activarEntradasProducto')== 'on' ? '1' : '0');
            $activarOfertasProducto = ($request->get('activarOfertasProducto') == 'on' ? '1' : '0');
            $unirRengRepetido = ($request->get('unirRengRepetido') == 'on' ? '1' : '0');
            $activarCateProducto = ($request->get('activarCateProducto') == 'on' ? '1' : '0');
            $mostrarModnofiscal = ($request->get('mostrarModnofiscal') == 'on' ? '1' : '0');
            $mostrarPactaDesc = ($request->get('mostrarPactaDesc') == 'on' ? '1' : '0');
            $mostrarMarcaDesc = ($request->get('mostrarMarcaDesc') == 'on' ? '1' : '0');
            $mostrarNetoCatalogo = ($request->get('mostrarNetoCatalogo') == 'on' ? '1' : '0');
            $activarBotonPsico = ($request->get('activarBotonPsico') == 'on' ? '1' : '0');
            $activarBotonPsicoCliente=($request->get('activarBotonPsicoCliente') == 'on' ? '1' : '0');
            $activarBotonFallaAlerta = ($request->get('activarBotonFallaAlerta') == 'on' ? '1' : '0');
            $activarBotonDias = ($request->get('activarBotonDias') == 'on' ? '1' : '0');
            $nomdominio = $request->get('nomdominio');
            $nomsubdominio = $request->get('nomsubdominio');
            $titulopagina = $request->get('titulopagina');
            $nomsoporte = $request->get('nomsoporte');
            $telsoporte = $request->get('telsoporte');
            $correosoporte = $request->get('correosoporte');
            $linkWhatsappTel = $request->get('linkWhatsappTel');
            $codvendInternet = $request->get('codvendInternet');
            $mostrarTasaCambiaria = ($request->get('mostrarTasaCambiaria') == 'on' ? '1' : '0');
            $mostrarPrecioOM = ($request->get('mostrarPrecioOM') == 'on' ? '1' : '0');
            $appAdm = $request->get('appAdm');
            $mostrarAlcabalaOM = ($request->get('mostrarAlcabalaOM') == 'on' ? '1' : '0');
            $LiteralTasaCambiaria = $request->get('LiteralTasaCambiaria');
            $mostrarPedidoOM = ($request->get('mostrarPedidoOM') == 'on' ? '1' : '0');
            $mostrarColumnaCantidad = ($request->get('mostrarColumnaCantidad') == 'on' ? '1' : '0');
            $imagenPdfRutaAbsoluta = $request->get('imagenPdfRutaAbsoluta');
            $cantPrecioUtilizar = $request->get('cantPrecioUtilizar');
            $ordenPredCatalogo = $request->get('ordenPredCatalogo');
            $diMincp = $request->get('diMincp');
            $ppMincp = $request->get('ppMincp');
            $formatoPersFac = $request->get('formatoPersFac');
            $formatoPersPed = $request->get('formatoPersPed');
            $formatoPersPag = $request->get('formatoPersPag');
            $formatoPersRec = $request->get('formatoPersRec');
            $formatoPersCat = $request->get('formatoPersCat');
            $styles = $request->get('styles');
            $modoInfo = ($request->get('modoInfo') == 'on' ? '1' : '0');
            $msgInfo = $request->get('msgInfo');
            $modoMant = ($request->get('modoMant') == 'on' ? '1' : '0');
            $mostrarBarraNavCatInicio = ($request->get('mostrarBarraNavCatInicio') == 'on' ? '1' : '0');
            $msgMant = $request->get('msgMant');
            $SedeSucursal = $request->get('SedeSucursal');
            $formulaProdDobleLinea = $request->get('formulaProdDobleLinea');
            $mostrarModNotificacion = ($request->get('mostrarModNotificacion') == 'on' ? '1' : '0');
            $mostrarModCesta = ($request->get('mostrarModCesta') == 'on' ? '1' : '0');
            $mostrarModProveedor = ($request->get('mostrarModProveedor') == 'on' ? '1' : '0');
            $ActivarMincp = ($request->get('ActivarMincp') == 'on' ? '1' : '0');
            $KeyMincp = $request->get('KeyMincp');
            $aplicarDaPrecio = $request->get('aplicarDaPrecio');            
            $rutaLogoRpt = $request->get('rutaLogoRpt');

            //CARRUSEL1
            if($request->hasfile('carrusel1')){
                $file = $request->file('carrusel1');
                $carrusel1 = $file->getClientOriginalName();
                $file->move(public_path().'/public/storage/', $carrusel1);
            } else {
                $carrusel1 = $request->get('ncarrusel1');
            }
            //CARRUSEL2
            if($request->hasfile('carrusel2')){
                $file = $request->file('carrusel2');
                $carrusel2 = $file->getClientOriginalName();
                $file->move(public_path().'/public/storage/', $carrusel2);
            } else {
                $carrusel2 = $request->get('ncarrusel2');
            }
            //CARRUSEL3
            if($request->hasfile('carrusel3')){
                $file = $request->file('carrusel3');
                $carrusel3 = $file->getClientOriginalName();
                $file->move(public_path().'/public/storage/', $carrusel3);
            } else {
                $carrusel3 = $request->get('ncarrusel3');
            }
            //CARRUSEL4
            if($request->hasfile('carrusel4')){
                $file = $request->file('carrusel4');
                $carrusel4 = $file->getClientOriginalName();
                $file->move(public_path().'/public/storage/', $carrusel4);
            } else {
                $carrusel4 = $request->get('ncarrusel4');
            }
            //CARRUSEL5
            if($request->hasfile('carrusel5')){
                $file = $request->file('carrusel5');
                $carrusel5 = $file->getClientOriginalName();
                $file->move(public_path().'/public/storage/', $carrusel5);
            } else {
                $carrusel5 = $request->get('ncarrusel5');
            }
         
            DB::table('cfg')
            ->where('codisb','=',$sucactiva)
            ->update( array("nombre" => $nombre,
                "nomcorto" => $nomcorto,
                "rif" => $rif,
                "direccion" => $direccion,
                "localidad" => $localidad,
                "contacto" => $contacto,
                "telefono" => $telefono,
                "fax" => $fax,
                "correo" => $correo,
                "facebook" => $facebook,
                "twitter" => $twitter,
                "instagram" => $instagram,
                "correoPago" => $correoPago,
                "correoReclamo" => $correoReclamo,
                "correoResumen" => $correoResumen,
                "correoRemitente" => $correoRemitente,
                "carrusel1" => $carrusel1,
                "carrusel2" => $carrusel2,
                "carrusel3" => $carrusel3,
                "carrusel4" => $carrusel4,
                "carrusel5" => $carrusel5,
                "activarCorreoCatalogo" => $activarCorreoCatalogo,
                "valorIva" => $valorIva,
                "cntvisitas" => $cntvisitas,
                "mision" => $mision,
                "vision" => $vision,
                "valores" => $valores,
                "antecedentes" => $antecedentes,
                "nuestraempresa" => $nuestraempresa,
                "mostrarImagen" => $mostrarImagen,
                "mostrarMarca" => $mostrarMarca,
                "mostrarBarra" => $mostrarBarra,
                "mostrarBulto" => $mostrarBulto,
                "mostrarModBlog" => $mostrarModBlog,
                "mostrarModDescarga" => $mostrarModDescarga,
                "mostrarComponente" => $mostrarComponente,
                "diasMaximoReclamo" => $diasMaximoReclamo,
                "diasMaximoEntradas" => $diasMaximoEntradas,
                "mostrarDa" => $mostrarDa,
                "mostrarDi" => $mostrarDi,
                "mostrarDc" => $mostrarDc,
                "mostrarPp" => $mostrarPp,
                "mostrarDp" => $mostrarDp,
                "mostrarDv" => $mostrarDv,
                "mostrarCodigo" => $mostrarCodigo,
                "mostrarLote" => $mostrarLote,
                "mostrarLoteCliente" => $mostrarLoteCliente,
                "modoVisual" => $modoVisual,
                "ordenPedSides" => $ordenPedSides,
                "sincronizar" => $sincronizar,
                "procAlcabala" => $procAlcabala,
                "modoAlcabala" => $modoAlcabala,
                "activarEntradasProducto" => $activarEntradasProducto,
                "activarOfertasProducto" => $activarOfertasProducto,
                "activarDestacadoProducto" => $activarDestacadoProducto,
                "activarMarcaProducto" => $activarMarcaProducto,
                "mostrarImagenPedido" => $mostrarImagenPedido,
                "activarBotonPsico" => $activarBotonPsico,
                "activarBotonDias" => $activarBotonDias,
                "mostrarNetoCatalogo" => $mostrarNetoCatalogo,
                "activarBotonPsicoCliente" => $activarBotonPsicoCliente,
                "activarBotonFallaAlerta" => $activarBotonFallaAlerta,
                "simboloMoneda" => $simboloMoneda,
                "simboloOM" => $simboloOM,
                "numRengPedido" => $numRengPedido,
                "unirRengRepetido" => $unirRengRepetido,
                "activarCateProducto" => $activarCateProducto,
                "mostrarModnofiscal" => $mostrarModnofiscal,
                "mostrarPactaDesc" => $mostrarPactaDesc,
                "mostrarMarcaDesc" => $mostrarMarcaDesc,
                "nomdominio" => $nomdominio,
                "nomsoporte" => $nomsoporte,
                "telsoporte" => $telsoporte,
                "correosoporte" => $correosoporte,
                "linkWhatsappTel" => $linkWhatsappTel,
                "nomsubdominio" => $nomsubdominio,
                "codvendInternet" => $codvendInternet,
                "mostrarTasaCambiaria" => $mostrarTasaCambiaria,
                "mostrarPrecioOM" => $mostrarPrecioOM,
                "appAdm" => $appAdm,
                "mostrarAlcabalaOM" => $mostrarAlcabalaOM,
                "LiteralTasaCambiaria" => $LiteralTasaCambiaria,
                "mostrarPedidoOM" => $mostrarPedidoOM,
                "cantPrecioUtilizar" => $cantPrecioUtilizar,
                "mostrarColumnaCantidad" => $mostrarColumnaCantidad,
                "imagenPdfRutaAbsoluta" => $imagenPdfRutaAbsoluta,
                "styles" => $styles,
                "formatoPersFac" => $formatoPersFac,
                "formatoPersPed" => $formatoPersPed,
                "formatoPersPag" => $formatoPersPag,
                "formatoPersRec" => $formatoPersRec,
                "formatoPersCat" => $formatoPersCat,
                "ordenPredCatalogo" => $ordenPredCatalogo,
                "modoInfo" => $modoInfo,
                "msgInfo" => $msgInfo,
                "modoMant" => $modoMant,
                "msgMant" => $msgMant,
                "SedeSucursal" => $SedeSucursal,
                "titulopagina" => $titulopagina,
                "mostrarModNotificacion" => $mostrarModNotificacion,
                "mostrarModCesta" => $mostrarModCesta,
                "mostrarModProveedor" => $mostrarModProveedor,
                "formulaProdDobleLinea" => $formulaProdDobleLinea,
                "mostrarBarraNavCatInicio" => $mostrarBarraNavCatInicio,
                "ActivarMincp" => $ActivarMincp,
                "KeyMincp" => $KeyMincp,
                "diMincp" => $diMincp,
                "ppMincp" => $ppMincp,
                "aplicarDaPrecio" => $aplicarDaPrecio,
                "rutaLogoRpt" => $rutaLogoRpt
            ));
            session()->flash('message', 'Configuración guardada satisfactoriamente');

        } catch (Exception $e) {
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/config');
    }

    public function reclamo() {
        $subtitulo = "CONFIGURACION";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $recmotivo = DB::table('recmotivo')
        ->orderBy("id","asc")
        ->get(); 
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view("seped.config.reclamo",["menu" => "Configuracion",
                                            "cfg" => $cfg,
                                            "recmotivo" => $recmotivo,
                                            "subtitulo" => $subtitulo]);
    }

    public function literales() {
        $subtitulo = "CONFIGURACION";
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        return view("seped.config.literales",["menu" => "Configuracion",
                                              "cfg" => $cfg,
                                              "subtitulo" => $subtitulo]);
    }

    public function grabarlit(Request $request) {
        try {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            DB::table('cfg')  
            ->where('codisb','=',$sucactiva)
            ->update( array("LitDa" => $request->get('LitDa'),
                "LitDp" => $request->get('LitDp'),
                "LitDv" => $request->get('LitDv'),
                "LitDi" => $request->get('LitDi'),
                "LitDc" => $request->get('LitDc'),
                "LitPp" => $request->get('LitPp'),
                "LitVip" => $request->get('LitVip'),
                "LitPrecio" => $request->get('LitPrecio'),
                "msgLitDa" => $request->get('msgLitDa'),
                "msgLitDp" => $request->get('msgLitDp'),
                "msgLitDv" => $request->get('msgLitDv'),
                "msgLitDi" => $request->get('msgLitDi'),
                "msgLitDc" => $request->get('msgLitDc'),
                "msgLitPp" => $request->get('msgLitPp'),
                "msgLitVip" => $request->get('msgLitVip'),
                "msgLitPrecio" => $request->get('msgLitPrecio')
            ));
            session()->flash('message', 'Configuración de literales guardada satisfactoriamente');
        } catch (Exception $e) {
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/config');
    }

    public function cuenta() {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
        $subtitulo = "CONFIGURACION";
        $ctabanco = DB::table('ctabanco')
        ->where('codisb','=',$sucactiva)
        ->orderBy("co_cta","asc")
        ->get(); 
        return view("seped.config.cuenta",["menu" => "Configuracion",
                                           "sucactiva" => $sucactiva,
                                           "cfg" => $cfg,
                                           "ctabanco" => $ctabanco,
                                           "subtitulo" => $subtitulo]);
    }
    
    public function correo(Request $request) {
        try {
            $asunto = $request->get('asunto');
            $remite = $request->get('remite');
            $contenido = $request->get('contenido');
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            $cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
            $destino = $cfg->correosoporte;
            if (bEnviaCorreo($asunto, $remite, $destino, $contenido)) 
                session()->flash('message', 'Correo enviado satisfactoriamente');
            else
                session()->flash('error', 'Correo no enviado');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/home');
    }

    public function modmotivo(Request $request) {
        $id = $request->get('id');
        $recmotivo = DB::table('recmotivo')
        ->where('id', '=', $id)
        ->first();
        if ($recmotivo) {
            $activo = $recmotivo->activo;
            if ($activo == '1')
                $activo = '0';
            else 
                $activo = '1';
            DB::table('recmotivo')
            ->where('id', '=', $id)
            ->update(array("activo" => $activo ));
        }
        return response()->json(['msg' => '' ]);
    }

    public function modcuenta(Request $request) {
        $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
        $id = $request->get('id');
        $ctabanco = DB::table('ctabanco')
        ->where('codisb','=',$sucactiva)
        ->where('co_cta', '=', $id)
        ->first();
        if ($ctabanco) {
            $activo = $ctabanco->activo;
            if ($activo == '1')
                $activo = '0';
            else 
                $activo = '1';
            DB::table('ctabanco')
            ->where('co_cta', '=', $id)
            ->update(array("activo" => $activo ));
        }
        return response()->json(['msg' => '' ]);
    }
    
}
