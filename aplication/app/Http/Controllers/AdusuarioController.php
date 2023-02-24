<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Session;
use DB;
  
class AdusuarioController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
 
    public function index(Request $request) {
    	if ($request) {
    		$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
    		$subtitulo = "USUARIOS";
    		$filtro = trim($request->get('filtro'));
    		$regs = DB::table('users')
    		->where(function ($q) use ($filtro) {
			  $q->where('name','LIKE','%'.$filtro.'%')
			  ->orwhere('codcli','LIKE','%'.$filtro.'%')
    		  ->orwhere('email','LIKE','%'.$filtro.'%');
			})
    		->orderBy('id','desc')
            ->get();
       		return view('seped.usuario.index' ,["menu" => "Usuarios",
       											"usuario" => $regs,
       											"subtitulo" => $subtitulo,
       											"cfg" => DB::table('cfg')->first(),
    											"filtro" => $filtro]);
    	}
    }

	public function create(Request $request) {
		$ctipo = trim($request->get('ctipo'));
		$subtitulo = "USUARIO NUEVO";
		$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
		$cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
		$cliente = DB::table('cliente')->where('codisb','=',$sucactiva)->get();
		$vendedor = DB::table('vendedor')->where('codisb','=',$sucactiva)->get();
		$grupo = DB::table('grupo')->where('codisb','=',$sucactiva)->get();
		$marca = DB::table('marca')->get();
		$choferes = DB::table('choferes')
		->where('codisb','=',$sucactiva)
		->where('chof_tipo','=','C')
		->get();
		return view("seped.usuario.create",["menu" => "Usuarios",
											"cliente" => $cliente,
										    "vendedor" => $vendedor, 
										    "grupo" => $grupo, 
										    "marca" => $marca, 
										    "choferes" => $choferes,
											"ctipo" => $ctipo,
											"cfg" => DB::table('cfg')->first(),
											"subtitulo" => $subtitulo]);
	}

	public function store(UsuarioFormRequest $request) {
		try {
			$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
		    $codcli = $request->get('codcli');
		    $usuario = $request->get('email');
		    $clave = $request->get('password');
			$reg = new User;
			$reg->name = $request->get('name');
			$reg->codcli = $codcli;
			$reg->email =$usuario; 
			$reg->tipo = $request->get('tipo');
			$reg->vendsuper = ($request->get('vendsuper') == 'on' ? '1' : '0');
			$reg->cambiarNegociacion = ($request->get('cambiarNegociacion') == 'on' ? '1' : '0');
			$reg->password = bcrypt($clave);
			$reg->clave = $clave;
			$reg->codisbpredet = $sucactiva;
			$reg->save();
			if ($request->get('tipo') == 'C') {
				DB::table('cliente')
		        ->where('codcli','=',$codcli)
		        ->where('codisb','=',$sucactiva)
		        ->update(array("codisbactivo" => '1'));
			}
			$fechaHoy = date('j-m-Y');
	        $FechaVenta = substr($fechaHoy, 0, 10);
	        $cfg = DB::table('cfg')
	        ->where('codisb','=',$sucactiva)
	        ->first();
	        $correoRemitente = $cfg->correoRemitente;
	        if (empty($correoRemitente)) {
	        	$cliente = DB::table('cliente')
	            ->where('codcli','=',$codcli)
	            ->where('codisb','=',$sucactiva)
	            ->first();
	            if ($cliente) {
					$nombre = $cliente->nombre;
	            	// FORMULARIO DEL CORREO
	                $subject = "REGISTRO DE USUARIO (".$FechaVenta.") - ".$cfg->nombre;
	                $headers = "MIME-Version: 1.0\r\n";
	                $headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
	                $headers .= "Content-Transfer-Encoding: 8bit\r\n";
	                $headers .= "X-Priority: 1\r\n";
	                $headers .= "X-MSMail-Priority: High\r\n";
	                $headers .= "From: <".$correoRemitente.">\r\n";
	                $headers .= "Reply-To: <".$correoRemitente.">\r\n";
	                $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
	                $headers .= "X-originating-IP: \r\n";
	                // ENCABEZADO
	                $message = "
	                <!DOCTYPE html>
	                <html>
	                <head>
	                <title>HTML</title>
	                </head>
	                <body> <br>";
    
	                $message .= "<img src='http://".$cfg->nomsubdominio."/images/logoRpt.png'><br>";
			     
    				$message .= "
    				<br><br>
					<center><h3>Estimado(a)</h3>
	                <h2>$nombre</h2></center>
	                <div>";

					$message .= "<div><h4>

					Le informamos que se ha registrado el siguiente usuario para tener acceso a nuestro portal web.
					<br>
					</h4></div>";

					$message .= "<div><h3>USUARIO: $usuario</h3></div>";
					$message .= "<div><h3>CLAVE  : $clave</h3></div>";

	                $message .= "
	                <strong>Ingresar para realizar su pedido: 
			            <a href='http://".$cfg->nomsubdominio."/'>http://"
			            .$cfg->nomsubdominio."
			            </a>
			        </strong>";

			        $message .= "</div>";

	                // PIE DEL FORMULARIO
	                $message .= "<h4>
	                	<br><br>
	                    <center>
	                        ".$cfg->nombre." | RIF: ".$cfg->rif." 
	                    </center>
	                </h4>";

	                $message .= "<h5>
	                    <center>
	                        ".$cfg->direccion."
	                    </center>
	                </h5>";

	                $message .= "<h5>
	                    <center>
	                        TELEFONO: ".$cfg->telefono." CONTACTO: ".$cfg->contacto."
	                    </center>
	                </h5>";

	                $message .= "<h5>
	                    <center>
	                 	<a href='http://".$cfg->nomdominio."/'>http://"
			            .$cfg->nomdominio."
			            </a>
	                    </center>
	                </h5>";

	                $message .= "</div>
	                </body>
	                </html>";

	                try {
		                if (mail($usuario, $subject, $message, $headers)) {
		                	log::info("USR NUEVO mail enviado: ".$usuario);
		                	session()->flash('message', 'Usuario '.$usuario.' agregado satisfactoriamente');
		                } else  {
		                	log::info("USR NUEVO mail no enviado: ".$usuario);
		                	session()->flash('message', 'Usuario '.$usuario.' agregado satisfactoriamente, Imposible enviar correo');
		                }
	            	} catch (Exception $e) {
	            		session()->flash('message', 'Usuario '.$usuario.' agregado satisfactoriamente, Imposible enviar correo');
	            	}
	            }
	        }
		} catch (Exception $e) {
		    session()->flash('error', $e);
		}
		return Redirect::to('/seped/usuario');
	}

	public function show($id) {
    	$subtitulo = "CONSULTAR USUARIO";
    	$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
  		$usr=DB::table('users')
		->where('id','=',$id)
		->first();
		$cliven=null;
		$tipo=$usr->tipo;
		if($tipo=='C') {
			$cliven=DB::table('cliente')
			->where('codcli','=',$usr->codcli)
	    	->first();
		}
		if($tipo=='V') {
			$cliven=DB::table('vendedor')
			->where('codigo','=',$usr->codcli)
	    	->first();
		}
		$codcli = $usr->codcli;
		$sucursal = DB::table('cliente')
		->where('codcli','=',$codcli)
		->get();
		return view("seped.usuario.show",["menu" => "Usuarios",
										  "usuario"=>$usr,
										  "cliven"=>$cliven,
										  "cfg" => DB::table('cfg')->first(),
										  "sucactiva" => $sucactiva,
										  "sucursal" => $sucursal,
    									  "subtitulo"=>$subtitulo]);
    }

	public function edit($id) {
		$subtitulo = "MODIFICAR USUARIO";
		$sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
		$cfg = DB::table('cfg')->where('codisb','=',$sucactiva)->first();
		$regCliente = DB::table('cliente')->get();
		$regUser = User::findOrFail($id);
		$codcli = $regUser->codcli;
		$sucursal = DB::table('cliente')
		->where('codcli','=',$codcli)
		->get();
		return view("seped.usuario.edit",["menu" => "Usuarios",
										  "usuario"=>User::findOrFail($id), 
						    			  "cliente"=>$regCliente, 
										  "codcli"=>$codcli,
										  "cfg" => $cfg,
										  "sucactiva" => $sucactiva,
										  "sucursal" => $sucursal,
										  "subtitulo"=>$subtitulo]);
	}

	public function resetear(Request $request) {
		$id = $request->get('codusu');
		$password = $request->get('password');
     	$regs = User::findOrFail($id);
		$regs->password = bcrypt($password);
		$regs->clave = $password;
		$regs->update();
        return response()->json(['msg' => 'OK']);
    }

	public function update(Request $request, $id) {
		$codcli = trim($request->get('codcli'));
		$tipo = $request->get('tipo');
		$codisbpredet = "";
		$codisbprimer = "";
		$array = $request->get('predeter');
		if ($array != null) {
			foreach( $array as $key => $val ) {
	        	$codisbpredet = trim($key);
		    }
		}
	    if ($tipo == 'C') {
	    	$mathcodisb = 0;
	 	    $array_codisbactivo = $request->get('codisbactivo');
		    DB::table('cliente')
        	->where('codcli','=', $codcli)
            ->update(array('codisbactivo' => '0'));
            if (isset($array_codisbactivo)) {
	            if (count($array_codisbactivo) > 0) {
				    foreach( $array_codisbactivo as $key => $val ) {
			        	$codisbactivo = trim($key);
			        	//dd($codcli .' - '. $codisbactivo);
			        	DB::table('cliente')
			        	->where('codcli','=', $codcli)
		                ->where('codisb','=', $codisbactivo)
		                ->update(array('codisbactivo' => '1'));
		                if ($codisbpredet == $codisbactivo) {
		                	$mathcodisb = 1;
		                	continue;
		                }
		                if ($codisbpredet == "") {
		                	$codisbpredet = $codisbactivo;
		                	$mathcodisb = 1;
		                	continue;
		                }
		                $codisbprimer = $codisbactivo;
		  		    }
				    if ($mathcodisb == 0) {
				    	$codisbpredet = $codisbprimer;
				    }
				}
			}
		}
		$reg = User::findOrFail($id);
		$reg->name = $request->get('name');
		$reg->email = $request->get('email');
		$reg->estado = $request->get('estado');
		$reg->vendsuper = ($request->get('vendsuper') == 'on' ? '1' : '0');
		$reg->cambiarNegociacion = ($request->get('cambiarNegociacion') == 'on' ? '1' : '0');
		$reg->codisbpredet = $codisbpredet;
		$reg->update();
		return Redirect::to('/seped/usuario');
	}

	public function destroy($id) {
		try {
    		$regs = DB::table('users')
			->where('id','=',$id)
			->delete();
	        session()->flash('message', 'Usuario '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            session()->flash('error', $e);
        }
		return Redirect::to('/seped/usuario');
	}

   	public function leercorreoclie(Request $request) {
        $codigo = $request->get('codigo');
        $reg = DB::table('cliente')
        ->where('codcli','=',$codigo)
        ->first();
        return response()->json(['email' => $reg->email,
        						 'nombre' => $reg->nombre,
        						 'rif' => $reg->rif ]);
    }

    public function leercorreoprov(Request $request) {
        $codigo = $request->get('codigo');
        $reg = DB::table('proveedor')
        ->where('codprov','=',$codigo)
        ->first();
        return response()->json(['email' => $reg->email,
        						 'nombre' => $reg->nombre,
        						 'rif' => $reg->rif ]);
    }
    
} 
