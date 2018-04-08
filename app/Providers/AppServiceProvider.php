<?php

namespace App\Providers;
use Validator;
use Illuminate\Support\ServiceProvider;
use App\Model\CupoProgramado;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('cupo_unico', function ($attribute, $value, $parameters, $validator) {
            
           $id_servicio=$parameters[0];
           $id_escuela=$parameters[1];
           $id_semestre=$parameters[2];

           $cupos=CupoProgramado::where('id_semestre',$id_semestre)->where('id_escuela',$id_escuela)->where('id_servicio',$id_servicio)->first();

           if ($cupos) {
               return false;
           }
           else{
            return true;
           }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
 