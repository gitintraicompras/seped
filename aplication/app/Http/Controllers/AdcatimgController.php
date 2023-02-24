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

class AdcatimgController extends Controller
{
  public function __construct()
  {
  	$this->middleware('auth');
  }

  public function index(Request $request) {
  	if ($request) {
     	$subtitulo = "IMAGENES DE CATEGORIAS";
      $tab = $request->get('tab');
      if ($tab == null)
        $tab='0';

      $filtro  = "";
      $s1 = explode('_', $tab );
      $tab = $s1[0];
      if ( count($s1) > 1) 
        $filtro = $s1[1];
 
      if ($tab == "0") {
        $cat = null;
    		$catimg = DB::table('catimg')
        ->Orwhere('codcat','LIKE','%'.$filtro.'%')
        ->Orwhere('nomcat','LIKE','%'.$filtro.'%')
        ->Orwhere('nomimagen','LIKE','%'.$filtro.'%')
    		->orderBy('nomcat','desc')
        ->get();
      } else {
        $catimg = null;
        $cat = DB::table('categoria')
        ->where('nomcat','LIKE','%'.$filtro.'%')
        ->whereNotExists(function($query) {
            $query->select(DB::raw(1))
                ->from('catimg')
                ->whereRaw("catimg.codcat = categoria.codcat");
        })
        ->orderBy('nomcat','desc')
        ->get();
      }
  		return view('seped.catimg.index' ,["menu" => "Imagenes",
                                         "catimg" => $catimg, 
                                         "cat" => $cat, 
                                         "tab" => $tab,
  			    						                 "filtro" => $filtro,
                                         "cfg" => DB::table('cfg')->first(),
  					    				                 "subtitulo" => $subtitulo]);
  	}
  }

  public function cat(Request $request, $id) {
    $filtro = trim($request->get('filtro'));
    $tab = $id.'_'.$filtro;
    return Redirect::to('/seped/catimg?tab='.$tab);  
  }

	public function destroy($id) {
    try {
        $catimg = DB::table('catimg')
        ->where('codcat','=',$id)
        ->first();
        if ($catimg) {
          DB::table('catimg')
          ->where('codcat','=',$id)
          ->delete();
          $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
          $filename = $BASE_PATH.'/public/storage/'.$catimg->nomimagen;
          if (file_exists($filename)) {
            @unlink($filename);
            log::info('DELIMG -> IMAGEN CATEGORIA ELMINADA: '.$filename);
          }
          session()->flash('message', 'Categoria '.$id.' eliminado satisfactoriamente');
        }
    } catch (Exception $e) {
        session()->flash('error', $e);
    }
    return Redirect::to('/seped/catimg');
	}

	public function create() {
    $subtitulo = "AGREGAR CATEGORIA";
    //$categoria = DB::table('categoria')->get();
    $categoria = DB::table('categoria')
    ->whereNotExists(function ($query) {
        $query->select(DB::raw(1))
            ->from('catimg')
            ->whereRaw('categoria.codcat = catimg.codcat');
    })
    ->get();
    return view('seped.catimg.create' ,["menu" => "Imagenes",
                                        "categoria" => $categoria,
                                        "cfg" => DB::table('cfg')->first(),
                                        "subtitulo" => $subtitulo]);
  }

	public function store(Request $request)	{
    $codcat = $request->get('codcat');
    $reg = DB::table('catimg')
    ->where('codcat','=',$codcat)
    ->first();
    if ($reg) {
        session()->flash('error', "Categoria ya existe en la lista");
    }
    else {
      if($request->hasfile('linkarchivo')) {
          $cat = DB::table('categoria')
          ->where('codcat','=',$codcat)
          ->first();
          $file = $request->file('linkarchivo');
          $nomimagen = $file->getClientOriginalName();

          $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
          $filename = $BASE_PATH.'/public/storage/categoria/'.$nomimagen;
          if (file_exists($filename)) {
            @unlink($filename);
            log::info('DELIMG -> IMAGEN CATEGORIA ELMINADA: '.$filename);
          }

          $file->move(public_path().'/public/storage/categoria', $nomimagen);
          DB::table('catimg')->insert([
              'codcat' => $codcat, 
              'nomimagen' => '/categoria/'.$nomimagen, 
              'nomcat' => $cat->nomcat
          ]);
          session()->flash('message','Categoria '.$codcat.' agregado satisfactoriamente');
      } else {
        session()->flash('error', "Categoria sin Imagen");   
      }
    }
  	return Redirect::to('/seped/catimg');
	}
 
}






