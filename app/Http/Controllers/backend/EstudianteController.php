<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Estudiante;
use App\Model\Escuela;

class EstudianteController extends Controller
{
    public function index(Request $request){
    	$parametro=$request->get('parametro');
    	if ($parametro!=null) {
    		$escuelas=Escuela::pluck('nombre','id_escuela')->prepend('Seleccione');
          	$estudiantes=Estudiante::where('codigo_universitario',$parametro)->orWhere('dni',$parametro)->orWhere('apellidos','like','%'.$parametro.'%')->orWhere('nombres','like','%'.$parametro.'%')->orderBy('id_escuela', 'ASC')->paginate(15);
        }
        else{
        	$escuelas=Escuela::pluck('nombre','id_escuela')->prepend('Seleccione');
            $estudiantes=Estudiante::orderBy('id_escuela', 'ASC')->paginate(15);
        }

        return view('estudiante.index',compact('estudiantes','escuelas','parametro'));	
    }

    public function insertar( Request $request){
    
    	if ($request->ajax()) {
         //'descripcion' => 'bail|required|unique:semestre,descripcion,'.$request->id_semestre.',id_semestre|max:7',
    		$this->validate($request,[
    			'codigo_universitario'=>'bail|required|digits:6|unique:estudiante,codigo_universitario',
    			'dni'=>'bail|sometimes|digits:8|unique:estudiante,dni',
    			'nombres'=>'bail|required|max:30',
    			'apellidos'=>'bail|required|max:30',
    			'id_escuela'=>'required|exists:escuela,id_escuela']);

      		$estudiante = new Estudiante();
      		$estudiante->codigo_universitario=$request->codigo_universitario;
      		$estudiante->dni=$request->dni;
      		$estudiante->nombres=$request->nombres;
      		$estudiante->apellidos=$request->apellidos;
      		$estudiante->id_escuela=$request->id_escuela;
      		$estudiante->matriculado=0;
    		$estudiante->save();
    		return response()->json(["mensaje"=>" Estudiante registrado correctamente !!","parametro"=>"insercion"]);
           
        }

    }
     public function actualizar( $codigo_universitario, Request $request){
    
    	if ($request->ajax()) {
         //'descripcion' => 'bail|required|unique:semestre,descripcion,'.$request->id_semestre.',id_semestre|max:7',
    		//dd($request->all());
    		$this->validate($request,[
    			'codigo_universitario'=>'bail|required|digits:6|unique:estudiante,codigo_universitario,'.$codigo_universitario.',codigo_universitario',
    			'dni'=>'sometimes|nullable|digits:8|unique:estudiante,dni,'.$codigo_universitario.',codigo_universitario',
    			'nombres'=>'bail|required|max:30',
    			'apellidos'=>'bail|required|max:30',
    			'id_escuela'=>'bail|required|exists:escuela,id_escuela']);

      		$estudiante =Estudiante::find($codigo_universitario);
      		//$estudiante->codigo_universitario=$request->codigo_universitario;
      		$estudiante->dni=$request->dni;
      		$estudiante->nombres=$request->nombres;
      		$estudiante->apellidos=$request->apellidos;
      		$estudiante->id_escuela=$request->id_escuela;
      		$estudiante->matriculado=0;
    		$estudiante->save();
    		return response()->json(["mensaje"=>"Datos  de estudiante actualizados correctamente !!","parametro"=>"edicion"]);
           
        }

    }
}
