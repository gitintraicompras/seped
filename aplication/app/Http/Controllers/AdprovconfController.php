<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;
     
class AdprovconfController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

 	public function index() {
    	$subtitulo = "CONFIGURACION";
        $codmarca = Auth::user()->codcli;
        $marca = DB::table('marca')
        ->where('codmarca','=',$codmarca)
        ->first();
        if (empty($marca)) 
            return back()->with('error', 'Código proveedor no encontrado!');                
       return view("seped.provconf.index",["menu" => "Configuracion",
                                           "cfg" => DB::table('cfg')->first(),
                                           "marca" => $marca,
                                      	   "subtitulo" => $subtitulo]);
    }
 
}
