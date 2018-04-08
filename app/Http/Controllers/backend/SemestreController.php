<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Model\Semestre;
use App\Http\Controllers\Controller;
use Session;

class SemestreController extends Controller
{
    public function index( Request $request)
    {	 $descripcion=$request->get('descripcion');
    if ($descripcion!=null) {
          $semestres=Semestre::where('descripcion',"like","%$descripcion%")->paginate(15);
        }
        else{
            $semestres=Semestre::paginate(15);
        }
       
        return view('semestre.index',compact('semestres','descripcion'));
    }
    public function registrar( Request $request){
    	if ($request->isMethod('get')) {
    		 return view('semestre.crear');		
    	}
        if ($request->isMethod('post')) {
            $this->validate($request, [
            'descripcion' => 'required|unique:semestre|max:7',
            'estado' => 'required|in:1,0'
            ]);	

            $semestre= new Semestre();
            $semestre->descripcion=$request->descripcion;
            $semestre->estado=$request->estado;
           
            if ( $semestre->save()) {
                Session::flash('msj-success','Semestre registrado Correctamente');
                return back();     
            }else{
                Session::flash('msj-error','Ocurrio un error, intentelo otra vez');
                return back();
            }
        
    	}

    }
    public function editar(Request $request){
        if ($request->isMethod('get')) {
            $semestre=Semestre::find($request->id_semestre);
             return view('semestre.editar',compact('semestre'));     
        }
        if ($request->isMethod('post')) {

            $this->validate($request, [
            'descripcion' => 'bail|required|max:7|unique:semestre,descripcion,'.$request->id_semestre.',id_semestre',
            'estado' => 'required|in:1,0'
            ]); 

            $semestre= Semestre::find($request->id_semestre);

            $semestre->descripcion=$request->descripcion;
            $semestre->estado=$request->estado;
           
            if ( $semestre->save()) {
                Session::flash('msj-success','Semestre editado correctamente');
                return back();     
            }else{
                Session::flash('msj-error','Ocurrio un error, intentelo otra vez');
                return back();
            }
        }        
    }
}
