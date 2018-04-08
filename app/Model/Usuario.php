<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuario';
    protected $primaryKey='id_usuario';
	public $timestamps=false;
	protected $fillable = [
        'dni','nombres','apellidos','email','password','estado','id_perfil'
    ];

      public function perfil(){
		return $this->belongsTo('App\Model\Perfil','id_perfil','id_perfil');
	}
	
}
