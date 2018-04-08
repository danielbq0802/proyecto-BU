<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
     protected $table='semestre';
	protected $primaryKey='id_semestre';
	//public $incrementing=true;
	public $timestamps=false;

	protected $fillable = [
        'id_semestre', 'descripcion','estado',
    ];

    public static function BuscarSemestre($nombre){
        return DB::table('pelicula')
        ->join('genero','genero.id','=','pelicula.genero_id')
        ->where('pelicula.nombre',"LIKE","%$name%")
        ->orwhere('genero.nombre',"LIKE","%$name%")
        ->select('pelicula.*','genero.nombre AS genero')
        ->orderBy('id','DESC')->paginate(3);
    }

   /* public function escuela(){
		return $this->belongsTo('App\Model\Escuela','id_escuela');
	}*/

}
