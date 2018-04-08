<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Escuela;

class EscuelaController extends Controller
{
	public function index( Request $request)
    {	 
    	$nombre=$request->get('nombre');
    	if ($nombre!=null) {
          $escuelas=Escuela::where('nombre',"like","%$nombre%")->paginate(10);
        }
        else{
            $escuelas=Escuela::paginate(10);
        }
       
        return view('escuela.index',compact('escuelas','nombre'));
    }
     public function insertar( Request $request){
    
    	if ($request->ajax()) {
        
    		$this->validate($request,['nombre'=>'required','siglas'=>'required','grupo'=>'in:A,B,C']);
      		$escuela = new Escuela();
      		$escuela->nombre=$request->nombre;
      		$escuela->siglas=$request->siglas;
      		$escuela->grupo=$request->grupo;
    		$escuela->save();
    		return response()->json(["mensaje"=>" Escuela registrada correctamente !!","parametro"=>"insercion"]);
           
        }

    }
    public function actualizar( Request $request,$id_escuela){
    
    	if ($request->ajax()) {
        
    		$this->validate($request,['id_escuela'=>'required','nombre'=>'required','siglas'=>'required','grupo'=>'in:A,B,C']);
      		$escuela = Escuela::find($id_escuela);
      		$escuela->nombre=$request->nombre;
      		$escuela->siglas=$request->siglas;
      		$escuela->grupo=$request->grupo;
    		$escuela->save();
    		return response()->json(["mensaje"=>" Escuela modificada correctamente !!","parametro"=>"edicion"]);
           
        }

    }
}
