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
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;

class AdbusquedasController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {

        $reg = DB::table('busquedas')
        ->selectRaw('count(*) as contador')
        ->first();
        $cont =  number_format($reg->contador, 0, '.', ',');

    	$subtitulo = "REGISTRO DE BUSQUEDAS (".$cont.")";
        $filtro = trim($request->get('filtro'));
        $tabla = DB::table('busquedas')
        ->Orwhere('texto','LIKE','%'.$filtro.'%')
        ->orderBy('contador','desc')
        ->paginate(100);
        return view('seped.busquedas.index' ,["menu" => "Reportes",
                                              "tabla" => $tabla, 
                                              "filtro" => $filtro,
                                              "cfg" => DB::table('cfg')->first(),
                                              "subtitulo" => $subtitulo]);
    }

	public function destroy($id) {
        try {
            DB::beginTransaction();
    		$regs = DB::table('busquedas')
    		->where('id','=',$id)
    		->delete();
            DB::commit();
            session()->flash('message', 'Busqueda '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
		return Redirect::to('/seped/busquedas');
	}

}
