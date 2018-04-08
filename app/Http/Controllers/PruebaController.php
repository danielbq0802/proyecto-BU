<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Estudiante;
use App\Model\Escuela;
use Session;
use Excel;
use DB;

class PruebaController extends Controller
{
    public function index()
    {   
        $escuelas=Escuela::withCount('estudiantes')->where('grupo','A')->get();
        return view('consumo',compact('escuelas')); 
    }
    public function procesar( Request $request){
    	/*if (Request::isMethod('get')) {
            return redirect->route('/');
        }*/
        $this->validate($request,['codigo'=>'required|digits_between:6,10']);//validamos los datos
		$codigo=trim($request->get('codigo'));
        if (strlen($codigo)===8) {
             $estudiante=Estudiante::whereRaw('dni=? ',[$codigo])->first();//consulta a la BD    
        }
        else{
            $codigo=substr($codigo,-6);
            $estudiante=Estudiante::whereRaw('codigo=? ',[$codigo])->first();//consulta a la BD    
        }
        $escuelas=Escuela::withCount('estudiantes')->where('grupo','A')->get();  
        if ($estudiante) {
            return view('consumo',compact('estudiante','escuelas'));    
        }
        $request->session()->flash('msj-warning', 'El alumno no se encuentra en la lista ');
        return redirect()->back();	    	
    }

    public function exportarExcel()
    {   
        $estudiantes=Estudiante::All();
         $datos;//arreglo de arreglos
         $i=1;
           foreach ($estudiantes as $estudiante) {
            $i++;
                $datos[]=[$estudiante->codigo, $estudiante->dni,$estudiante->nombre,$estudiante->apellido,$estudiante->escuela_id];
            }
        Excel::create('Lista de estudiantes', function($excel) use($datos,$i)
        {
            $excel->sheet('Hoja 1', function($sheet) use($datos,$i)
            {
                $sheet->setOrientation('landscape');
                //$sheet->mergeCells('A1:E1');
                $sheet->setAutoSize(true);
                //$sheet->setHeight(1,50);

                $sheet->cells('A1:E1',function($cells){
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                    //$cells->setBackground('#1497cc');
                    $cells->setBackground('#2467BA');
                    $cells->setFontColor('#ffffff');
                    $cells->setFontSize(12);
                   
                });

                $sheet->setBorder('A2:E'.$i, 'thin');//borde de todo
                $sheet->cell('A1', function($cell){$cell->setValue('CODIGO');});
                $sheet->cell('B1', function($cell){$cell->setValue('DNI');});
                $sheet->cell('C1', function($cell){$cell->setValue('NOMBRE');});
                $sheet->cell('D1', function($cell){$cell->setValue('APELLIDO');});
                $sheet->cell('E1', function($cell){$cell->setValue('ESCUELA_ID');});   

               $sheet->fromArray($datos,null,'A2',false,false);//aqui se forma la matriz con los datos

                          
            });
        })->export('xls');
        
        
    }
    public function importarExcel(){
        return view('subirExcel');

    }
    public function procesarExcel(Request $request){
        set_time_limit(180);
        $archivo=$request->file('archivo');
        $nombreOriginal=$archivo->getClientOriginalName();
        //$r1=\Storage::disk('archivos')->put($nombreOriginal,\File::get($archivo));
        $r1= $request->file('archivo')->move(public_path().'/archivos/', $nombreOriginal);
        if ($r1) {
           
               Excel::selectSheetsByIndex(0)->load('public/archivos/'.$nombreOriginal,function($hoja){
             
                $hoja->each(function($fila){
                  
                    $codigo=Estudiante::where('codigo_estudiante',$fila->CODIGO_ESTUDIANTE)->first();
                        
                    if (count($codigo)==0) {

                        $estudiante= new Estudiante;
                        $estudiante->codigo_estudiante=$fila->codigo_estudiante;
                        //$estudiante->dni=$fila->dni;
                        $estudiante->nombres=$fila->nombres;
                        $estudiante->apellidos=$fila->apellidos;
                        $estudiante->id_escuela=$fila->id_escuela;
                        $estudiante->save();
                        
                    }
                });

            });
            $request->session()->flash('msj-success',' Alumnos registrados correctamente');
            return redirect()->back();
        }
         $request->session()->flash('msj-error',' Ocurrio un error al subir el archivo');
            return redirect()->back();
    }
    public function subirFoto(Request $request){
        if ($request->isMethod('get')) {
            return view('subirFoto');
        }
         if ($request->isMethod('post')) {

            $archivo=$request->file('archivo');
            $nombreOriginal=$archivo->getClientOriginalName();
            $r1=\Storage::disk('local')->put($nombreOriginal,\File::get($archivo));
            $request->session()->flash('msj-success',' foto subida correctamente!!!');
            return redirect()->back();
        }
    }

    public function cambiarPassword(){
        $estudiante=Estudiante::find('73219797');
        $estudiante->password=\Hash::make('73219797');
        $estudiante->save();
        echo " clave cambiada correctamente";
    }

}
