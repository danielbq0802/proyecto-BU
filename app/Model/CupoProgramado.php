<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CupoProgramado extends Model
{
    protected $table='cupo_programado';
	protected $primaryKey='id_cupoprogramado';
	public $incrementing=true;
	public $timestamps=false;
	protected $fillable = [
        'id_cupoprogramado', 'cantidad','id_escuela','id_semestre','id_servicio'
    ];
	public function semestre(){
		return $this->belongsTo('App\Model\Semestre','id_semestre');
	}
	public function servicio(){
		return $this->belongsTo('App\Model\Servicio','id_servicio');
	}
	public function escuela(){
		return $this->belongsTo('App\Model\Escuela','id_escuela');
	}
}
