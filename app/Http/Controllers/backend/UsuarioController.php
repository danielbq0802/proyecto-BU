<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Usuario;
use App\Model\Perfil;
use Session;

class UsuarioController extends Controller
{
    public function index( Request $request)
    {	 
    	$perfiles=Perfil::pluck('nombre','id_perfil')->prepend('Seleccione');
    	$nombres=$request->get('nombres');
    	if ($nombres!=null) {
          $usuarios=Usuario::where('nombres',"like","%$nombres%")->paginate(10);
        }
        else{
            $usuarios=Usuario::paginate(10);
        }
       
        return view('usuario.index',compact('usuarios','perfiles','nombres'));
    }
    public function insertar( Request $request){
    
    	if ($request->ajax()) {
        
    		$this->validate($request,['dni'=>'required','nombres'=>'required','apellidos'=>'required','email'=>'required','estado'=>'in:0,1','id_perfil'=>'required|exists:perfil,id_perfil']);
      		$usuario = new Usuario();
      		$usuario->dni=$request->dni;
      		$usuario->nombres=$request->nombres;
      		$usuario->apellidos=$request->apellidos;
      		$usuario->email=$request->email;
      		 $usuario->password=\Hash::make($request->dni);
      		$usuario->estado=$request->estado;
      		$usuario->id_perfil=$request->id_perfil;

    		$usuario->save();
    		return response()->json(["mensaje"=>" usuario registrado correctamente !!","parametro"=>"insercion"]);
           
        }

    }
    public function actualizar( Request $request,$id_usuario){
    
    	if ($request->ajax()) {
        
    		$this->validate($request,['dni'=>'required','nombres'=>'required','apellidos'=>'required','email'=>'required','estado'=>'in:0,1','id_perfil'=>'required']);
      		$usuario = Usuario::find($id_usuario);

      		$usuario->dni=$request->dni;
      		$usuario->nombres=$request->nombres;
      		$usuario->apellidos=$request->apellidos;
      		$usuario->email=$request->email;
      		$usuario->estado=$request->estado;
      		$usuario->id_perfil=$request->id_perfil;
    		$usuario->save();
    		return response()->json(["mensaje"=>" usuario modificado correctamente !!","parametro"=>"edicion"]);
           
        }

    }
      public function cambiarPassword( Request $request){
    	if ($request->isMethod('get')) {
    		 return view('usuario.cambiarClave');		
    	}
        if ($request->isMethod('post')) {
           $this->validate($request,
                    ['password'=>'required',
                      'nuevo_password'=>'required|min:8',
                      'repetir_nueva'=>'required|same:nuevo_password'
                    ],['password.required'=>'El campo contraseña es obligatorio','nuevo_password.required'=>'El campo contraseña nueva es obligatorio','repetir_nueva.required'=>'El campo repetir contraseña es obligatorio','repetir_nueva.same'=>'Los campos nueva contraseña y repita nueva no coinciden']

                );

           $usuario=Usuario::find(Session::get('id_usuario'));

         if ($usuario && \Hash::check(trim($request->password),$usuario->password)) {

                
               $usuario->password=\Hash::make($request->nuevo_password);
               if ($usuario->save()) {
                   Session::flash('msj-success','Contraseña cambiada correctamente !!');
                    return redirect()->back(); 
               }
               else{
                   Session::flash('msj-error','Ocurrio un error, intentalo otra vez !!');
                    return redirect()->back();
               }
            
                
        }
         Session::flash('msj-error','La contraseña actual es incorrecta   !!');
            return redirect()->back();
        
    	}

    }
}
