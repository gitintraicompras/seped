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
use Illuminate\Support\Facades\Log;
use DB;
 
class AdmarcaimgController extends Controller
{
  public function __construct()
  {
  	$this->middleware('auth');
  }

  public function index(Request $request) {
  	if ($request) {
     	$subtitulo = "IMAGENES DE MARCAS";
      $tab = $request->get('tab');
      if ($tab == null)
        $tab='0';
      $filtro  = "";
      $s1 = explode('_', $tab );
      $tab = $s1[0];
      if ( count($s1) > 1) 
        $filtro = $s1[1];
 
      if ($tab == "0") {
        $marca = null;
  		  $marcaimg = DB::table('marcaimg')
        ->Orwhere('codmarca','LIKE','%'.$filtro.'%')
        ->Orwhere('desmarca','LIKE','%'.$filtro.'%')
        ->Orwhere('nomimagen','LIKE','%'.$filtro.'%')
    		->orderBy('desmarca','desc')
        ->get();
      } else {
        $marcaimg = null;
        $marca = DB::table('marca')
        ->where('codmarca','LIKE','%'.$filtro.'%')
        ->whereNotExists(function($query) {
            $query->select(DB::raw(1))
                ->from('marcaimg')
                ->whereRaw("marcaimg.codmarca = marca.codmarca");
        })
        ->orderBy('codmarca','asc')
        ->get();  
      }
  		return view('seped.marcaimg.index' ,["menu" => "Imagenes",
                                           "marcaimg" => $marcaimg, 
                                           "marca" => $marca, 
                                           "tab" => $tab,
  			    						                   "filtro" => $filtro,
                                           "cfg" => DB::table('cfg')->first(),
  					    				                   "subtitulo" => $subtitulo]);
    }
  }

  public function marca(Request $request, $id) {
    $filtro = trim($request->get('filtro'));
    $tab = $id.'_'.$filtro;
    return Redirect::to('/seped/marcaimg?tab='.$tab);  
  }

	public function destroy($id) {
    try {
      $marcaimg = DB::table('marcaimg')
      ->where('codmarca','=',$id)
      ->first();

      if ($marcaimg) {
        DB::table('marcaimg')
        ->where('codmarca','=',$id)
        ->delete();
        $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
        $filename = $BASE_PATH.'/public/storage/'.$marcaimg->nomimagen;
        if (file_exists($filename)) {
          @unlink($filename);
          log::info('DELIMG -> IMAGEN MARCA ELMINADA: '.$filename);
        }
        session()->flash('message', 'Marca '.$id.' eliminado satisfactoriamente');
      }
    } catch (Exception $e) {
        DB::rollBack();
        session()->flash('error', $e);
    }
    return Redirect::to('/seped/marcaimg');
	}

	public function create() {
    $subtitulo = "AGREGAR MARCA";
    vGeneraTablaMarcas(); // debo generarlas la tablas de marcas, a partir de la tabla productos
    // $marca = DB::table('marca')->get(); 
    $marca = DB::table('marca')
    ->whereNotExists(function ($query) {
        $query->select(DB::raw(1))
            ->from('marcaimg')
            ->whereRaw('marcaimg.codmarca = marca.codmarca');
    })
    ->get();
    return view('seped.marcaimg.create' ,["menu" => "Imagenes",
                                          "marca" => $marca,
                                          "cfg" => DB::table('cfg')->first(),
                                          "subtitulo" => $subtitulo]);
  }

	public function store(Request $request)	{
    $codmarca = $request->get('codmarca');
    $desmarca = $request->get('desmarca');
    if ($desmarca == "") {
      $desmarca = $codmarca;
    }
    $reg = DB::table('marcaimg')
    ->where('codmarca','=',$codmarca)
    ->first();
    if ($reg) {
        session()->flash('error', "Marca ya existe en la lista");
    }
    else {
      if($request->hasfile('linkarchivo')) {
          $file = $request->file('linkarchivo');
          $nomimagen = $file->getClientOriginalName();

          $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
          $filename = $BASE_PATH.'/public/storage/marca/'.$nomimagen;
          if (file_exists($filename)) {
            @unlink($filename);
            log::info('DELIMG -> IMAGEN MARCA ELMINADA: '.$filename);
          }

          $file->move(public_path().'/public/storage/marca', $nomimagen);
          DB::table('marcaimg')->insert([
              'codmarca' => $codmarca, 
              'nomimagen' => '/marca/'.$nomimagen, 
              'desmarca' => $desmarca
          ]);
          session()->flash('message','Marca '.$codmarca.' agregado satisfactoriamente');
      } else {
        session()->flash('error', "Marca sin Imagen");   
      }
    }
  	return Redirect::to('/seped/marcaimg');
	}
 
}








