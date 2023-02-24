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
use Session;

class AdpedcrisepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        if ($request)
        {
            $subtitulo = "CRITERIO SEPARACION";
            $filtro=trim($request->get('filtro'));
            $tabla=DB::table('pedcrisep')
            ->where('descrip','LIKE','%'.$filtro.'%')
            ->orderBy('id','desc')
            ->get();
            return view('seped.pedcrisep.index' ,["menu" => "Criterios",
                                                  "tabla" => $tabla,
                                                  "subtitulo" => $subtitulo,
                                                  "cfg" => DB::table('cfg')->first(),
                                                  "filtro" => $filtro]);
        }
    }

    public function create(Request $request) {
        $subtitulo = "CRITERIO NUEVO";
        return view("seped.pedcrisep.create",["menu" => "Criterios",
                                              "cfg" => DB::table('cfg')->first(),
                                              "subtitulo" => $subtitulo]);
    }

    public function store(Request $request) {
        try {
            $sucactiva = Session::get('sucactiva', sRetornaCodSucursal());
            DB::table('pedcrisep')->insert([
                'descrip' => $request->get('descrip'),
                'criterio' => $request->get('criterio'),
                'diasCredito' => $request->get('diasCredito'),
                'estado' => $request->get('estado'),
                'codisb' => $sucactiva
            ]);
        } catch (\Exception $e) {
            dd($e);
        }
        return Redirect::to('/seped/pedcrisep');
    }

    public function show($id) {
        $subtitulo = "CONSULTAR CRITERIO";
        $tabla = DB::table('pedcrisep')
        ->where('id','=',$id)
        ->first();
        return view("seped.pedcrisep.show",["menu" => "Criterios",
                                            "tabla" => $tabla,
                                            "cfg" => DB::table('cfg')->first(),
                                             "subtitulo" => $subtitulo]);
    }

    public function edit($id) {
        $subtitulo = "EDITAR CRITERIO";
        $tabla = DB::table('pedcrisep')
        ->where('id','=',$id)
        ->first();
        return view("seped.pedcrisep.edit",["menu" => "Grupos",
                                            "tabla" => $tabla,
                                            "cfg" => DB::table('cfg')->first(),
                                            "subtitulo" => $subtitulo]);
    }

    public function update(Request $request, $id) {

        $tabla = DB::table('pedcrisep')
        ->where('id','=',$id)
        ->where('origenPromDias','>',0)
        ->first();
        if ($tabla) {
            session()->flash('error', 'Criterio '.$id.' no se puede modificar ya que esta asignado a una promoción x dias');
        } else {
            DB::table('pedcrisep')
            ->where('id','=',$id)
            ->update(array('descrip' => $request->get('descrip'),
                'criterio' => $request->get('criterio'),
                'diasCredito' => $request->get('diasCredito'),
                'estado' => $request->get('estado')
            ));
        }
        return Redirect::to('/seped/pedcrisep');
    }

    public function destroy($id) {
        try {

            $tabla = DB::table('pedcrisep')
            ->where('id','=',$id)
            ->where('origenPromDias','>',0)
            ->first();
            if ($tabla) {
                session()->flash('error', 'Criterio '.$id.' no se puede eliminar ya que esta asignado a una promoción x dias');
            }
            else {
                DB::beginTransaction();
                $regs = DB::table('pedcrisep')
                ->where('id','=',$id)
                ->delete();
                DB::commit();
                session()->flash('message', 'Criterio '.$id.' eliminado satisfactoriamente');
            }
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }
        return Redirect::to('/seped/pedcrisep');
    }

}
