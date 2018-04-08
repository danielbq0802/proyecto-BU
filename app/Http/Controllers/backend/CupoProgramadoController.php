<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CupoProgramado;
use App\Model\Escuela;
use App\Model\Servicio;
use Session;
class CupoProgramadoController extends Controller
{
    public function index()
    {	 
   		//$cupos=CupoProgramado::with('Escuela')->where('id_semestre',Session::get('id_semestre'))->get();
   		$cuposEscuela = Escuela::with(['cuposprogramados' => function ($query) {
	    	$query->where('id_semestre',Session::get('id_semestre'));
		}])->get();

        $escuelas=Escuela::all();
        $desayunoNoProgramados=$this->listaServiciosNoAsignados(1);
        $almuerzoNoProgramados=$this->listaServiciosNoAsignados(2);
       //dd($almuerzoNoProgramados);
        //dd($desayunoNoProgramados);
        //dd($escuelas);
        return view('cupo.index',compact('escuelas','cuposEscuela','desayunoNoProgramados','almuerzoNoProgramados'));
    }
   public function insertar( Request $request){
      
    
        if ($request->ajax()) {
             $this->validate($request,['cantidad'=>'bail|required|numeric|cupo_unico:'.$request->id_servicio.','.$request->id_escuela.','.Session::get('id_semestre'),'id_escuela'=>'bail|required|exists:escuela,id_escuela','id_servicio'=>'required|exists:servicio,id_servicio']);
            
           $cupoprogramado = new CupoProgramado();
            $cupoprogramado->cantidad=$request->cantidad;
            $cupoprogramado->id_escuela=0;
            $cupoprogramado->id_servicio=$request->id_servicio;
            $cupoprogramado->id_escuela=$request->id_escuela;
            $cupoprogramado->id_semestre=Session::get('id_semestre');
            $cupoprogramado->save();
            return response()->json(["mensaje"=>" Cupo registrado correctamente !!","parametro"=>"insercion"]);
        
            
        }
        
    }
    public function actualizar( Request $request){
      
    
    if ($request->ajax()) {
             $this->validate($request,['cantidad'=>'bail|required|numeric','id_cupoprogramado'=>'bail|required|numeric|exists:cupo_programado,id_cupoprogramado']);
            
           $cupoprogramado = CupoProgramado::find($request->id_cupoprogramado);
            $cupoprogramado->cantidad=$request->cantidad;
            $cupoprogramado->save();
            return response()->json(["mensaje"=>" Cupo actualizado correctamente !!","parametro"=>"edicion"]);
        
            
        }
        
    }

     //desayunos
    private function listaServiciosNoAsignados($id_servicio){
    	$cuposNoProgramados=array();
    	//$lista=CupoProgramado::where('id_escuela',1)->where()
    	$servicio=Servicio::find($id_servicio);
    	
    	$escuelas=Escuela::all();
    	foreach ($escuelas as $escuela) {
    		$cupo=CupoProgramado::with('Escuela')->where('id_semestre',Session::get('id_semestre'))->where('id_escuela',$escuela->id_escuela)->where('id_servicio',$id_servicio)->first();
    		
    		if (empty($cupo)) {
    			$cuposNoProgramados[]=array(
    				"id_escuela"=>$escuela->id_escuela,
    				"nombre_escuela"=>$escuela->nombre,
    				"id_servicio"=>$servicio->id_servicio,
    				"nombre_servicio"=>$servicio->descripcion
    			);	
    		}
    		else{
    			$cuposNoProgramados[]=array(
    				"id_escuela"=>$escuela->id_escuela,
    				"nombre_escuela"=>$escuela->nombre,
    				"id_servicio"=>null,
    				"nombre_servicio"=>null
    			);	

    		}

    	}
    
    	return $cuposNoProgramados;
    }
    		
    
}
