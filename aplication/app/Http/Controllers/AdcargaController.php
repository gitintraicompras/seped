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

class AdcargaController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request) {
            $subtitulo = "CARGA DE ARCHIVOS";
    		$filtro = trim($request->get('filtro'));
    		$tabla = DB::table('carga')
            ->Orwhere('descrip','LIKE','%'.$filtro.'%')
            ->Orwhere('ruta','LIKE','%'.$filtro.'%')
            ->orderBy('id','asc')
            ->paginate(100);
    		return view('seped.carga.index' ,["menu" => "Cargas",
                                              "tabla" => $tabla, 
    									      "filtro" => $filtro,
                                              "cfg" => DB::table('cfg')->first(),
    									      "subtitulo" => $subtitulo]);
    	}
    }

	public function destroy($id) {
        try {
            DB::beginTransaction();
    		$regs = DB::table('carga')
    		->where('id','=',$id)
    		->delete();
            DB::commit();
            session()->flash('message','Archivo '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
		return Redirect::to('/seped/carga');
	}

	public function create() {
        $subtitulo = "AGREGAR ARCHIVO";
        return view("seped.carga.create",["menu" => "Cargas",
                                          "cfg" => DB::table('cfg')->first(),
                                          "subtitulo" => $subtitulo]);
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            if ($request->hasfile('ruta')) {
                $file = $request->file('ruta');
                $nomarchivo = $file->getClientOriginalName();
                $file->move(public_path().'/public/storage/', $nomarchivo);

                $id = DB::table('carga')->insertGetId([
                    'descrip' => $request->get('descrip'),
                    'ruta' => $nomarchivo
                ]);
                DB::commit();
                session()->flash('message','Archivo '.$id.' agregado satisfactoriamente');
            } else {
                session()->flash('error', 'Debe agregar un archivo');    
            }
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/carga');
    }
    
}
