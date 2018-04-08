<?php

use App\Model\Usuario;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/panel','backend\PanelController@index')->middleware('ident');
Route::get('/semestre','backend\SemestreController@index')->middleware('ident');
Route::match(['get','post'],'/semestre/registrar','backend\SemestreController@registrar')->middleware('ident');
Route::match(['get','post'],'/semestre/{id_semestre}/editar','backend\SemestreController@editar')->middleware('ident');

//rutas para escuela
Route::get('/escuela','backend\EscuelaController@index')->middleware('ident');
Route::post('/escuela/insertar','backend\EscuelaController@insertar')->middleware('ident');
Route::post('/escuela/{id_escuela}/actualizar','backend\EscuelaController@actualizar')->middleware('ident');

//rutas para servicio
Route::get('/servicio','backend\ServicioController@index')->middleware('ident');
Route::post('/servicio/insertar','backend\ServicioController@insertar')->middleware('ident');
Route::post('/servicio/{id_escuela}/actualizar','backend\ServicioController@actualizar')->middleware('ident');

//rutas para usuario
Route::get('/usuario','backend\UsuarioController@index')->middleware('ident');
Route::post('/usuario/insertar','backend\UsuarioController@insertar')->middleware('ident');
Route::post('/usuario/{id_escuela}/actualizar','backend\UsuarioController@actualizar')->middleware('ident');

//rutas para cambiar de contraseña
Route::match(['get','post'],'/cambiarPassword','backend\UsuarioController@cambiarPassword')->middleware('ident');
//Route::get('/consumo','PruebaController@index')->middleware('ident');
//rutas para estudiante
Route::get('/estudiante','backend\EstudianteController@index')->middleware('ident');
Route::post('/estudiante/insertar','backend\EstudianteController@insertar')->middleware('ident');
Route::post('/estudiante/{codigo}/actualizar','backend\EstudianteController@actualizar')->middleware('ident');
//rutas para beneficiario
Route::get('/beneficiario','backend\BeneficiarioController@index')->middleware('ident');
Route::match(['get','post'],'/beneficiario/registrar','backend\BeneficiarioController@registrar')->middleware('ident');
Route::post('/beneficiario/eliminar','backend\BeneficiarioController@eliminar')->middleware('ident');
Route::post('/beneficiario/{id_beneficiario}/actualizar','backend\BeneficiarioController@actualizar')->middleware('ident');



//Route::get('/estudiante','backend\EstudianteController@index')->middleware('ident');
//Route::post('/consumo', 'PruebaController@procesar')->middleware('ident');
//rutas cupo programado
Route::get('/cupoprogramado','backend\CupoProgramadoController@index')->middleware('ident');
Route::post('/cupoprogramado/insertar','backend\CupoProgramadoController@insertar')->middleware('ident');
Route::post('/cupoprogramado/actualizar','backend\CupoProgramadoController@actualizar')->middleware('ident');


//Route::get('/excelestudiantes','PruebaController@exportarExcel');
Route::get('/subirExcel','PruebaController@importarExcel');
Route::post('/subirExcel','PruebaController@procesarExcel');
//Route::match(['get','post'],'/subirFoto','PruebaController@subirFoto');

/*Route::get('/cambiarPassword',function(){
	 $usuario=Usuario::find(1);
        $usuario->password=\Hash::make('73219797');
        $usuario->save();
        echo " clave cambiada correctamente";
});*/

Route::get('/crearusuario', 'UsuarioController@insertar');
Route::get('/home', 'HomeController@index');

//Route::get('/home', 'HomeController@index');
//rutas de login
Route::post('/iniciarSesion', 'LoginController@iniciarSesion');
Route::get('/cerrarSesion', 'LoginController@cerrarSesion');

Route::get('/log', 'LoginController@index');











