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

class AdprodimgController extends Controller
{
  public function __construct()
  {
  	$this->middleware('auth');
  }

  public function index(Request $request) {
  	if ($request) {
      $subtitulo = "IMAGENES DE PRODUCTOS";
      $tab = $request->get('tab');
      if ($tab == null)
        $tab='0';
      $filtro  = "";
      $s1 = explode('_', $tab );
      $tab = $s1[0];
      if ( count($s1) > 1) 
        $filtro = $s1[1];
 
      if ($tab == "1") {
        $prodimg = null;
        $prod = DB::table('producto')
        ->where(function ($q) use ($filtro) {
            $q->where('desprod','LIKE','%'.$filtro.'%')
            ->Orwhere('codprod','LIKE','%'.$filtro.'%')
            ->Orwhere('barra','LIKE','%'.$filtro.'%');
        })
        ->whereNotExists(function($query) {
            $query->select(DB::raw(1))
                ->from('prodimg')
                ->whereRaw("prodimg.codprod = producto.codprod");
        })
        ->orderBy('desprod','asc')
        ->get();  
      } else {
        $prod = null;
        $prodimg = DB::table('prodimg')
        ->Orwhere('desprod','LIKE','%'.$filtro.'%')
        ->Orwhere('codprod','LIKE','%'.$filtro.'%')
        ->Orwhere('nomimagen','LIKE','%'.$filtro.'%')
        ->orderBy('desprod','desc')
        ->get();
      }
      return view('seped.prodimg.index' ,["menu" => "Imagenes",
                                          "prodimg" => $prodimg, 
                                          "prod" => $prod, 
  									                      "tab" => $tab,
                                          "filtro" => $filtro,
                                          "cfg" => DB::table('cfg')->first(),
  									                      "subtitulo" => $subtitulo]);
  	}
  }

  public function prod(Request $request, $id) {
    $filtro = trim($request->get('filtro'));
    $tab = $id.'_'.$filtro;
    return Redirect::to('/seped/prodimg?tab='.$tab);  
  }

	public function show($id) {
    $subtitulo = "VER IMAGEN";
    $prodimg= DB::table('prodimg')
    ->where('codprod','=',$id)
    ->first();
    return view('seped.prodimg.show',["menu" => "Imagenes",
                                      "prodimg" => $prodimg, 
                                      "cfg" => DB::table('cfg')->first(),
                                      "subtitulo" => $subtitulo ]);
  }
 
	public function destroy($id) {
    try {
      $prodimg = DB::table('prodimg')
      ->where('codprod','=',$id)
      ->first();
      if ($prodimg) {
        DB::table('prodimg')
        ->where('codprod','=',$id)
        ->delete();
        $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
        $filename = $BASE_PATH.'/public/storage/'.$prodimg->nomimagen;
        if (file_exists($filename)) {
          @unlink($filename);
          log::info('DELIMG -> IMAGEN PRODUCTO ELMINADA: '.$filename);
        }
        session()->flash('message', 'Producto imagen '.$id.' eliminado satisfactoriamente');
      }
    } catch (Exception $e) {
        session()->flash('error', $e);
    }
    return Redirect::to('/seped/prodimg');
	}

	public function create() {
    $subtitulo = "AGREGAR IMAGEN";
    //$producto = DB::table('producto')->get();
    $producto = DB::table('producto')
    ->whereNotExists(function ($query) {
        $query->select(DB::raw(1))
            ->from('prodimg')
            ->whereRaw('producto.codprod = prodimg.codprod');
    })
    ->get();
    return view('seped.prodimg.create' ,["menu" => "Imagenes",
                                         "producto" => $producto,
                                         "cfg" => DB::table('cfg')->first(),
                                         "subtitulo" => $subtitulo]);
  }

	public function store(Request $request)	{
    $cfg = DB::table('cfg')->first();
    $codprod = $request->get('codprod');
    $reg = DB::table('prodimg')
    ->where('codprod','=',$codprod)
    ->first();
    if ($reg) {
        session()->flash('error', "Producto ya existe en la lista");
    }
    else {
      $prod = DB::table('producto')
      ->where('codprod','=',$codprod)
      ->first();
      if($request->hasfile('linkarchivo')) {
          $file = $request->file('linkarchivo');
          $nomimagen = $file->getClientOriginalName();

          $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
          $filename = $BASE_PATH.'/public/storage/prod/'.$nomimagen;
          if (file_exists($filename)) {
            @unlink($filename);
            log::info('DELIMG -> IMAGEN PRODUCTO ELMINADA: '.$filename);
          }

          $file->move(public_path().'/public/storage/prod/', $nomimagen);
          DB::table('prodimg')->insert([
              'codprod' => $codprod, 
              'nomimagen' => '/prod/'.$nomimagen, 
              'desprod' => $prod->desprod,
              "codisb" => $cfg->codisb
          ]);
          session()->flash('message','Producto '.$codprod.' agregado satisfactoriamente');
      } else {
        session()->flash('error', "Producto sin Imagen");   
      }
    }
  	return Redirect::to('/seped/prodimg');
	}
 
}




