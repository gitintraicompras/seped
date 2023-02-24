<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use DB;
 
class AdtransplitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if ($request)
        {
            $subtitulo = "CONFIGURACION";
            $filtro = trim($request->get('filtro'));
            $transplit = DB::table('transplit')
            ->where('literal','LIKE','%'.$filtro.'%')
            ->orderBy('id','desc')
            ->get();
            return view('seped.transplit.index' ,["menu" => "Grupos",
                                                  "transplit" => $transplit,
                                                  "subtitulo" => $subtitulo,
                                                  "cfg" => DB::table('cfg')->first(),
                                                  "filtro" => $filtro]);
        }
    }

    public function create(Request $request) {
        $subtitulo = "LITERAL NUEVO";
        return view("seped.transplit.create",["menu" => "Grupos",
                                              "cfg" => DB::table('cfg')->first(),
                                              "subtitulo" => $subtitulo]);
    }

    public function store(Request $request) {
        try {
            DB::table('transplit')->insert([
                'literal' => $request->get('literal')
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
        return Redirect::to('/seped/transplit');
    }
 
    public function destroy($id) {
        try {
            DB::table('transplit')
            ->where('id','=',$id)
            ->delete();
            session()->flash('message', 'Literal '.$id.' eliminado satisfactoriamente');
        } catch (Exception $e) {
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/transplit');
    }
}
