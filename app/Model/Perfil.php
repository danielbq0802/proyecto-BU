<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table='perfil';
    protected $primaryKey='id_perfil';
	public $timestamps=false;
	protected $fillable = [
        'nombre'
    ];

     public function usuarios()
	{
	return $this->hasMany('App\Model\Usuario','dni', 'id_perfil');
	}
	
}
