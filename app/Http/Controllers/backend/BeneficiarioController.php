<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Estudiante;
use App\Model\Beneficiario;
use App\Model\Escuela;
use Session;
use App\Model\CupoProgramado;
use DB;

class BeneficiarioController extends Controller
{
    public function index(Request $request){
    	$parametro=$request->get('parametro');

    	if ($parametro!=null) {
             $beneficiarios = DB::table('beneficiario')
            ->join('estudiante', 'beneficiario.codigo_universitario', '=', 'estudiante.codigo_universitario')
            ->join('escuela', 'escuela.id_escuela', '=', 'estudiante.id_escuela')
            ->where('beneficiario.id_semestre',Session::get('id_semestre'))->where(function ($query) use($parametro) {
                    $query->where('estudiante.codigo_universitario',$parametro)->orWhere('estudiante.dni',$parametro)->orWhere('estudiante.apellidos','like','%'.$parametro.'%')->orWhere('estudiante.nombres','like','%'.$parametro.'%')->orderBy('beneficiario.id_beneficiario', 'DESC');
                })
                            ->select('beneficiario.*', 'estudiante.*','escuela.siglas')
                            ->paginate(100);
        }
        else{
        	
             $beneficiarios = DB::table('beneficiario')
            ->join('estudiante', 'beneficiario.codigo_universitario', '=', 'estudiante.codigo_universitario')
            ->join('escuela', 'escuela.id_escuela', '=', 'estudiante.id_escuela')
            ->where('beneficiario.id_semestre',Session::get('id_semestre'))
            ->select('beneficiario.*', 'estudiante.*','escuela.siglas')->orderBy('beneficiario.id_beneficiario', 'DESC')
            ->paginate(100);
        }

        return view('beneficiario.index',compact('beneficiarios','parametro'));	
    }
  
    public function registrar( Request $request){
        if ($request->isMethod('get')) {
            $codigo=trim($request->codigo);
            if ($codigo!=null){
                $this->validate($request,['codigo'=>'required|digits_between:6,8']);//validamos los datos
               
                $codigo=substr($codigo,-6);
                $estudiante=Estudiante::whereRaw('codigo_universitario=? ',[$codigo])->first();//consulta a la BD  
                if ($estudiante) {
                     

                    $beneficiario=Beneficiario::where('codigo_universitario',$codigo)->where('id_semestre',Session::get('id_semestre'))->first();
                    if (!$beneficiario) {
                     
                        return view('beneficiario.registrar',compact('estudiante','codigo'));
                        
                    }
                    else{
                         $request->session()->flash('msj-info', 'El estudiante ya se encuantra  registrado como beneficiario en el presente semestre '.Session::get('nombre_semestre'));
                          
                          return redirect('/beneficiario/registrar');  
                    }
                }else{
                     $request->session()->flash('msj-warning', 'El estudiante no se encuentra registrado en la base de datos');
                    return redirect('/beneficiario/registrar');  

                }          
            }else{
                  return view('beneficiario.registrar',compact('codigo'));     
            }
            
           
        }//si viene por post
        else{
             $this->validate($request,['tipo'=>'bail|required|in:Regular,Becado','observacion'=>'bail|max:100','codigo_universitario'=>'bail|required|digits:6']);//validamos los datos
                $codigo=trim($request->codigo_universitario);

                $codigo=substr($codigo,-6);

              
                try {
                    DB::beginTransaction();//iniciamos la transaccion
                      $estudiante=Estudiante::whereRaw('codigo_universitario=? ',[$codigo])->first();//consulta a la BD 
                    if ($estudiante) {
                        //verificamos  la cantidad de cupos de la escuela
                        
                        $beneficiario=Beneficiario::where('codigo_universitario',$codigo)->where('id_semestre',Session::get('id_semst'))->first();
                        if (!$beneficiario) {
                            $cupo=CupoProgramado::where('id_semestre',Session::get('id_semestre'))->where('id_escuela',$estudiante->id_escuela)->where('id_servicio',2)->first();
                            if ($cupo) {
                                if ($cupo->cantidad>$cupo->ocupado) {
                                $cupo->ocupado=$cupo->ocupado+1;
                                $cupo->save();
                                $beneficiario= new Beneficiario();
                                $beneficiario->id_semestre=Session::get('id_semestre');
                                $beneficiario->tipo=$request->tipo;
                                $beneficiario->estado=1;
                                $beneficiario->observacion=$request->observacion;
                                $beneficiario->codigo_universitario=$codigo;
                                $beneficiario->save();
                                 DB::commit();//confirmamos la transaccion
                                $request->session()->flash('msj-success', 'Estudiante con código universitario: '.$codigo.' fue registrado correctamente en la lista de beneficiarios');
                                return redirect('beneficiario/registrar');
                            }else{
                                  $request->session()->flash('msj-warning', 'Los cupos programados para '.$estudiante->escuela->nombre.' ya estan completos');
                                return redirect('beneficiario/registrar');
                            }  
                            }else{
                                $request->session()->flash('msj-error', 'No se han asignado cupos para '.$estudiante->escuela->nombre.' en el servicio de Almuerzo');
                                return redirect('beneficiario/registrar'); 
                            }
                        }
                        else{
                             $request->session()->flash('msj-warning', 'El estudiante ya se encuantra  registrado como beneficiario en el presente semestre '.Session::get('nombre_semestre'));
                            return redirect()->back();    
                        }
                    } else{
                         $request->session()->flash('msj-warning', 'El estudiante no se encuentra registrado en la base de datos');
                        return redirect()->back();
                    }
                     
                 } catch (Exception $e) {
                     DB::rollback();//si se produce algun error al insertar, restablecemos la bd a como estaba antes
                      $request->session()->flash('msj-error', 'Ocurrio un error , intentelo otra vez');
                        return redirect('beneficiario/registrar');
                 } 

        }      
    }
    public function tablaResumen(Request $request){
        if ($request->ajax()) {
             $escuelas=DB::table('escuela')
              ->join('estudiante', 'escuela.id_escuela', '=', 'estudiante.id_escuela')
            ->join('beneficiario', 'beneficiario.codigo_universitario', '=', 'estudiante.codigo_universitario')
             ->where('beneficiario.id_semestre',Session::get('id_semestre'))->select('escuela.nombre',DB::raw('COUNT(escuela.id_escuela) AS total'))->groupBy('escuela.nombre')->get(); 
                 return response()->json(view('beneficiario.registrar',compact('escuelas')))->render();
                 
        }
       
    }
    public function eliminar(Request $request){

        $beneficiario=Beneficiario::find($request->id_beneficiario);

        if ($beneficiario) {
            
            $beneficiario->delete();
            $request->session()->flash('msj-success', 'Beneficiario Eliminado correctamete');

            return redirect()->back();
        }
        else{
            
            $request->session()->flash('msj-error', 'Ocurrio un error al intentar eliminar el registro');   
            return redirect()->back();
        }

    }
}
