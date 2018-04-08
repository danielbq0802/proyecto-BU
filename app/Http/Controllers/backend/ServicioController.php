<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Servicio;

class ServicioController extends Controller
{
    public function index( Request $request)
    {	 
    	$descripcion=$request->get('descripcion');
    	if ($descripcion!=null) {
          $servicios=Servicio::where('descripcion',"like","%$descripcion%")->paginate(10);
        }
        else{
            $servicios=Servicio::paginate(10);
        }
       
        return view('servicio.index',compact('servicios','descripcion'));
    }
    public function insertar( Request $request){
    
    	if ($request->ajax()) {
        
    		$this->validate($request,['descripcion'=>'required','precio'=>'required','estado'=>'in:0,1']);
      		$servicio = new Servicio();
      		$servicio->descripcion=$request->descripcion;
      		$servicio->precio=$request->precio;
      		$servicio->estado=$request->estado;
    		$servicio->save();
    		return response()->json(["mensaje"=>" Servicio registrado correctamente !!","parametro"=>"insercion"]);
           
        }

    }
    public function actualizar( Request $request,$id_servicio){
    
    	if ($request->ajax()) {
        
    		$this->validate($request,['id_servicio'=>'required','descripcion'=>'required','precio'=>'required','estado'=>'in:0,1']);
      		$servicio = Servicio::find($id_servicio);
      		$servicio->descripcion=$request->descripcion;
      		$servicio->precio=$request->precio;
      		$servicio->estado=$request->estado;
    		$servicio->save();
    		return response()->json(["mensaje"=>" Servicio modificada correctamente !!","parametro"=>"edicion"]);
           
        }

    }
}
