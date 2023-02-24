<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use DB;

class BlogController extends Controller
{
    public function __construct()
    {
    	//$this->middleware('auth');
    }

    public function index(Request $request) {
    	if ($request)
    	{
    		$id = trim($request->get('id'));
    		$blog = DB::table('blogs')
    		->where('id','=',$id)
    	    ->first();
       		return view('blog' ,['blog' => $blog,
                                 "cfg" => DB::table('cfg')->first()  ]);
    	}
    }
    
}
