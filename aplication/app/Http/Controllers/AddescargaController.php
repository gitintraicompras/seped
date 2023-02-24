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
use Illuminate\Support\Facades\Response;
use DB;

class AddescargaController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
        if ($request) {
            $subtitulo = "MODULO DE DESCARGAS";
            $filtro = trim($request->get('filtro'));
            $carga = DB::table('carga')
            ->Orwhere('descrip','LIKE','%'.$filtro.'%')
            ->Orwhere('ruta','LIKE','%'.$filtro.'%')
            ->orderBy('id','asc')
            ->get();
            return view('seped.descargas.index' ,["menu" => "Descargas",
                                                  "carga" => $carga, 
                                                  "filtro" => $filtro,
                                                  "cfg" => DB::table('cfg')->first(),
                                                  "subtitulo" => $subtitulo]);
        }
    }

    public function show($id) {
        try {
            $carga = DB::table('carga')
            ->where('id','=',$id)
            ->first();
            if ($carga) {
                $cont = $carga->contdescarga;
                $cont = $cont + 1;
                DB::table('carga')
                ->where('id', '=', $id)
                ->update(array('contdescarga' => $cont ));
                $archivo = $carga->ruta;
                $rutaarc = public_path().'/public/storage/'.$archivo;
                if (file_exists($rutaarc)) {
                    $headers = ['Content-type'=>'text/plain', 'test'=>'YoYo', 'Content-Disposition'=>sprintf('attachment; filename="%s"', $archivo),'X-BooYAH'=>'WorkyWorky'];
                    return response()->download($rutaarc);
                }
            }
        } catch (Exception $e) {
            session()->flash('error',$e);
        }
        return Redirect::to('/seped/descarga');
    }
}
