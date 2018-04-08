<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table='estudiante';
	protected $primaryKey='codigo_universitario';
	//public $incrementing=true;
	public $timestamps=false;
	protected $casts=['codigo_universitario' => 'string','dni'=>'string', 'nombres'=>'string','apellidos'=>'string','id_escuela'=>'int','matriculado'=>'int'];

	protected $fillable = [
        'codigo_universitario', 'dni', 'nombres','apellidos','id_escuela','matriculado'
    ];

    public function escuela(){
		return $this->belongsTo('App\Model\Escuela','id_escuela');
	}
	public function beneficiarios()
	{
	return $this->hasMany('App\Model\Beneficiario','codigo_universitario', 'codigo_universitario');
	}

}
