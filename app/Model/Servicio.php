<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table='servicio';
	protected $primaryKey='id_servicio';
	public $incrementing=true;
	public $timestamps=false;
	protected $fillable = [
        'descripcion', 'precio', 'estado'
    ];
	public function consumos()
	{
	return $this->hasMany('App\Model\Consumo','id_servicio', 'id_servicio');
	}
	public function cupo_programado()
	{
	return $this->hasMany('App\Model\CupoProgramado','id_servicio', 'id_servicio');
	}
	
	
}
