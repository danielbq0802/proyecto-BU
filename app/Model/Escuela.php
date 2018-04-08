<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    protected $table='escuela';
	protected $primaryKey='id_escuela';
	public $incrementing=true;
	public $timestamps=false;
	protected $fillable = [
        'nombre', 'siglas', 'grupo',
    ];
	public function estudiantes()
	{
	return $this->hasMany('App\Model\Estudiante','id_escuela', 'id_escuela');
	}
	public function cuposprogramados()
	{
	return $this->hasMany('App\Model\CupoProgramado','id_escuela', 'id_escuela');
	}
}
