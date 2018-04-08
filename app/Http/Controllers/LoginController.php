<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Usuario;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use Session;
class LoginController extends Controller
{
	public function index(){
		$this->bloqueo();//llamamos a la funcion de bloqueo 
		return view('welcome');
	}
    public function iniciarSesion(Request $request){
    	
    	if ($this->bloqueo()) {return back();}//llamamos a la funcion de bloqueo 
    	$this->validate($request,['dni'=>'required|digits:8','password'=>'required']);//validamos los datos
		$usuario=Usuario::whereRaw('dni=? and estado=1',[trim($request->get('dni'))])->first();//consulta a la BD
		
			if ($usuario && Hash::check(trim($request->get('password')),$usuario->password)) {
				$request->session()->put('id_usuario', $usuario->id_usuario);
				$request->session()->put('nombre', $usuario->nombres);
				$request->session()->put('id_perfil', $usuario->id_perfil);
                $request->session()->put('id_semestre', 1);
                 $request->session()->put('nombre_semestre','2018-I');
				$request->session()->flash('msj-success','Bienvenido '.$usuario->nombre);
				return redirect('/panel');
			}
			Session::flash('msj-error','Usuario y/o contraseña incorectos');
			
			return back();
    }

    public function cerrarSesion(Request $request){
    	$request->session()->flush();//eliminamis todas las variables de sesión
    	$request->session()->flash('msj-success','Has cerrado sessión');
    	return redirect('/');
    }

    public function bloqueo(){//funcion q bloquea el login despues de 3 intentos fallidos
    	if (Session::has('contadorBloqueo')) {
    		$contador=Session::get('contadorBloqueo');
    		 Session::put('contadorBloqueo',$contador +=1);
    		if ($contador>3 && Session::has('horaBloqueo')) {
    			$horaBloqueo=Session::get('horaBloqueo');
    			$horaActual=date('Hi');
    			if ($horaBloqueo < $horaActual) {
    				Session::forget('contadorBloqueo');//borramos la hora de bloqueo
    				Session::forget('horaBloqueo');//borramos la hora de bloqueo
    				return false;
    			}
    		}
    		if ($contador>3 && !Session::has('horaBloqueo')) {
    			Session::put('horaBloqueo',date('Hi'));
    			Session::flash('msj-error','Se ha realizado 4 intentos fallidos,intentelo otra vez en 1 minuto');
				return true;
    		}
    		return false;
    	}
    	else
    		Session::put('contadorBloqueo',1);
    		return false;
    }
}