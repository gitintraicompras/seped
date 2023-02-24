<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use DB;

class AdblogsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request)
    	{
         	$subtitulo='BLOGS';
    		$filtro=trim($request->get('filtro'));
    		$blogs=DB::table('blogs')
    		->where('nombre','LIKE','%'.$filtro.'%')
    		->orderBy('id','desc')
            ->get();
       		return view('seped.blogs.index' ,["menu"=>"Blogs",
                                              "blogs"=>$blogs,
       										  "subtitulo"=>$subtitulo,
                                              "cfg" => DB::table('cfg')->first(),
    										  "filtro"=>$filtro]);
    	}
    }

	public function create(Request $request) {
		$subtitulo = "BLOG NUEVO";
 		return view("seped.blogs.create",["menu"=>"Blogs",
                                          "cfg" => DB::table('cfg')->first(),
                                          "subtitulo"=>$subtitulo]);
	}

	public function store(Request $request) {
        $nombre = $request->get('nombre');
        $fecha = $request->get('fecha');
        $breve = $request->get('breve');
        $descrip = $request->get('descrip');
        $imagen = $request->get('imagen');
        $publicado = $request->get('publicado');
        $status = $request->get('status');
        // IMAGEN
        $rutaimagen = public_path().'/public/storage/'.$imagen;
        if (file_exists($rutaimagen)) {
            @unlink($rutaimagen);
            log::info('DELIMG -> IMAGEN BLOG ELMINADA: '.$rutaimagen);
        }
        if($request->hasfile('imagen')){
            $file = $request->file('imagen');
            $imagen = $file->getClientOriginalName();
            $file->move(public_path().'/public/storage/', $imagen);
        } else {
            $imagen = $request->get('nimagen');
        }
        $id = DB::table('blogs')->insertGetId([
	        'nombre' => $nombre,
            'fecha' => $fecha,
            'breve' => $breve,
            'descrip' => $descrip,
            'imagen' => $imagen,
            'publicado' => $publicado,
            'status' => $status,
            "imagen" => $imagen
	    ]);
        return Redirect::to('/seped/blogs');
    }

	public function show($id) {
    	$subtitulo = "CONSULTAR BLOG";
      	$blog=DB::table('blogs')
		->where('id','=',$id)
		->first();
		return view("seped.blogs.show",["menu"=>"Blogs",
                                        "blog"=>$blog,
                                        "cfg" => DB::table('cfg')->first(),
									    "subtitulo"=>$subtitulo]);
    }

	public function edit($id) {
     	$subtitulo = "MODIFICAR BLOG";
		$blog=DB::table('blogs')
		->where('id','=',$id)
		->first();
		return view("seped.blogs.edit",["menu"=>"Blogs",
                                        "blog"=>$blog,
                                        "cfg" => DB::table('cfg')->first(),
										"subtitulo"=>$subtitulo]);
	}

	public function update(Request $request, $id) {
    	// IMAGEN
        if($request->hasfile('imagen')){
            $file = $request->file('imagen');
            $imagen = $file->getClientOriginalName();
            $file->move(public_path().'/storage/', $imagen);
        } else {
            $imagen = $request->get('nimagen');
        }
   		DB::table('blogs')
		->where('id','=',$id)
		->update(array('nombre' => $request->get('nombre'),
			'fecha' => $request->get('fecha'),
			'breve' => $request->get('breve'),
			'descrip' => $request->get('descrip'),
			'imagen' => $imagen,
			'publicado' => $request->get('publicado'),
			'status' => $request->get('status')
		));
		return Redirect::to('/seped/blogs');
	}

	public function destroy($id) {
        try {
            $blog = DB::table('blogs')
            ->where('id','=',$id)
            ->first();
            if ($blog) {
          		DB::table('blogs')
        		->where('id','=',$id)
        		->delete();
                $BASE_PATH = env('INTRANET_RUTA_PUBLIC', base_path());
                $filename = $BASE_PATH.'/public/storage/'.$blog->imagen;
                if (file_exists($filename)) {
                    @unlink($filename);
                    log::info('DELIMG -> IMAGEN CATEGORIA ELMINADA: '.$filename);
                }
                session()->flash('message', 'Blog '.$id.' eliminado satisfactoriamente');
            }
        } catch (Exception $e) {
            session()->flash('error', $e);
        }
		return Redirect::to('/seped/blogs');
	}
    
}
