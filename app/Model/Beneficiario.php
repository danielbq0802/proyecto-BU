<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $table='beneficiario';
	protected $primaryKey='id_beneficiario';
	public $incrementing=true;
	public $timestamps=false;
	protected $fillable = [
        'id_semestre', 'codigo_universitario', 'tipo','estado','opservacion'
    ];
	

	 public function estudiante(){
		return $this->belongsTo('App\Model\Estudiante','codigo_universitario','codigo_universitario');
	}
	public function semestre(){
		return $this->belongsTo('App\Model\Semestre','id_semestre','id_semestre');
	}
}
